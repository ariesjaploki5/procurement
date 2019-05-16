<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        {{ price_schedule.category.category_desc }} - {{ price_schedule.price_schedule_year }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm" id="price_schedule">
                        <table class="table table-sm table-hover table-bordered" id="table1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="15%">Description</th>
                                    <th class="text-center">Quantity</th>
                                    <th>ABC</th>
                                    <th>
                                        <div class="row thead_bidder">
                                            <div class="col_rank">Rank</div>
                                            <div class="col_bid">Bidders</div>
                                            <div class="col_price">Bid Price</div>
                                            <div class="col_brand">Brand</div>
                                            <div class="col_pack">Packaging</div>
                                            <div class="col_manu">Manufaturer</div>
                                            <div class="col_co">Country of Origin</div>
                                            <div class="col_act">Modify</div>
                                        </div>
                                    </th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in items" :key="item.item_id">
                                    <td>{{ item.item_id }}</td>
                                    <td widtd="15%">{{ item.item_desc }}</td>
                                    <td class="text-center">Quantity</td>
                                    <td>ABC</td>
                                    <td>
                                        <p v-if="!item.item_price_schedules.length">No Bidder</p>
                                        <div v-else>
                                            <table class="table" id="table2">
                                                <tbody>
                                                    <tr v-for="(ps, index) in item.item_price_schedules" :key="ps.id">
                                                        <td v-bind:class="{ 'table-success' : index == 0, 'bg-danger': ps.terminated == 1}">
                                                            <div class="row tbody_bidder">
                                                                <div class="col_rank">
                                                                    <p v-if="ps.rank">{{ ps.rank }}</p>
                                                                    <p v-else></p>
                                                                </div>
                                                                <div class="col_bid">{{ ps.supplier.supplier_name }}</div>
                                                                <div class="col_price">
                                                                    {{ ps.bid_price | currency2 }}
                                                                </div>
                                                                <div class="col_brand">
                                                                    <p v-if="ps.brand">{{ ps.brand.brand_desc }}</p>
                                                                    <p v-else></p>
                                                                </div>
                                                                <div class="col_pack">
                                                                    <p v-if="ps.packaging">{{ ps.packaging.packaging_desc }}</p>
                                                                    <p v-else></p>
                                                                </div>
                                                                <div class="col_manu">
                                                                    <p v-if="ps.manufacturer">{{ ps.manufacturer.manufacturer_desc }}</p>
                                                                    <p v-else></p>
                                                                </div>
                                                                <div class="col_co">
                                                                    <p v-if="ps.country">{{ ps.country.country_desc }}</p>
                                                                    <p v-else></p>
                                                                </div>
                                                                <div class="col_act">
                                                                    <div class="btn-group dropleft btn-sm">
                                                                        <button id="btn_custom" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                                            <button class="dropdown-item" @click="edit_bidder(item, ps)"><i class="fas fa-pen"></i> Edit</button>
                                                                            <button class="dropdown-item" @click="terminate_bidder(ps.id)">Terminate</button>
                                                                            <button class="dropdown-item" @click="unterminate_bidder(ps.id)">Unterminate</button>
                                                                            <button class="dropdown-item" @click="delete_bidder(ps.id)">Remove</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm" @click="add_bidder(item)" id="btn_custom">
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
                                        <h4>{{ form.item_desc }}</h4>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cat" class="col col-form-label">Bidder</label>
                                    <div class="col">
                                        <select class="from-control form-control-sm" v-model="form.supplier_id" required>
                                            <option v-for="s in suppliers" :key="s.supplier_id" :value="s.supplier_id">{{ s.supplier_name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cat" class="col-sm-2 col-form-label">Bid Price</label>
                                    <div class="col-sm-6">
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
            items: {},
            form: new Form({
                id: '',
                item_desc: '',
                item_id: '',
                bid_price: '',
                supplier_id: '',
                brand_id: '',
                manufacturer_id: '',
                packaging_id: '',
                country_id: '',
            }),
            price_schedule: {},
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

        add_bidder(item){
            this.editmode = false;
            this.form.reset();
            this.form.item_id = item.item_id;
            this.form.item_desc = item.item_desc;
            $('#bidderModal').modal('show');
        },
        store_bidder(){
            this.form.post('../../api/item_price_schedule/'+this.$route.params.id).then(() => {
                
                $('#bidderModal').modal('hide');
            });
        },
        edit_bidder(item, ps){
            this.editmode = true;
            this.form.reset();
            this.form.fill(ps);
            this.form.item_desc = item.item_desc;
            $('#bidderModal').modal('show');
        },
        update_bidder(){
            this.form.put('../../api/item_price_schedule/'+this.form.id).then(() => {
                
                $('#bidderModal').modal('hide');
            });
        },
        terminate_bidder(id){
            axios.put('../../api/item_price_schedule/'+id+"/terminate").then(() => {
                
            }).catch(() => {

            });
        },
        unterminate_bidder(id){
            axios.put('../../api/item_price_schedule/'+id+"/unterminate").then(() => {
                
            }).catch(() => {

            });
        },
        delete_bidder(id){
            axios.delete('../../api/item_price_schedule/'+id).then(() => {
                
            }).catch(() => {

            });
        },
        get_items(){
            axios.get('../../api/price_schedule/'+this.$route.params.id).then(({data}) => {
                this.items = data;
            }).catch(() => {

            });
        },
        
    },
    created(){
        this.get_items();
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
    },
    mounted(){
        window.Echo.channel("ips_created").listen(".item_price_schedule.created", (e) => {
            this.get_items();
        });
        window.Echo.channel("ips_updated").listen(".item_price_schedule.updated", (e) => {
            this.get_items();
        });
    }
}
</script>
<style>
    #btn_custom {
        padding: 0.3rem 0.3rem !important;
        font-size: 0.60rem !important;
        line-height: 1.5;
        border-radius: 0.2rem;
    }

    #price_schedule{
        font-size: 11px !important;
    }

    .btn-system{
        padding-top: 4rem !important;
        padding-bottom: 4rem !important;
        font-weight: 700 !important;
        font-size: 1.5rem !important;
        border-radius: 1rem !important;
        border: 3px solid !important;
        margin-top: 3% !important;
        margin-bottom: 3% !important;
    }


    .row .thead_bidder{
        width: 100%;
        margin-left: 0.15rem !important;
        margin-right: 0.15rem !important;
    }

    .row .tbody_bidder{
        width: 100%;
        margin-left: 0.15rem !important;
        margin-right: 0.15rem !important;
    }

    .col_price{
        width: 20% !important;
        padding: 0rem 0.1rem !important;
    }

    .col_bal{
        width: 20% !important;
        padding: 0rem 0.1rem !important;
    }

    .col_rank{
        width: 7% !important;
        padding: 0rem 0.1rem !important;
    }

    .col_bid{
        width: 19% !important;
        padding: 0rem 0.15rem !important;
    }

    .col_price{
        width: 10% !important;
        padding: 0rem 0.15rem !important;
    }

    .col_brand{
        width: 14% !important;
        padding: 0rem 0.15rem !important;
    }

    .col_pack{
        width: 12% !important;
        padding: 0rem 0.15rem !important;
    }

    .col_manu{
        width: 15% !important;
        padding: 0rem 0.15rem !important;
    }

    .col_co{
        width: 15% !important;
        padding: 0rem 0.15rem !important;
    }

    .col_act{
        width: 8% !important;
        padding: 0rem 0.15rem !important;
        margin: auto !important;
    }

</style>
