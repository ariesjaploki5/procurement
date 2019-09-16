<template>
    <div class="row">
        <div class="col-md-12">
             <div class="row bg-white rounded">
                <h6><i class="fas fa-cart-arrow-down"></i> Purchase Order</h6>
            </div>
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
                        <th width="37%">Supplier</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tbody class="table-bordered">
                    <tr v-for="po in pos" :key="po.purchase_order_id">
                        <th @click="view_po(po)" width="10%">{{ po.po_id }}</th>
                        <th @click="view_po(po)" width="15%">{{ po.created_at | myDate3 }}</th>
                        <th @click="view_po(po)" width="18%"><span v-if="po.csid">{{ po.csd }}</span></th>
                        <th @click="view_po(po)" width="10%">{{ po.mode_desc }}</th>
                        <th @click="view_po(po)" width="37%">{{ po.supplier_name }}</th>
                        <th width="10%">
                            <button type="button" class="btn btn-sm btn-success" v-if="po.csid == 7" @click="budget_rcv(po.purchase_order_id)">
                                <i class="fas fa-file-download"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" v-if="po.csid == 8 && po.obrs_date" @click="budget_rls(po.purchase_order_id)">
                                <i class="fas fa-file-upload"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" v-if="po.csid == 21" @click="budget_rls(po.purchase_order_id)">
                                <i class="fas fa-file-upload"></i>
                            </button>
                            <!-- <router-link class="btn btn-sm btn-success" :to="{ name: 'po', params: { id: po.purchase_order_id }}"><i class="fas fa-print"></i> PO</router-link> -->
                            <router-link class="btn btn-sm btn-success" v-show="po.obrs_date" :to="{ name: 'obrs', params: { id: po.purchase_order_id }}"><i class="fas fa-print"></i> OBRS</router-link>
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
                            PO No.: <span class="ml-2" v-if="view_po_form.po_id"> {{ view_po_form.po_id}}</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" v-if="!isLoading">
                            <div class="table-responsive-sm">
                                <table class="table table-sm table-hover" id="po_table">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="5%">#</th>
                                            <th width="25%">Description</th>
                                            <th>SSL</th>
                                            <th>BOH</th>
                                            <th class="text-bold"><small>Monthly Avg. Consumption</small> </th>
                                            <th width="10%">Order Qty</th>
                                            <th>Unit Cost</th>
                                            <th>Estimated Cost</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="po_tbody">
                                        <tr v-for="(dmd,index) in view_po_form.dmd_purchase_orders" :key="dmd.dpo">
                                            <td  class="table-bordered" width="5%">{{ index + 1}}</td>
                                            <td width="25%">
                                                <tr>
                                                    <td colspan="2"><span>{{ dmd.dmddesc }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold" width="30%">Brand:</td>
                                                    <td width="auto">{{ dmd.brand_desc }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold" width="30%">Manufacturer:</td>
                                                    <td width="auto">{{ dmd.manufacturer_desc }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold" width="30%">Supplier:</td>
                                                    <td width="auto">{{ dmd.supplier_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold" width="30%">Packaging:</td>
                                                    <td width="auto">{{ dmd.packaging_desc }}</td>
                                                </tr>
                                            </td>
                                            <td class="text-right table-bordered">{{ dmd.ssl | numeral3 }}</td>
                                            <td class="text-right table-bordered">{{ dmd.boh | numeral3 }}</td>
                                            <td class="text-right table-bordered">{{ dmd.cons | numeral3 }}</td>
                                            <td width="10%" class="text-right">
                                                <span>{{ dmd.order_quantity | numeral3 }}</span>
                                            </td>
                                            <td class="text-right table-bordered">
                                                <span>{{ dmd.cost_price | currency2 }}</span>
                                            </td>
                                            <td  class="text-right table-bordered">
                                                <span>{{ dmd.order_quantity * dmd.cost_price | currency2}}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div>
                                                        <span class="text-bold">Serial No: </span>    
                                                        {{ view_po_form.obrs_no }}
                                                    </div>

                                                </div>
                                                <div class="col-md-2 text-right" v-if="view_po_form.csid == 8">
                                                    <button class="btn btn-sm btn-primary" type="button" v-if="!view_po_form.obrs_no" @click="create_obrs()">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-success" type="button" v-else @click="edit_obrs()">
                                                        <i class="fas fa-pen-square"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body" v-else>
                            <div class="spinner-border text-center" role="status">
                                <span class="sr-only" width="50%" height="50%">Loading...</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- col-md-12 poModal -->
        <div class="col-md-12">
            <div class="modal fade" id="obrsModal" tabindex="-1" role="dialog" aria-labelledby="obrsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            OBRS
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="store_obrs()">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" :value="1" v-model="view_po_form.ors_burs" required>
                                    <label class="form-check-label" for="gridRadios1">
                                        OBLIGATION REQUEST AND STATUS
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" :value="2" v-model="view_po_form.ors_burs" required>
                                    <label class="form-check-label" for="gridRadios2">
                                        BUDGET UTILIZATION REQUEST AND STATUS
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label font-weight-bold">Allotment</div>
                                <select v-show="current_user.role_id == 6" class="form-control form-control-sm" v-model="view_po_form.allotment_id">
                                    <option v-for="al in allotments" :key="al.allotment_id" :value="al.allotment_id">{{ al.allotment_desc }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="form-label font-weight-bold">Fund Cluster</div>
                                <select class="form-control form-control-sm" v-model="view_po_form.fund_cluster_id">
                                    <option v-for="fc in fund_clusters" :key="fc.fund_cluster_id"  :value="fc.fund_cluster_id">{{ fc.fund_cluster_desc }} - {{ fc.fund_cluster_code }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="form-label font-weight-bold">Fund Source</div>
                                <select v-show="current_user.role_id == 6" class="form-control form-control-sm" v-model="view_po_form.fund_source_id">
                                    <option v-for="fs in fund_sources" :key="fs.fund_source_id" :value="fs.fund_source_id">{{ fs.description }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="form-label font-weight-bold">Fund Source Code</div>
                                <select v-show="current_user.role_id == 6" class="form-control form-control-sm" v-model="view_po_form.fund_source_code_id">
                                    <option v-for="fsc in fund_source_codes" :key="fsc.fund_source_code_id" :value="fsc.fund_source_code_id">{{ fsc.description }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="form-label font-weight-bold">UACS</div>
                                <select v-show="current_user.role_id == 6" class="form-control form-control-sm" v-model="view_po_form.uacs_code_id">
                                    <option v-for="uc in uacs_codes" :key="uc.uacs_code_id" :value="uc.uacs_code_id">{{ uc.uacs_desc }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- col-md-12 obrsmodal -->
        <div class="col-md-12">
            <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            Update Order
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="update_order()">
                        <div class="modal-body">  
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </div>
                        </form>
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
            pos: [],
            search_form: new Form({
                word: '',
            }),
            view_po_form: new Form({
                obrs_no: '',
                allotment_code: '',
                allotment_desc: '',
                
                created_at: '',
                csd: '',
                csid:'',
                date_of_delivery:'',
                delivery_term:'',
                fs_acro: '',
                fs_desc: '',
                
                fsc_ca: '',
                fsc_cra: '',
                fsc_desc: '',
                fsc_source: '',

                fund_cluster_desc: '',
                fund_cluster_code: '',

                id: '',
                mode_desc:'',
                obrs_date: '',
                po_id:'',
                purchase_order_id:'',
                purchase_request_id:'',
                supplier_name:'',

                allotment_id: '',
                fund_cluster_id: '',
                fund_source_code_id: '',
                fund_source_id: '',
                uacs_code_id: '',

                uacs_code: '',
                uacs_desc: '',
                uacs_type_id: '',
                dmd_purchase_orders: [],

                ors_burs: '',
            }),
            track_po_modal: {},
            fund_sources: [],
            fund_clusters: [],
            uacs_codes: [],
            allotments: [],
            fund_source_codes: [],
            uacs: [],
            isLoading: true,
            update_order_form: new Form({
                id: '',
                
            }),
        }
    },
    methods:{
        view_po(po){
            this.isLoading = true;
            this.view_po_form.reset();
            this.view_po_form.fill(po);
            axios.
            get('../../api/budget_show/'+po.purchase_order_id)
            .then(({data}) => {
                    this.view_po_form.dmd_purchase_orders = data;
                    this.isLoading = false;
                })
            .catch(() => {

                });
            $('#poModal').modal('show');
        },
        get_fund_clusters(){
            axios.get('../../api/fund_cluster').then(({data}) => {
                this.fund_clusters = data;
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
        get_fund_source_codes(){
            axios.get('../../api/fund_source_code').then(({data}) => {
                this.fund_source_codes = data;
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
        create_obrs(){
            $('#obrsModal').modal('show')
        },
        edit_obrs(){
            $('#obrsModal').modal('show')
        },
        store_obrs(){
            this.view_po_form.post('../../api/obrs').then(() => {
                toast.fire({
                    type: 'success',
                    title: 'Success'
                });

                $('#obrsModal').modal('hide');
                $('#poModal').modal('hide');
                // axios.get('../../api/purchase_order/'+this.view_po_form.purchase_order_id).then(({data}) => {
                //     this.view_po_form.fill(data);
                // }).catch(() => {

                // });
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
        budget_rcv(id){
            axios.put('../../api/budget_rcv/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Receive'
                });
            }).catch(() => {

            });
        },
        update_order(){
            this.update_order_form.put('../../api/update_order/'+this.update_order_form.id).then(() => {

            }).catch(() => {

            });
        }
    },
    created(){

        this.get_pos();
        this.get_fund_source_codes();
        this.get_allotments();
        this.get_uacs_codes();
        this.get_fund_sources();
        this.get_uacs();
        this.get_fund_clusters();
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
@media (min-width: 770px) {
    .modal-xl {
            width: 95%;
            max-width:1500px;
        }
    }
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
        height: 24rem;             
        display: -moz-groupbox; 
    }

    #po_tbody{
        overflow-y: scroll;      
        height: 22rem;           
        width: 98.5%;
        position: absolute;
    }
</style>
