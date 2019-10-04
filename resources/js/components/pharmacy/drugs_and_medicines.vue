<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row mb-2 bg-white rounded">
                <div class="col">
                    <h6> <i class="fas fa-capsules"></i> Drugs And Medicines</h6>
                </div>
                <div class="col-md-auto">Legend:</div>
                <div class="col-md-auto"><i class="fas fa-stop" style="color: #fff6a1"></i> - Below ROP</div>
                <div class="col-md-auto"><i class="fas fa-stop" style="color: #f4b0af"></i> - No SSL</div>
                <div class="col-md-auto"><i class="fas fa-stop" style="color: #b3e8ca"></i> - Above SSL</div>
                <div class="col-md-auto"><i class="fas fa-stop" style="color:blue"></i> - Item in Transit</div>
                <div class="col-md-auto text-right">
                    <button class="btn btn-sm btn-primary" :disabled="cart_item == 0" @click="cart_modal()"><i class="fas fa-shopping-cart"></i> <span class="badge badge-light">{{ cart_item }}</span></button>
                </div>
            </div>
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tabs-home-tab" data-toggle="tab" href="#ntpr" role="tab" aria-controls="ntpr" aria-selected="true">Need To PR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tabs-home-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="false">All</a>
                </li>
            </ul>
                <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="ntpr" role="tabpanel" aria-labelledby="ntpr-tab">
                    <form @submit.prevent="search_submit()">
                        <div class="row mb-1 mt-1">
                        <div class="col-md-4">
                            <input type="text" class="form-control form-control-sm" v-model="search_form.word">
                        </div>
                        <div class="col-md-aut">
                            <button class="btn btn-sm btn-primary" type="submit">Search</button>
                        </div>
                        </div>
                    </form>
                    <div class="table-responsive-sm">
                        <table class="table table-fixed table-sm table-hover table-condensed">
                            <thead class="shadow">
                                <tr>
                                    <th width="2%" class="text-center">#</th>
                                    <th width="30%" class="text-left">Description</th>
                                    <th width="5%" class="text-center">Balance On Hand</th>
                                    <th width="5%" class="text-center">SSL</th>
                                    <th width="5%" class="text-center">ROP</th>
                                    <th width="5%" class="text-center">Item In Transit</th>
                                    <th width="5%" class="text-center">Last PR</th>
                                    <th width="5%" class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody class="table-bordered">
                                <tr v-for="(d, index) in filteredNtprs" :key="d.dmd_id" class="table-warning" >
                                    <td width="2%" class="text-right bg-white">{{ index + 1}}</td>
                                    <td width="30%" class="text-left">{{ d.dmddesc }}</td>
                                    <td width="5%" class="text-right">{{ d.boh | numeral3 }}</td>
                                    <td width="5%" class="text-right">{{ d.ssl | numeral3 }} 
                                        <button class="custom-btn fas fa-pen text-dark" data-toggle="tooltip" data-placement="top" title="Edit SSL" @click="edit_ssl(d)">
                                        </button>
                                    </td>
                                    <td width="5%" class="text-right">{{ d.rop | numeral3 }}</td>
                                    <td width="5%" class="text-right">{{ d.iit | numeral3 }}</td>
                                    <td width="5%" class="text-center"><span v-if="d.last_pr">{{ d.last_pr | myDate3 }}</span><span v-else></span></td>
                                    <td class="text-center" width="5%">
                                        <span v-show="(d.dps_id || d.ad_id)  && d.ssl != 0 && !d.cart_dmd_id">
                                            <!-- public bidding -->
                                            <button class="custom-btn text-primary" v-if="d.dps_id !== null" @click="add_item_2(d.dmd_id, 1)">
                                                <i class="fas fa-shopping-cart fa-lg"></i>
                                                <i class="fas fa-plus fa-lg"></i>
                                            </button>
                                            <!-- shopping -->
                                            <button class="custom-btn text-primary" v-else @click="add_item_2(d.dmd_id, 4)">
                                                <i class="fas fa-shopping-cart fa-lg"></i>
                                                <i class="fas fa-plus fa-lg"></i>
                                            </button>                                 
                                        </span>
                                        <span v-show="(d.dps_id !== null || d.ad_id)  && d.ssl != 0 && d.cart_dmd_id">
                                            <span class="badge badge-light">in cart</span>    
                                        </span>
                                        <span v-show="!d.dps_id && !d.ad_id">
                                           N/A
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <form @submit.prevent="search_submit_2()">
                        <div class="row mb-1 mt-1">
                        <div class="col-md-4">
                            <input type="text" class="form-control form-control-sm" v-model="search_form.word">
                        </div>
                        <div class="col-md-aut">
                            <button class="btn btn-sm btn-primary" type="submit">Search</button>
                        </div>
                        </div>
                    </form>
                    <div class="table-responsive-sm">
                        <table class="table table-fixed table-sm table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th width="2%" class="text-center">#</th>
                                    <th width="30%" class="text-left">Description</th>
                                    <th width="5%" class="text-center">Balance On Hand</th>
                                    <th width="5%" class="text-center">SSL</th>
                                    <th width="5%" class="text-center">ROP</th>
                                    <th width="5%" class="text-center">Item In Transit</th>
                                    <th width="5%" class="text-center">Last PR</th>
                                    <th width="5%" class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody class="table-bordered">
                                <tr v-for="(d, index) in filteredDmds" :key="d.dmd_id" :class="{ 'table-warning' : d.rop >= d.boh , 'table-danger' : d.ssl == 0 , 'table-success' : d.boh > d.ssl/2, 'table-primary' : d.boh > d.ssl/2}" >
                                    <td width="2%" class="text-right bg-white">{{ index + 1}}</td>
                                    <td width="30%" class="text-left">{{ d.dmddesc }}</td>
                                    <td width="5%" class="text-right">{{ d.boh | numeral3 }}</td>
                                    <td width="5%" class="text-right">{{ d.ssl | numeral3 }} 
                                        <button class="custom-btn fas fa-pen text-dark" data-toggle="tooltip" data-placement="top" title="Edit SSL" @click="edit_ssl(d)">
                                        </button>
                                    </td>
                                    <td width="5%" class="text-right">{{ d.rop | numeral3 }}</td>
                                    <td width="5%" class="text-right">{{ d.iit | numeral3 }}</td>
                                    <td width="5%" class="text-center"><span v-if="d.last_pr">{{ d.last_pr | myDate3 }}</span><span v-else></span></td>
                                    <td class="text-center" width="5%">
                                        <span v-show="(d.dps_id || d.ad_id)  && d.ssl != 0 && !d.cart_dmd_id">
                                            <!-- public bidding -->
                                            <button class="custom-btn text-primary" v-if="d.dps_id !== null" @click="add_item_2(d.dmd_id, 1)">
                                                <i class="fas fa-shopping-cart fa-lg"></i>
                                                <i class="fas fa-plus fa-lg"></i>
                                            </button>
                                            <!-- shopping -->
                                            <button class="custom-btn text-primary" v-else @click="add_item_2(d.dmd_id, 4)">
                                                <i class="fas fa-shopping-cart fa-lg"></i>
                                                <i class="fas fa-plus fa-lg"></i>
                                            </button>                                 
                                        </span>
                                        <span v-show="(d.dps_id !== null || d.ad_id)  && d.ssl != 0 && d.cart_dmd_id">
                                            <span class="badge badge-light">in cart</span>    
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="sslModal" tabindex="-1" role="dialog" aria-labelledby="sslModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5  class="modal-title text-bold" id="sslModalLabel">Edit SSL</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form  @submit.prevent="update_ssl()">
                        <div class="modal-body">
                            <label class="form-label text-bold"><h4>
                                {{ ssl_form.gendesc }} {{ ssl_form.dmdnost }} {{ ssl_form.stredesc }} {{ ssl_form.formdesc }} {{ ssl_form.brandname }}
                                </h4>
                            </label>
                            <div class="form-group row">
                                <div class="col">
                                    <label for="ssl" class="form-label"><h5>Standard Stock Level</h5></label>
                                </div>
                                <div class="col">
                                    <money class="form-control form-control-sm text-right" v-model="ssl_form.ssl" v-bind="money"></money>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content" id="d_modal_content">
                        <div class="modal-header">
                            Purchase Request
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="pr_submit()">
                            <div class="modal-body">
                                <div v-show="pb_form.items.length">
                                   <span class="font-weight-bold">With Bidder</span>
                                    <table class="table table-sm table-hover " style="height: 12rem; display: -moz-groupbox;">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="4%">#</th>
                                                <th width="30%">Description</th>
                                                <th>SSL</th>
                                                <th>BOH</th>
                                                <th>Item In Transit</th>
                                                <th width="10%">Quantity</th>
                                                <th>Unit Cost</th>
                                                <th>Estimated Cost</th>
                                                <th width="6%" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody style="overflow-y: scroll;height: 11rem; width: 98.5%; position: absolute;" class="table-bordered">
                                            <tr v-for="(item,index) in pb_form.items" :key="item.dmd_id">
                                                <td width="4%">{{ index + 1}}</td>
                                                <td width="30%">
                                                    <div class="col-12">{{ item.dmddesc }}</div>
                                                    <div class="row">
                                                        <div class="col-auto  text-right">
                                                        <span>Type:</span>
                                                        
                                                    </div>
                                                    <div class="col-7">
                                                        <select class="form-control form-control-sm" v-model="item.ep">
                                                            <option value="0">Regular Purchase</option>
                                                            <option value="1">Emergency Purchase</option>
                                                        </select>
                                                    </div>
                                                    </div>
                                                </td>
                                                <td class="text-right">{{ item.ssl | numeral3 }}</td>
                                                <td class="text-right">{{ item.boh | numeral3 }}</td>
                                                <td class="text-right">{{ item.iit | numeral3}}</td>
                                                <td width="10%" class="text-right">
                                                    <input type="number" v-if="item.ep == 0" class="form-control form-control-sm text-right invalid" :max="item.ssl - item.boh" min="1" v-model="item.item_needed">
                                                    <input type="number" v-else class="form-control form-control-sm text-right invalid" v-model="item.item_needed">
                                                </td>
                                                <td class="text-right">{{ item.cost | currency2 }}</td>
                                                <td class="text-right">{{ item.cost * item.item_needed | currency2 }}</td>
                                                <td width="6%" class="text-center">
                                                    <button type="button" class="btn btn-sm btn-danger" @click="remove_item(item.cart_dmd_id)">
                                                        <i class="fas fa-times-circle"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div v-show="sp_form.items.length">
                                    <span class="font-weight-bold">For Shopping</span>
                                    <table class="table table-sm table-hover" style="height: 12rem; display: -moz-groupbox;">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="4%">#</th>
                                                <th width="30%">Description</th>
                                                <th>SSL</th>
                                                <th>BOH</th>
                                                <th>Item In Transit</th>
                                                <th width="10%">Quantity</th>
                                                <th>Unit Cost</th>
                                                <th>Estimated Cost</th>
                                                <th width="6%" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody style="overflow-y: scroll;height: 11rem; width: 98.5%; position: absolute;" class="table-bordered">
                                            <tr v-for="(item,index) in sp_form.items" :key="item.dmd_id">
                                                <td width="4%">{{ index + 1}}</td>
                                                <td width="30%">
                                                    <div class="col-12">{{ item.dmddesc }}</div>
                                                    <div class="row">
                                                        <div class="col-auto text-right">
                                                        <span>Type:</span>
                                                        
                                                    </div>
                                                    <div class="col-7">
                                                        <select class="form-control form-control-sm" v-model="item.ep">
                                                            <option value="0">Regular Purchase</option>
                                                            <option value="1">Emergency Purchase</option>
                                                        </select>
                                                    </div>
                                                    </div>
                                                </td>
                                                <td class="text-right">{{ item.ssl }}</td>
                                                <td class="text-right">{{ item.boh }}</td>
                                                <td class="text-right">{{ item.iit }}</td>
                                                <td width="10%" class="text-right">
                                                    <input type="number" v-if="item.ep == 0" class="form-control form-control-sm text-right" :max="item.ssl - item.boh" min="1" v-model="item.item_needed">
                                                    <input type="number" v-else class="form-control form-control-sm text-right" v-model="item.item_needed">
                                                </td>
                                                <td class="text-right">{{ item.cost | currency2 }}</td>
                                                <td class="text-right">{{ item.cost * item.item_needed | currency2 }}</td>
                                                <td width="6%" class="text-center">
                                                    <button type="button" class="btn btn-sm btn-danger" @click="remove_item(item.cart_dmd_id)">
                                                        <i class="fas fa-times-circle"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Purpose: </label>
                                    <textarea type="text" class="form-control form-control-sm" rows="2" v-model="form.purpose"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
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
export default {
    components: {Money},
    data(){
        return{
            money: {
                decimal: ',',
                thousands: ',',
                prefix: ' ',
                suffix: ' ',
                precision: 0,
                masked: false
            },
            dmds: [],
            ntprs: [],
            search_form: new Form({
                word: '',
            }),
            search_word: '',
            search_word_2: '',
            ssl_form: new Form({
                dmd_id: '',gendesc: '',dmdnost: '',stredesc: '',formdesc: '',brandname: '',
                dmdcomb: '',dmdctr: '',
                ssl: '',
            }),
            form: new Form({
                mode_id: 1,
                category_id: 1,
                pr_id: '',
                items: [],
                purpose: '',
            }),
            pb_form:new Form({
                mode_id: 1,
                category_id: 1,
                pr_id: '',
                items: [],
                purpose: '',
            }),
            sp_form:new Form({
                mode_id: 4,
                category_id: 1,
                pr_id: '',
                items: [],
                purpose: '',
            }),
        }
    },
    methods:{
        search_submit(){
            this.search_form.post("../../api/dmd_search").then(({data}) => {
                this.ntprs = data;
            }).catch(() => {

            });
        },
        search_submit_2(){
            this.search_form.post("../../api/dmd_search").then(({data}) => {
                this.dmds = data;
            }).catch(() => {

            });
        },
        get_need_to_pr(){
            axios.get('../../api/need_to_pr').then(({data}) => {
                    this.ntprs = data;
            }).catch(() => {

            });
        },
        get_pb_items(){
            axios.get('../../api/public_bidding').then(({data}) => {
                this.pb_form.items = data;
            }).catch(() => {
                
            });
        },
        get_sp_items(){
            axios.get('../../api/shopping').then(({data}) => {
                this.sp_form.items = data;
            }).catch(() => {

            });
        },
        get_pr_items(){
            axios.get('../../api/pr_items').then(({data}) => {
                this.form.items = data;
            }).catch(() => {

            });
        },
        pb_submit(){
            axios.post('../../api/dmd_pr',{
                items: this.pb_form.items,
                category_id: this.pb_form.category_id,
                user_id: this.current_user.user_id,
                purpose: this.form.purpose,
            }).then(({data}) => { 
                 console.log(data);
            }).catch(() => {

            });
        },
        pr_submit(){
            this.pb_submit();
            this.sp_submit();
            $('#cartModal').modal('hide');
            toast.fire({
                type: 'success',
                title: 'Purchase Request Created Successfully',
            });
            this.get_dmds();
            this.get_pb_items();
            this.get_sp_items();
            this.$router.push({path: 'pr_dmd'});
        },
        sp_submit(){
            axios.post('../../api/shopping', {
                items: this.sp_form.items,
                category_id: this.sp_form.category_id,
                user_id: this.current_user.user_id,
                purpose: this.form.purpose,
            }).then(({data}) => {
                console.log(data);
            }).catch(() =>{

            });
        }, 
        add_item_2(dmd_id, mode_id){
            axios.post('../../api/cart_dmd_2/'+this.current_user.user_id, {
                mode_id: mode_id,
                dmd_id: dmd_id,
            }).then(() => {
                // this.get_dmds();
                // this.get_pb_items();
                // this.get_sp_items();
                // this.get_need_to_pr();
                toast.fire({
                    type: 'success',
                    title: 'Item Added',
                });
            }).catch(() => {

            });
        },
        remove_item(cart_dmd_id){
            axios.delete('../../api/cart_dmd/'+cart_dmd_id).then(() => {
                this.get_dmds();
                this.get_pb_items();
                this.get_sp_items();
            });
        },
        public_bidding(){
            $('#pbModal').modal('show');
        },
        shopping(){
            $('#spModal').modal('show');
        },
        cart_modal(){
            $('#cartModal').modal('show');
        },
        get_dmds(){
            axios.get('../../api/dmd').then(({data}) => {
                this.dmds = data;
            }).catch(() => {

            });
        },
        search(){
            this.search_form.post('../../api/dmd_search').then(({data}) => {
                this.dmds = data;
            }).catch(() => {

            });
        },
        edit_ssl(d){
            this.ssl_form.fill(d);
            $('#sslModal').modal('show');
        },
        update_ssl(){
            this.ssl_form.put('../../api/dmd_ssl_update/'+this.ssl_form.dmd_id).then(() => {
                $('#sslModal').modal('hide');
                this.get_dmds();
            }).catch(() => {

            });
        },
    },
    created(){
        this.get_need_to_pr();
        this.get_dmds();
        this.get_pb_items();
        this.get_sp_items();
    },
    computed:{
        current_user() {
            return this.$store.getters.current_user;
        },
        filteredDmds: function(){
            let matcher = new RegExp(this.search_word, 'i')
            return this.dmds.filter(function(dmd){
                return matcher.test(dmd.dmddesc)
            });
        },
        filteredNtprs: function(){
            let matcher = new RegExp(this.search_word_2, 'i')
            return this.ntprs.filter(function(ntpr){
                return matcher.test(ntpr.dmddesc)
            });
        },
        cart_item: function(){
            // let sum = 0;
            // sum += (parseFloat(this.pb_form.items.length) + parseFloat(this.sp_form.items.length));
            // return sum;
        }
    },
    mounted(){
        window.Echo.channel("cart_dmd_created").listen(".cart_dmd.created", (e) => {
            this.get_need_to_pr();
            this.get_dmds();
            this.get_pb_items();
            this.get_sp_items();
        });
        window.Echo.channel("cart_dmd_updated").listen(".cart_dmd.updated", (e) => {
            this.get_need_to_pr();
            this.get_dmds();
            this.get_pb_items();
            this.get_sp_items();
        });
        
    },

}   

</script>
<style scoped>
    .nav-tabs .nav-link.active{
        color: white;
        background-color: #4a5ea5fa;
        
    }
    .custom-btn{
        background-color: Transparent;
        background-repeat:no-repeat;
        border: none; 
        cursor:pointer; 
        overflow: hidden; 
        outline:none;
    }

    @media (min-width: 768px) {
        .modal-xl {
            width: 90%;
            max-width:1400px;
        }
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
