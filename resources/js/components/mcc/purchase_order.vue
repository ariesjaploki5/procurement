<template>
    <div class="row">
        <div class="col-md-12">

            <div class="font-weight-bold">
                <h3 class="card-title"> Purchase Orders</h3>
            </div>

            <div class="table-responsive-sm">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Mode</th>
                            <th>Date Created</th>
                            <th>Date of Delivery</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="pos in purchase_orders" :key="pos.purchase_order_id">
                            <td>{{ pos.created_at | myDate }} - {{ pos.purchase_order_id | numeral2 }}</td>
                            <td>
                                <span v-if="pos.mode_id">{{ pos.mode.mode_desc }}</span>
                            </td>
                            <td>{{ pos.created_at }}</td>
                            <td>{{ pos.date_of_delivery }}</td>
                            <td>
                                <div id="print" class="mb-2">
                                    <button type="button" class="btn btn-sm btn-primary" @click="view_po(pos)"><i class="fas fa-eye"></i></button>
                                    <button type="button" class="btn btn-sm btn-success" @click="track_po(pos)"><i class="fas fa-truck"></i></button>
                                </div>
                                <div id="document_tracking" class="">
                                    <button type="button" v-show="pos.fmo_rls && !pos.mcc_rcv" class="btn btn-sm btn-success" @click="mcc_rcv(pos.purchase_order_id)">Received</button>
                                    <button type="button" v-show="pos.mcc_rcv && !pos.mcc_rls" class="btn btn-sm btn-danger" @click="mcc_rls(pos.purchase_order_id)">Release</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
                
         
            <div class="modal fade" id="poModal" tabindex="-1" role="dialog" aria-labelledby="poModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header font-weight-bold">
                            <h5>{{ view_po_form.created_at | myDate }} - {{ view_po_form.purchase_order_id | numeral2 }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive-sm">
                                <table class="table table-sm table-hover" style="height: 23rem !important;">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="5%">#</th>
                                            <th width="60%">Description</th>
                                            <th width="10%">Quantity</th>
                                            <th width="10%">Unit Cost</th>
                                            <th width="15%">Estimated Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody  style="height: 20rem !important;">
                                        <tr v-for="(item,index) in view_po_form.dmd_purchase_orders" :key="index">
                                            <td width="5%">{{ index + 1}}</td>
                                            <td width="60%">
                                                <tr>
                                                    <td class="text-bold">{{ item.new_dmd.dmddesc }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold text-right">Brand: </td><td class="text-left">{{ item.brand.brand_desc }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold text-right">Packaging: </td><td class="text-left" v-if="item.packaging_id">{{ item.packaging.packaging_desc }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold text-right">Manufacturer: </td><td class="text-left">{{ item.manufacturer.manufacturer_desc }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold text-right">Country of Origin: </td><td class="text-left" v-if="item.country_id">{{ item.country.country_desc }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold text-right">CPR: </td><td class="text-left"></td>
                                                </tr>
                                            </td>
                                            <td width="10%" class="text-right">
                                                <span>{{ item.order_quantity }}</span>
                                            </td>
                                            <td width="10%" class="text-right">{{ item.cost_price | currency2}}</td>
                                            <td width="15%" class="text-right">{{ item.order_quantity * item.cost_price | currency2 }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div v-if="view_po_form.date_of_delivery">
                               <b> Date of Delivery:</b> {{ view_po_form.date_of_delivery}}
                            </div>
                            
                            <div v-else></div>

                            <span v-if="view_po_form.fund_source_id && view_po_form.allotment_id && view_po_form.uacs_id ">
                               <b> ORS / BURS No.:</b> {{ view_po_form.fund_source.acronym }}-0{{ view_po_form.allotment.allotment_code }}-{{ view_po_form.uacs.current_appropriations }}-{{ view_po_form.obrs_date | myDate}}-{{ view_po_form.purchase_order_id | numeral2}}
                            </span>
                            <div v-else></div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="trackModal" tabindex="-1" role="dialog" aria-labelledby="trackModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>{{ view_po_form.created_at | myDate }} - {{ track_po_modal.purchase_order_id | numeral2 }}</h4>
                            <!-- {{track_po_modal.purchase_order_id}} -->
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
                supplier_id: '',
                supplier:{},
                fund_source_id: '',
                fund_source: {},
                amount: '',
                obrs_date: '',
                date_of_delivery: '',
                terminated: '',
                dmd_purchase_orders: [],
                current_status: '',
                delivery_term: '',
                allotment_id: '',
                allotment:{},
                uacs_id: '',
                uacs:{},
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
        
        get_pos(){
            axios.get('../../api/for_fmo').then(({data}) => {
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
        pmo_rcv_2(id){
            axios.put('../../api/pmo_rcv_2/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Received'
                });
            }).catch(() => {

            });
        },
        accounting_rcv(id){
            axios.put('../../api/accounting_rcv/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Received'
                });
            }).catch(() => {

            });
        },
        accounting_rls(id){
            axios.put('../../api/accounting_rls/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Release'
                });
            }).catch(() => {

            });
        },
        mcc_rcv(id){
            axios.put('../../api/mcc_rcv/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Received'
                });
            }).catch(() => {

            });
        },
        mcc_rls(id){
            axios.put('../../api/mcc_rls/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Release'
                });
            }).catch(() => {

            });
        },
        fmo_rcv(id){
            axios.put('../../api/fmo_rcv/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Received'
                });
            }).catch(() => {

            });
        },
        fmo_rls(id){
            axios.put('../../api/fmo_rls/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Release'
                });
            }).catch(() => {

            });
        },
        pmo_rcv_2(id){
            axios.put('../../api/pmo_rcv_2/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Received'
                });
            }).catch(() => {

            });
        },
        pmo_rls_2(id){
            axios.put('../../api/pmo_rls_2/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Release'
                });
            }).catch(() => {

            });
        },
        pmo_rcv_3(id){
            axios.put('../../api/pmo_rcv_3/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Received'
                });
            }).catch(() => {

            });
        },
        pmo_rls_3(id){
            axios.put('../../api/pmo_rls_3/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Release'
                });
            }).catch(() => {

            });
        },
        mmo_rcv(id){
            axios.put('../../api/mmo_rcv/'+id).then(() => {
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
        div_head_rcv_2(id){
            axios.put('../../api/div_head_rcv_2/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Received'
                });
            }).catch(() => {

            });
        },
        div_head_rls_2(id){
            axios.put('../../api/div_head_rls_2/'+id).then(() => {
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
        window.Echo.channel("po_created").listen(".purchase_order.created", (e) => {
            this.get_pos();
        });
        window.Echo.channel("po_updated").listen(".purchase_order.updated", (e) => {
            this.get_pos();
        });
    }
}
</script>

<style scoped>
.modal-body{
        padding-top: 0rem;
}
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
