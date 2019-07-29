<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row mb-1 shadow p-3 mb-3 bg-white rounded">
                <h4><i class="fas fa-cart-arrow-down"></i> Purchase Order</h4>
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
                                    <router-link class="btn btn-sm btn-success" :to="{ name: 'po', params: { id: pos.purchase_order_id }}"><i class="fas fa-print"></i> PO</router-link>
                                    <router-link class="btn btn-sm btn-success" v-show="pos.obrs_date" :to="{ name: 'obrs', params: { id: pos.purchase_order_id }}"><i class="fas fa-print"></i> OBRS</router-link>
                                </div>
                                <div id="document_tracking" class="">
                                    <button type="button" v-show="pos.pmo_rls && !pos.budget_rcv" class="btn btn-sm btn-success" @click="budget_rcv(pos.purchase_order_id)">Received From PMO</button>
                                    <button type="button" v-show="pos.obrs_date && pos.budget_rcv && !pos.budget_rls" class="btn btn-sm btn-danger" @click="budget_rls(pos.purchase_order_id)">Send To Accounting</button>
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
                            <div class="container" v-show="current_user.role_id == 3">
                                <div class="row">
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <form action="">
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <div class="form-label">Date of Delivery:</div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="date" class="form-control form-control-sm" v-model="view_po_form.date_of_delivery">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <div class="form-label">
                                                                Delivery Term: <small>(Days)</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="number" class="form-control form-control-sm" v-model="view_po_form.delivery_term">
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-sm btn-success" type="button" @click="store_dod()">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span v-if="view_po_form.fund_source_id && view_po_form.allotment_id && view_po_form.uacs_id ">
                               <b> ORS / BURS No.:</b> {{ view_po_form.fund_source.acronym }}-0{{ view_po_form.allotment.allotment_code }}-{{ view_po_form.uacs.current_appropriations }}-{{ view_po_form.obrs_date | myDate}}-{{ view_po_form.purchase_order_id | numeral2}}
                            </span>
                            <div v-else></div>
                            <div class="container" v-show="current_user.role_id == 6">
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <form @submit.prevent="store_obrs()">
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <div class="form-label">Fund Source</div>
                                                        </div>
                                                        
                                                        <div class="col-md-9">
                                                            <select v-show="current_user.role_id == 6" class="form-control form-control-sm" v-model="view_po_form.fund_source_id">
                                                                <option v-for="fs in fund_sources" :key="fs.id" :value="fs.id">{{ fs.description }}</option>
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <div class="form-label">Allotment</div>
                                                        </div>
                                                        
                                                        <div class="col-md-9">
                                                            <select v-show="current_user.role_id == 6" class="form-control form-control-sm" v-model="view_po_form.allotment_id">
                                                                <option v-for="al in allotments" :key="al.allotment_id" :value="al.allotment_id">{{ al.allotment_desc }}</option>
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <div class="form-label">UACS</div>
                                                        </div>
                                                            
                                                        <div class="col-md-9">
                                                            <select v-show="current_user.role_id == 6" class="form-control form-control-sm" v-model="view_po_form.uacs_id">
                                                                <option v-for="uc in uacs" :key="uc.id" :value="uc.id">{{ uc.description }}</option>
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="form-group-row">
                                                        <div class="col-md-12 text-right">
                                                            <button v-show="current_user.role_id == 6" type="submit" class="btn btn-sm btn-success">Save</button>
                                                        </div>
                                                    </div>
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
        store_dod(){
            axios.post('../../api/date_of_delivery', {
                purchase_order_id: this.view_po_form.purchase_order_id,
                date_of_delivery: this.view_po_form.date_of_delivery,
                delivery_term: this.view_po_form.delivery_term,
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
            axios.get('../../api/for_budget').then(({data}) => {
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
