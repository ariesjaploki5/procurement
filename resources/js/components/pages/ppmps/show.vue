<template>
    <div class="row">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    <div class="row mt-2 justify-content-center">
                        <div class="col-md-7">
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" v-model="search_form.word" placeholder="Description">
                                </div>
                                <div class="col-md-auto">
                                    <button type="button" class="btn btn-sm btn-primary" @click="search()">Search</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="card-body" v-show="items.length">
                    <div class="table-responsive-sm" id="table_1">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">ID</th>
                                    <th>Description</th>
                                    <th width="10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in items" :key="item.item_id">
                                    <td class="text-right">{{ item.item_id }}</td>
                                    <td>{{ item.item_desc }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary" @click="add_item_ppmp(item.item_id)"><i class="fas fa-plus"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            {{ ppmp.category.category_desc }} - {{ ppmp.ppmp_year }}
                        </div>
                    </div>
                </div>
                <div class="card-body" v-show="form.items.length">
                    <form @submit.prevent="update_item_ppmp()">
                        <div class="table-responsive-sm" id="table_2" v-show="form.items.length">
                            <table class="table table-sm table-hover">
                                <thead class="text-center table-bordered">
                                    <tr>
                                        <th rowspan="2" style="width: 4% !important;">CODE</th>
                                        <th rowspan="2" style="width: 14% !important;">General Description</th>
                                        <th rowspan="2" style="width: 4% !important;">Unit of Issue</th>
                                        <th style="width: 4% !important;">Quantity</th>
                                        <th rowspan="2" style="width: 4% !important;">Estimated Budget</th>
                                        <th rowspan="2" style="width: 4% !important;">Mode of Procurement</th>
                                        <th colspan="12" style="width: 60% !important;">Schedule/Milestone of Activies</th>
                                    </tr>
                                    <tr>
                                        <th>Size</th>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>
                                        <th>May</th>
                                        <th>Jun</th>
                                        <th>July</th>
                                        <th>Aug</th>
                                        <th>Sept</th>
                                        <th>Oct</th>
                                        <th>Nov</th>
                                        <th>Dec</th>
                                    </tr>
                                </thead>
                                <tbody v-if="isLoading == false" class="table_tbody">
                                    <tr v-for="item in form.items" :key="item.item_ppmp_id">
                                        <td></td>
                                        <td>{{ item.item.item_desc }}</td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            <select v-model="item.mode_id">
                                                <option v-for="mode in modes" :key="mode.mode_id" :value="mode.mode_id">{{ mode.mode_desc }}</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="input_number" v-model="item.jan">
                                        </td>
                                        <td>
                                            <input type="number" class="input_number" v-model="item.feb">
                                        </td>
                                        <td>
                                            <input type="number" class="input_number" v-model="item.mar">
                                        </td>
                                        <td>
                                            <input type="number" class="input_number" v-model="item.apr">
                                        </td>
                                        <td>
                                            <input type="number" class="input_number" v-model="item.may">
                                        </td>
                                        <td>
                                            <input type="number" class="input_number" v-model="item.june">
                                        </td>
                                        <td>
                                            <input type="number" class="input_number" v-model="item.july">
                                        </td>
                                        <td>
                                            <input type="number" class="input_number" v-model="item.aug">
                                        </td>
                                        <td>
                                            <input type="number" class="input_number" v-model="item.sept">
                                        </td>
                                        <td>
                                            <input type="number" class="input_number" v-model="item.oct">
                                        </td>
                                        <td>
                                            <input type="number" class="input_number" v-model="item.nov">
                                        </td>
                                        <td>
                                            <input type="number" class="input_number" v-model="item.dec">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success">Save</button>
                    </form>
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
                            <form  @submit.prevent="update_item_ppmp()">
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
            isLoading:false,
            editmode: false,
            items: {},
            form:new Form({
                ppmp_id: '',
                items:{},
            }),
            ppmp: {},
            search_form: new Form({
                word: '',
            }),
        }
    },
    methods:{
        ...mapActions([
            'get_modes',
        ]),
        ppmp_get(){
            axios.get('../../api/ppmp_get/'+this.$route.params.id).then(({data}) => {
                this.ppmp = data;
                this.form.ppmp_id = this.$route.params.id;
            }).catch(() => {

            });
        },
        get_item_ppmp(){
            axios.get('../../api/item_ppmp/'+this.$route.params.id).then(({data}) => {
                this.form.items = data;
            }).catch(()=> {

            })
        },
        add_item_ppmp(id){
            axios.post('../../api/item_ppmp/'+this.$route.params.id+'/'+id).then(()=> {
                this.get_item_ppmp();
            }).catch(() => {

            });
        },
        store_item_ppmp(){

        },
        edit_item_ppmp(item){
            this.form.fill(item);

        },
        update_item_ppmp(){
            this.form.put('../../api/item_ppmp/'+this.form.ppmp_id).then(() => {
                this.get_item_ppmp();
            }).catch(() => {

            });
        },
        search(){
            this.search_form.post('../../api/search_item_ppmp/'+this.ppmp.category_id).then(({data}) => {
                this.items = data;
            }).catch(() => {

            });
        }
    },
    computed:{
        ...mapGetters([
            'modes'
        ]),

    },
    created(){
        this.ppmp_get();
        this.get_item_ppmp();
        this.get_modes();
    }
}
</script>

<style>
#btn_custom {
        padding: 0.3rem 0.3rem !important;
        font-size: 0.55rem !important;
        line-height: 1.5;
        border-radius: 0.2rem;
    }
#table_1{
    background-color: white !important;
}
#table_2{
    background-color: white !important;
    font-size: 11px !important;
}
.input_number{
    width: 50px !important;
    text-align: right;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
}
</style>
