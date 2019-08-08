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
                        <th width="32%">Supplier</th>
                        <th width="15%"></th>
                    </tr>
                </thead>
                <tbody class="table-bordered">
                    <tr v-for="po in pos" :key="po.purchase_order_id">
                        <th @click="view_po(po)" width="10%">{{ po.po_id }}</th>
                        <th @click="view_po(po)" width="15%">{{ po.created_at | myDate3 }}</th>
                        <th @click="view_po(po)" width="18%">
                            <span v-if="po.csd">{{ po.csd }}</span>
                        </th>
                        <th @click="view_po(po)" width="10%">{{ po.mode_desc }}</th>
                        <th @click="view_po(po)" width="32%">{{ po.supplier_name }}</th>
                        <th width="15%">
                            <span v-if="!po.csd && po.dod">
                                <button type="button" class="btn btn-sm btn-danger" @click="pmo_rls_po(po.purchase_order_id)">
                                    <i class="fas fa-file-upload"></i>
                                </button>
                            </span>
                            <router-link class="btn btn-sm btn-success" :to="{ name: 'po', params: { id: po.purchase_order_id }}"><i class="fas fa-print"></i> PO</router-link>
                            <router-link class="btn btn-sm btn-success" :to="{ name: 'obrs', params: { id: po.purchase_order_id }}"><i class="fas fa-print"></i> OBRS</router-link>
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
                        <div class="modal-body">
                            <div class="table-responsive-sm">
                                <table class="table table-sm table-hover" id="po_table">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="5%">#</th>
                                            <th width="20%">Description</th>
                                            <th>SSL</th>
                                            <th>BOH</th>
                                            <th>Item In Transit</th>
                                            <th width="10%">Quantity</th>
                                            <th>Unit Cost</th>
                                            <th>Estimated Cost</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="po_tbody">
                                        <tr v-for="(dmd,index) in view_po_form.dmd_purchase_orders" :key="dmd.dmd_id">
                                            <td width="5%">{{ index + 1}}</td>
                                            <td width="20%">{{ dmd.dmddesc }}</td>
                                            <td class="text-right table-danger">{{ dmd.ssl | numeral3 }}</td>
                                            <td class="text-right table-danger">{{ dmd.boh | numeral3 }}</td>
                                            <td class="text-right table-danger"></td>
                                            <td width="10%" class="text-right">
                                                <span>{{ dmd.order_quantity | numeral3 }}</span>
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row" v-if="!view_po_form.dod">
                                            <div class="col text-right">
                                                <button class="btn btn-sm btn-primary" type="button" @click="create_dod()">
                                                    Add Delivery Date
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row" v-else>
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div>
                                                            <span class="text-bold">Date of Delivery: </span>    
                                                            {{ view_po_form.date_of_delivery }}
                                                        </div>
                                                        <div>
                                                            <span class="text-bold">Delivery Term: </span>  
                                                            {{ view_po_form.delivery_term }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div>
                                                            <span class="text-bold">Place of Delivery: </span>    
                                                            {{ view_po_form.place_of_delivery }}
                                                        </div>
                                                        <div>
                                                            <span class="text-bold">Payment Term: </span>  
                                                            {{ view_po_form.payment_term_desc }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
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
        <div class="col-md-12">
            <div class="modal fade" id="dodModal" tabindex="-1" role="dialog" aria-labelledby="dodModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            PO #: <span v-if="view_po_form.po_id"> {{ view_po_form.po_id}}</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="store_dod()">
                        <div class="modal-body">
                            
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-label">Date of Delivery:</div>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" class="form-control form-control-sm" v-model="view_po_form.date_of_delivery" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-label">Delivery Term: <small>(Days)</small></div>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control form-control-sm" v-model="view_po_form.delivery_term" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-label">Place of Delivery:</div>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm" v-model="view_po_form.place_of_delivery" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-label">Payment Term: </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select v-model="view_po_form.payment_term_id" class="form-control form-control-sm">
                                            <option v-for="pt in payment_terms" :key="pt.id" :value="pt.id">{{ pt.payment_term_desc }}</option>
                                        </select>
                                    </div>
                                </div>
                                
                            
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-success" type="submit">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- col-md-12 dodModal -->
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
                payment_term_id: '',
                place_of_delivery: '',
                purchase_order_id: '',
                purchase_request_id: '',
                payment_term_desc: '',
                po_id: '',
                uacs_code_id: '',
                uacs: '',
                allotment_id: '',
                allotment: '',
                uacs_id: '',
                fund_source_id: '',
                fund_source: '',
                date_of_delivery: '',
                delivery_term: '',
                dmd_purchase_orders: [],
                last_status: {},
                dod: '',
                purchase_request:{
                   view_dmd_purchase_requests:[],
                   last_status: {},
               },
            }),
            track_po_modal: {},
            payment_terms: [],
        }
    },
    methods:{
        get_payment_terms(){
            axios.get('../../api/payment_term').then(({data}) => {
                this.payment_terms = data;
            }).catch(() => {

            });
        }, 
        get_pos(){
            axios.get('../../api/po_for_pmo').then(({data}) => {
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
        view_po(po){
            this.view_po_form.reset();
            this.view_po_form.fill(po);
            axios.get('../../api/purchase_order/'+po.purchase_order_id).then(({data}) => {
                    this.view_po_form.dmd_purchase_orders = data;
                }).catch(() => {

                });
            $('#poModal').modal('show');
        },

        track_po(pos){
            this.track_po_modal = pos;
            $('#trackModal').modal('show')
        },
        pmo_rls_po(id){ 
            axios.put('../../api/pmo_rls_po/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Release'
                });
            }).catch(() => {

            });
        },
        create_dod(){
            $('#dodModal').modal('show')
        },
        store_dod(){
            this.view_po_form.post('../../api/date_of_delivery').then(() => {
                toast.fire({
                    type: 'success',
                    title: 'Success'
                });
                axios.get('../../api/purchase_order/'+this.view_po_form.purchase_order_id).then(({data}) => {
                this.view_po_form.fill(data);
                $('#dodModal').modal('hide')
                $('#poModal').modal('hide');
                }).catch(() => {

                });
            }).catch(() => {

            });
        },
        
    },
    created(){
        this.get_pos();
        this.get_payment_terms();
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
