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
                    <tr v-for="po in pos" :key="po.po_id">
                        <th @click="view_po(po)" width="10%">{{ po.po_id }}</th>
                        <th @click="view_po(po)" width="15%">{{ po.created_at | myDate3 }}</th>
                        <th @click="view_po(po)" width="18%"><span v-if="po.csid">{{ po.csd }}</span></th>
                        <th @click="view_po(po)" width="10%">{{ po.mode_desc }}</th>
                        <th @click="view_po(po)" width="37%">{{ po.supplier_name }}</th>
                        <th width="10%">
                            <button type="button" class="btn btn-sm btn-success" v-if="po.csid == 7" @click="budget_rcv(po.po_id)">
                                <i class="fas fa-file-download"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" v-if="po.csid == 8 && po.obrs_date" @click="budget_rls(po.po_id)">
                                <i class="fas fa-file-upload"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" v-if="po.csid == 21" @click="budget_rls(po.po_id)">
                                <i class="fas fa-file-upload"></i>
                            </button>
                            <!-- <router-link class="btn btn-sm btn-success" :to="{ name: 'po', params: { id: po.po_id }}"><i class="fas fa-print"></i> PO</router-link> -->
                            <router-link class="btn btn-sm btn-success" v-show="po.obrs_no" :to="{ name: 'obrs', params: { id: po.po_id }}"><i class="fas fa-print"></i> OBRS</router-link>
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
                                                        <span class="text-bold">Serial No.:</span>   
                                                        <div class="w-100"></div>
                                                        <span>{{ view_po_form.obrs_no }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-right" v-if="view_po_form.csid == 8">
                                                    <button class="btn btn-sm btn-primary" type="button" v-if="!view_po_form.obrs_no" @click="create_obrs(view_po_form.po_id)">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-success" type="button" v-else @click="edit_obrs(view_po_form.po_id)">
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
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            OBRS
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="store_obrs()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <label for="" class="form-label">Type Of Obligation:</label>
                                        </div>
                                        <select class="form-control col-9" v-model="obrs_form.type_of_obligation" required>
                                            <option value="" selected disabled></option>
                                            <option value="1">OBLIGATION REQUEST AND STATUS</option>
                                            <option value="2">BUDGET UTILIZATION REQUEST AND STATUS</option>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <label for="" class="form-label">Fund:</label>
                                        </div>
                                        <input type="text" class="form-control col-9" v-model="obrs_form.fund">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <label for="" class="form-label">Allotment Class:</label>
                                        </div>
                                        <select class="form-control col-9" v-model="obrs_form.allotment_class" required>
                                            <option value="" selected disabled></option>
                                            <option value="01">Personnel Services - 01</option>
                                            <option value="02">Maintenance & Other Operating Expenses - 02</option>
                                            <option value="03">Financial Expenses - 03</option>
                                            <option value="04">Capital Outlays - 04</option>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <label for="" class="form-label">Funding Source:</label>
                                        </div>
                                        <select class="form-control col-9" v-model="obrs_form.funding_source" required>
                                            <option value="" selected disabled></option>
                                            <option value="1">Specific Budgets of National Government                               - 01 - Regular Agency Fund</option>
                                            <option value="2">Miscellaneous Personal Benefits Fund                                  - 01 - Regular Agency Fund</option>
                                            <option value="3">Pension and Gratuity Fund                                             - 01 - Regular Agency Fund</option>
                                            <option value="4">Retirement and Life Insurance Premiums                                - 01 - Regular Agency Fund</option>
                                            <option value="5">Hospital Retained Income applicable to all DOH - retained hospitals   - 05 - Internally Generated Funds</option>
                                            <option value="6">Drugs and Medicines Revolving Funds                                   - 06 - Business Related Funds</option>
                                            <option value="7">Receipts Deposited with Authorized Government Depository Banks (AGDB) - 07 - Trust Receipts</option>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <label for="" class="form-label">Type Of Appropriation:</label>
                                        </div>
                                        <select class="form-control col-9" v-model="obrs_form.type_of_appropriation" required>
                                            <option value="" selected disabled></option>
                                            <option value="1">Current Appropriations</option>
                                            <option value="2">Continuing Appropriations</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label for="" class="form-label">UACS Object Code/Expenditure</label>
                                        </div>

                                        <div class="col-6 text-right text-bold">
                                            Total Amount:   <span>{{ view_po_form.total_amount | currency2 }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group row" v-for="(item, index) in obrs_form.uc" :key="index">
                                        <div class="col-9">
                                            <select v-model="item.code" class="form-control form-control-sm" >
                                                <option v-for="uc in uacs_codes" :key="uc.id" :value="uc.uacs_code">{{ uc.uacs_desc }}</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <input type="text" class="form-control form-control-sm text-right" v-model="item.amount">
                                        </div>
                                        
                                    </div>
                                    <button type="button" class="btn btn-sm btn-primary" @click="add_uc()" v-if="obrs_form.uc.length < 5">add</button>
                                    <button type="button" class="btn btn-sm btn-danger" @click="remove_uc()" v-if="obrs_form.uc.length > 1">remove</button>
                                </div>
                            </div>
                            
                            
                            <!-- <div class="form-group row">
                                <div class="col-3">
                                    <label for="" class="form-label">UACS Object Code/Expenditure:</label>
                                </div>
                                <vue-multi-select v-model="obrs_form.uacs_codes" 
                                :options="uacs_codes" 
                                option-label="uacs_desc" 
                                :max-results="192"
                                class="col-6">
                                </vue-multi-select>
                            </div>  -->
                            
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
import {Money} from 'v-money'
import VueMultiSelect from "vue-simple-multi-select";
export default {

    components: {
        VueMultiSelect,
        Money
    },
    data(){
        return{
            pos: [],
            search_form: new Form({
                word: '',
            }),
            view_po_form: new Form({
                created_at: '',
                csd: '',
                csid:'',
                date_of_delivery:'',
                delivery_term:'',
                id: '',
                mode_desc:'',
                obrs_no: '',
                obrs_date: '',
                po_id:'',
                po_id:'',
                purchase_request_id:'',
                supplier_name:'',
                dmd_purchase_orders: [],
                total_amount: '',
            }),
            track_po_modal: {},
            
            obrs_form: new Form({
                po_id: '',
                type_of_obligation: '',
                fund: '',
                allotment_class: '',
                funding_source: '',
                type_of_appropriation: '',
                uacs_object_code: [],
                amount: '',
                uacs_codes: [],
                uc: [
                    {
                        code: null,
                        amount: '',
                    }
                ],
            }),
            isLoading: true,
            update_order_form: new Form({
                id: '',    
            }),

            uacs_codes: [],
            value: [],
            uc_limit: 5,
            uc_count: 1,
        }
    },
    methods:{

        view_po(po){
            this.isLoading = true;
            this.view_po_form.reset();
            this.view_po_form.fill(po);
            axios.
            get('../../api/budget_show/'+po.po_id)
            .then(({data}) => {
                    this.view_po_form.dmd_purchase_orders = data;
                    this.isLoading = false;
                })
            .catch(() => {

                });
            $('#poModal').modal('show');
        },

        get_uacs_codes(){
            axios.get('../../api/uacs_code').then(({data}) => {
                this.uacs_codes = data;
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

        create_obrs(id){
            this.obrs_form.po_id = id;
            $('#obrsModal').modal('show')
        },

        edit_obrs(id){
            this.obrs_form.po_id = id;
            $('#obrsModal').modal('show')
        },
        
        store_obrs(){
            this.obrs_form.post('../../api/obrs_no').then(() => {
                toast.fire({
                    type: 'success',
                    title: 'Success'
                });

                $('#obrsModal').modal('hide');
                $('#poModal').modal('hide');
                this.obrs_form.reset();
                this.view_po_form.reset();
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
        },

        get_uacs_codes(){
            axios.get('../../api/uacs_code').then(({data}) => {
                this.uacs_codes = data;
            });
        },
        add_uc(){
            this.obrs_form.uc.push({
                code: null,
                amount: '',
            });
        },
        remove_uc(){
            this.obrs_form.uc.pop();
        }
          
    },
    created(){

        this.get_pos();
        this.get_uacs_codes();
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
