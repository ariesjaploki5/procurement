<template>
    <div class="row">
        <div class="col-md-12">
            <span>Item Purchase Requests</span>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <div class="col-md-auto">
                    <label for="" class="form-label">Search Item</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control form-control-sm" v-model="search_word">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th width="3%" class="text-left">#</th>
                        <th width="24%" class="text-left">Item Desc</th>
                        <th width="5%" class="text-left">Unit</th>
                        <th width="10%" class="text-left">PR #</th>
                        <th width="10%" class="text-left">Date of PR</th>
                        <th width="10%" class="text-center">Status</th>
                        <th width="10%" class="text-center">Date(Status)</th>
                        <th width="13%" class="text-left">Date(Whole)</th>
                        <th width="7%" class="text-center">Qty Ordered</th>
                        <th width="5%" class="text-left"></th>
                    </tr>
                </thead>
                <tbody class="table-bordered">
                    <tr v-for="(item, index) in filteredPrs" :key="item.dmd_pr_id">
                        <td width="3%" class="text-left">{{ index + 1 }}</td>
                        <td width="24%" class="text-left">
                            <span class="text-link btn" @click="view_pr(item.purchase_request_id)">
                                {{ item.dmddesc }}
                            </span>
                        </td>
                        <td width="5%" class="text-left">
                            {{ item.unit_id }}
                        </td>
                        <td width="10%" class="text-center">
                            <span class="text-link btn" @click="view_pr(item.purchase_request_id)">
                                {{ item.created_at | myDate }} - {{ item.purchase_request_id | numeral2 }}
                            </span>
                        </td>  
                        <td width="10%" class="text-center">
                            <span>
                                {{ item.pr_date | myDate3 }}
                            </span>
                        </td>
                        <td width="10%" class="text-center">
                            <span v-if="item.last_status"  class="badge badge-pill"
                            v-bind:class="[
                                { 'badge-primary' : item.last_status.current_status_id == 1 },
                                { 'badge-primary' : item.last_status.current_status_id == 2 },
                                { 'badge-secondary' : item.last_status.current_status_id == 3 },
                                { 'badge-secondary' : item.last_status.current_status_id == 4 },
                                { 'badge-success' : item.last_status.current_status_id == 5 },
                                { 'badge-success' : item.last_status.current_status_id == 6 },
                                { 'badge-danger' : item.last_status.current_status_id == 7 },
                                { 'badge-danger' : item.last_status.current_status_id == 8 },
                                { 'badge-warning' : item.last_status.current_status_id == 9 },
                                { 'badge-warning' : item.last_status.current_status_id == 10 },
                                { 'badge-info' : item.last_status.current_status_id == 11 },
                                { 'badge-info' : item.last_status.current_status_id == 12 },
                                { 'badge-light' : item.last_status.current_status_id == 13 },
                                { 'badge-light' : item.last_status.current_status_id == 14 },
                                { 'badge-dark' : item.last_status.current_status_id == 15 },
                                { 'badge-dark' : item.last_status.current_status_id == 16 },
                                ]">
                                {{ item.last_status.current_status.current_status_desc }}
                            </span>
                        </td>
                        <td width="10%" class="text-center">
                            <span v-if="item.last_status">
                                {{ item.last_status.status_date_time | myDate3 }}
                            </span>
                        </td>
                        <td width="13%" class="text-left">
                            {{ item.pr_date | myDate3 }}
                            <span v-if="item.last_status">
                                 - {{ item.last_status.status_date_time | myDate3 }}
                            </span>
                            <span v-else>
                            </span>
                        </td>
                        <td width="7%" class="text-right">
                            <span>
                                {{ item.request_quantity | numeral3 }}
                            </span>
                        </td>
                        <td width="5%">
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="viewPrModal" tabindex="-1" role="dialog" aria-labelledby="viewPrModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5  class="modal-title text-bold" id="viewPrModalLabel">PR # {{ pr.created_at | myDate }} - {{ pr.purchase_request_id | numeral2 }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                    <div class="modal-body">
                        <form action="">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%"  class="text-center">#</th>
                                        <th width="20%"  class="text-center">Item Desc</th>
                                        
                                        <th></th>
                                        <th class="text-center">SSL</th>
                                        <th class="text-center">BOH</th>
                                         <th></th>
                                        <th width="10%" class="text-center">Request Qty</th>
                                        <th class="text-center">Cost</th>
                                        <th class="text-center">Estimated Cost</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(dmd,index) in pr.dmd_purchase_requests" :key="dmd.dmd_id">
                                        <td width="5%">{{ index + 1}}</td>
                                        <td width="20%">{{ dmd.dmd.dmddesc }}</td>
                                        <td class="text-right table-danger"></td>
                                        <td class="text-right table-danger">{{ dmd.dmd.ssl | numeral3 }}</td>
                                        <td class="text-right table-danger">{{ dmd.dmd.boh | numeral3 }}</td>
                                        <td class="text-right table-danger"></td>
                                        <td width="10%" class="text-right">
                                            <input v-if="!pr.send" type="number" class="form-control form-control-sm text-right" v-model="dmd.request_quantity">
                                            <div v-else>{{ dmd.request_quantity }}</div>
                                        </td>
                                        <td class="text-right">
                                            <span>{{ dmd.cost_price | currency2 }}</span>
                                        </td>
                                        <td  class="text-right">
                                            <span>{{ dmd.request_quantity * dmd.cost_price | currency2}}</span>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger" @click="remove_item(dmd.id)">
                                                <i class="fas fa-times-circle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer" >
                        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Cancel</button>
                        <span v-show="!pr.last_status">
                            <button type="button" class="btn btn-sm btn-success" @click="send_to_cmps()">Send to CMPS</button>
                        </span>
                        
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
            dmd_pr: [],
            pr: {},
            search_word: '',
        }
    },
    methods:{
        get_dmd_pr(){
            axios.get('../../api/all_dmd_pr').then(({data}) => {
                this.dmd_pr = data;
            })
        },
        view_pr(id){
            axios.get('../../api/purchase_request/'+id).then(({data}) => {
                this.pr = data;
                $('#viewPrModal').modal('show');
            }).catch(() => {

            });
        },
        send_to_cmps(){
            axios.put('../../api/send_to_cmps/'+this.pr.purchase_request_id).then(() =>{
                this.pr = '';
                toast.fire({
                    type: 'success',
                    title: 'Send Successfuly', 
                });
                $('#viewPrModal').modal('hide');
            }).catch(() => {

            });
        },

    },
    created(){
        this.get_dmd_pr();

    },
    computed:{
        filteredPrs: function(){
            let matcher = new RegExp(this.search_word, 'i')
            return this.dmd_pr.filter(function(dmd){
                return matcher.test(dmd.dmddesc)
            });
        },

    }
}
</script>

<style scoped>

    .text-link{
        color: rgba(#085fc2e3) !important;
        padding: 0.25rem 0.5rem;
        font-size: 0.7rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }
    .text-link:hover{
        color: rgba(#5093df93) !important;
        text-decoration:underline;
        display:inline-block;
    }

    
    tbody.table-bordered > tr > td{
        border:1px solid black;
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

    tr {
        width: 100%;
        display: inline-table;
        table-layout: fixed;
        /* line-height: 20px;
        min-height: 20px;
        height: 20px; */
    }

    table {
        height:35rem;             
        display: -moz-groupbox;    
    }

    tbody {
        overflow-y: scroll;      
        height: 34rem;           
        width: 98.5%;
        position: absolute;
    }
</style>
