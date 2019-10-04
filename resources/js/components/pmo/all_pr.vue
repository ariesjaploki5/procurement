<template>
    <div class="row">
        <div class="col-md-12">
            <span>Purchase Requests</span>
        </div>
        <div class="col-md-12 mt-1">
            <form @submit.prevent="search()">
                <div class="row">
                    <div class="col-md-auto">
                        <label for="" class="form-label">PR #</label>
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
                        <th width="10%">PR #</th>
                        <th width="12%">Date Created</th>
                        <th width="8%"  class="text-center">CMPS Status</th>
                        <th width="15%">Track</th>
                        <th width="10%">Mode</th>
                        <th width="40%">Supplier</th>
                        <th width="5%"></th>
                    </tr>
                </thead>
                <tbody class="table-bordered">
                    <tr v-for="(pr, index) in prs" :key="index" >
                        <td @click="view_pr(pr)" width="10%">{{ pr.pr_id }}</td> 
                        <td @click="view_pr(pr)" width="12%">{{ pr.created_at | myDate4}} - {{ pr.created_at | time1}}</td>
                        <td @click="view_pr(pr)" width="8%" class="text-center">
                            <span v-show="pr.status == 2">Disapproved</span>
                            <span v-show="pr.status == 1">Approved</span>
                            <span v-show="pr.status == 0">Pending</span>
                        </td>
                        <td @click="view_pr(pr)" width="15%">
                            <span v-if="pr.cdi2">{{ pr.csd2 }}</span>
                            <span v-else>{{ pr.csd }}</span>
                        </td>
                        <td @click="view_pr(pr)" width="10%">{{ pr.mode_desc }}</td>
                        <td @click="view_pr(pr)" width="45%">
                            <span v-if="pr.supplier_name">{{ pr.supplier_name }}</span>
                        </td>
                        <td width="5%">
                            <span v-if="pr.csi">
                                <button type="button" class="btn btn-sm btn-success" v-if="pr.csi == 3" @click="pmo_rcv(pr.pr_id)">
                                    <i class="fas fa-file-download"></i>
                                </button>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <div class="modal fade" id="prModal" tabindex="-1" role="dialog" aria-labelledby="prModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            PR #: <span v-if="view_pr_form.pr_id">  {{ view_pr_form.pr_id}}</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive-sm">
                                <table class="table table-sm table-hover" id="pr_table">
                                    <thead>
                                        <tr>
                                            <th width="5%" class="text-center">#</th>
                                            <th width="25%" class="text-center">Item Desc</th>
                                            <th class="text-center">SSL</th>
                                            <th class="text-center">BOH</th>
                                            <th width="10%" class="text-center">Quantity</th>
                                            <th width="10%" class="text-center">Cost</th>
                                            <th width="15%" class="text-center">Estimated Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody id="pr_tbody">
                                        <tr v-for="(dmd,index) in view_pr_form.dmd_purchase_requests" :key="dmd.dmd_id">
                                            <td width="5%" class="text-right">
                                                {{ index + 1}}
                                            </td>
                                            <td width="25%">
                                                <span>{{ dmd.dmddesc }}</span>
                                            </td>
                                            <td class="text-right">
                                                <span>{{ dmd.ssl | numeral3 }}</span> 
                                            </td>
                                            <td class="text-right">
                                                <span>{{ dmd.boh | numeral3 }}</span>
                                            </td>
                                            <td width="10%" class="text-right">
                                                <span>{{ dmd.request_quantity | numeral3 }}</span>
                                            </td>
                                            <td width="10%" class="text-right">
                                                <span>{{ dmd.cost_price | currency2 }}</span>
                                            </td>
                                            <td width="15%"  class="text-right">
                                                <span>{{ dmd.request_quantity * dmd.cost_price | currency2}}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <span v-if="!view_pr_form.purchase_request_remark"></span>
                                <span v-else>Remarks: {{ view_pr_form.purchase_request_remarks.remarks }}</span>
                            </div>
                        </div>
                        <div class="modal-footer" >
                            <button v-show="view_pr_form.mode_id == '4' && view_pr_form.rfq_id == null" type="button" class="btn btn-light btn-sm" @click="store_rfq()">
                                Request for Quotation
                            </button>
                            <button v-show="!view_pr_form.po_id && view_pr_form.mode_id == 1" type="button" class="btn btn-success btn-sm" @click="store_pr_po(view_pr_form.pr_id)">
                                Purchase Order
                            </button>
                            <button v-show="!view_pr_form.po_id && view_pr_form.mode_id == 4 && view_pr_form.rfq_id" type="button" class="btn btn-success btn-sm" @click="rfqPo_modal()">
                                Purchase Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- col-md-12 prmodal -->
        <div class="col-md-12">
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
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.div_head_rcv }">Division Head Received <div>{{ track_pr_modal.div_head_rcv }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.div_head_rls }">Division Head Released <div>{{ track_pr_modal.div_head_rcv }}</div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.pmo_rcv }">PMO Received <div>{{ track_pr_modal.pmo_rcv }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.pmo_rls }">PMO Released <div>{{ track_pr_modal.pmo_rls }}</div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">  
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.div_head_rcv_2 }">Division Head Received <div>{{ track_pr_modal.div_head_rcv_2 }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.div_head_rls_2 }">Division Head Released <div>{{ track_pr_modal.div_head_rls_2 }}</div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.pmo_rcv_2 }">PMO Received <div>{{ track_pr_modal.pmo_rcv_2 }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.pmo_rls_2 }">PMO Released <div>{{ track_pr_modal.pmo_rls_2 }}</div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">  
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.budget_rcv }">Budget Received <div>{{ track_pr_modal.budget_rcv }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.budget_rls }">Budget Released <div>{{ track_pr_modal.budget_rls }}</div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.mcc_rcv }">MCC Received <div>{{ track_pr_modal.mcc_rcv }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.mcc_rls }">MCC Released <div>{{ track_pr_modal.mcc_rls }}</div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.fmo_rcv }">FMO Received <div>{{ track_pr_modal.fmo_rcv }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.fmo_rls }">FMO Released <div>{{ track_pr_modal.fmo_rls }}</div></li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.pmo_rcv_3 }">PMO Received <div>{{ track_pr_modal.pmo_rcv_3 }}</div></li>
                                        <li class="list-group-item" :class="{ ' bg-success' : track_pr_modal.pmo_rls_3 }">PMO Released <div>{{ track_pr_modal.pmo_rls_3 }}</div></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- col-md-12 trackmodal -->
        <div class="col-md-12">
            <div class="modal fade" id="rfqPoModal" tabindex="-1" role="dialog" aria-labelledby="rfqPoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            Creating Purchase Order
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-sm table-hover" id="pr_table">
                                <thead>
                                    <tr class="text-center">
                                        <th width="5%">#</th>
                                        <th width="20%">Description</th>
                                        <th width="65%">Supplier</th>
                                    </tr>
                                </thead>
                                <tbody id="pr_tbody">
                                    <tr v-for="(dmd,index) in rfq_po_form.dmd_purchase_requests" :key="index">
                                        <td width="5%">{{ index + 1}}</td>
                                        <td width="20%">{{ dmd.dmddesc }}</td>
                                        <td width="65%">
                                            <select v-model="dmd.dmd_rfq_id" class="form-control form-control-sm">
                                                <option v-for="dr in dmd.dmd_rfqs" :key="dr.id" :value="dr.id">
                                                    <div>Price: {{ dr.cost_unit | currency2 }}</div>
                                                    <div>Supplier: 
                                                        <span v-if="dr.supplier.supplier_name">{{ dr.supplier.supplier_name }}</span>
                                                        
                                                        </div>
                                                </option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-success" type="button" @click="store_rfq_po(rfq_po_form.pr_id)">Submit</button>
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
            prs: [],
            search_form: new Form({
                word: '',
            }),
            pr_remarks: '',
            view_pr_form: new Form({
                pr_id: '',
                po_id: '',
                dmd_purchase_requests: [],
                mode_id: '',
                rfq: {},
                rfq_id: '',
                created_at: '',
                send: '',
                status: '',
                purchase_request_remarks: {},
                send: '',
            }),
            track_pr_modal: {},
            rfq_po_form: new Form({
                pr_id : '',
                dmd_purchase_requests: [],
                dmd_rfq: [],
            }),            
        }
    },
    methods:{
        rfqPo_modal(){
            axios.get('../../api/pr_dmd_rqf/'+this.view_pr_form.rfq_id).then(({data}) => {
                this.rfq_po_form.dmd_purchase_requests = data.purchase_request.view_dmd_purchase_requests;
                this.rfq_po_form.purchase_request_id = this.view_pr_form.purchase_request_id;
                $('#rfqPoModal').modal('show');
            }).catch(() => {

            });

        },
        get_prs(){
            axios.get('../../api/pr_for_pmo').then(({data}) => {
                this.prs = data;
            }).catch(() => {

            });
        },
        search(){
            this.search_form.post('../../api/search_pr').then(({data}) => {
                this.prs = data;
            }).catch(() => {

            });
        },
        view_pr(pr){
            this.view_pr_form.reset();
            this.view_pr_form.fill(pr);
            axios.get('../../api/purchase_request/'+pr.pr_id).then(({data}) => {
                    this.view_pr_form.dmd_purchase_requests = data;
                }).catch(() => {

                });
            $('#prModal').modal('show');
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
                this.view_pr_form.reset();
            }).catch(() => {

            });
        },
        approved_pr(){
            axios.put('../../api/approved_pr/'+this.view_pr_form.pr_id).then(() => {
                $('#prModal').modal('hide');
                this.view_pr_form.reset();
            }).catch(() => {
                
            });
        },
        track_pr(prs){
            this.track_pr_modal = prs;
            $('#trackModal').modal('show')
        },
        cmps_rcv(id){
            axios.put('../../api/cmps_rcv/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PR Recieved'
                });
                this.view_pr(id);
            }).catch(() => {

            });
        },
        cmps_rls(id){
            axios.put('../../api/cmps_rls/'+id).then(() => {
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
        store_pr_po(id){
            axios.post('../../api/pr_to_po',{
                purchase_request_id: id,
                pr_id: this.view_pr_form.pr_id,
                items: this.view_pr_form.dmd_purchase_requests,
            }).then(() => {

                $('#prModal').modal('hide');

                toast.fire({
                    type: 'success',
                    title: 'Purchase Order Created Successfully'
                });

            }).catch(() => {

            });
        },
        store_rfq_po(id){
            axios.post('../../api/rfq_to_po',{
                pr_id: ths.view_pr_form.pr_id,
                items: this.rfq_po_form.dmd_purchase_requests,
            }).then(() => {

                $('#prModal').modal('hide');
                $('#rfqPoModal').modal('hide');
                toast.fire({
                    type: 'success',
                    title: 'Purchase Order Created Successfully'
                });

            }).catch(() => {

            });
        },
        store_rfq(){
            this.view_pr_form.post('../../api/rfq').then(() => {
                $('#prModal').modal('hide');
                toast.fire({
                    type: 'success',
                    title: 'Request For Quotation Created Successfully'
                });
            }).catch(() => {

            });
        },
    },
    created(){
        this.get_prs();
    },
    computed:{
        current_user() {
            return this.$store.getters.current_user;
        }
    },

    mounted(){
        window.Echo.channel("pr_created").listen(".purchase_request.created", (e) => {
            this.get_prs();
        });
        window.Echo.channel("pr_updated").listen(".purchase_request.updated", (e) => {
            this.get_prs();
        });
        window.Echo.channel("po_created").listen(".purchase_order.created", (e) => {
            this.get_prs();
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
