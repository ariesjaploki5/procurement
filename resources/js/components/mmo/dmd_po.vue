<template>
    <div class="row">
        <div class="col-md-12">
            Purchase Orders
        </div>
        <div class="w-100 mb-1"></div>
            <div class="col-md-12">
                <form  @submit.prevent="search()">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" class="form-control form-control-sm" v-model="search_form.word"> 
                        </div>
                        <div class="col-md-5">
                            <button type="submit" class="btn btn-sm btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        <div class="w-100 mb-2"></div>
        <div class="col-md-12">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th width="12%">PO #</th>
                        <th width="54%">Item Description</th>
                        <th width="20%">Ordered Qty</th>
                        <th width="14%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="dp in dmd_po" :key="dp.dmd_po_id">
                        <td width="12%">{{ dp.po_id }}</td>
                        <td width="54%">{{ dp.dmddesc }}</td>
                        <td width="20%" class="text-right">{{ dp.order_quantity | numeral3 }}</td>
                        <td width="14%" class="text-center">
                            <div class="btn-group dropleft btn-sm">
                                <button type="button" class="btn btn-light btn-outline-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button class="dropdown-item" @click="receive_modal(dp)">Receive</button>
                                    <button class="dropdown-item" @click="notice_to_terminate_modal(dp)">Notice to Terminate</button>
                                    <button class="dropdown-item" @click="terminate_modal(dp)">Terminate</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="modal fade" id="receiveModal" tabindex="-1" role="dialog" aria-labelledby="receiveModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            Receive
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div> 
                        <form  @submit.prevent="receive()">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Description</label>
                                    </div>
                                    <div class="col-md-8">
                                        <span>{{ receive_form.dmddesc }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Quantity</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control form-control-sm text-right" v-model="receive_form.order_quantity">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-sm btn-warning">Cancel</button>
                                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="terminateModal" tabindex="-1" role="dialog" aria-labelledby="terminateModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            Terminate
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div> 
                        <form  @submit.prevent="terminate()">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Please Select:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select class="form-control form-control-sm">
                                            <option :value="1">With Waiver</option>
                                            <option :value="0">Without Waiver</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-sm btn-warning">Cancel</button>
                                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="noticeToTerminateModal" tabindex="-1" role="dialog" aria-labelledby="noticeToTerminateModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            Notice To Terminate
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div> 
                        <form  @submit.prevent="notice_to_terminate()">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="" class="form-label"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-sm btn-warning">Cancel</button>
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
export default {
    data(){
        return{
            dmd_po: [],
            search_form: new Form({
                word: '',
            }),
            receive_form: new Form({
                dmd_id: '',
                purchase_order_id: '',
                order_quantity: '',
                dmddesc: '',
                manufacturer_desc: '',
                brand_desc: '',
                packaging_desc: '',
                supplier_name: '',
            }),
            terminate_form: new Form({
                dmd_id: '',
                purchase_order_id: '',
                order_quantity: '',
                dmddesc: '',
                manufacturer_desc: '',
                brand_desc: '',
                packaging_desc: '',
                supplier_name: '',
            }),
            notice_to_terminate_form: new Form({
                dmd_id: '',
                purchase_order_id: '',
                order_quantity: '',
                dmddesc: '',
                manufacturer_desc: '',
                brand_desc: '',
                packaging_desc: '',
                supplier_name: '',
            }),
        }
    },
    methods:{
        get_dmd_po(){
            axios.get('../../api/mmo_dmd_po').then(({data}) => {
                this.dmd_po = data;
            }).catch(() => {

            });
        },
        search(){
            this.search_form.post('../../api/mmo_dmd_po_search').then(({data}) => {
                this.dmd_po = data;
            }).catch(() => {

            });
        },
        receive_modal(dp){
            this.receive_form.fill(dp);
            $('#receiveModal').modal('show');
        },
        receive(){

        },
        notice_to_terminate_modal(dp){
            this.notice_to_terminate_form.fill(dp);
            $('#noticeToTerminateModal').modal('show');
        },
        notice_to_terminate(){

        },
        terminate_modal(dp){
            this.terminate_form.fill(dp);
            $('#terminateModal').modal('show');
        },
        terminate(){

        }
        
    },
    created(){
        this.get_dmd_po();
    }
}
</script>
<style>
tr {
        width: 100%;
        display: inline-table;
        table-layout: fixed;
    }

    table {
        height:36rem;             
        display: -moz-groupbox;    
    }

    tbody {
        overflow-y: scroll;      
        height: 34rem;           
        width: 98.5%;
        position: absolute;
    }
</style>