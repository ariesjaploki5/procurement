<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row mb-1 shadow p-3 mb-3 bg-white rounded">
                <h4><i class="fas fa-wallet"></i> Request for Quotation</h4>
            </div>
                <div class="card-body">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>PR ID</th>
                                <th>Date Created</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="rfq in rfqs" :key="rfq.rfq_id">
                                <td @click="view_rfq(rfq.rfq_id)">{{ rfq.rfq_id }}</td>
                                <td @click="view_rfq(rfq.rfq_id)">{{ rfq.pr_id }}</td>
                                <td @click="view_rfq(rfq.rfq_id)">{{rfq.created_at | myDate3 }} - {{rfq.created_at | time1 }}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            <div class="modal fade" id="viewRfqModal" tabindex="-1" role="dialog" aria-labelledby="viewRfqModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6  class="modal-title text-bold" id="viewRfqModalLabel">{{ rfq.created_at | myDate }} - {{ rfq.purchase_request_id | numeral2 }}</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th id="rfq_item">Item No.</th>
                                        <th id="rfq_qty">QTY</th>
                                        <th id="rfq_unit_1">Unit</th>
                                        <th id="rfq_desc">Article And Description</th>
                                        <th id="rfq_abc" class="text-center">ABC</th>
                                        <th id="rfq_1">
                                            <div id="rfq_2">
                                                <div id="rfq_num"></div>
                                                <div id="rfq_brand">Brand Name</div>
                                                <div id="rfq_manu">Manufacturer</div>
                                                <div id="rfq_tree">
                                                    <div id="rfq_price">Price</div>
                                                    <div id="rfq_price_2">
                                                        <div id="rfq_unit">Unit</div>
                                                        <div id="rfq_total">Total</div>
                                                    </div>
                                                </div>
                                                <div id="rfq_act">Action</div>
                                            </div>
                                        </th>
                                        <th id="rfq_act_2">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in rfq.purchase_request.view_dmd_purchase_requests" :key="item.id">
                                        <td id="rfq_item">{{ index+1}}</td>
                                        <td id="rfq_qty">{{ item.request_quantity | numeral3 }}</td>
                                        <td id="rfq_unit_1"></td>
                                        <td id="rfq_desc">{{ item.dmddesc }}</td>
                                        <td id="rfq_abc" class="text-right">{{ item.app_dmd.cost * item.app_dmd.quantity | currency2 }}</td>
                                        <td id="rfq_1">
                                            <div id="rfq_3"  v-for="(rfq, index) in item.dmd_rfqs" :key="rfq.id">
                                                <div id="rfq_num">{{ index+1 }}</div>
                                                <div id="rfq_brand">{{ rfq.brand.brand_desc }}</div>
                                                <div id="rfq_manu">{{ rfq.manufacturer.manufacturer_desc }}</div>
                                                <div id="rfq_tree">
                                                    <div id="rfq_price_2">
                                                        <div id="rfq_unit">{{ rfq.cost_unit | currency2 }}</div>
                                                        <div id="rfq_total">{{ rfq.cost_unit * item.request_quantity | currency2 }}</div>
                                                    </div>
                                                </div>
                                                <div id="rfq_act">
                                                    <div class="btn-group dropleft btn-sm">
                                                        <button id="btn_custom" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                            <button class="dropdown-item" @click="edit_rfq(item, rfq, rfq.id)"><i class="fas fa-pen"></i> Edit</button>
                                                            <button class="dropdown-item" @click="delete_rfq(rfq.id)"><i class="fas fa-trash"></i> Delete</button>
                                                        </div>
                                                    </div>
                                                    <!-- <button type="button" class="btn btn-sm btn-success" @click="print_rfq(rfq.id)"><i class="fas fa-print"></i> Print Rfq</button> -->
                                                </div>
                                            </div>
                                        </td>
                                        <td id="rfq_act_2" class="row">
                                            <button class="btn btn-sm btn-primary" data-toggle="tooltip" title="Add" type="button" @click="create_rfq(item)"><i class="fas fa-plus"></i> </button>
                                            <button type="button" data-toggle="tooltip" title="Print AOQ" class="btn btn-sm btn-success" @click="print_aoq(item.dmd_id)"><i class="fas fa-print"></i> </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <!-- <button class="btn btn-sm btn-success" type="button" @click="create_po()">Create PO</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="rfqModal" tabindex="-1" role="dialog" aria-labelledby="rfqModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editmode" class="modal-title" id="rfqModalLabel">Add New</h5>
                            <h5 v-show="editmode" class="modal-title" id="rfqModalLabel">Edit</h5>                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="editmode ? update_rfq() : store_rfq()">
                                <div>
                                    <h4>{{ form.gendesc }} {{ form.dmdnost }} {{ form.stredesc }} {{ form.formdesc }} {{ form.brandname }}</h4>
                                </div>
                                <div class="form group">
                                    <div class="form-label font-weight-bold">Supplier</div>
                                    <select class="form-control form-control-sm" v-model="form.supplier_id">
                                        <option v-for="m in suppliers" :key="m.supplier_id" :value="m.supplier_id">{{ m.supplier_name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-label font-weight-bold">Brand</div>
                                    <select class="form-control form-control-sm" v-model="form.brand_id">
                                        <option v-for="m in brands" :key="m.brand_id" :value="m.brand_id">{{ m.brand_desc }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-label font-weight-bold">Manufacturer</div>
                                    <select class="form-control form-control-sm" v-model="form.manufacturer_id">
                                        <option v-for="m in manufacturers" :key="m.manufacturer_id" :value="m.manufacturer_id">{{ m.manufacturer_desc }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-label font-weight-bold">Packaging</div>
                                    <select class="form-control form-control-sm" v-model="form.packaging_id">
                                        <option v-for="p in packagings" :key="p.packaging_id" :value="p.packaging_id">{{ p.packaging_desc }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-label font-weight-bold">Country of Origin</div>
                                    <select class="form-control form-control-sm" v-model="form.country_id">
                                        <option v-for="c in countries" :key="c.country_id" :value="c.country_id">{{ c.country_desc }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-label font-weight-bold">Cost</div>
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
            editmode: false,
            rfqs: {},
            rfq: {
                purchase_request_id: '',
                purchase_request: {
                    view_dmd_purchase_requests:[],
                },
            },
            selected_id: '',
            form: new Form({
                id: '',
                supplier_id: '',
                brand_id: '',
                manufacturer_id: '',
                packaging_id: '',
                country_id: '',
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
            'get_brands', 'get_manufacturers', 'get_suppliers', 'get_packagings', 'get_countries',
        ]),
        create_rfq(item){
            this.editmode = false;
            this.form.fill(item);
            $('#rfqModal').modal('show');
        },
        store_rfq(){
            this.form.post('../../api/add_rfq/'+this.selected_id).then(() => {
                this.get_rfq();
                $('#rfqModal').modal('hide');
            }).catch(() => {

            }); 
        },
        edit_rfq(item, rfq, id){
            this.editmode = true;
            this.form.fill(item);
            this.form.brand_id = rfq.brand_id;
            this.form.manufacturer_id = rfq.manufacturer_id;
            this.form.cost_unit = rfq.cost_unit;
            this.form.supplier_id = rfq.supplier_id;
            this.form.id = id;
            $('#rfqModal').modal('show');
        },
        create_po(){
            axios.post('../../api/rfq_to_po',{
                pr_id: this.rfq.purchase_request_id,
                item: this.rfq.purchase_request.view_dmd_purchase_requests

            }).then(() => {
                
            }).catch(() => {

            });
        },
        update_rfq(){
            this.form.put('../../api/rfq/'+this.form.id).then(() => {
                this.get_rfq();
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
        get_rfqs(){
            axios.get('../../api/rfq').then(({data}) => {
                this.rfqs = data;
            }).catch(() => {

            });
        },
        view_rfq(id){
            this.selected_id = id;
            this.get_rfq();
            $('#viewRfqModal').modal('show');
        },
        get_rfq(){
            axios.get('../../api/rfq/'+this.selected_id).then(({data}) => {
                this.rfq = data;
            }).catch(() => {

            });
        },
        // print_rfq(rfq_id){
        //     $('#viewRfqModal').modal('hide');
        //     this.$router.push({name: 'rfq', params:{ id: rfq_id }});
        // },
        print_aoq(dmd_id){
            $('#viewRfqModal').modal('hide');
            this.$router.push({name: 'aoq', params:{ id: dmd_id, rfq_id: this.rfq.rfq_id }});
        },
    },
    created(){
        this.get_rfqs();
        this.get_manufacturers();
        this.get_brands();
        this.get_suppliers();
        this.get_packagings();
        this.get_countries();
    },
    computed:{
        ...mapGetters([
            'brands', 'manufacturers', 'suppliers', 'packagings', 'countries',
        ]),
    }
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
    @media (min-width: 770px) {
    .modal-xl {
            width: 95%;
            max-width:1500px;
        }
    }
    #rfq_qty{
        width: 5%;
    }
    #rfq_abc{
        width: 5%;
    }
    #rfq_unit_1{
        width: 5%;
    }
    #btn_xs{
        height: 20px !important;
        width: 40px !important;
    }
    #rfq_item{
        width: 3%;
    }
    #rfq_desc{
        width: 10%;
    }
    #rfq_1{
        width: 70%;
    }
    #rfq_2{
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }
    #rfq_3{
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }
    #rfq_num{
        position: relative;
        width: 4%;
        text-align: center;
    }
    #rfq_brand{
        position: relative;
        width: 20%;
    }
    #rfq_manu{
        position: relative;
        width: 30%;
    }
    #rfq_tree{
        position: relative;
        width: 25%;
    }
    #rfq_act{
        position: relative;
        width: 15%;
        text-align: center;
    }
    #rfq_price{
        display: flex;
        flex-wrap: wrap;
        /* margin-right: -15px;
        margin-left: -15px; */
        width: 100%;
        text-align: center;
            padding-left: 60%;
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
        width: 45%;
        text-align: right;
    }
    #rfq_total{
        position: relative;
        width: 45%;
        text-align: right;
    }   
    #rfq_act_2{
        position: relative;
        width: 5%;
        text-align: center;
    }
</style>