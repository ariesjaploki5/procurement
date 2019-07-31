<template>
    <div class="row">
        <div class="col-md-12">
            <span>Purchase Requests</span>
        </div>
        <div class="col-md-12 mt-1">
            <form @submit.prevent="search()">
                <div class="row">
                    <div class="col-md-auto">
                        <label for="" class="form-label">PO #</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control form-control-sm" required v-model="search_form.word">
                    </div>
                    <div class="col-md-auto">
                        <button class="btn btn-sm btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12 mt-1">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th width="10%">PO #</th>
                        <th width="15%">Date Created</th>
                        <th width="18%">Track</th>
                        <th width="10%">Mode</th>
                        <th width="40%">Supplier</th>
                        <th width="7%"></th>
                    </tr>
                </thead>
                <tbody class="table-bordered">
                    <tr v-for="po in pos" :key="po.purchase_order_id">
                        <th @click="view_po(po)" width="10%">{{ po.po_id }}</th>
                        <th @click="view_po(po)" width="15%">{{ po.created_at }}</th>
                        <th @click="view_po(po)" width="18%">
                            <span v-if="po.last_status">
                                {{ po.last_status.current_status.current_status_desc }}
                            </span>
                            <span v-else>
                                {{ po.purchase_request.last_status.current_status.current_status_desc }}
                            </span>
                        </th>
                        <th @click="view_po(po)" width="10%">{{ po.mode.mode_desc }}</th>
                        <th @click="view_po(po)" width="40%">{{ po.supplier.supplier_name }}</th>
                        <th width="7%">
                            <button type="button" class="btn btn-sm btn-success" v-if="po.last_status.current_status_id == 5" @click="budget_rcv(po.purchase_order_id)">
                                <i class="fas fa-file-download"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" v-if="po.last_status.current_status_id == 6" @click="budget_rls(po.purchase_order_id)">
                                <i class="fas fa-file-upload"></i>
                            </button>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <div class="modal fade" id="poModal" tabindex="-1" role="dialog" aria-labelledby="poModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            PO #: <span v-if="view_po_form.po_id"> {{ view_po_form.po_id}}</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" v-if="!isLoading">
                            <div class="table-responsive-sm">
                                <table class="table table-sm table-hover" id="po_table">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="5%">#</th>
                                            <th width="20%">Description</th>
                                            <th>SSL</th>
                                            <th>BOH</th>
                                            <th>Item In Transit</th>
                                            <th>
                                                <small>2 Months</small>
                                                <small>Consumption</small>
                                            </th>
                                            <th width="10%">Order Qty</th>
                                            <th>Unit Cost</th>
                                            <th>Estimated Cost</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="po_tbody">
                                        <tr v-for="(dmd,index) in view_po_form.dmd_purchase_orders" :key="dmd.dpo">
                                            <td width="5%">{{ index + 1}}</td>
                                            <td width="20%">{{ dmd.dmddesc }}</td>
                                            <td class="text-right table-danger">{{ dmd.ssl | numeral3 }}</td>
                                            <td class="text-right table-danger">{{ dmd.boh | numeral3 }}</td>
                                            <td class="text-right table-danger"></td>
                                            <td class="text-right">{{ dmd.cons | numeral3 }}</td>
                                            <td width="10%" class="text-right">
                                                <input v-if="!view_po_form.last_status" type="number" class="form-control form-control-sm text-right" v-model="dmd.order_quantity">
                                                <div v-else>{{ dmd.order_quantity | numeral3 }}</div>
                                            </td>
                                            <td class="text-right">
                                                <span>{{ dmd.cost_price | currency2 }}</span>
                                            </td>
                                            <td  class="text-right">
                                                <span>{{ dmd.order_quantity * dmd.cost_price | currency2}}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row" v-if="view_po_form.fund_source_id">
                                <div class="col-md-12">
                                    <b> ORS / BURS No.:</b> {{ view_po_form.fund_source.acronym }}-0{{ view_po_form.allotment.allotment_code }}-{{ view_po_form.uacs.current_appropriations }}-{{ view_po_form.obrs_date | myDate}}-{{ view_po_form.purchase_order_id | numeral2}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
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
                                <div class="col-md-12">

                                </div>
                            </div>
                        </div>
                        <div class="modal-body" v-else>
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="modal-footer" >
                            
                                <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- col-md-12 poModal -->
        <div class="col-md-12">
            <div class="modal fade" id="trackModal" tabindex="-1" role="dialog" aria-labelledby="trackModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{ track_po_modal.created_at | myDate }} - {{ track_po_modal.purchase_order_id | numeral2 }}
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
        </div><!-- col-md-12 trackmodal -->
    </div>
    
</template>

<script>
export default {
    data(){
        return{
            pos: [],
            search_form: new Form({
                word: '',
            }),
            view_po_form: new Form({
                purchase_order_id: '',
                purchase_request_id: '',
                po_id: '',
                uacs_code_id: '',
                uacs: {},
                allotment_id: '',
                allotment: {},
                uacs_id: '',
                fund_source_id: '',
                fund_source: {},
                date_of_delivery: '',
                dmd_purchase_orders: [],
                last_status: {},
                purchase_request:{
                   view_dmd_purchase_requests:[],
                   last_status: {},
               },
            }),
            track_po_modal: {},
            fund_sources: [],
            uacs_codes: [],
            allotments: [],
            uacs: [],
            isLoading: true,
        }
    },
    methods:{
        view_po(po){
            this.isLoading = true;
            this.view_po_form.reset();
            axios.get('../../api/budget_show/'+po.purchase_order_id).then(({data}) => {
                    
                    this.view_po_form.dmd_purchase_orders = data;
                    this.view_po_form.purchase_order_id = po.purchase_order_id;
                    this.view_po_form.purchase_request_id = po.purchase_request_id;
                    this.view_po_form.po_id = po.po_id;
                    this.view_po_form.uacs_code_id = po.uacs_code_id;
                    this.view_po_form.uacs = po.uacs;
                    this.view_po_form.allotment_id = po.allotment_id;
                    this.view_po_form.allotment = po.purchase_order_id;
                    this.view_po_form.uacs_id = po.uacs_id;
                    this.view_po_form.fund_source_id = po.fund_source_id;
                    this.view_po_form.fund_source = po.fund_source;
                    this.view_po_form.date_of_delivery = po.date_of_delivery;
                    this.view_po_form.last_status = po.last_status;
                    this.view_po_form.purchase_request = po.purchase_request;
                    this.isLoading = false;
                }).catch(() => {

                });
            $('#poModal').modal('show');
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
            axios.get('../../api/po_for_budget').then(({data}) => {
                this.pos = data;
            }).catch(() => {

            });
        },
        search(){
            this.search_form.post('../../api/search_po').then(({data}) => {
                this.pos = data;
            }).catch(() => {

            });
        },
        
        track_po(pos){
            this.track_po_modal = pos;
            $('#trackModal').modal('show')
        },
        store_obrs(){
            this.view_po_form.post('../../api/obrs').then(() => {
                toast.fire({
                    type: 'success',
                    title: 'Success'
                });
                axios.get('../../api/purchase_order/'+this.view_po_form.purchase_order_id).then(({data}) => {
                    this.view_po_form.fill(data);
                }).catch(() => {

                });
            }).catch(() => {

            });
        },
        budget_rls(id){
            axios.put('../../api/budget_rls/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Received'
                });
            }).catch(() => {

            });
        },
        budget_rcv(id){
            axios.put('../../api/budget_rcv/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Release'
                });
            }).catch(() => {

            });
        },
    },
    created(){
        this.get_allotments();
        this.get_uacs_codes();
        this.get_fund_sources();
        this.get_uacs();
        this.get_pos();
    },
    computed:{
        current_user() {
            return this.$store.getters.current_user;
        }
    },
    mounted(){
        window.Echo.channel("po_created").listen(".purchase_order.created", (e) => {
            this.get_pos();
        });
        window.Echo.channel("po_updated").listen(".purchase_order.updated", (e) => {
            this.get_pos();
        });
    },
}
</script>
<style scoped>
    #disapprovedModal{
        background-color: #0606067a;
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
    .nav-tabs .nav-link.active{
        color: white;
        background-color: #4a5ea5fa;
        
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

    #po_table{
        height: 20rem;             
        display: -moz-groupbox; 
    }

    #po_tbody{
        overflow-y: scroll;      
        height: 18rem;           
        width: 98.5%;
        position: absolute;
    }
</style>
