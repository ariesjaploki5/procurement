<template>
    <div class="row">
        <div class="col-md-12"><span>Purchase Requests</span></div>
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
                        <th width="10%" class="text-center">Date Created</th>
                        <th width="18%" class="text-center">Track</th>
                        <th width="10%" class="text-center">Mode</th>
                        <th width="32%">Supplier</th>
                        <th width="10%" class="text-center">Status</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tbody class="table-bordered">
                    <tr v-for="po in pos" :key="po.purchase_order_id" :class="{ 'table-danger' : po.terminated == 1 }">
                        <th @click="view_po(po)" width="10%">{{ po.po_id }}</th>
                        <th @click="view_po(po)" width="10%">{{ po.created_at | myDate3 }}</th>
                        <th @click="view_po(po)" width="18%"><span v-if="po.csd">{{ po.csd }}</span></th>
                        <th @click="view_po(po)" width="10%">{{ po.mode_desc }}</th>
                        <th @click="view_po(po)" width="32%">{{ po.supplier_name }}</th>
                        <th @click="view_po(po)" width="10%" :class="{ 'table-danger' : po.terminated == 1 }">
                            <span v-if="po.terminated == 1">Terminated</span>
                            <span></span>
                        </th>
                        <th width="10%">
                            <button type="button" class="btn btn-sm btn-success" v-if="po.csid == 15" @click="mmo_rcv(po.purchase_order_id)">
                                <i class="fas fa-file-download"></i>
                            </button>
                            <div class="btn-group dropleft btn-sm">
                                <button type="button" class="btn btn-light btn-outline-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <span v-if="po.terminated != 1">
                                        <span v-if="po.notice == 1">
                                            <router-link class="dropdown-item" :to="{ name: 'ntt', params: { id: po.purchase_order_id }}">
                                                Print Notice to Terminate
                                            </router-link>
                                        </span>
                                        <span v-else>
                                            <button class="dropdown-item" @click="notice_to_terminate(po)">Notice to Terminate</button>
                                        </span>
                                        <button class="dropdown-item" @click="terminate_modal(po)">Terminate</button>
                                        <span>
                                            <button class="dropdown-item" @click="dv_modal(po)">Disburesment Voucher</button>
                                        </span>
                                    </span>
                                    
                                </div>
                            </div>
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
                                            <th width="3%">#</th>
                                            <th width="25%">Description</th>
                                            <th width="7%">SSL</th>
                                            <th width="7%">BOH</th>
                                            <th width="7%">Ordered Qty.</th>
                                            <th width="7%">Unit Cost</th>
                                            <th width="7%">Estimated Cost</th>
                                            <th width="36%">
                                                <tr width="100%">
                                                    <th>IAR NO</th>
                                                    <th>Received Qty</th>
                                                    <th>Date Received</th>
                                                    <th></th>
                                                </tr>
                                            </th>
                                            <th width="7%"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="po_tbody">
                                        <tr v-for="(dmd,index) in view_po_form.dmd_purchase_orders" :key="dmd.dmd_id">
                                            <td width="3%">{{ index + 1}}</td>
                                            <td width="25%">
                                                <tr><td colspan="2"><span class="text-bold">{{ dmd.dmddesc }}</span></td></tr>
                                                <tr><td class="text-bold" width="30%">Brand:</td><td width="auto">{{ dmd.brand_desc }}</td></tr>
                                                <tr><td class="text-bold" width="30%">Manufacturer:</td><td width="auto">{{ dmd.manufacturer_desc }}</td></tr>
                                                <tr><td class="text-bold" width="30%">Supplier:</td><td width="auto">{{ dmd.supplier_name }}</td></tr>
                                                <tr><td class="text-bold" width="30%">Packaging:</td><td width="auto">{{ dmd.packaging_desc }}</td></tr>
                                            </td>
                                            <td width="7%" class="text-right">{{ dmd.ssl | numeral3 }}</td>
                                            <td width="7%" class="text-right">{{ dmd.boh | numeral3 }}</td>
                                            <td width="7%" class="text-right">{{ dmd.order_quantity | numeral3 }}</td>
                                            <td width="7%" class="text-right"><span>{{ dmd.cost_price | currency2 }}</span></td>
                                            <td width="7%" class="text-right"><span>{{ dmd.order_quantity * dmd.cost_price | currency2}}</span></td>
                                            <td width="36%">
                                                <tr width="100%" v-for="dpr in dmd.dmd_po_receiveds" :key="dpr.id">
                                                    <td>{{ dpr.iar_no }}</td>
                                                    <td>{{ dpr.received_quantity }}</td>
                                                    <td>{{ dpr.date_received }}</td>
                                                    <td>
                                                        <button class="btn btn-success btn-sm" type="button">Edit</button>
                                                    </td>
                                                </tr>
                                            </td>
                                            <td width="7%" class="text-center">
                                                <button type="button" class="btn btn-sm btn-success" @click="receive_modal(dmd)">
                                                    Receive
                                                </button>
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
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            PO #: <span v-if="view_po_form.po_id"> {{ view_po_form.po_id}}</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form @submit.prevent="receive()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="" class="label form-label">Item Description:</label>
                                    {{ receive_form.dmddesc }}
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="" class="label form-label">Receiving Officer: </label>
                                    </div>
                                    <div class="col-md-8">
                                        <select class="form-control form-control-sm" v-model="receive_form.officer_id">
                                            <option v-for="ro in receiving_officers" :key="ro.id" :value="ro.id">
                                                {{ ro.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="" class="label form-label">Inspection Officer: </label>
                                    </div>
                                    <div class="col-md-8">
                                        <select class="form-control form-control-sm" v-model="receive_form.inspector_id">
                                            <option v-for="i in inspectors" :key="i.id" :value="i.id">
                                                {{ i.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="" class="label form-label">Quantity: </label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control form-control-sm text-right" v-model="receive_form.order_quantity" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="" class="label form-label">Expiry Date: </label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="date" class="form-control form-control-sm text-right" v-model="receive_form.expiry_date" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="" class="label form-label">Date Received: </label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="date" class="form-control form-control-sm text-right" v-model="receive_form.date_received" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="" class="label form-label">Remarks: </label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control form-control-sm" v-model="receive_form.remarks">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" >
                                <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" aria-label="Close">Close</button>
                                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- col-md-12 receiveModal -->
        <div class="col-md-12">
            <div class="modal fade" id="dvModal" tabindex="-1" role="dialog" aria-labelledby="dvModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            PO #: <span v-if="dv_form.purchase_order_id"> {{ dv_form.purchase_order_id}}</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <span>Item Description:</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span>{{ dv_form.dmddesc }}</span>
                                    </div>
                                    <div class="col-md-3">
                                        <select v-model="dv_form.vat_exempt" class="form-control form-control-sm">
                                            <option value="0"></option>
                                            <option value="1">VAT-EXEMPT</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <span>
                                            Approving Officer:
                                        </span>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control form-control-sm" v-model="dv_form.approving_officer_id">
                                            <option v-for="ao in approving_officers" :key="ao.id" :value="ao.id">{{ ao.officer_name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        Supplier:
                                    </div>
                                    <div class="col-md-9">
                                        <span>{{ dv_form.supplier_name }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        
                                    </div>
                                    <div class="col-md-9">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        Attachments:
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="button" class="btn btn-sm btn-primary" @click="add_attachment()">Add Attachment</button>
                                    </div>
                                    <div class="w-100 mb-2"></div>
                                    <div class="col-md-11">
                                        <table class="table table-sm table-hover">
                                            <tbody>
                                                <tr v-for="(at, index) in dv_form.attachments" :key="index">
                                                    <td width="3%">{{ index + 1 }}</td>
                                                    <td>{{ at.attachment }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>  
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-sm btn-warning">Cancel</button>
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- col-md-12 dvModal -->
        <div class="modal fade" id="noticeToTerminateModal" tabindex="-1" role="dialog" aria-labelledby="noticeToTerminateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        Notice To Terminate
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
                    <form  @submit.prevent="notice_to_terminate()">
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="" class="form-label"></label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-warning">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="terminateModal" tabindex="-1" role="dialog" aria-labelledby="terminateModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span>Terminate PO# {{ terminate_form.po_id }} </span>    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
                    <form  @submit.prevent="terminate()">
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="" class="form-label">Please Select:</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control form-control-sm" v-model="terminate_form.waiver" required>
                                        <option :value="1">With Waiver</option>
                                        <option :value="0">Without Waiver</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-warning">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="attachmentModal" tabindex="-1" role="dialog" aria-labelledby="attachmentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span>PO No.: {{ dv_form.purchase_order_id }}</span>    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
                    <form  @submit.prevent="attachment()">
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="" class="form-label">Attachment: </label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control form-control-sm" v-model="attachment_form.attachment_id">
                                        <option v-for="at in attachments" :key="at.id" :value="at.id">
                                            {{ at.attachment_desc }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    Number/Date/Particulars
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-control-sm" v-model="attachment_form.attachment_text">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-warning">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
export default {
    data(){
        return{
            editmode: false,
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
                id: '',
                brand_id: '',
                dmd_id: '',
                dmd_po_id: '',
                list_no: '',
                dmddesc: '',
                order_quantity: '',
                officer_id: '',
                inspector_id: '',
                expiry_date: '',
                date_received: '',
            }),
            terminate_form: new Form({
                purchase_order_id: '',
                po_id: '',
                waiver: '',
            }),
            dv_form: new Form({
                purchase_order_id: '',
                vat_exempt: '',
                total_amount: '',
                attachments: [],
                dmddesc: '',
                approving_officer_id: '',
                supplier_name: '',
            }),
            receiving_officers: [],
            inspectors: [],
            attachments: [],
            attachment_form: new Form({
                attachment_id: '',
                purchase_order_id: '',
                attachment_text: '',
            }),
            approving_officers: [],
        }
    },
    methods:{
        get_receiving_officers(){
            axios.get('../../api/receiving_officer').then(({data}) => {
                this.receiving_officers = data;
            }).catch(() => {

            });
        },
        get_inspectors(){
            axios.get('../../api/inspector').then(({data}) => {
                this.inspectors = data;
            }).catch(() => {

            });
        },
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
        add_attachment(){
            $('#attachmentModal').modal('show');

        },
        get_attachments(){
            axios.get('../../api/attachment').then(({data}) => {
                this.attachments = data;
            }).catch(() => {

            });
        },
        dv_modal(po){
            $('#dvModal').modal('show');
            this.dv_form.purchase_order_id = po.po_id;
            this.dv_form.supplier_name = po.supplier_name;
            axios.get('../../api/get_attachments/'+po.purchase_order_id).then(({data}) => {
                this.dv_form.attachments = data;
            }).catch(() => {

            });
            axios.get('../../api/get_dv_item/'+po.purchase_order_id).then(({data}) => {
                this.dv_form.dmddesc = data.dmddesc;
                this.dv_form.total_amount = data.total_amount;
            }).catch(() => {

            });
        },
        receive_modal(dmd){
            $('#receiveModal').modal('show');
            this.receive_form.fill(dmd);
            this.receive_form.qty = dmd.order_quantity;
        },
        receive(){
            this.receive_form.post('../../api/dmd_po_receive').then(() => {
                $('#receiveModal').modal('hide');
            }).catch(() => {

            });
        },
        update_receive(){
            this.receive_form.put('../../api/dmd_po_receive/'+this.receive_form.id).then(() => {

            }).catch(() => {

            });
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
        notice_to_terminate(po){
            axios.put('../../api/notice_to_terminate/'+po.purchase_order_id).then(() => {

            }).catch(() => {

            });
        },
        terminate_modal(po){
            this.terminate_form.fill(po);
            $('#terminateModal').modal('show');
        },
        terminate(){
            this.terminate_form.put('../../api/terminate_po/'+this.terminate_form.purchase_order_id).then(() => {
                $('#terminateModal').modal('hide');
            }).catch(() => {

            });
        },
        get_approving_officers(){
            axios.get('../../api/approving_officer').then(({data}) => {
                this.approving_officers = data;
            }).catch(() => {

            });
        }
    },
    created(){
        this.get_pos();
        this.get_receiving_officers();
        this.get_inspectors();
        this.get_approving_officers();
        this.get_attachments();
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
