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
                                        <button type="button" class="btn btn-sm btn-primary" @click="view_po(pos.purchase_order_id)"><i class="fas fa-eye"></i></button>
                                        <button type="button" class="btn btn-sm btn-success" @click="track_po(pos)"><i class="fas fa-truck"></i></button>
                                        <!-- <router-link class="btn btn-sm btn-success" :to="{ name: 'po', params: { id: pos.purchase_order_id }}"><i class="fas fa-print"></i> PO</router-link>
                                        <router-link class="btn btn-sm btn-success" v-show="pos.obrs_date" :to="{ name: 'obrs', params: { id: pos.purchase_order_id }}"><i class="fas fa-print"></i> OBRS</router-link> -->
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
                        <div class="modal-header font-weight-bold">
                            <h5>{{ view_po_form.created_at | myDate }} - {{ view_po_form.purchase_order_id | numeral2 }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive-sm">
                                <table class="table table-sm table-hover" style="height: 20rem !important;">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="5%">#</th>
                                            <th width="40%">Description</th>
                                            <th width="5%">Quantity</th>
                                            <th width="10%">Unit Cost</th>
                                            <th width="10%">Estimated Cost</th>
                                            <th width="15%">Received Quantity</th>
                                            <th width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody  style="height: 20rem !important;" class="table-bordered">
                                        <tr v-for="(item,index) in view_po_form.dmd_purchase_orders" :key="item.dmd_id">
                                            <td width="5%">{{ index + 1}}</td>
                                            <td width="40%">
                                                <div class="font-weight-bold border-bottom-0 text-center">{{ item.new_dmd.dmddesc }}</div>
                                                <tr><td class="text-right border-bottom-0 border-top-0 font-weight-bold">Brand:</td><td class="border-bottom-0 border-top-0">{{ item.brand.brand_desc }}</td></tr>
                                                <tr><td class="text-right border-bottom-0 border-top-0 font-weight-bold">Packaging:</td><td class="border-bottom-0 border-top-0">{{ item.packaging.packaging_desc }}</td></tr>
                                                <tr><td class="text-right border-bottom-0 border-top-0 font-weight-bold">Manufacturer:</td><td class="border-bottom-0 border-top-0">{{ item.manufacturer.manufacturer_desc }}</td></tr>
                                                <tr><td class="text-right border-bottom-0 border-top-0 font-weight-bold">Country of Origin:</td><td class="border-bottom-0 border-top-0">{{ item.country.country_desc }}</td></tr>
                                                <tr><td class="text-right border-bottom-0 border-top-0 font-weight-bold">CPR:</td><td class="border-bottom-0 border-top-0"></td></tr>
                                            </td>
                                            <td width="5%" class="text-right">
                                                <span v-if="current_user.roled_id = '5'">{{ item.order_quantity }}</span>
                                                <span v-else><input type="number" class="form-control form-control-sm text-right" v-model="item.order_quantity"></span>
                                            </td>
                                            <td width="10%" class="text-right">{{ item.cost_price | currency2}}</td>
                                            <td width="10%" class="text-right">{{ item.order_quantity * item.cost_price | currency2 }}</td>
                                            <td width="15%" class="text-left">
                                                <div v-for="rcv in item.dmd_receiveds" :key="rcv.id">
                                                    Date : {{ rcv.date_received | myDate4 }}  - Quantity: {{ rcv.received_quantity }}
                                                </div>
                                            </td>
                                            <td width="10%" class="text-center">
                                                <button type="button" class="btn btn-sm btn-success" @click="receive_dmd(item)" v-show="!item.received_quantity">Received</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div v-if="view_po_form.date_of_delivery">
                               <b> Date of Delivery:</b> {{ view_po_form.date_of_delivery}}
                            </div>
                            <div v-else></div>

                            <span v-if="view_po_form.fund_source_id">
                               <b> ORS / BURS No.:</b> {{ view_po_form.fund_source.acronym }}-0{{ view_po_form.allotment.allotment_code }}-{{ view_po_form.uacs.current_appropriations }}-{{ view_po_form.obrs_date | myDate}}-{{ view_po_form.purchase_order_id | numeral2}}
                            </span>
                            <div v-else></div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-danger" @click="notify_terminate_po(view_po_form.purchase_order_id)">Notify to Terminate</button>
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

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="receiveModal" tabindex="-1" role="dialog" aria-labelledby="receiveModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>{{ dmd.dmddesc }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="" class="form-label">Received Type</label>
                                <select class="form-control form-control-sm" v-model="received_form.received_type_id">
                                    <option value=""></option>
                                    <option value="1">Complete</option>
                                    <option value="2">Partial</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Received Quantity</label>
                                <input type="number" class="form-control form-control-sm text-right" v-model="received_form.received_quantity" :max='dmd.order_quantity'>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Expiration Date</label>
                                <input type="date" class="form-control from-control-sm text-right" v-model="received_form.received_exp">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-warning">Cancel</button>
                            <button type="button" class="btn btn-sm btn-success" @click="store_received()">Submit</button>
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
                uacs: {},
                allotment_id: '',
                allotment: {},
                uacs_id: '',
                fund_source_id: '',
                fund_source: {},
                date_of_delivery: '',
                purchase_request:{
                   view_dmd_purchase_requests:[],
               },
               dmd_purchase_orders: [],
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
            dmd: {},
            received_quantity: '',
            received_form: new Form({
                dmd_id: '',
                dmdctr: '',
                dmdcomb: '',
                purchase_request_id: '',
                purchase_order_id: '',
                received_quantity: '',
                received_type_id: '',
                received_exp: '',
                dmd_po_id: '',
            }),
        }
    },
    methods:{
        notify_terminate_po(id){
            axios.put('../../api/notify_terminate_po/'+id).then(() => {
                this.get_pos();
                $('#poModal').modal('hide');
            }).catch(() => {

            });
        },
        receive_dmd(dmd){
            this.dmd = dmd;
            this.received_form.dmd_id = null;
            this.received_form.dmd_id = this.dmd.dmd_id;
            this.received_form.dmd_po_id = this.dmd.dmd_po_id;

            $('#receiveModal').modal('show');
        },
        store_received(){
            this.received_form.post('../../api/received_po_dmd').then(() => {
                this.get_pos();
                $('#receiveModal').modal('hide');
                $('#poModal').modal('hide');

            }).catch(() => {

            });
        },
        get_pos(){
            axios.get('../../api/for_mmo_po').then(({data}) => {
                this.purchase_orders = data;
            }).catch(() => {

            });
        },
        view_po(id){
            // this.view_po_form.fill(pos);
            axios.get('../../api/get_po/'+id).then(({data}) => {
                this.view_po_form = data;
                $('#poModal').modal('show');
            }).catch(() => {

            });
            
            this.received_form.purchase_request_id = this.view_po_form.purchase_request_id;
            this.received_form.purchase_order_id = this.view_po_form.purchase_order_id;

        },
        track_po(pos){
            this.track_po_modal = pos;
            $('#trackModal').modal('show');
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
    @media (min-width: 768px) {
        .modal-xl {
            width: 90%;
            max-width:1400px;
        }
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
