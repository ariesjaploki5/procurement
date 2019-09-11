<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row mb-2 bg-white">
                <h6><i class="fas fa-capsules"></i> Purchase Requests</h6>
            </div>
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
                        <th width="9%" class="text-left">PR #</th>
                        <th width="9%" class="text-left">Date of PR</th>
                        <th width="9%" class="text-center">Status</th>
                        <th width="9%" class="text-center">Date (Status)</th>
                        <th width="13%" class="text-left">Date (Whole)</th>
                        <th width="7%">Qty Ordered</th>
                        <th width="9%" class="text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="table-bordered">
                    <tr v-for="(item, index) in filteredPrs" :key="item.dmd_pr_id">
                        <td width="3%" class="text-left" @click="view_pr(item.purchase_request_id)">{{ index + 1 }}</td>
                        <td width="24%" class="text-left" @click="view_pr(item.purchase_request_id)">
                            <span class="text-link btn" >
                                {{ item.dmddesc }}
                            </span>
                        </td>
                        <td width="5%" class="text-left" @click="view_pr(item.purchase_request_id)">
                            {{ item.unit_id }}
                        </td>
                        <td width="9%" class="text-center" @click="view_pr(item.purchase_request_id)">
                            <span class="text-link btn">
                                {{ item.pr_id }}
                            </span>
                        </td>  
                        <td width="9%" class="text-center" @click="view_pr(item.purchase_request_id)">
                            <span>
                                {{ item.pr_date_time | myDate4 }}
                            </span>
                        </td>
                        <td width="9%" class="text-center" @click="view_track(item.purchase_request_id)">
                            <span v-if="item.csid2" class="badge badge-pill" v-bind:class="[
                                { 'badge-success' : item.csid2 == 5 },
                                { 'badge-success' : item.csid2 == 6 },
                                { 'badge-danger' : item.csid2 == 7 },
                                { 'badge-danger' : item.csid2 == 8 },
                                { 'badge-warning' : item.csid2 == 9 },
                                { 'badge-warning' : item.csid2 == 10 },
                                { 'badge-info' : item.csid2 == 11 },
                                { 'badge-info' : item.csid2 == 12 },
                                { 'badge-light' : item.csid2 == 13 },
                                { 'badge-light' : item.csid2 == 14 },
                                { 'badge-dark' : item.csid2 == 15 },
                                { 'badge-dark' : item.csid2 == 16 },
                                ]">{{ item.csd2 }}
                            </span>
                            <span v-else>
                                <span v-if="item.csid" class="badge badge-pill" v-bind:class="[
                                    { 'badge-primary' : item.csid == 1 },
                                    { 'badge-primary' : item.csid == 2 },
                                    { 'badge-secondary' : item.csid == 3 },
                                    { 'badge-secondary' : item.csid == 4 },
                                    ]">
                                    {{ item.csd }}
                                </span>
                            </span>
                        </td>
                        <td width="9%" class="text-center" @click="view_pr(item.purchase_request_id)">
                            <span v-if="item.csid2">
                                {{ item.lpos_datetime | myDate4 }}
                            </span>
                            <span v-else>
                                <span v-if="item.lprs_datetime">
                                    {{ item.lprs_datetime | myDate4 }}
                                </span>
                                <span v-else>
                                    {{ item.pr_date_time | myDate4 }}
                                </span>
                            </span>
                        </td>
                        <td width="13%" class="text-center" @click="view_pr(item.purchase_request_id)">
                            {{ item.pr_date_time | myDate4 }}
                            <span v-if="item.lprs_datetime"> - 
                                <span v-if="item.lpos_datetime">
                                    {{ item.lpos_datetime | myDate4 }}
                                </span>
                                <span v-else>
                                    {{ item.lprs_datetime | myDate4 }}
                                </span>
                            </span>
                            <span v-else>
                            </span>
                        </td>
                        <td width="7%" class="text-right" @click="view_pr(item.purchase_request_id)">
                            <span v-if="item.o_qty">
                                {{ item.o_qty | numeral3 }}
                            </span>
                            <span v-else>
                                {{ item.r_qty | numeral3 }}
                            </span>
                        </td>
                        <td width="9%" class="text-center">
                            <router-link v-show="current_user.role_id == 2" class="btn btn-sm btn-primary" :to="{ name: 'pr', params: { id: item.purchase_request_id }}">PR</router-link>
                            <router-link v-show="current_user.role_id == 2" class="btn btn-sm btn-success" :to="{ name: 'sps', params: { id: item.purchase_request_id }}">SPS</router-link>
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
                            <table class="table table-sm table-hover" id="pr_table">
                                <thead>
                                    <tr>
                                        <th width="5%"  class="text-center">#</th>
                                        <th width="25%"  class="text-center">Item Desc</th>
                                        <th class="text-center">Unit</th>
                                        <th class="text-center">SSL</th>
                                        <th class="text-center">BOH</th>
                                        <th width="10%" class="text-center">Quantity</th>
                                        <th width="10%" class="text-center">Cost</th>
                                        <th width="15%" class="text-center">Estimated Cost</th>
                                        <!-- <th></th> -->
                                    </tr>
                                </thead>
                                <tbody id="pr_tbody">
                                    <tr v-for="(dmd,index) in pr" :key="dmd.dpr_id">
                                        <td width="5%">{{ index + 1}}</td>
                                        <td width="25%">{{ dmd.dmddesc }}</td>
                                        <td class="text-right"></td>
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
                                        <!-- <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger" @click="remove_item(dmd.id)">
                                                <i class="fas fa-times-circle"></i>
                                            </button>
                                        </td> -->
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer" >
                        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Cancel</button>
                        <!-- <span v-show="!pr.last_status">
                            <button type="button" class="btn btn-sm btn-success" @click="send_to_cmps()">Send to CMPS</button>
                        </span> -->
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="viewTrack" tabindex="-1" role="dialog" aria-labelledby="viewTrackLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5  class="modal-title text-bold" id="viewTrackLabel">PR # {{ pr.created_at | myDate }} - {{ pr.purchase_request_id | numeral2 }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Date/Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(tr, index) in track" :key="index">
                                            <td>{{ tr.status_desc }}</td>
                                            <td>{{ tr.date_time | myDate4 }} - {{ tr.date_time | myDate5 }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
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
            dmd_pr: [],
            pr: {},
            search_word: '',
            track: {},
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
        view_track(id){
            axios.get('../../api/purchase_request_track/'+id).then(({data}) => {
                this.track = data;
                $('#viewTrack').modal('show');
            }).catch(() => {

            });
        }
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
        current_user() {
            return this.$store.getters.current_user;
        }

    },
    mounted(){
        window.Echo.channel("pr_created").listen(".purchase_request.created", (e) => {
            this.get_dmd_pr();
        });
        window.Echo.channel("pr_updated").listen(".purchase_request.updated", (e) => {
            this.get_dmd_pr();
        });
        window.Echo.channel("po_created").listen(".purchase_order.created", (e) => {
            this.get_dmd_pr();
        });
        window.Echo.channel("po_updated").listen(".purchase_order.updated", (e) => {
            this.get_dmd_pr();
        });
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
        /* background: #38c172;
        color: white; */
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

    #pr_tbody {
        overflow-y: scroll;      
        height: 22rem;           
        width: 98.5%;
        position: absolute;
    }

    #pr_table {
        height:24rem;             
        display: -moz-groupbox;    
    }

    
</style>
