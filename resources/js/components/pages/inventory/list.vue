<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-auto">
                            <label for="" class="form-label">Category</label>
                        </div>
                        <div class="col-md-auto">
                            <select class="form-control form-control-sm" @change="onChange" v-model="category_id">
                                <option v-for="c in categories" :key="c.category_id" :value="c.category_id">{{ c.category_desc }}</option>
                            </select>
                        </div>
                        <div class="col-md-auto" v-show="category_id">
                            <label for="" class="form-label">Search</label>
                        </div>
                        <div class="col-md-auto" v-show="category_id">
                            <input class="form-control form-control-sm" v-model="search_form.word" placeholder="Description">
                        </div>
                        <div class="col-md-auto" v-show="category_id">
                            <button type="button" class="btn btn-sm btn-primary" @click="search()">Search</button>
                        </div>
                    </div>  
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th width="45%">Description</th>
                                    <th class="text-center">Standard Stock Level</th>
                                    <th class="text-center">Re-order Point</th>
                                    <th class="text-center">Balance On Hand</th>
                                    <th class="text-center">Item in Transit</th>
                                    <th class="text-right">Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in items" :key="item.item_id" v-bind:class="{ 'table-danger' : !item.item_homis_link }">
                                    <td>{{ item.item_id }}</td>
                                    <td>{{ item.item_desc }}</td>
                                    <td class="text-right">
                                        <div v-if="item.standard_stock_level == null || item.standard_stock_level == 0">
                                            
                                        </div>
                                        <div v-else>
                                            {{ item.standard_stock_level | numeral3}}
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div v-if="item.standard_stock_level == null || item.standard_stock_level == 0">
                                            
                                        </div>
                                        <div v-else>
                                            {{ item.standard_stock_level / 2 | numeral3 }}
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div v-if="!item.item_homis_link">
                                            
                                        </div>
                                        <div v-else>
                                            {{ item.item_homis_link.boh | numeral3}}
                                        </div>
                                        
                                    </td>
                                    <td></td>
                                    <td class="text-center">
                                        <div class="btn-group dropleft btn-sm">
                                            <button id="btn_custom" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                            <div class="dropdown-menu" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                <button class="dropdown-item" @click="edit_item(item)"><i class="fas fa-pen"></i> Edit</button>
                                                <button class="dropdown-item" @click="view_balance(item)"><i class="fas fa-eye"></i> View Balance</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5  class="modal-title" id="viewModalLabel">{{ form.item_desc }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive-sm">
                                        <table class="table table-sm table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="40%">End User</th>
                                                    <th class="text-center" width="20%">Balance</th>
                                                    <th class="text-center" width="30%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody v-show="views.end_users">
                                                <tr v-for="end_user in views.end_users" :key="end_user.id">
                                                    <td>{{ end_user.chrgdesc }}</td>
                                                    <td class="text-right">{{ end_user.stockbal }}</td>
                                                    <td>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <form action="">
                                <div class="form-group">

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5  class="modal-title" id="itemModalLabel">{{ form.item_desc }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form  @submit.prevent="update_item()">
                                <div class="form-group">
                                    <label for="ssl" class="form-label">Standard Stock Level</label>
                                    <input type="number" class="form-control form-control-sm" v-model="form.standard_stock_level">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
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
import { mapGetters, mapActions } from "vuex";

export default {
    data(){
        return{
            form: new Form({
                item_id: '',
                item_desc: '',
                standard_stock_level: '',
                beginning_balance: '',
                category_id: '',
                unit_id: '',
            }),
            search_form: new Form({
                word: '',
            }),
            category_id: '',
            items: {},
            isLoading: false,
            views: {},
        }
    },
    methods:{
        ...mapActions([
            'get_categories'
        ]),
        onChange(){
            this.search_form.category_id = this.category_id;
            this.get_items();
        },
        get_items(){
            axios.get('../../api/inventory/'+this.category_id).then(({data}) => {
                this.items = data;
            }).catch(() => {

            });
        },
        search(){
            this.search_form.post('../../api/search_item/'+this.category_id).then(({data}) => {
                this.items = data;
            }).catch(() => {

            });
        },
        view_balance(item){
            this.form.item_id = item.item_id;
            this.form.item_desc = item.item_desc;
            
            this.views = item.item_homis_link;
            
            
            $('#viewModal').modal('show');

        },
        edit_item(item){
            this.form.fill(item);
            $('#itemModal').modal('show');
        },
        update_item(){
            this.form.put('../../api/item/'+this.form.item_id).then(() => {
                $('#itemModal').modal('hide');
            }).catch(() => {

            });
        }
    },
    computed:{
        ...mapGetters([
            'categories'
        ]),
    },
    created(){
        this.get_categories();
    },
    mounted(){
        
        window.Echo.channel("item_created").listen(".item.created", (e) => {
            this.get_items();
        });
        window.Echo.channel("item_updated").listen(".item.updated", (e) => {
            this.get_items();
        });
    
    },
}
</script>

<style>
.table{
    font-size: 12px !important;
}
#btn_custom {
        padding: 0.3rem 0.3rem !important;
        font-size: 0.60rem !important;
        line-height: 1.5;
        border-radius: 0.2rem;
    }
</style>
