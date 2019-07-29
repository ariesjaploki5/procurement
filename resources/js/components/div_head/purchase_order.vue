<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row mb-1 shadow p-3 mb-3 bg-white rounded">
                <h4><i class="fas fa-cart-arrow-down"></i> Purchase Order</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="pos in purchase_orders" :key="pos.purchase_order_id">
                                <td>{{ pos.created_at | myDate }} - {{ pos.purchase_order_id | numeral2 }}</td>
                                <td>{{ pos.created_at }}</td>
                                <td>
                                    <div id="print" class="mb-2">
                                        <button type="button" class="btn btn-sm btn-primary" @click="view_po(pos)"><i class="fas fa-eye"></i></button>
                                        <button type="button" class="btn btn-sm btn-success" @click="track_po(pos)"><i class="fas fa-truck"></i></button>
                                        <router-link class="btn btn-sm btn-success" :to="{ name: 'po', params: { id: pos.purchase_order_id }}"><i class="fas fa-print"></i> PO</router-link>
                                        <router-link class="btn btn-sm btn-success" :to="{ name: 'obrs', params: { id: pos.purchase_order_id }}"><i class="fas fa-print"></i> OBRS</router-link>
                                    </div>
                                    <div id="document_tracking" class="">
                                        <div v-show="current_user.role_id == 5">
                                            <button type="button" class="btn btn-sm btn-success" v-show="!pos.purchase_request.div_head_rcv_2" @click="div_head_rcv_2(pos.purchase_order_id)">Received From Pharmacy <i class="fas fa-file-download"></i></button>
                                            <button type="button" class="btn btn-sm btn-danger" v-show="pos.purchase_request.div_head_rcv_2 && !pos.purchase_request.div_head_rls_2" @click="div_head_rls_2(pos.purchase_order_id)">Send To PMO <i class="fas fa-file-upload"></i></button>
                                        </div>
                                        <div v-show="current_user.role_id == 3 && pos.purchase_request.div_rls_2">
                                            <button type="button" class="btn btn-sm btn-success" v-show="!pos.purchase_request.pmo_rcv_2" @click="pmo_rcv_2(pos.purchase_order_id)">Received From Division Head <i class="fas fa-file-download"></i></button>
                                            <button type="button" class="btn btn-sm btn-danger" v-show="pos.purchase_request.pmo_rcv_2 && !pos.purchase_request.pmo_rls_2" @click="pmo_rls_2(pos.purchase_order_id)">Send To Budget <i class="fas fa-file-upload"></i></button>
                                        </div>
                                        <div v-show="current_user.role_id == 6 && pos.purchase_request.pmo_rls_2">
                                            <button type="button" class="btn btn-sm btn-success" v-show="!pos.purchase_request.budget_rcv" @click="budget_rcv(pos.purchase_order_id)">Received From PMO <i class="fas fa-file-download"></i></button>
                                            <button type="button" class="btn btn-sm btn-danger" v-show="pos.purchase_request.budget_rcv && !pos.purchase_request.budget_rls" @click="budget_rls(pos.purchase_order_id)">Send To Accounting <i class="fas fa-file-upload"></i></button>
                                        </div>
                                        <div v-show="current_user.role_id == 7 && pos.purchase_request.budget_rls">
                                            <button type="button" class="btn btn-sm btn-success" v-show="!pos.purchase_request.accounting_rcv" @click="accounting_rcv(pos.purchase_order_id)">Received From Budget <i class="fas fa-file-download"></i></button>
                                            <button type="button" class="btn btn-sm btn-danger" v-show="pos.purchase_request.accounting_rcv && !pos.purchase_request.accounting_rls" @click="accounting_rls(pos.purchase_order_id)">Send To FMO <i class="fas fa-file-upload"></i></button>
                                        </div>
                                        
                                        <div v-show="current_user.role_id == 8 && pos.purchase_request.accounting_rls">
                                            <button type="button" class="btn btn-sm btn-success" v-show="!pos.purchase_request.fmo_rcv" @click="fmo_rcv(pos.purchase_order_id)">Received From Accounting <i class="fas fa-file-download"></i></button>
                                            <button type="button" class="btn btn-sm btn-danger" v-show="pos.purchase_request.fmo_rcv && !pos.purchase_request.fmo_rls" @click="fmo_rls(pos.purchase_order_id)">Send To MCC <i class="fas fa-file-upload"></i></button>
                                        </div>

                                        <div v-show="current_user.role_id == 9 && pos.purchase_request.fmo_rls">
                                            <button type="button" class="btn btn-sm btn-success" v-show="!pos.purchase_request.mcc_rcv" @click="mcc_rcv(pos.purchase_order_id)">Received From FMO <i class="fas fa-file-download"></i></button>
                                            <button type="button" class="btn btn-sm btn-danger" v-show="pos.purchase_request.mcc_rcv && !pos.purchase_request.mcc_rls" @click="mcc_rls(pos.purchase_order_id)">Send To PMO <i class="fas fa-file-upload"></i></button>
                                        </div>

                                        <div v-show="current_user.role_id == 3 && pos.purchase_request.mcc_rls">
                                            <button type="button" class="btn btn-sm btn-success" v-show="!pos.purchase_request.pmo_rcv_3" @click="pmo_rcv_3(pos.purchase_order_id)">Received From MCC <i class="fas fa-file-download"></i></button>
                                            <button type="button" class="btn btn-sm btn-danger" v-show="pos.purchase_request.pmo_rcv_3 && !pos.purchase_request.pmo_rls_3" @click="pmo_rls_3(pos.purchase_order_id)">Send To MMO <i class="fas fa-file-upload"></i></button>
                                        </div>
                                        <div v-show="current_user.role_id == 4 && pos.purchase_request.pmo_rls_3">
                                            <button type="button" class="btn btn-sm btn-success" v-show="!pos.purchase_request.mmo_rcv" @click="mmo_rcv(pos.purchase_order_id)">Received From PMO <i class="fas fa-file-download"></i></button>
                                            <!-- <button type="button" class="btn btn-sm btn-danger" v-show="pos.purchase_request.mmo_rcv && !pos.purchase_request.mmo_rls" @click="mmo_rls(pos.purchase_order_id)"><i class="fas fa-file-upload"></i></button> -->
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="poModal" tabindex="-1" role="dialog" aria-labelledby="poModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{ view_pr_form.created_at | myDate }} - {{ view_pr_form.purchase_order_id | numeral2 }}
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
                                            <td class="text-right">{{ dmd.dmd_price_schedule.bid_price | currency2}}</td>
                                            <td class="text-right">{{ dmd.request_quantity * dmd.dmd_price_schedule.bid_price | currency2 }}</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div v-if="view_po_form.date_of_delivery">
                                Date of Delivery: {{ view_po_form.date_of_delivery}}
                            </div>
                            <div v-else></div>
                            <div class="container" v-show="current_user.role_id == 3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <form action="">
                                                    <div class="form-group">
                                                        <div class="form-label">Date of Delivery:</div>
                                                        <input type="date" class="form-control form-control-sm" v-model="view_po_form.date_of_delivery">
                                                        <button class="btn btn-sm btn-success" type="button" @click="store_dod()">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="view_po_form.fund_source_id">
                                ORS / BURS No.: {{ view_po_form.fund_source.acronym }}-0{{ view_po_form.allotment.allotment_code }}-{{ view_po_form.uacs.current_appropriations }}-{{ view_po_form.obrs_date | myDate}}-{{ view_po_form.purchase_order_id | numeral2}}
                            </div>
                            <div v-else></div>
                            <div class="container" v-show="current_user.role_id == 6">
                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                            </div>
                                            <div class="card-body">
                                                <form @submit.prevent="store_obrs()">
                                                    <div class="form-group">
                                                        <div class="form-label">Fund Source</div>
                                                        <select v-show="current_user.role_id == 6" class="form-control form-control-sm" v-model="view_po_form.fund_source_id">
                                                            <option v-for="fs in fund_sources" :key="fs.id" :value="fs.id">{{ fs.description }}</option>
                                                        </select>

                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-label">Allotment</div>
                                                        <select v-show="current_user.role_id == 6" class="form-control form-control-sm" v-model="view_po_form.allotment_id">
                                                            <option v-for="al in allotments" :key="al.allotment_id" :value="al.allotment_id">{{ al.allotment_desc }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-label">UACS</div>
                                                        <select v-show="current_user.role_id == 6" class="form-control form-control-sm" v-model="view_po_form.uacs_id">
                                                            <option v-for="uc in uacs" :key="uc.id" :value="uc.id">{{ uc.description }}</option>
                                                        </select>
                                                    </div>
                                                    <button v-show="current_user.role_id == 6" type="submit" class="btn btn-sm btn-success">Save</button>
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
                uacs_code_id: '',
                uacs: '',
                allotment_id: '',
                allotment: '',
                uacs_id: '',
                fund_source_id: '',
                fund_source: '',
                date_of_delivery: '',
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
        store_dod(){
            axios.post('../../api/date_of_delivery', {
                purchase_order_id: this.view_po_form.purchase_order_id,
                date_of_delivery: this.view_po_form.date_of_delivery,
            }).then(() => {
                $('#poModal').modal('hide');
                toast.fire({
                    type: 'success',
                    title: 'Date of Delivery Save'
                });
            }).catch(() => {

            });
        },
        store_obrs(){
            axios.post('../../api/obrs', {
                purchase_order_id: this.view_po_form.purchase_order_id,
                uacs_id: this.view_po_form.uacs_id,
                allotment_id: this.view_po_form.allotment_id,
                fund_source_id: this.view_po_form.fund_source_id,
            }).then(() => {
                $('#poModal').modal('hide');
                toast.fire({
                    type: 'success',
                    title: 'Success'
                });
            }).catch(() => {

            });
        },
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
        pmo_rls_2(id){
            axios.put('../../api/pmo_rls_2/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Release'
                });
            }).catch(() => {

            });
        },
        budget_rcv(id){
            axios.put('../../api/budget_rcv/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Received'
                });
            }).catch(() => {

            });
        },
        budget_rls(id){
            axios.put('../../api/budget_rls/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Release'
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
