<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            Drugs And Medicines
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="btn-group dropleft">
                                <button type="button"  :disabled="!pb_form.items.length && !sp_form.items.length" class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-shopping-cart"></i>  Purchase Requests</button>
                                <div class="dropdown-menu" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button v-show="pb_form.items.length" class="dropdown-item" @click="public_bidding()">Public Bidding</button>
                                    <button v-show="sp_form.items.length" class="dropdown-item" @click="shopping()">Shopping</button>
                                    <!-- <button class="dropdown-item" @click="small_value()">Small Value</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-auto text-right">Search:</div>
                        <div class="col-md-4"><input type="text" class="form-control form-control-sm" v-model="search_word"></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-fixed table-sm table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="10%">ID</th>
                                    <th width="30%">Description</th>
                                    <th width="10%" class="text-center">Balance On Hand</th>
                                    <th class="text-center">SSL</th>
                                    <th class="text-center">ROP</th>
                                    <th class="text-center">Item In Transit</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(d, index) in filteredDmds" :key="d.dmd_id" :class="{ 'bg-success' : d.boh > d.ssl/2, 'bg-warning' : d.ssl/2 >= d.boh, 'bg-danger' : d.ssl == 0 }" >
                                    <td width="5%">{{ index + 1}}</td>
                                    <td width="10%">{{ d.dmdcomb }}-{{ d.dmdctr}}</td>
                                    <td width="30%">{{ d.gendesc }} {{ d.dmdnost }} {{ d.stredesc }} {{ d.formdesc }} {{ d.brandname }}</td>
                                    <td width="10%" class="text-right">{{ d.boh | numeral3 }}</td>
                                    <td class="text-right">{{ d.ssl | numeral3 }}</td>
                                    <td class="text-right">{{ d.rop | numeral3 }}</td>
                                    <td class="text-right"></td>
                                    <td class="text-left">
                                        <button type="button" class="btn btn-sm btn-light btn-outline-dark" @click="edit_ssl(d)">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button v-show="d.dmd_price_schedule !== null" :disabled="d.cart_dmd_id != null || d.ssl/2 < d.boh || d.ssl == 0" type="button" class="btn btn-sm btn-primary " @click="add_item(d)">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="sslModal" tabindex="-1" role="dialog" aria-labelledby="sslModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6  class="modal-title text-bold" id="sslModalLabel">Edit SSL</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form  @submit.prevent="update_ssl()">
                                <div>
                                    {{ ssl_form.gendesc }} {{ ssl_form.dmdnost }} {{ ssl_form.stredesc }} {{ ssl_form.formdesc }} {{ ssl_form.brandname }}
                                </div>
                                <div class="form-group">
                                    <label for="ssl" class="form-label">Standard Stock Level</label>
                                    <input type="number" class="form-control form-control-sm text-right" v-model="ssl_form.ssl">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="pbModal" tabindex="-1" role="dialog" aria-labelledby="pbModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            Public Bidding
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form  @submit.prevent="pb_submit()">
                                <table class="table table-sm table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th width="20%">Description</th>
                                            <th>SSL</th>
                                            <th>BOH</th>
                                            <th>Item In Transit</th>
                                            <th width="10%">Quantity</th>
                                            <th>Unit Cost</th>
                                            <th>Estimated Cost</th>
                                            <th class="text-center">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item,index) in pb_form.items" :key="item.dmd_id">
                                            <td>{{ index + 1}}</td>
                                            <td width="20%">{{ item.gendesc }} {{ item.dmdnost }} {{ item.stredesc }} {{ item.formdesc }} {{ item.brandname }}</td>
                                            <td class="text-right table-danger">{{ item.ssl }}</td>
                                            <td class="text-right table-danger">{{ item.boh }}</td>
                                            <td class="text-right table-danger"></td>
                                            <td width="10%" class="text-right">
                                                <input type="number" class="form-control form-control-sm text-right" v-model="item.quantity">
                                            </td>
                                            <td class="text-right">
                                                {{ item.dmd_price_schedule.bid_price | currency2 }}
                                            </td>
                                            <td class="text-right">
                                                {{ item.dmd_price_schedule.bid_price * item.quantity | currency2 }}
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-danger" @click="remove_item(item.id)">
                                                    <i class="fas fa-times-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="spModal" tabindex="-1" role="dialog" aria-labelledby="spModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            Shopping
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form  @submit.prevent="sp_submit()">
                                <table class="table table-sm table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th width="20%">Description</th>
                                            <th>SSL</th>
                                            <th>BOH</th>
                                            <th>Item In Transit</th>
                                            <th width="10%">Quantity</th>
                                            <th>Unit Cost</th>
                                            <th>Estimated Cost</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item,index) in sp_form.items" :key="item.dmd_id">
                                            <td>{{ index + 1}}</td>
                                            <td>{{ item.gendesc }} {{ item.dmdnost }} {{ item.stredesc }} {{ item.formdesc }} {{ item.brandname }}</td>
                                            <td class="text-right table-danger">{{ item.ssl }}</td>
                                            <td class="text-right table-danger">{{ item.boh }}</td>
                                            <td class="text-right table-danger"></td>
                                            <td class="text-right">
                                                <input type="text" class="form-control form-control-sm text-right" :value="item.quantity = item.ssl - item.boh">
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                </div>
                            </form>
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
            dmds: [],
            form: new Form({
                
            }),
            search_word: '',
            ssl_form: new Form({
                dmd_id: '',
                gendesc: '',
                dmdnost: '',
                stredesc: '',
                formdesc: '',
                brandname: '',
                dmdcomb: '',
                dmdctr: '',
                ssl: '',
            }),
            pb_form:new Form({
                mode_id: 1,
                category_id: 1,
                pr_id: '',
                items: [],
            }),
            sp_form:new Form({
                pr_id: '',
                items: [],
            }),
        }
    },
    methods:{
        get_pb_items(){
            axios.get('../../api/public_bidding').then(({data}) => {
                this.pb_form.items = data;
            }).catch(() => {
                
            });
        },
        pb_submit(){
            axios.post('../../api/dmd_pr',{
                items: this.pb_form.items,
                mode_id: this.pb_form.mode_id,
                category_id: this.pb_form.category_id,
                user_id: this.current_user.user_id,
            }).then(() => {
                $('#pbModal').modal('hide');
                this.get_dmds();
                this.get_pb_items();
            }).catch(() => {

            });
        },  
        get_sp_items(){

        },
        add_item(dmd){
            axios.post('../../api/cart_dmd/'+this.current_user.user_id, {
                mode_id: dmd.mode_id,
                dmd_id: dmd.dmd_id,
            }).then(() => {
                this.get_dmds();
                this.get_pb_items();
            }).catch(() => {

            });
        },
        remove_item(id){
            axios.delete('../../api/cart_dmd/'+id).then(() => {
                this.get_dmds();
                this.get_pb_items();
            })
        },
        public_bidding(){
            $('#pbModal').modal('show');
        },
        shopping(){
            $('#spModal').modal('show');
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
        this.get_dmds();
        this.get_pb_items();
    },
    computed:{
        current_user() {
            return this.$store.getters.current_user;
        },
        filteredDmds: function(){
            let matcher = new RegExp(this.search_word, 'i')
            return this.dmds.filter(function(dmd){
                return matcher.test(dmd.gendesc)
            })
        },
    },
    mounted(){
        
    },
}
</script>

<style scoped>
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
