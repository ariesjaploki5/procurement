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
                        <th width="37%">Supplier</th>
                        <th width="10%"></th>
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
                        <th @click="view_po(po)" width="37%">{{ po.supplier_name }}</th>
                        <th width="10%">
                            <button type="button" class="btn btn-sm btn-success" v-if="po.csid == 15" @click="mmo_rcv(po.purchase_order_id)">
                                <i class="fas fa-file-download"></i>
                            </button>
                            <!-- <button type="button" class="btn btn-sm btn-danger" v-if="po.csd == 14" @click="fmo_rls(po.purchase_order_id)">
                                <i class="fas fa-file-upload"></i>
                            </button> -->
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
                                            <th width="4%">#</th>
                                            <th width="25%">Description</th>
                                            <th>SSL</th>
                                            <th>BOH</th>
                                            <th width="10%">Ordered Qty.</th>
                                            <th>Unit Cost</th>
                                            <th>Estimated Cost</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="po_tbody">
                                        <tr v-for="(dmd,index) in view_po_form.dmd_purchase_orders" :key="dmd.dmd_id">
                                            <td width="4%">{{ index + 1}}</td>
                                            <td width="25%">
                                                <tr><td colspan="2"><span class="text-bold">{{ dmd.dmddesc }}</span></td></tr>
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
                                            </td>
                                            <td class="text-right">{{ dmd.ssl | numeral3 }}</td>
                                            <td class="text-right">{{ dmd.boh | numeral3 }}</td>
                                            <td width="10%" class="text-right">{{ dmd.order_quantity | numeral3 }}</td>
                                            <td class="text-right"><span>{{ dmd.cost_price | currency2 }}</span></td>
                                            <td  class="text-right"><span>{{ dmd.order_quantity * dmd.cost_price | currency2}}</span></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-success" @click="receive_modal(dmd)">Receive</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
            <div class="modal fade" id="receiveModal" tabindex="-1" role="dialog" aria-labelledby="receiveModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            PO #: <span v-if="view_po_form.po_id"> {{ view_po_form.po_id}}</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="" class="label form-label">Item Description:</label>
                                {{ receive_form.dmddesc }}
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="" class="label form-label">Quantity: </label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" class="form-control form-control-sm text-right" v-model="receive_form.qty">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" >
                            <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" aria-label="Close">Close</button>
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- col-md-12 receiveModal -->
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
            receive_form: new Form({
                purchase_order_id: '',
                dmd_id: '',
                purchase_request_id: '',
                dmddesc: '',
                qty: '',
            }),
        }
    },
    methods:{
        get_pos(){
            axios.get('../../api/for_mmo_po').then(({data}) => {
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
        receive_modal(dmd){
            $('#receiveModal').modal('show');
            this.receive_form.fill(dmd);
            this.receive_form.qty = dmd.order_quantity;
        },
        track_po(pos){
            this.track_po_modal = pos;
            $('#trackModal').modal('show')
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
    created(){
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
        height: 25rem;             
        display: -moz-groupbox; 
    }

    #po_tbody{
        overflow-y: scroll;      
        height: 23rem;           
        width: 98.5%;
        position: absolute;
    }
</style>
