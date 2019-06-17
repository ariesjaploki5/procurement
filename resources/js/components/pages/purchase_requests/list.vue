<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Purchase Requests
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-sm btn-primary" @click="create_pr()">
                                <i class="fas fa-plus"></i> Create
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>PR #</th>
                                    <th>Category</th>
                                    <th>Mode</th>
                                    <th>Supplier</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="prModal" tabindex="-1" role="dialog" aria-labelledby="prModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editmode"  class="modal-title" id="prModalLabel">New Purchase Request</h5>
                            <h5 v-show="editmode" class="modal-title" id="prModalLabel">Update Purchase Request</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editmode ? update_pr() : store_pr()">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="category" class="col-sm-3 col-form-label">Category</label>
                                            <div class="col-sm-6">
                                                <select class="form-control form-control-sm" v-model="category_id" @change="categoryChange()">
                                                    <option v-for="cat in categories" :key="cat.category_id" :value="cat.category_id">{{ cat.category_desc }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="mode" class="col-sm-3 col-form-label">Mode</label>
                                            <div class="col-sm-6">
                                                <select class="form-control form-control-sm" v-model="mode_id" @change="modeChange()" v-if="category_id">
                                                    <option v-for="mode in modes" :key="mode.mode_id" :value="mode.mode_id">{{ mode.mode_desc }}</option>
                                                </select>
                                                <select class="form-control form-control-sm" disabled v-else> 
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive-sm">
                                            <table class="table table-sm table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Item Code</th>
                                                        <th>Qty</th>
                                                        <th>Unit of Issue</th>
                                                        <th>Item Description</th>
                                                        <th>Stock No</th>
                                                        <th>Unit Cost</th>
                                                        <th>Estimated Cost</th>
                                                        <th>Balance On Hand</th>
                                                        <th>Item in Transit</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody v-show="!category_id && !mode_id">
                                                </tbody>
                                                <tbody v-show="isLoading">
                                                    <tr>
                                                        <td colspan="10" class="text-center">
                                                            <div class="spinner-border" style="width: 6rem; height: 6rem;" role="status">
                                                                <span class="sr-only">Loading...</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tbody v-show="!isLoading">
                                                    <tr v-for="item in form.items" :key="item.item_id">
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success btn-sm">Save</button>
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
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
            category_id: '',
            mode_id: '',
            isLoading: false,
            editmode: false,
            form: new Form({
                purchase_request_id: '',
                supplier_id: '',
                items:{},
                mode_id: '',
                category_id: '',
            }),
            purchase_requests: [],
        }
    },
    methods:{
        ...mapActions([
            'get_categories', 'get_modes'
        ]),
        create_pr(){
            this.editmode = false;
            this.form.reset();
            $('#prModal').modal('show')
        },
        store_pr(){

        },
        modeChange(){
            this.get_items();
            this.form.mode_id = this.mode_id;

        },
        categoryChange(){
            this.isLoading = true;
            this.form.category_id = this.category_id;
        },
        get_items(){
            axios.get('../../api/item/'+this.mode_id+'/'+this.category_id).then(({data}) => {
                this.form.items = data;
            }).catch(() => {

            });
        },
        get_prs(){
            axios.get('../../api/purchase_request').then(({data}) => {
                this.purchase_requests = data;
            }).catch(() => {

            });
        },
        div_head_rcv(id){

        },
        div_head_rls(id){

        },
        pmo_rcv(id){

        },
        pmo_rls(id){

        },
        budget_rcv(id){

        },
        budget_rls(id){

        },
        accounting_rcv(id){

        },
        accounting_rls(id){

        },
        mcc_rcv(id){

        },
        mcc_rls(id){

        },
        fmo_rcv(id){

        },
        fmo_rls(id){

        },
        pmo_rcv2(id){

        },
        pmo_rls2(id){

        },
        pmo_rcv3(id){

        },
        pmo_rls3(id){

        },
        mmo_rcv(id){

        },
        mmo_rls(id){

        },
        div_head_rcv2(id){

        },
        div_head_rls2(id){

        },
    },
    computed:{
        ...mapGetters([
            "categories", "modes"
        ]),
    },
    created(){
        this.get_categories();
        this.get_modes();
        this.get_prs();
    }
}
</script>

<style>


</style>
