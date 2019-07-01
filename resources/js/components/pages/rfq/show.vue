<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    RFQ ID: {{ rfqs.rfq_id }}
                </div>
                <div class="card-body">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Item No.</th>
                                <th>QTY</th>
                                <th>Unit</th>
                                <th>Article And Description</th>
                                <th class="text-center">ABC</th>
                                <th id="rfq_1">
                                    <div id="rfq_2">
                                        <div id="rfq_brand">Brand Name</div>
                                        <div id="rfq_manu">Manufacturer</div>
                                        <div id="rfq_tree">
                                            <div id="rfq_price">
                                                Price
                                            </div>
                                            <div id="rfq_price_2">
                                                <div id="rfq_unit">
                                                    Unit
                                                </div>
                                                <div id="rfq_total">
                                                    Total
                                                </div>
                                            </div>
                                        </div>
                                        <div  id="rfq_act">
                                            Action
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-show="rfqs.purchase_request" v-for="(item, index) in rfqs.purchase_request.view_dmd_purchase_requests" :key="item.id">
                                <td>{{ index+1}}</td>
                                <td class="text-right">{{ item.request_quantity }}</td>
                                <td class="text-right"></td>
                                <td>{{ item.gendesc }} {{ item.dmdnost }} {{ item.stredesc }} {{ item.formdesc }} {{ item.brandname }}</td>
                                <td class="text-right">{{ item.app_dmd.cost * item.app_dmd.quantity | currency2 }}</td>
                                <td id="rfq_1">
                                    <div id="rfq_3"  v-for="rfq in item.dmd_rfqs" :key="rfq.id">
                                        <div id="rfq_brand">{{ rfq.brand.brand_desc }}</div>
                                        <div id="rfq_manu">{{ rfq.manufacturer.manufacturer_desc }}</div>
                                        <div id="rfq_tree">
                                            <div id="rfq_price_2">
                                                <div id="rfq_unit">
                                                    {{ rfq.cost_unit }}
                                                </div>
                                                <div id="rfq_total">
                                                    {{ rfq.cost_unit * item.request_quantity | currency2 }}
                                                </div>
                                            </div>
                                        </div>
                                        <div id="rfq_act">
                                            <div class="btn-group dropleft btn-sm">
                                                <button id="btn_custom" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                <div class="dropdown-menu" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                    <button class="dropdown-item" @click="edit_rfq(item, rfq.id)"><i class="fas fa-pen"></i> Edit</button>
                                                    <button class="dropdown-item" @click="delete_rfq(rfq.id)"><i class="fas fa-trash"></i> Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary" type="button" @click="create_rfq(item)">Add</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="rfqModal" tabindex="-1" role="dialog" aria-labelledby="rfqModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6  class="modal-title text-bold" id="rfqModalLabel">Add new</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form  @submit.prevent="editmdode ? update_rfq() : store_rfq()">
                                <div>
                                    {{ form.gendesc }} {{ form.dmdnost }} {{ form.stredesc }} {{ form.formdesc }} {{ form.brandname }}
                                </div>
                                <div class="form-group">
                                    <div class="form-label">Brand</div>
                                    <select class="form-control form-control-sm" v-model="form.brand_id">
                                        <option v-for="m in brands" :key="m.brand_id" :value="m.brand_id">{{ m.brand_desc }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-label">Manufacturer</div>
                                    <select class="form-control form-control-sm" v-model="form.manufacturer_id">
                                        <option v-for="m in manufacturers" :key="m.manufacturer_id" :value="m.manufacturer_id">{{ m.manufacturer_desc }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-label">Cost</div>
                                   <input type="text" v-model="form.cost_unit" class="form-control form-control-sm">
                                </div>
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
import { mapGetters, mapActions } from "vuex";
export default {
    data(){
        return{
            rfqs:{},
            editmode: false,
            form: new Form({
                id: '',
                brand_id: '',
                manufacturer_id: '',
                cost_unit: '',
                dmd_id: '',
                gendesc: '',
                dmdnost: '',
                stredesc: '',
                formdesc: '',
                brandname: '',
            }),
        }
    },
    methods:{
        ...mapActions([
            'get_brands', 'get_manufacturers'
        ]),
        get_rfqs(){
            axios.get('../../api/rfq/'+this.$route.params.id).then(({data}) => {
                this.rfqs = data;
            }).catch(() => {

            });
        },
        create_rfq(item){
            this.editmode = false;
            this.form.fill(item);
            $('#rfqModal').modal('show');
        },
        store_rfq(){
            this.form.post('../../api/add_rfq/'+this.$route.params.id).then(() => {
                this.get_rfqs();
                $('#rfqModal').modal('hide');
            }).catch(() => {

            }); 
        },
        edit_rfq(item, id){
            this.editmode = true;
            this.form.fill(item);
            this.form.id = id;
            $('#rfqModal').modal('show');
        },
        update_rfq(){
            this.form.put('../../api/edit_rfq/'+this.form.id).then(() => {
                this.get_rfqs();
                $('#rfqModal').modal('hide');
            }).catch(() => {

            }); 
        },
        delete_rfq(id){
            axios.delete('../../api/rfq/'+id).then(() => {
                this.get_rfqs();
            }).catch(() => {

            });
        },
    },
    created(){
        this.get_rfqs();
        this.get_manufacturers();
        this.get_brands();
    },
    computed:{
        ...mapGetters([
            'brands', 'manufacturers'
        ]),
    },
    mounted(){

    },
}
</script>

<style scoped> 
    #rfq_1{
        width: 60%;
    }
    #rfq_2{
        display: flex;
        flex-wrap: wrap;
        /* margin-right: -15px;
        margin-left: -15px; */
        width: 100%;
        
    }
    #rfq_3{
        display: flex;
        flex-wrap: wrap;
        /* margin-right: -15px;
        margin-left: -15px; */
        width: 100%;

    }
    #rfq_brand{
        position: relative;
        width: 30%;

    }
    #rfq_manu{
        position: relative;
        width: 30%;

    }
    #rfq_tree{
        position: relative;
        width: 30%;
    }
    #rfq_act{
        position: relative;
        width: 10%;
        text-align: center;
    }
    #rfq_price{
        display: flex;
        flex-wrap: wrap;
        /* margin-right: -15px;
        margin-left: -15px; */
        width: 100%;
    }
    #rfq_price_2{
        display: flex;
        flex-wrap: wrap;
        /* margin-right: -15px;
        margin-left: -15px; */
        width: 100%;
        text-align: center;
    }
    #rfq_unit{
        position: relative;
        width: 50%;
        text-align: right;
    }
    #rfq_total{
        position: relative;
        width: 50%;
        text-align: right;
    }   
</style>
