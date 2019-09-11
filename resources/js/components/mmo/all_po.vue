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
                        <th width="32%" class="text-center">Supplier</th>
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
                        <th @click="view_po(po)" width="8%" :class="{ 'table-danger' : po.terminated == 1 }">
                            <span v-if="po.terminated == 1">Terminated</span>
                            <span v-else></span>
                        </th>
                        <th width="12%">
                            <button type="button" class="btn btn-sm btn-success" v-if="po.csid == 26" @click="mmo_rcv(po.purchase_order_id)">
                                <i class="fas fa-file-download"></i>
                            </button>
                            <div class="btn-group dropleft btn-sm" v-if="po.csid == 16">
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
                                        <span>
                                            <button class="dropdown-item" @click="terminate_modal(po)">Terminate</button>
                                        </span>
                                        <span>
                                            <button class="dropdown-item" @click="dv_modal(po)">Disburesment Voucher</button>
                                        </span>
                                    </span>
                                    <span v-else>
                                        <button class="dropdown-item" @click="unterminate(po.purchase_order_id)">Unterminate</button>
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
                                                    <th class="text-center">IAR NO</th>
                                                    <th class="text-center">Received Qty</th>
                                                    <th class="text-center">Date Received</th>
                                                    <th class="text-center"></th>
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
                                                    <td class="text-center">{{ dpr.iar_no }}</td>
                                                    <td class="text-center">{{ dpr.received_quantity }}</td>
                                                    <td class="text-center">{{ dpr.date_received | myDate3 }}</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-success btn-sm" type="button">
                                                            Edit
                                                        </button>
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
                                        <label for="" class="label form-label">Days Delayed: </label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control form-control-sm text-right" v-model="receive_form.days_delayed">
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
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            PO #: <span v-if="dv_form.purchase_order_id"> {{ dv_form.purchase_order_id}}</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form @submit.prevent="store_dv()">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="" class="label form-label"><span>Item Description:</span></label>
                                            </div>
                                            <div class="col-md-6">
                                                <span>{{ dv_form.dmddesc }}</span>
                                            </div>
                                            <!-- <div class="col-md-3">
                                                <select v-model="dv_form.vat_exempt" class="form-control form-control-sm">
                                                    <option value="0"></option>
                                                    <option value="1">VAT-EXEMPT</option>
                                                </select>
                                            </div> -->
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="" class="label form-label">
                                                    <span>Approving Officer:</span>
                                                </label>
                                            </div>
                                            <div class="col-md-9">
                                                <select class="form-control form-control-sm" v-model="dv_form.approving_officer_id" required>
                                                    <option v-for="ao in approving_officers" :key="ao.id" :value="ao.id">{{ ao.officer_name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="" class="label form-label">
                                                    <span>Supplier:</span>
                                                </label>
                                            </div>
                                            <div class="col-md-9">
                                                <span>{{ dv_form.supplier_name }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="" class="label form-label">
                                                    <span>Amount (Payment):</span>
                                                </label>
                                            </div>
                                            <div class="col-md-9 text-right">
                                                <span>{{ dv_form.total_amount | currency2 }}</span>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="" class="label form-label">
                                                    <span>Tax Base:</span>
                                                </label>
                                            </div>
                                            <div class="col-md-9 text-right">
                                                <span>{{ dv_form.total_amount | currency2 }}</span>
                                            </div>
                                        </div> -->
                                        <!-- <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="" class="label form-label">
                                                    <span>Taxes:</span>
                                                </label>
                                            </div>
                                            <div class="col-md-9 text-right">
                                                <div class="row">
                                                    <div class="col-md-6">EWT 1%: [{{ dv_form.total_amount | currency2 }} x 1%]</div>
                                                    <div class="col-md-6">{{ dv_form.total_amount * 0.01 | currency2 }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6"></div>
                                                    <div class="col-md-6"></div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="" class="label form-label">
                                                    <span>
                                                        Liquidated Damages
                                                    </span>
                                                </label>
                                            </div>
                                            <!-- <div class="col-md-auto">

                                            </div> -->
                                            <div class="col-md-11">
                                                <table class="table table-sm table-hover" style="height: 4rem; display: -moz-groupbox; ">
                                                    <thead>
                                                        <tr>
                                                            <th>IAR NO</th>
                                                            <th>Taxes</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="overflow-y: scroll; height: 4rem; width: 98.5%; position: absolute;">
                                                        <tr v-for="ld in dv_form.liquidated_damages" :key="ld.iar_no">
                                                            <td>{{ ld.iar_no }}</td>
                                                            <td>{{ ld.tax | currency }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="" class="label form-label">
                                                    <span>
                                                        Attachments:
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-md-5 text-right">
                                                <button type="button" class="btn btn-sm btn-primary" @click="add_attachment()">Add Attachment</button>
                                            </div>
                                            <div class="w-100 mb-2"></div>
                                            <div class="col-md-11">
                                                <table class="table table-sm table-hover" style="height: 12rem; display: -moz-groupbox; ">
                                                    <tbody style="overflow-y: scroll; height: 11rem; width: 98.5%; position: absolute;">
                                                        <tr v-for="(at, index) in dv_form.attachments" :key="index">
                                                            <td width="3%">{{ index + 1 }}</td>
                                                            <td>{{ at.attachment }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
        </div> <!-- col-md-12 noticeToTerminateModal -->
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
        </div> <!-- col-md-12 terminateModal -->
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
                                    <label for="" class="label form-label">Number/Date/Particulars:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-control-sm" v-model="attachment_form.number_date_particulars">
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
        </div> <!-- col-md-12 attachmentModal -->
    </div>
</template>
<script>
    export default {
        data(){
            return{
                editmode: false,
                editmode_2: false,
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
                    days_delayed: '',
                }),
                terminate_form: new Form({
                    purchase_order_id: '',
                    po_id: '',
                    waiver: '',
                }),
                dv_form: new Form({
                    purchase_order_id: '',
                    po_id: '',
                    vat_exempt: 0,
                    total_amount: '',
                    attachments: [],
                    liquidated_damages: [],
                    dmddesc: '',
                    approving_officer_id: '',
                    supplier_name: '',
                    tax_id: '',
                }),
                receiving_officers: [],
                inspectors: [],
                attachments: [],
                attachment_form: new Form({
                    po_id: '',
                    purchase_order_id: '',
                    attachment_id: '',
                    number_date_particulars: '',
                }),
                approving_officers: [],
            }
        },
        methods:{
            store_dv(){
                this.dv_form.post('../../api/dv').then(({data}) => {
                    console.log(data);
                    $('#dvModal').modal('hide');
                }).catch(() => {

                });
            },
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
            attachment(){
                this.attachment_form.post('../../api/attachment').then(() => {
                    
                    $('#attachmentModal').modal('hide');
                    this.attachment_form.attachment_id = '';
                    this.attachment_form.number_date_particulars = '';
                    this.refresh_attachment();
                    
                }).catch(() => {

                });
            },
            refresh_attachment(){
                axios.get('../../api/get_attachments/'+dv_form.purchase_order_id).then(({data}) => {
                    this.dv_form.attachments = data;
                }).catch(() => {

                });
            },
            add_attachment(){
                this.editmode_2 = false;  
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
                    this.dv_form.purchase_order_id = po.purchase_order_id;
                    this.dv_form.po_id = po.po_id;
                    this.attachment_form.purchase_order_id = po.purchase_order_id;
                    this.attachment_form.po_id = po.po_id;
                    this.dv_form.supplier_name = po.supplier_name;
                axios.get('../../api/get_attachments/'+po.purchase_order_id).then(({data}) => {
                    this.dv_form.attachments = data;
                }).catch(() => {

                });
                axios.get('../../api/get_liquidated_damages/'+po.purchase_order_id).then(({data}) => {
                    this.dv_form.liquidated_damages = data;
                }).catch(() => {

                });
                axios.get('../../api/get_dv_item/'+po.purchase_order_id).then(({data}) => {
                    this.dv_form.dmddesc = data.dmddesc;
                    this.dv_form.total_amount = data.total_amount;
                    this.dv_form.tax_id = data.tax_id;
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
            unterminate(id){
                axios.put('../../api/unterminate_po/'+id).then(() => {

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
            },
            vat_minus_amount(){
                let sum = 0;
                    sum = (this.dv_form.total_amount - (this.dv_form.total_amount * 0.01));
                return sum;
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
        overflow-x: hidden;
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
