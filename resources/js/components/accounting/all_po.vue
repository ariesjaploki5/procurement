<template>
    <div class="row">
        <div class="col-md-12">
            <span>Purchase Requests</span>
        </div>
        <div class="col-md-12 mt-1">
            <form @submit.prevent="search()">
                <div class="row">
                    <div class="col-md-auto">
                        <label for="" class="form-label">PO #</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control form-control-sm" required v-model="search_form.word">
                    </div>
                    <div class="col-md-auto">
                        <button class="btn btn-sm btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12 mt-1">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th width="10%">PO #</th>
                        <th width="15%">Date Created</th>
                        <th width="18%">Track</th>
                        <th width="10%">Mode</th>
                        <th width="37%">Supplier</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tbody class="table-bordered">
                    <tr v-for="po in pos" :key="po.purchase_order_id">
                        <th @click="view_po(po)" width="10%">{{ po.po_id }}</th>
                        <th @click="view_po(po)" width="15%">{{ po.created_at | myDate3 }}</th>
                        <th @click="view_track(po)" width="18%">
                            <span v-if="po.csd">{{ po.csd }}</span>
                        </th>
                        <th @click="view_po(po)" width="10%">{{ po.mode_desc }}</th>
                        <th @click="view_po(po)" width="37%">{{ po.supplier_name }}</th>
                        <th width="10%">
                            <button type="button" class="btn btn-sm btn-success" v-if="po.csid == 9" @click="accounting_rcv(po.purchase_order_id)">
                                <i class="fas fa-file-download"></i> Received
                            </button>
                            <!-- <button type="button" class="btn btn-sm btn-danger" v-if="po.csid == 10" @click="accounting_rls(po.purchase_order_id)">
                                <i class="fas fa-file-upload"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-primary" v-if="po.csid == 10" @click="na_modal(po)">
                                print   
                            </button> -->
                            <div class="btn-group" role="group" v-if="po.csid == 10">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span>Action</span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <button v-if="!po.noa_id" class="dropdown-item" @click="na_modal(po)">
                                        <span>Notice of Adjustment</span>
                                    </button>
                                    <router-link v-else class="dropdown-item" :to="{ name: 'na', params: { id: po.purchase_order_id }}">
                                        <span>Notice of Adjustment</span>
                                    </router-link>
                                    <!-- <button class="dropdown-item" v-show="po.csid == 10" @click="accounting_rls(po.purchase_order_id)">
                                        <span>Released to FMO</span>
                                    </button> -->
                                    <button class="dropdown-item" @click="release_modal(po)">
                                        <span>Release</span>
                                    </button>
                                </div>
                            </div>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <div class="modal fade" id="poModal" tabindex="-1" role="dialog" aria-labelledby="poModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            PO #: <span v-if="view_po_form.po_id"> {{ view_po_form.po_id}}</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive-sm">
                                <table class="table table-sm table-hover" id="po_table">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="5%">#</th>
                                            <th width="17%" class="text-center">Stock No</th>
                                            <th width="35%">Description</th>
                                            <th width="7%">SSL</th>
                                            <th width="7%">BOH</th>
                                            <!-- <th>Item In Transit</th> -->
                                            <th width="7%">Quantity</th>
                                            <th width="10%">Unit Cost</th>
                                            <th width="12%">Estimated Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody id="po_tbody">
                                        <tr v-for="(dmd,index) in view_po_form.dmd_purchase_orders" :key="dmd.dmd_id">
                                            <td width="5%">{{ index + 1}}</td>
                                            <td width="17%" class="text-center">
                                                <span v-if="dmd.code">{{ dmd.code }}</span>
                                                <span v-else>
                                                    <button class="btn btn-sm btn-primary" type="button" @click="add_stock_code(dmd)">add stock no</button>
                                                </span>
                                            </td>
                                            <td width="35%">
                                                <tr><td colspan="2"><span>{{ dmd.dmddesc }}</span></td></tr>
                                                <tr>
                                                    <td class="text-bold" width="30%">Brand:</td>
                                                    <td width="auto">{{ dmd.brand_desc }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold" width="30%">Manufacturer:</td>
                                                    <td width="auto">{{ dmd.manufacturer_desc }}</td>
                                                    </tr>
                                                <tr>
                                                    <td class="text-bold" width="30%">Supplier:</td>
                                                    <td width="auto">{{ dmd.supplier_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold" width="30%">Packaging:</td>
                                                    <td width="auto">{{ dmd.packaging_desc }}</td>
                                                </tr>
                                            </td>
                                            <td class="text-right" width="7%">{{ dmd.ssl | numeral3 }}</td>
                                            <td class="text-right" width="7%">{{ dmd.boh | numeral3 }}</td>
                                            <!-- <td class="text-right table-danger"></td> -->
                                            <td width="7%" class="text-right">{{ dmd.order_quantity | numeral3 }}</td>
                                            <td class="text-right" width="10%"><span>{{ dmd.cost_price | currency2 }}</span></td>
                                            <td class="text-right" width="12%"><span>{{ dmd.order_quantity * dmd.cost_price | currency2}}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div>
                                                <span class="text-bold">Place of Delivery: </span>BGHMC
                                            </div>
                                            <div>
                                                <span class="text-bold">Payment Term: </span>{{ view_po_form.payment_term_desc }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div>
                                                        <span class="text-bold">Serial No: </span>    
                                                        <div class="w-100"></div>
                                                        {{ view_po_form.obrs_no }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4 text-right">
                                    <button class="btn btn-sm btn-primary" type="button" @click="edit_dod()">Edit</button>
                                </div> -->
                            </div>
                        </div>
                        <div class="modal-footer" >
                            <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- col-md-12 poModal -->
        <div class="col-md-12">
            <div class="modal fade" id="naModal" tabindex="-1" role="dialog" aria-labelledby="naModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            PO #: <span v-if="view_po_form.po_id"> {{ view_po_form.po_id}}</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form  @submit.prevent="store_na()">
                            <div class="modal-body">
                                <div class="col-md-12 text-center">
                                    <h4>
                                        <span>Notice of Adjustment</span>
                                    </h4>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck9" v-model="na_form.ors">
                                                <label class="custom-control-label" for="customCheck9">OBLIGATION REQUEST AND STATUS</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck8" v-model="na_form.burs">
                                                <label class="custom-control-label" for="customCheck8">BUDGET UTILIZATION REQUEST AND STATUS</label>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="form-group row">
                                            <div class="col-md-5">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck1" v-model="na_form.adjust_ors_burs_no">
                                                    <label class="custom-control-label" for="customCheck1">ORS / BURS No:</label>
                                                </div>
                                            </div>
                                            <div class="col-md-7 text-center">
                                                <span>{{ view_po_form.obrs_no }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-5">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck2" v-model="na_form.resp_center_to_check">
                                                    <label class="custom-control-label" for="customCheck2">Responsibility Center to</label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control form-control-sm" v-model="na_form.resp_center_to" :disabled="!na_form.resp_center_to_check">
                                            </div>
                                            
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-5">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck3" v-model="na_form.particulars_to_check">
                                                    <label class="custom-control-label" for="customCheck3">Particulars to</label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control form-control-sm" v-model="na_form.particulars_to" :disabled="!na_form.particulars_to_check">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-5">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck4" v-model="na_form.mfo_pap_to_check">
                                                    <label class="custom-control-label" for="customCheck4">MFO/PAP to</label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control form-control-sm" v-model="na_form.mfo_pap_to" :disabled="!na_form.mfo_pap_to_check">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-5">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck5" v-model="na_form.account_code_to_check">
                                                    <label class="custom-control-label" for="customCheck5">Account Code to</label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control form-control-sm" v-model="na_form.account_code_to" :disabled="!na_form.account_code_to_check">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-5">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck6" v-model="na_form.amount_to_p">
                                                    <label class="custom-control-label" for="customCheck6">Amount to P</label>
                                                </div>
                                            </div>
                                            <div class="col-md-7 text-right">
                                                <span>{{ view_po_form.total_amount | currency }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-5">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck7" v-model="na_form.adjust_raod_check">
                                                    <label class="custom-control-label" for="customCheck7">RAOD/RBUD for excess/ under obligation per attached JEV No dated</label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control form-control-sm" v-model="na_form.adjust_raod" :disabled="!na_form.adjust_raod_check">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-5 text-center">
                                                <label class="form-label">Remarks</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control form-control-sm" v-model="na_form.remarks">
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="modal-footer" >
                                <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" aria-label="Close">Close</button>
                                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- col-md-12 returnModal -->
        <div class="col-md-12">
            <div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="stockModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span>Stock No Modal</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form  @submit.prevent="store_stock_code()">
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="" class="label form-label">
                                        Description:
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <span>{{ stock_code_form.dmddesc }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="" class="label form-label">
                                        Brand:
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <span>{{ stock_code_form.brand_desc }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="" class="label form-label" >
                                        UACS CODE:
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-control-sm" v-model="stock_code_form.code">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" >
                            <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" aria-label="Close">Close</button>
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- col-md-12 stockModal -->
        <div class="col-md-12">
            <div class="modal fade" id="releaseModal" tabindex="-1" role="dialog" aria-labelledby="releaseModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span>Release or Return</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form  @submit.prevent="release()">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-md-3">Office:</div>
                                    <div class="col-md-9">
                                        <select class="form-control form-control-sm" v-model="release_form.cs_id">
                                            <option value="18">Pharmacy</option>
                                            <option value="19">CMPS</option>
                                            <option value="20">PMO</option>
                                            <option value="21">Budget</option>
                                            <option value="13">FMO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        Remarks:
                                    </div>
                                    <div class="col-md-9">
                                        <textarea class="form-control form-control-sm" v-model="release_form.remarks"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" >
                                <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" aria-label="Close">Close</button>
                                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- col-md-12 releaseModal -->
        <div class="col-md-12">
            <div class="modal fade" id="viewTrack" tabindex="-1" role="dialog" aria-labelledby="viewTrackLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5  class="modal-title text-bold" id="viewTrackLabel">PO # {{ po_id }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Status</th>
                                                <th>Date/Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(tr, index) in track" :key="index">
                                                <td>{{ tr.status_desc }}</td>
                                                <td>{{ tr.date_time | myDate4 }} - {{ tr.date_time | myDate5 }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- col-md-12 viewTrack -->
    </div>
</template>
<script>
export default {
    data(){
        return{
            pos: [],
            search_form: new Form({
                word: '',
            }),
            view_po_form: new Form({
                payment_term_id: '',
                place_of_delivery: '',
                purchase_order_id: '',
                purchase_request_id: '',
                payment_term_desc: '',
                po_id: '',
                uacs_code_id: '',
                uacs: '',
                allotment_id: '',
                allotment: '',
                uacs_id: '',
                fund_source_id: '',
                fund_source: '',
                date_of_delivery: '',
                delivery_term: '',
                dmd_purchase_orders: [],
                last_status: {},
                dod: '',
                obrs_no: '',
                total_amount: '',
                noa_id: '',
            }),
            na_form: new Form({
                purchase_order_id: '',
                ors: false,
                burs: false,
                amount_to_p: false,
                adjust_ors_burs_no: false,
                resp_center_to_check: false,
                particulars_to_check: false,
                mfo_pap_to_check: false,
                account_code_to_check: false,
                adjust_raod_check: false,
                resp_center_to: '',
                particulars_to: '',
                mfo_pap_to: '',
                account_code_to: '',
                adjust_raod: '',
                remarks: '',
            }),
            track_po_modal: {},
            stock_code_form: new Form({
                brand_id: '',
                dmd_id: '',
                dmddesc: '',
                brand_desc: '',
                code: '',
            }),
            release_form: new Form({
                po_id: '',
                purchase_order_id: '',
                cs_id: '',
                remarks: '',
            }),
            track: {},
            po_id: '',
        }
    },
    methods:{
        release_modal(po){
            this.release_form.po_id = po.po_id;
            this.release_form.purchase_order_id = po.purchase_order_id;
            $('#releaseModal').modal('show');
        },
        release(){
            this.release_form.post('../../api/release').then(({data}) => {

                $('#releaseModal').modal('hide');
                toast.fire({
                    type: 'success',
                    title: data
                });
            }).catch(() => {

            });
        },
        get_pos(){
            axios.get('../../api/for_accounting').then(({data}) => {
                this.pos = data;
            }).catch(() => {

            });
        },
        search(){
            this.search_form.post('../../api/search_po').then(({data}) => {
                this.pos = data;
            }).catch(() => {

            });
        },
        view_po(po){
            this.view_po_form.reset();
            this.view_po_form.fill(po);
            axios.get('../../api/purchase_order/'+po.purchase_order_id).then(({data}) => {
                    this.view_po_form.dmd_purchase_orders = data;
                }).catch(() => {

                });
            $('#poModal').modal('show');
        },
        track_po(pos){
            this.track_po_modal = pos;
            $('#trackModal').modal('show');
        },
        na_modal(po){
            this.view_po_form.fill(po);
            this.na_form.purchase_order_id = po.purchase_order_id;
            $('#naModal').modal('show')
        },
        store_na(){
            this.na_form.post("../../api/notice_of_adjustment").then(() => {
                this.na_form.reset();
                $('#naModal').modal('hide')
            }).catch(() => {

            });
        },
        accounting_rcv(id){
            axios.put('../../api/accounting_rcv/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Received'
                });
            }).catch(() => {

            });
        },
        accounting_rls(id){
            axios.put('../../api/accounting_rls/'+id).then(() => {
                toast.fire({
                    type: 'success',
                    title: 'PO Release'
                });
            }).catch(() => {

            });
        },
        add_stock_code(dmd){
            this.stock_code_form.fill(dmd);
            $('#stockModal').modal('show');
        },
        store_stock_code(){
            this.stock_code_form.post('../../api/dmd_uacs').then(() => {
                $('#stockModal').modal('hide');
                axios.get('../../api/purchase_order/'+view_po_form.purchase_order_id).then(({data}) => {
                    this.view_po_form.dmd_purchase_orders = data;
                    
                }).catch(() => {

                });
                
            }).catch(() => {

            });
        },
        view_track(po){
            this.po_id = po.po_id;
            axios.get('../../api/purchase_request_track/'+po.purchase_request_id).then(({data}) => {
                this.track = data;
                $('#viewTrack').modal('show');
            }).catch(() => {

            });
        }
    },
    created(){
        this.get_pos();
    },
    computed:{
        current_user() {
            return this.$store.getters.current_user;
        }
    },
    mounted(){
        window.Echo.channel("po_created").listen(".purchase_order.created", (e) => {
            this.get_pos();
        });
        window.Echo.channel("po_updated").listen(".purchase_order.updated", (e) => {
            this.get_pos();
        });
    },
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
    .nav-tabs .nav-link.active{
        color: white;
        background-color: #4a5ea5fa;
        
    }
    ul{
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0;
    }
    ul li{
        width: 50% !important;
        
    }
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

    #po_table{
        height: 20rem;             
        display: -moz-groupbox; 
    }

    #po_tbody{
        overflow-y: scroll;      
        height: 18rem;           
        width: 98.5%;
        position: absolute;
    }
</style>
