<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-12">
                        <h3>
                            {{ price_schedule.category.category_desc }} - {{ price_schedule.price_schedule_year }}
                        </h3>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-auto text-right">
                                Search:
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-sm" v-model="search_word">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm" id="price_schedule">
                        <table class="table table-sm table-hover table-bordered" id="price_schedule_table_2">
                            <thead id="price_schedule_thead">
                                <tr>
                                    <th id="ps_id">#</th>
                                    <th id="ps_desc">Description</th>
                                    <th id="ps_unit">Unit</th>
                                    <th id="ps_qty">Quantity</th>
                                    <th id="ps_abc">ABC</th>
                                    <th id="ps_bid">
                                        <div id="ps_bid_2">
                                            <div id="ps_bid_rank_head">Rank</div>
                                            <div id="ps_bid_bidder_head">Bidder</div>
                                            <div id="ps_bid_price_head">Bid Price</div>
                                            <div id="ps_bid_brand_head">Brand</div>
                                            <div id="ps_bid_pack_head">Packaging</div>
                                            <div id="ps_bid_manu_head">Manufacturer</div>
                                            <div id="ps_bid_co_head">Country of Origin</div>
                                            <div id="ps_bid_mod_head">Modify</div>
                                        </div>
                                    </th>
                                    <th id="ps_act" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="price_schedule_tbody">
                                <tr v-for="(dmd, index) in filteredDmds" :key="dmd.dmd_id">
                                    <td id="ps_id">{{ index+1 }}</td>
                                    <td id="ps_desc">{{ dmd.gendesc }} {{ dmd.dmdnost }} {{ dmd.stredesc }} {{ dmd.formdesc }} {{ dmd.brandname }}</td>
                                    <td id="ps_unit">{{ dmd.app_dmd.unit_desc }}</td>
                                    <td id="ps_qty">{{ dmd.app_dmd.quantity }}</td>
                                    <td id="ps_abc">{{ dmd.app_dmd.cost | currency2 }}</td>
                                    <td id="ps_bid">
                                        <p v-show="!dmd.dmd_price_schedules.length">No Bidder</p>
                                        <div id="ps_bid_2" v-show="dmd.dmd_price_schedules != null" v-for="(ps, index) in dmd.dmd_price_schedules" :key="ps.dps_id"  v-bind:class="{ 'table-success' : index == 0, 'bg-danger': ps.terminated == 1}">
                                            <div id="ps_bid_rank">{{ ps.rank }}</div>
                                            <div id="ps_bid_bidder">{{ ps.supplier_name }}</div>
                                            <div id="ps_bid_price">{{ ps.bid_price | currency2 }}</div>
                                            <div id="ps_bid_brand">{{ ps.brand_desc }}</div>
                                            <div id="ps_bid_pack">{{ ps.packaging_desc }}</div>
                                            <div id="ps_bid_manu">{{ ps.manufacturer_desc }}</div>
                                            <div id="ps_bid_co">{{ ps.country_desc }}</div>
                                            <div id="ps_bid_mod">
                                                <div class="btn-group dropleft btn-sm">
                                                    <button id="btn_custom" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                    <div class="dropdown-menu" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                        <button class="dropdown-item" @click="edit_bidder(dmd, ps)"><i class="fas fa-pen"></i> Edit</button>
                                                        <button class="dropdown-item" @click="terminate_bidder(ps.dps_id)">Terminate</button>
                                                        <button class="dropdown-item" @click="unterminate_bidder(ps.dps_id)">Unterminate</button>
                                                        <button class="dropdown-item" @click="delete_bidder(ps.dps_id)">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td  id="ps_act" class="text-center">
                                        <button class="btn btn-primary btn-sm" @click="add_bidder(dmd)" id="btn_custom">
                                            <i class="fas fa-plus"></i> Bidder
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="bidderModal" tabindex="-1" role="dialog" aria-labelledby="bidderModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content text-left">
                        <div class="modal-header">
                            <h5 v-show="!editmode" class="modal-title" id="bidderModalLabel">New Bidder</h5>
                            <h5 v-show="editmode" class="modal-title" id="bidderModalLabel">Update Bidder</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editmode ? update_bidder() : store_bidder()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="col">
                                        <h4>{{ form.dmddesc }}</h4>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cat" class="col col-form-label">Bidder</label>
                                    <div class="col">
                                        <select class="from-control form-control-sm" v-model="form.supplier_id" required>
                                            <option v-for="s in suppliers" :key="s.supplier_id" :value="s.supplier_id">
                                                {{ s.supplier_name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cat" class="col-sm-2 col-form-label">Bid Price</label>
                                    <div class="col">
                                        <input type="float" class="form-control form-control-sm" v-model="form.bid_price" required>  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cat" class="col col-form-label">Brand</label>
                                    <div class="col">
                                        <select class="from-control form-control-sm" v-model="form.brand_id" required>
                                            <option v-for="b in brands" :key="b.brand_id" :value="b.brand_id">{{ b.brand_desc }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cat" class="col col-form-label">Packaging</label>
                                    <div class="col">
                                        <select class="from-control form-control-sm" v-model="form.packaging_id" required>
                                            <option v-for="p in packagings" :key="p.packaging_id" :value="p.packaging_id">{{ p.packaging_desc }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cat" class="col col-form-label">Manufacturer</label>
                                    <div class="col">
                                        <select class="from-control form-control-sm" v-model="form.manufacturer_id" required>
                                            <option v-for="m in manufacturers" :key="m.manufacturer_id" :value="m.manufacturer_id">{{ m.manufacturer_desc }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cat" class="col col-form-label">Country of Origin</label>
                                    <div class="col">
                                        <select class="from-control form-control-sm" v-model="form.country_id" required>
                                            <option v-for="c in countries" :key="c.country_id" :value="c.country_id">{{ c.country_desc }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button v-show="!editmode" type="submit" class="btn btn-primary">Submit</button>
                                <button v-show="editmode" type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
    data(){
        return{
            editmode: false,
            dmds: [],
            form: new Form({
                id: '',
                dmddesc: '',
                dmd_id: '',
                bid_price: '',
                supplier_id: '',
                brand_id: '',
                manufacturer_id: '',
                packaging_id: '',
                country_id: '',
            }),
            price_schedule: {},
            search_word: '',
        }
    },
    methods:{
        ...mapActions([
            'get_suppliers', 'get_brands', 'get_packagings', 'get_manufacturers', 'get_countries'
        ]),
        async price_schedule_get(){
            await axios.get('../../api/price_schedule_get/'+this.$route.params.id).then(({data}) => {
                this.price_schedule = data;
            });
        },
        add_bidder(dmd){
            this.editmode = false;
            this.form.reset();
            this.form.dmd_id = dmd.dmd_id;
            this.form.dmddesc = dmd.dmddesc;
            $('#bidderModal').modal('show');
        },
        store_bidder(){
            this.form.post('../../api/dmd_price_schedule/'+this.$route.params.id).then(() => {
                
                $('#bidderModal').modal('hide');
            });
        },
        edit_bidder(dmd, ps){
            this.editmode = true;
            this.form.reset();
            this.form.fill(ps);
            this.form.dmddesc = dmd.dmddesc;
            $('#bidderModal').modal('show');
        },
        update_bidder(){
            this.form.put('../../api/dmd_price_schedule/'+this.form.id).then(() => {
                
                $('#bidderModal').modal('hide');
            });
        },
        terminate_bidder(id){
            axios.put('../../api/dmd_price_schedule/'+id+"/terminate").then(() => {
                
            }).catch(() => {

            });
        },
        unterminate_bidder(id){
            axios.put('../../api/dmd_price_schedule/'+id+"/unterminate").then(() => {
                
            }).catch(() => {

            });
        },
        delete_bidder(id){
            axios.delete('../../api/dmd_price_schedule/'+id).then(() => {
                
            }).catch(() => {

            });
        },
        get_dmds(){
            axios.get('../../api/price_schedule/'+this.$route.params.id).then(({data}) => {
                this.dmds = data;
            }).catch(() => {

            });
        },
    },
    created(){
        this.get_dmds();
        this.get_suppliers();
        this.get_brands();
        this.get_packagings();
        this.get_manufacturers();
        this.get_countries();
        this.price_schedule_get();
    },
    computed:{
        ...mapGetters([
            'suppliers', 'brands', 'packagings', 'manufacturers', 'countries'
        ]),
        filteredDmds: function(){
            let matcher = new RegExp(this.search_word, 'i')
            return this.dmds.filter(function(dmd){
                return matcher.test(dmd.gendesc)
            })
        },
    },
    mounted(){
        window.Echo.channel("dmd_price_schedule_created").listen(".dmd_price_schedule.created", (e) => {
            this.get_dmds();
        });
        window.Echo.channel("dmd_price_schedule_updated").listen(".dmd_price_schedule.updated", (e) => {
            this.get_dmds();
        });
    }
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
    #btn_custom {
        padding: 0.3rem 0.3rem !important;
        font-size: 0.60rem !important;
        line-height: 1.5;
        border-radius: 0.2rem;
    }
    #price_schedule_table_1{
        table-layout: fixed;
        width: 100%;
    }
    #price_schedule_table_2{
        table-layout: fixed;
        width: 100%;
    }

    #ps_id{
        width: 2%;
    }
    #ps_desc{
        width: 18%;
    }
    #ps_unit{
        width: 4%;
    }
    #ps_qty{
        width: 5%;
    }
    #ps_abc{
        width: 5%;
    }
    #ps_bid{
        width: 58%;
    }
    #ps_act{
        width: 7%;
    }
    #ps_bid_2{
        display: flex;
        flex-wrap: wrap;
        /* margin-right: -15px;
        margin-left: -15px; */
        width: 100%;
    }

    #ps_bid_rank_head{
        position: relative;
        width: 10%;
        font-size: 10px;text-align: center;
    }
    #ps_bid_bidder_head{
        position: relative;
        width: 20%;
        font-size: 10px;text-align: center;
    }
    #ps_bid_price_head{
        position: relative;
        width: 10%;
        font-size: 10px;text-align: center;
    }
    #ps_bid_brand_head{
        position: relative;
        width: 10%;
        font-size: 10px;text-align: center;
    }
    #ps_bid_pack_head{
        position: relative;
        width: 10%;
        font-size: 10px;text-align: center;
    }
    
    #ps_bid_manu_head{
        position: relative;
        width: 20%;
        font-size: 10px;text-align: center;
    }

    #ps_bid_co_head{
        position: relative;
        width: 10%;
        font-size: 10px;text-align: center;
    }

    #ps_bid_mod_head{
        position: relative;
        width: 10%;
        font-size: 10px;text-align: center;
    }

    
    #ps_bid_rank{
        width: 10%;
        font-size: 10px;
    }
    #ps_bid_bidder{
        width: 20%;
        font-size: 10px;
    }
    #ps_bid_price{
        width: 10%;
        font-size: 10px;
    }
    #ps_bid_brand{
        width: 10%;
        font-size: 10px;
    }
    #ps_bid_pack{
        width: 10%;
        font-size: 10px;
    }
    
    #ps_bid_manu{
        width: 20%;
        font-size: 10px;
    }

    #ps_bid_co{
        width: 10%;
        font-size: 10px;
    }

    #ps_bid_mod{
        width: 10%;
        font-size: 10px;
    }

</style>
