<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-6 font-weight-bold">
                        Purchase Orders
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Supplier Name</th>
                                    <th>Date Created</th>
                                    <th>Due Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="pos in purchase_orders" :key="pos.purchase_order_id" :class="{ 'table-danger' : pos.terminated == 1, 'table-success' :pos.terminated == 2}">
                                    <td>{{ pos.created_at | myDate }} - {{ pos.purchase_order_id | numeral2 }}</td>
                                    <td>{{ pos.purchase_request.supplier.supplier_name }}</td>
                                    <td>{{ pos.created_at | myDate3 }} {{ pos.created_at | time1 }}</td>
                                    <td>{{ pos.date_of_delivery | myDate3 }}</td>
                                    <td>
                                        <div id="print" class="mb-2">
                                            <button type="button" class="btn btn-sm btn-primary" @click="view_po(pos)"><i class="fas fa-eye"></i></button>
                                            <button type="button" class="btn btn-sm btn-success" @click="track_po(pos)"><i class="fas fa-truck"></i></button>
                                            <router-link v-show="pos.terminated == 1" class="btn btn-sm btn-danger" :to="{ name: 'ntt', params: { id: pos.purchase_order_id }}"><i class="fas fa-print"></i> Notice to Terminate</router-link>
                                        </div>
                                        <div id="document_tracking" class="">
                                            <div v-show="current_user.role_id == 4">
                                                <button type="button" class="btn btn-sm btn-success" v-show="!pos.purchase_request.mmo_rcv" @click="mmo_rcv(pos.purchase_order_id)"><i class="fas fa-file-download"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="poModal" tabindex="-1" role="dialog" aria-labelledby="poModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{ view_po_form.created_at | myDate }} - {{ view_po_form.purchase_order_id | numeral2 }}
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive-sm">
                                <table class="table table-sm table-hover" style="height: 20rem !important;">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th width="20%">Description</th>
                                            <th width="10%">Ordered Quantity</th>
                                            <th>Unit Cost</th>
                                            <th>Estimated Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody  style="height: 18rem !important;">
                                        <tr v-for="(dmd,index) in view_po_form.purchase_request.view_dmd_purchase_requests" :key="dmd.dmd_id">
                                            <td>{{ index + 1}}</td>
                                            <td width="20%">{{ dmd.gendesc }} {{ dmd.dmdnost }} {{ dmd.stredesc }} {{ dmd.formdesc }} {{ dmd.brandname }}</td>
                                            <td width="10%" class="text-right">{{ dmd.order_quantity }}</td>
                                            <td class="text-right">{{ dmd.dmd_price_schedule.bid_price | currency2}}</td>
                                            <td class="text-right">{{ dmd.request_quantity * dmd.dmd_price_schedule.bid_price | currency2 }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <b>Date of Delivery:</b> {{ view_po_form.date_of_delivery }}
                            </div>
                            <div>
                                <b>ORS / BURS No.:</b> {{ view_po_form.fund_source.acronym }}-0{{ view_po_form.allotment.allotment_code }}-{{ view_po_form.uacs.current_appropriations }}-{{ view_po_form.obrs_date | myDate}}-{{ view_po_form.purchase_order_id | numeral2}}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button v-show="!view_po_form.terminated == 1" type="button" class="btn btn-sm btn-danger" @click="terminate()">Terminate</button>
                            <button v-show="!view_po_form.terminated == 1" type="button" class="btn btn-sm btn-success" @click="received_dmd()">Received</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="trackModal" tabindex="-1" role="dialog" aria-labelledby="trackModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                             {{ view_po_form.created_at | myDate }} - {{ track_po_modal.purchase_order_id | numeral2 }}
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item" :class="{ ' bg-success' : track_po_modal.div_head_rcv }">Division Head Received <div>{{ track_po_modal.div_head_rcv }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_po_modal.div_head_rls }">Division Head Released <div>{{ track_po_modal.div_head_rcv }}</div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item" :class="{ ' bg-success' : track_po_modal.pmo_rcv }">PMO Received <div>{{ track_po_modal.pmo_rcv }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_po_modal.pmo_rls }">PMO Released <div>{{ track_po_modal.pmo_rls }}</div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">  
                                        <li class="list-group-item" :class="{ ' bg-success' : track_po_modal.div_head_rcv_2 }">Division Head Received <div>{{ track_po_modal.div_head_rcv_2 }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_po_modal.div_head_rls_2 }">Division Head Released <div>{{ track_po_modal.div_head_rls_2 }}</div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item" :class="{ ' bg-success' : track_po_modal.pmo_rcv_2 }">PMO Received <div>{{ track_po_modal.pmo_rcv_2 }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_po_modal.pmo_rls_2 }">PMO Released <div>{{ track_po_modal.pmo_rls_2 }}</div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">  
                                        <li class="list-group-item" :class="{ ' bg-success' : track_po_modal.budget_rcv }">Budget Received <div>{{ track_po_modal.budget_rcv }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_po_modal.budget_rls }">Budget Released <div>{{ track_po_modal.budget_rls }}</div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item" :class="{ ' bg-success' : track_po_modal.mcc_rcv }">MCC Received <div>{{ track_po_modal.mcc_rcv }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_po_modal.mcc_rls }">MCC Released <div>{{ track_po_modal.mcc_rls }}</div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item" :class="{ ' bg-success' : track_po_modal.fmo_rcv }">FMO Received <div>{{ track_po_modal.fmo_rcv }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_po_modal.fmo_rls }">FMO Released <div>{{ track_po_modal.fmo_rls }}</div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item" :class="{ ' bg-success' : track_po_modal.pmo_rcv_3 }">PMO Received <div>{{ track_po_modal.pmo_rcv_3 }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_po_modal.pmo_rls_3 }">PMO Released <div>{{ track_po_modal.pmo_rls_3 }}</div></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="terminateModal" tabindex="-1" role="dialog" aria-labelledby="terminateModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div>
                                        <h4>Are you sure?</h4>  
                                    </div>
                                    <div>
                                        <h4>You want to terminate?</h4> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-warning">No</button>
                            <button type="button" class="btn btn-sm btn-danger" @click="terminate_po()">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            purchase_orders: [],
            view_po_form: new Form({
                purchase_order_id: '',
                purchase_request_id: '',
                uacs_code_id: '',
                uacs: '',
                allotment_id: '',
                allotment: '',
                uacs_id: '',
                fund_source_id: '',
                fund_source: '',
                date_of_delivery: '',
                terminated: '',
                purchase_request:{
                   view_dmd_purchase_requests:[],
               },
            }),
            track_po_modal: {},
            fund_cluster_form: new Form({
                purchase_order_id: '',
                uacs_code_id: '',
            }),
            allotments: {},
            uacs_codes: {},
            fund_sources: {},
            uacs:{},
        }
    },
    methods:{
        terminate(){
            $('#terminateModal').modal('show');
        },
        terminate_po(){
            axios.put('../../api/terminate_po/'+this.view_po_form.purchase_order_id).then(() => {
                this.get_pos();
                $('#terminateModal').modal('hide');
                $('#poModal').modal('hide');
            }).catch(() => {

            });
        },
        received_dmd(){
            axios.post('../../api/received_dmd',{
                items : this.view_po_form.purchase_request.view_dmd_purchase_requests,
            }).then(() => {
                this.get_pos();
                $('#poModal').modal('hide');
            }).catch(() => {

            });
        },
        get_pos(){
            axios.get('../../api/purchase_order').then(({data}) => {
                this.purchase_orders = data;
            }).catch(() => {

            });
        },
        view_po(pos){
            this.view_po_form.fill(pos);
            $('#poModal').modal('show');

        },
        track_po(pos){
            this.track_po_modal = pos;
            $('#trackModal').modal('show');

        },
        mmo_rcv(id){
            axios.put('../../api/mmo_rcv/'+id).then(() => {
                this.get_pos();
                toast.fire({
                    type: 'success',
                    title: 'PO Received'
                });
            }).catch(() => {

            });
        },
        mmo_rls(id){
            axios.put('../../api/mmo_rls/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Release'
                });
            }).catch(() => {

            });
        },
    },
    
    computed: {
        current_user() {
            return this.$store.getters.current_user;
        }
        
    },
    created(){
        this.get_pos();

    },
    mounted(){
        window.Echo.channel("pr_created").listen(".purchase_order.created", (e) => {
            this.get_pos();
        });
        window.Echo.channel("pr_updated").listen(".purchase_order.updated", (e) => {
            this.get_pos();
        });
    }
}
</script>

<style scoped>
    #d_modal_content{
        background-color: #4a5ea5fa;
        color: #d5e8e2;
    }
    .modal-content{
        background-color: #4a5ea5fa;
        color: #d5e8e2;
    }
    .modal-body{
        background-color: white;
        color: black;
    }
    ul{
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0;
    }

    ul li{
        width: 50% !important;
    }

    tr {
        width: 100%;
        display: inline-table;
        table-layout: fixed;
    }

    table {
        height:33rem;             
        display: -moz-groupbox;    
    }

    tbody {
        overflow-y: scroll;      
        height: 31rem;           
        width: 98.5%;
        position: absolute;
    }
</style>
