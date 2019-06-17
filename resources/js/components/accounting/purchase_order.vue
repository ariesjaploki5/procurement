<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-6">
                        Purchase Requests
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Status</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="pos in purchase_orders" :key="pos.purchase_order_id">
                                    <td>{{ pos.purchase_order_id }}</td>
                                    <td>
                                        <div v-show="pos.status == 0">
                                            Pending
                                        </div>
                                        <div v-show="pos.status == 1">
                                            Approved
                                        </div>
                                        <div v-show="pos.status == 2">
                                            Disapproved
                                        </div>
                                    </td>
                                    <td>{{ pos.created_at }}</td>
                                    <td>
                                        <div id="print" class="mb-2">
                                            <button type="button" class="btn btn-sm btn-primary" @click="view_po(pos)"><i class="fas fa-eye"></i></button>
                                            <button type="button" class="btn btn-sm btn-success" @click="track_po(pos)"><i class="fas fa-truck"></i></button>
                                            <router-link class="btn btn-sm btn-info" :to="{ name: 'po', params: { id: pos.purchase_order_id }}"><i class="fas fa-print"></i> PO</router-link>
                                            <router-link class="btn btn-sm btn-info" :to="{ name: 'sps', params: { id: pos.purchase_order_id }}"><i class="fas fa-print"></i> SPS</router-link>
                                        </div>
                                        <div id="document_tracking" class="">
                                            <div v-show="current_user.role_id == 7">
                                                <button type="button" class="btn btn-sm btn-success" v-show="!pos.purchase_request.accounting_rcv" @click="accounting_rcv(pos.purchase_order_id)"><i class="fas fa-file-download"></i></button>
                                                <button type="button" class="btn btn-sm btn-danger" v-show="pos.purchase_request.accounting_rcv" @click="accounting_rls(pos.purchase_order_id)"><i class="fas fa-file-upload"></i></button>
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
                            {{view_po_form.purchase_order_id}}
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
                                            <th width="10%">Quantity</th>
                                            <th>Unit Cost</th>
                                            <th>Estimated Cost</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody  style="height: 18rem !important;">
                                        <tr v-for="(dmd,index) in view_po_form.purchase_request.view_dmd_purchase_requests" :key="dmd.dmd_id">
                                            <td>{{ index + 1}}</td>
                                            <td width="20%">{{ dmd.gendesc }} {{ dmd.dmdnost }} {{ dmd.stredesc }} {{ dmd.formdesc }} {{ dmd.brandname }}</td>
                                            <td width="10%" class="text-right">
                                                <input type="number" class="form-control form-control-sm text-right" v-model="dmd.request_quantity">
                                            </td>
                                            <td class="text-right">
                                                {{ dmd.dmd_price_schedule.bid_price | currency2}}
                                            </td>
                                            <td class="text-right">
                                                {{ dmd.request_quantity * dmd.dmd_price_schedule.bid_price | currency2 }}
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                
                                            </div>
                                            <div class="card-body">
                                                <form action="">
                                                    <div class="form-group">
                                                        <div class="form-label">Fund Source</div>
                                                        <select class="form-control form-control-sm" v-model="obrs_form.fund_source_id">
                                                            <option v-for="fs in fund_sources" :key="fs.id" :value="fs.id">{{ fs.description }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-label">Allotment</div>
                                                        <select class="form-control form-control-sm" v-model="obrs_form.allotment_id">
                                                            <option v-for="al in allotments" :key="al.allotment_id" :value="al.allotment_id">{{ al.allotment_desc }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-label">UACS</div>
                                                        <select class="form-control form-control-sm" v-model="obrs_form.uacs_id">
                                                            <option v-for="uc in uacs" :key="uc.uacs_id" :value="uc.uacs_id">{{ uc.description }}</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-sm btn-success">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="trackModal" tabindex="-1" role="dialog" aria-labelledby="trackModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{track_po_modal.purchase_order_id}}
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
               purchase_request:{
                   view_dmd_purchase_requests:[],
               },
            }),
            track_po_modal: {},
            fund_cluster_form: new Form({
                purchase_order_id: '',
                uacs_code_id: '',
            }),
            obrs_form: new Form({
                purchase_order_id: '',
                uacs_code_id: '',
                allotment_id: '',
                uacs_id: '',
            }),

            allotments: {},
            uacs_codes: {},
            fund_sources: {},
            uacs:{},
        }
    },
    methods:{
        get_uacs(){
            axios.get('../../api/uacs').then(({data}) => {
                this.uacs = data;
            }).catch(() => {

            });
        },
        get_fund_sources(){
            axios.get('../../api/fund_source').then(({data}) => {
                this.fund_sources = data;
            }).catch(() => {

            });
        },
        get_uacs_codes(){
            axios.get('../../api/uacs_code').then(({data}) => {
                this.uacs_codes = data;
            }).catch(() => {

            });
        },
        get_allotments(){
            axios.get('../../api/allotment').then(({data}) => {
                this.allotments = data;
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
            this.obrs_form.purchase_order_id = pos.purchase_order_id;
            $('#poModal').modal('show');
        },
        track_po(pos){
            this.track_po_modal = pos;
            $('#trackModal').modal('show');
        },

        accounting_rcv(id){
            axios.put('../../api/accounting_rcv/'+id).then(() => {

            }).catch(() => {

            });
        },
        accounting_rls(id){
            axios.put('../../api/accounting_rls/'+id).then(() => {

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
        this.get_allotments();
        this.get_uacs_codes();
        this.get_fund_sources();
        this.get_uacs();
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
