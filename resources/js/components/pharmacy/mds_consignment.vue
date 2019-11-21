<template>
    <div class="row">
        <div class="col-md-12 mt-0 ">
            <div class="row mb-1 shadow p-3 mb-3 bg-white rounded">
                <h4><i class="fas fa-medkit"></i> Medical Supply Consignment</h4> 
            </div>
            <div class="row mb-2">
                <div class="col-auto font-weight-bold"> Search:</div> 
                <div class="col-6"><input type="text" class="form-control form-control-sm" v-model="search_word"></div>
                <div class="col-5 text-right">
                    <button type="button" class="btn btn-sm btn-success" :disabled="!form.items.length" @click="cart()"><i class="fas fa-shopping-cart"></i> PR <span class="badge badge-light">{{ cart_item }}</span></button>
                </div>
            </div>
            <table class="table table-hover table-sm" id="table_1">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Item Description</th>
                        <th>Cost Price</th>
                        <th>Retail Price</th>
                        <th width="5%"></th>
                    </tr>
                </thead>
                <tbody id="table_1">
                    <tr v-for="(md, index) in filteredMds" :key="md.id" id="table_1">
                        <td width="5%">{{ index+1 }}</td>
                        <td  class="table-bordered">{{ md.cl1desc }} {{ md.cl2desc }}</td>
                        <td>{{ md.costprc | currency2 }}</td>
                        <td>{{ md.cl2retprc | currency2 }}</td>
                        <td width="5%">
                            <button type="button" class="btn btn-sm btn-primary" @click="add_to_cart(md)">
                                <i class="fas fa-cart-plus"></i> 
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content" id="d_modal_content">
                    <div class="modal-header">
                        Consignment Request
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="pr_submit()">
                        <div class="modal-body">
                            <table class="table table-sm table-hover" style="height:13rem; display: -moz-groupbox;    ">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="40%">Item Description</th>
                                        <th width="10%" class="text-center">Price</th>
                                        <th width="10%" class="text-center">Quantity</th>
                                        <th width="10%" class="text-center">Estimated Cost</th>
                                    </tr>
                                </thead>
                                <tbody style="overflow-y: scroll; height: 12rem; width: 98.5%;position: absolute;">
                                    <tr v-for="(md, index) in form.items" :key="md.id">
                                        <td width="5%">{{ index+1 }}</td>
                                        <td width="40%">{{ md.cl1desc }}{{ md.cl2desc }}</td>
                                        <td width="10%" class="text-right">{{ md.cl2retprc | currency2}}</td>
                                        <td width="10%" class="text-right">
                                            <input type="number" class="form-control form-control-sm text-right" v-model="md.itemQty" required>
                                        </td>
                                        <td width="10%" class="text-right">
                                            <span v-if="md.itemQty">{{ md.cl2retprc * md.itemQty | currency2}}</span>
                                            <span v-else></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="">Hospital Number: {{ form.hpercode }}</label>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" @click="search_modal()" class="btn btn-sm btn-primary">
                                        <span v-if="form.hpercode">Change</span>
                                        <span v-else>Search Patient</span>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Purpose: </label>
                                <textarea type="text" class="form-control form-control-sm" rows="2" v-model="form.purpose" :disabled="!form.hpercode" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-sm btn-success" :disabled='!form.hpercode && !form.purpose'>Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content" id="d_modal_content">
                    <div class="modal-header">
                        Modal Title
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                <div class="col-md-12 bg-secondary">
                                    <span>Search Patient</span>
                                </div>
                                <div class="form-group row mt-1">
                                    <div class="col-3"><label for="" class="form-label">HOSP NUMBER</label></div>
                                    <div class="col"><input type="text" class="form-control form-control-sm" v-model="search_form.hospnumber"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-3"><label for="" class="form-label">LAST NAME</label></div>
                                    <div class="col"><input type="text" class="form-control form-control-sm" v-model="search_form.patlast"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-3"><label for="" class="form-label">FIRST NAME</label></div>
                                    <div class="col"><input type="text" class="form-control form-control-sm" v-model="search_form.patfirst"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-3"><label for="" class="form-label">MIDDLE NAME</label></div>
                                    <div class="col"><input type="text" class="form-control form-control-sm" v-model="search_form.patmiddle"></div>
                                    
                                </div>
                                    <button class="btn btn-primary btn-sm mb-1" @click="search_patient()">Search</button>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12 bg-secondary">
                                        <span>Patient History</span>
                                    </div>
                                    <div class="col-md-6">
                                        Hospital No: <span v-if="selected_patient" class="font-weight-bold">{{ selected_patient.hpercode }}</span>
                                    </div>
                                    <div class="col-md-6">
                                        Date of Birth: <span v-if="selected_patient" class="font-weight-bold">{{ selected_patient.patbdate | myDate3}}</span>
                                    </div>
                                    <div class="col-md-6">
                                        Name: <span v-if="selected_patient" class="font-weight-bold">{{ selected_patient.patlast }}, {{ selected_patient.patfirst }} {{ selected_patient.patmiddle }}</span>
                                    </div>
                                    <table class="table table-sm table-hover mt-1" style="height:6rem; display: -moz-groupbox;">
                                        <thead>
                                            <tr>
                                                <th>Date/Time</th>
                                                <th>Type</th>
                                                <th>Final Diagnosis</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody style="overflow-y: scroll; height: 5rem; width: 98.5%;position: absolute;">
                                            <tr v-for="enc in enccode" :key="enc.enccode" @click="select_enccode(enc.enccode)">
                                                <td class="font-weight-bold">{{ enc.admdate | myDate3 }}</td>
                                                <td class="font-weight-bold">{{ enc.toecode }}</td>
                                                <td></td>
                                                <td>
                                                    <button class="btn btn-sm btn-success" @click="select_enccode_2(enc.enccode)">Submit</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <table class="table table-sm table-hover mt-1" style="height:12rem; display: -moz-groupbox;">
                            <thead>
                                <tr>
                                    <th>Hosp #</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Birthdate</th>
                                    <th>Birth Place</th>
                                    <th>Sex</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody style="height: 10rem; width: 98.5%;position: absolute;">
                                <tr v-for="patient in patients" :key="patient.hpercode" @click="select_patient(patient)">
                                    <td>{{ patient.hpercode }}</td>
                                    <td>{{ patient.patlast }} </td> 
                                    <td>{{ patient.patfirst }}</td> 
                                    <td>{{ patient.patmiddle }}</td> 
                                    <td>{{ patient.patbdate | myDate3 }}</td> 
                                    <td>{{ patient.patbplace}}</td> 
                                    <td>{{ patient.patsex }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-success" @click="select_patient_2(patient)">Submit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">

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
            mds: [],
            search_word: '',
            form: new Form({
                purpose: '',
                items: {},
                enccode: '',
                hpercode: '',
            }),

            search_form:new Form({
                hospnumber: '',
                patlast: '',
                patfirst: '',
                patmiddle: '',
            }),

            patients: [],
            selected_patient: null,
            enccode: '',
        }
    },
    methods:{
        select_patient(patient){
            this.selected_patient = patient;
            this.form.hpercode = patient.hpercode;
            this.get_enccode();
        },
        select_patient_2(patient){
            this.selected_patient = patient;
            this.form.hpercode = patient.hpercode;
            $('#searchModal').modal('hide');
        },
        select_enccode(enccode){
            this.form.enccode = enccode;
            $('#searchModal').modal('hide');
            this.patients = null;
        },
        select_enccode_2(enccode){
            this.form.enccode = enccode;
            $('#searchModal').modal('hide');
            this.patients = null;
        },
        get_enccode(){
            axios.post('../../api/select_enccode',{
                hospnumber: this.selected_patient.hpercode,
            }).then(({data}) => {
                this.enccode = data;
            }).catch(() => {

            });
        },
        search_patient(){

        },
        search_patient(){
            axios.post('../../api/search_patient', {
                hospnumber: this.search_form.hospnumber,
                patlast: this.search_form.patlast,
                patfirst: this.search_form.patfirst,
                patmiddle: this.search_form.patmiddle,
                
            }).then(({data}) => {
                this.patients = data;
            }).catch(() => {

            });
        },
        search_modal(){
            $('#searchModal').modal('show');
        },
        cart(){
            $('#cartModal').modal('show');
        },
        get_mds(){
            axios.get('../../api/mds_consignment').then(({data}) => {
                this.mds = data;
            }).catch(() => {

            });
        },
        get_cart(){
            axios.get('../../api/mds_cart').then(({data}) => {
                this.form.items = data;
            }).catch(() => {

            });
        },
        add_to_cart(md){
            axios.get('../../api/add_to_mds_cart/'+md.cl2comb+'/'+md.costprc).then(() => {
                this.get_cart();
                this.item_added();
            }).catch(() => {

            });
        },
        
        pr_submit(){
            this.form.post('../../api/mds_c_pr_submit').then(({data}) => {
                $('#cartModal').modal('hide');
                this.get_cart();
                this.success_pr();
                this.$router.push({name: 'cpr', params: { id: data }});
            }).catch(() => {

            });
        },
        item_added(){
            toast.fire({
                type: 'success',
                title: 'Item added',
            });
        },
        success_pr(){
            toast.fire({
                type: 'success',
                title: 'Purchase Request Created Successfully',
            });

        },
    },
    created(){
        this.get_mds();
        this.get_cart();

    },
    computed:{
        filteredMds(){
            let matcher = new RegExp(this.search_word, 'i');
            return this.mds.filter(function(md){
                return matcher.test(md.cl1desc)
            });
        },
        cart_item: function(){
            let sum = 0;
            sum += (parseFloat(this.form.items.length));
            return sum;
        }

    }
}
</script>

<style scoped>
@media (min-width: 768px) {
        .modal-xl {
            width: 90%;
            max-width:1400px;
        }
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
 tr {
    width: 100%;
    display: inline-table;
    table-layout: fixed;
}
 table {
    height:30rem;             
    display: -moz-groupbox;    
}
 tbody {
    overflow-y: scroll;      
    height: 28rem;           
    width: 98.5%;
    position: absolute;
}


</style>
