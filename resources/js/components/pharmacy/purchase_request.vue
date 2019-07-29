<template>
    <div class="row">
        <div class="col-md-12">
             <div class="row mb-1 shadow p-3 mb-3 bg-white rounded">
                <h4><i class="fas fa-shopping-cart"></i> Purchase Request</h4>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="new-tab" data-toggle="tab" href="#new" role="tab" aria-controls="new" aria-selected="true" >New</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="false">All</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-tab">
                    <div class="table-responsive-sm mt-4">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>PR #</th>
                                    <th>Date Created</th>
                                    <th>Status</th>
                                    <th>Mode</th>
                                    <th>Supplier</th>
                                    <th width="30%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="prs in new_purchase_requests" :key="prs.purchase_request_id" v-show="prs.dmd_purchase_requests.length" :class="{ 'table-danger' : prs.status == 2, 'table-success' : prs.status == 1 }">
                                    <td>{{ prs.created_at | myDate }} - {{ prs.purchase_request_id | numeral2 }}</td> 
                                    <td>{{ prs.created_at | myDate4}} - {{ prs.created_at | time1}}</td>
                                    <td>
                                        <span v-show="prs.status == 0">Pending</span>
                                        <span v-show="prs.status == 1">Approved</span>
                                        <span v-show="prs.status == 2">Disapproved</span>
                                    </td>
                                    <td>{{ prs.mode.mode_desc }}</td>
                                    <td>
                                        <span v-if="!prs.supplier"></span>
                                        <span v-else>{{ prs.supplier.supplier_name }}</span>
                                    </td>
                                    <td width="30%" class="text-center">
                                        <div id="print" class="mb-2">
                                            <button type="button" class="btn btn-sm btn-primary" @click="view_pr(prs.purchase_request_id)"><i class="fas fa-eye"></i></button>
                                            <button type="button" class="btn btn-sm btn-success" @click="track_pr(prs)"><i class="fas fa-truck"></i></button>
                                            <router-link v-show="current_user.role_id == 2" class="btn btn-sm btn-success" :to="{ name: 'pr', params: { id: prs.purchase_request_id }}"><i class="fas fa-print"></i> PR</router-link>
                                            <router-link v-show="current_user.role_id == 2" class="btn btn-sm btn-success" :to="{ name: 'sps', params: { id: prs.purchase_request_id }}"><i class="fas fa-print"></i> SPS</router-link>
                                        </div>
                                        <div id="document_tracking" class="">
                                            <div v-show="current_user.role_id == 5">
                                                <button type="button" class="btn btn-sm btn-success" v-show="!prs.div_head_rcv" @click="div_head_rcv(prs.purchase_request_id)">Received From End User <i class="fas fa-file-download"></i></button>
                                                <button type="button" class="btn btn-sm btn-danger" v-show="prs.div_head_rcv && !prs.div_head_rls && prs.status == 1" @click="div_head_rls(prs.purchase_request_id)">Send To PMO <i class="fas fa-file-upload"></i></button>
                                            </div>
                                            <div v-show="current_user.role_id == 3">
                                                <button type="button" class="btn btn-sm btn-success" v-show="!prs.pmo_rcv" @click="pmo_rcv(prs.purchase_request_id)">Received From CMPS <i class="fas fa-file-download"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="table-responsive-sm mt-4">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>PR #</th>
                                    <th>Date Created</th>
                                    <th>Status</th>
                                    <th>Mode</th>
                                    <th>Supplier</th>
                                    <th width="30%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="prs in purchase_requests" :key="prs.purchase_request_id" v-show="prs.dmd_purchase_requests.length"  :class="{ 'table-danger' : prs.status == 2, 'table-success' : prs.status == 1 }">
                                    <td>{{ prs.created_at | myDate }} - {{ prs.purchase_request_id | numeral2 }}</td>
                                    <td>{{ prs.created_at | myDate4}} - {{ prs.created_at | time1}}</td>
                                    <td>
                                        <span v-show="prs.status == 0">Pending</span>
                                        <span v-show="prs.status == 1">Approved</span>
                                        <span v-show="prs.status == 2">Disapproved</span>
                                    </td>
                                    <td>{{ prs.mode.mode_desc }}</td>
                                    <td><span v-if="!prs.supplier"></span><span v-else>{{ prs.supplier.supplier_name }}</span></td>
                                    <td width="30%" class="text-center">
                                        <div id="print" class="mb-2">
                                            <button type="button" class="btn btn-sm btn-primary" @click="view_pr(prs.purchase_request_id)"><i class="fas fa-eye"></i></button>
                                            <button type="button" class="btn btn-sm btn-success" @click="track_pr(prs)"> <i class="fas fa-truck"></i></button>
                                            <router-link v-show="current_user.role_id == 2" class="btn btn-sm btn-success" :to="{ name: 'pr', params: { id: prs.purchase_request_id }}"><i class="fas fa-print"></i> PR</router-link>
                                            <router-link v-show="current_user.role_id == 2" class="btn btn-sm btn-success" :to="{ name: 'sps', params: { id: prs.purchase_request_id }}"><i class="fas fa-print"></i> SPS</router-link>
                                        </div>
                                        <div id="document_tracking" class="">
                                            <div v-show="current_user.role_id == 5">
                                                <button type="button" class="btn btn-sm btn-success" v-show="!prs.div_head_rcv" @click="div_head_rcv(prs.purchase_request_id)">Received From End User <i class="fas fa-file-download"></i></button>
                                                <button type="button" class="btn btn-sm btn-danger" v-show="prs.div_head_rcv && !prs.div_head_rls && prs.status == 1" @click="div_head_rls(prs.purchase_request_id)">Send To PMO <i class="fas fa-file-upload"></i></button>
                                            </div>
                                            <div v-show="current_user.role_id == 3">
                                                <button type="button" class="btn btn-sm btn-success" v-show="!prs.pmo_rcv" @click="pmo_rcv(prs.purchase_request_id)">Received From CMPS <i class="fas fa-file-download"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="prModal" tabindex="-1" role="dialog" aria-labelledby="prModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- {{ view_pr_form.created_at | myDate }} - {{ view_pr_form.purchase_request_id | numeral2 }} -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive-sm">
                                <table class="table table-sm table-hover" id="pr_table">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="5%">#</th>
                                            <th width="20%">Description</th>
                                            <th>Packaging</th>
                                            <th>SSL</th>
                                            <th>BOH</th>
                                            <th>Item In Transit</th>
                                            <th width="10%">Quantity</th>
                                            <th>Unit Cost</th>
                                            <th>Estimated Cost</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="!isLoading" id="pr_tbody">
                                        <tr v-for="(dmd,index) in view_pr_form.dmd_purchase_requests" :key="dmd.dmd_id">
                                            <td width="5%">{{ index + 1}}</td>
                                            <td width="20%">{{ dmd.dmd.dmddesc }}</td>
                                            <td class="text-right table-danger">{{  }}</td>
                                            <td class="text-right table-danger">{{ dmd.dmd.ssl | numeral3 }}</td>
                                            <td class="text-right table-danger">{{ dmd.dmd.boh | numeral3 }}</td>
                                            <td class="text-right table-danger"></td>
                                            <td width="10%" class="text-right">
                                                <input v-if="!view_pr_form.send" type="number" class="form-control form-control-sm text-right" v-model="dmd.request_quantity">
                                                <div v-else>{{ dmd.request_quantity }}</div>
                                            </td>
                                            <td class="text-right">
                                                <span>{{ dmd.cost_price | currency2 }}</span>
                                            </td>
                                            <td  class="text-right">
                                                
                                                <span>{{ dmd.request_quantity * dmd.cost_price | currency2}}</span></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-danger" @click="remove_item(dmd.id)">
                                                    <i class="fas fa-times-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <div class="spinner-border" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </tbody>
                                </table>
                                <span v-if="view_pr_form.purchase_request_remarks != null">Remarks: {{ view_pr_form.purchase_request_remarks.remarks }}</span>
                                <span v-else></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button v-show="current_user.role_id == 5 && view_pr_form.status == 0" type="button" class="btn btn-sm btn-success" @click="approved_pr()">
                                Approved
                            </button>
                            <button v-show="current_user.role_id == 5 && view_pr_form.status == 0" type="button" class="btn btn-sm btn-danger" @click="disapproved_modal()">
                                Disapproved
                            </button>
                            <button v-show="current_user.role_id == 2 && !view_pr_form.send" type="button" class="btn btn-sm btn-success" @click="send_to_cmps(view_pr_form.purchase_request_id)">
                                Send to CMPS
                            </button>
                            <button v-show="view_pr_form.mode_id == '4' && view_pr_form.rfq === null && current_user.role_id == 3" type="button" class="btn btn-light btn-sm" @click="store_rfq(view_pr_form.purchase_request_id)">
                                Request for Quotation
                            </button>
                            <button v-show="!view_pr_form.purchase_order_id && view_pr_form.mode_id == 1 && current_user.role_id == 3" type="button" class="btn btn-success btn-sm" @click="store_po(view_pr_form.purchase_request_id)">
                                Purchase Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="trackModal" tabindex="-1" role="dialog" aria-labelledby="trackModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{ track_pr_modal.created_at | myDate }} - {{ track_pr_modal.purchase_request_id | numeral2 }}
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.div_head_rcv  }">Division Head Received <div v-show="track_pr_modal.div_head_rcv">{{ track_pr_modal.div_head_rcv | myDate3 }}, {{ track_pr_modal.div_head_rcv | time1 }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.div_head_rls }">Division Head Released <div v-show="track_pr_modal.div_head_rls">{{ track_pr_modal.div_head_rls | myDate3 }}, {{ track_pr_modal.div_head_rls | time1 }}</div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.pmo_rcv }">PMO Received <div v-show="track_pr_modal.pmo_rcv">{{ track_pr_modal.pmo_rcv | myDate3 }}, {{ track_pr_modal.pmo_rcv | time1 }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.pmo_rls }">PMO Released <div v-show="track_pr_modal.pmo_rls">{{ track_pr_modal.pmo_rls | myDate3 }}, {{ track_pr_modal.pmo_rls | time1 }} </div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">  
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.div_head_rcv_2 }">Division Head Received <div v-show="track_pr_modal.div_head_rcv_2">{{ track_pr_modal.div_head_rcv_2 | myDate3 }}, {{ track_pr_modal.div_head_rcv_2 | time1 }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.div_head_rls_2 }">Division Head Released <div v-show="track_pr_modal.div_head_rls_2">{{ track_pr_modal.div_head_rls_2 | myDate3 }}, {{ track_pr_modal.div_head_rls_2 | time1 }} </div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.pmo_rcv_2 }">PMO Received <div v-show="track_pr_modal.pmo_rcv_2">{{ track_pr_modal.pmo_rcv_2 | myDate3 }}, {{ track_pr_modal.pmo_rcv_2 | time1 }} </div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.pmo_rls_2 }">PMO Released <div v-show="track_pr_modal.pmo_rls_2">{{ track_pr_modal.pmo_rls_2 | myDate3 }}, {{ track_pr_modal.pmo_rls_2 | time1 }}</div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">  
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.budget_rcv }">Budget Received <div v-show="track_pr_modal.budget_rcv">{{ track_pr_modal.budget_rcv | myDate3 }}, {{ track_pr_modal.budget_rcv | time1 }} </div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.budget_rls }">Budget Released <div v-show="track_pr_modal.budget_rls">{{ track_pr_modal.budget_rls | myDate3 }}, {{ track_pr_modal.budget_rls | time1 }} </div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.mcc_rcv }">MCC Received <div v-show="track_pr_modal.mcc_rcv">{{ track_pr_modal.mcc_rcv | myDate3 }}, {{ track_pr_modal.mcc_rcv | time1 }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.mcc_rls }">MCC Released <div v-show="track_pr_modal.mcc_rls">{{ track_pr_modal.mcc_rls | myDate3 }}, {{ track_pr_modal.mcc_rls | time1 }} </div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.fmo_rcv }">FMO Received <div v-show="track_pr_modal.fmo_rcv">{{ track_pr_modal.fmo_rcv | myDate3 }}, {{ track_pr_modal.fmo_rcv | time1 }} </div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.fmo_rls }">FMO Released <div v-show="track_pr_modal.fmo_rls">{{ track_pr_modal.fmo_rls | myDate3 }}, {{ track_pr_modal.fmo_rls | time1 }}</div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.pmo_rcv_3 }">PMO Received <div v-show="track_pr_modal.pmo_rcv_3">{{ track_pr_modal.pmo_rcv_3 | myDate3 }}, {{ track_pr_modal.pmo_rcv_3 | time1 }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.pmo_rls_3 }">PMO Released <div v-show="track_pr_modal.pmo_rls_3">{{ track_pr_modal.pmo_rls_3 | myDate3 }}, {{ track_pr_modal.pmo_rls_3 | time1 }}</div></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="disapprovedModal" tabindex="-1" role="dialog" aria-labelledby="disapprovedModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" id="d_modal_content">
                        <div class="modal-header">
                            Remarks
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <form>
                                        <div class="form-group">
                                            <textarea rows="4" class="form-control form-control-sm" v-model="pr_remarks">
                                            </textarea>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-sm btn-warning" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-sm btn-success" @click="store_pr_remarks()">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
import {Money} from 'v-money'
export default {
    components: {Money},
    data(){
        return{
            
            pr_remarks: '',
            purchase_requests: [],
            new_purchase_requests: [],
            view_pr_form: new Form({
               purchase_request_id: '',
               dmd_purchase_requests: [],
               purchase_order_id: '',
               mode_id: '',
               rfq: {},
               created_at: '',
               send: '',
               status: '',
               purchase_request_remarks: {},
               send: '',
            }),
            isLoading: false,
            track_pr_modal: {},
            selected_id: '',
        }
    },
    methods:{
        send_to_cmps(id){
            this.view_pr_form.put('../../api/send_to_cmps/'+id).then(() =>{
                $('#prModal').modal('hide');
                toast.fire({
                    type: 'success',
                    title: 'Send Successfuly'
                });
            }).catch(() => {

            });
        },
        get_prs(){
            axios.get('../../api/purchase_request').then(({data}) => {
                this.purchase_requests = data;
            }).catch(() => {

            });
        },
        get_new_prs(){
            axios.get('../../api/new_purchase_request').then(({data}) => {
                this.new_purchase_requests = data;
            }).catch(() => {

            });
        },
        view_pr(id){
            this.view_pr_form.reset();
            axios.get('../../api/purchase_request/'+id).then(({data}) => {
                    this.selected_id = id;
                    this.isLoading = true;
                    this.view_pr_form.fill(data);
                    this.isLoading = false;
                }).catch(() => {

                });
            $('#prModal').modal('show')
        },
        disapproved_modal(){
            $('#disapprovedModal').modal('show');
        },
        store_pr_remarks(){
            axios.post('../../api/pr_remarks', {
                remarks: this.pr_remarks,
                purchase_request_id: this.view_pr_form.purchase_request_id,
                user_id: this.current_user.user_id,
            }).then(() => {
                $('#disapprovedModal').modal('hide');
            }).catch(() => {

            });
        },
        approved_pr(){
            axios.put('../../api/approved_pr/'+this.view_pr_form.purchase_request_id).then(() => {
                $('#prModal').modal('hide');
            }).catch(() => {

            });
        },
        track_pr(prs){
            this.track_pr_modal = prs;
            $('#trackModal').modal('show')
        },
        div_head_rcv(id){
            axios.put('../../api/div_head_rcv/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PR Recieved'
                });
            }).catch(() => {

            });
        },
        div_head_rls(id){
            axios.put('../../api/div_head_rls/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PR Release'
                });
            }).catch(() => {

            });
        },
        pmo_rcv(id){
            axios.put('../../api/pmo_rcv/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PR Received'
                });
            }).catch(() => {

            });
        },
        pmo_rls(id){
            axios.put('../../api/pmo_rls/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PR Release'
                });
            }).catch(() => {

            });
        },
        store_po(id){
            this.view_pr_form.put('../../api/purchase_request/'+id).then(() =>{
                $('#prModal').modal('hide');
                toast.fire({
                    type: 'success',
                    title: 'Purchase Order Created Successfully'
                });
            }).catch(() => {

            });
        },
        store_rfq(id){
            this.view_pr_form.post('../../api/rfq').then(() => {
                $('#prModal').modal('hide');
                toast.fire({
                    type: 'success',
                    title: 'Request For Quotation Created Successfully'
                });
            }).catch(() => {

            });
        },
        remove_item(id){
            axios.delete('../../api/dmd_pr/'+id).then(() => {
                this.view_pr(this.selected_id);
                this.get_prs();
            }).catch(()=> {

            });
        },
    },
    computed: {
        current_user() {
            return this.$store.getters.current_user;
        }
    },
    created(){
        this.get_prs();
        this.get_new_prs();
    },
    mounted(){
        window.Echo.channel("pr_created").listen(".purchase_request.created", (e) => {
            this.get_prs();
            this.get_new_prs();
        });
        window.Echo.channel("pr_updated").listen(".purchase_request.updated", (e) => {
            this.get_prs();
            this.get_new_prs();
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

    #pr_table{
        height: 20rem;             
        display: -moz-groupbox; 
    }

    #pr_tbody{
        overflow-y: scroll;      
        height: 18rem;           
        width: 98.5%;
        position: absolute;
    }
</style>
