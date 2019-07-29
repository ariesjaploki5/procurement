<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row mb-1 shadow p-3 mb-3 bg-white rounded">
                <h4>
                    <i class="fas fa-book"></i> Consignment Purchase Request
                </h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-auto font-weight-bold">Patient Name:</div>
                        <div class="col-md-4">
                            <input type="text" class="form-control form-control-sm" v-model="search_word">
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th width="20%">crID</th>
                        <th width="20%">Patient Name</th>
                        <th width="20%">Hospital Number<th>
                        <th width="20%">Purpose</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="cpr in filteredPat" :key="cpr.crID">
                        <td width="20%">{{ cpr.crID }}</td>
                        <td width="20%">{{ cpr.fullname }}</td>
                        <td width="20%">{{ cpr.hpercode }}</td>
                        <td width="20%">{{ cpr.purpose }}</td>
                        <td width="20%">
                            <button type="button" class="btn btn-sm btn-primary" @click="view_cpr(cpr.crID)">
                                View <i class="fas fa-eye"></i>
                            </button>
                            <router-link class="btn btn-sm btn-success" :to="{ name: 'cpr', params: { id: cpr.crID }}">
                                <i class="fas fa-print"></i> Print View
                            </router-link>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="modal fade" id="cprModal" tabindex="-1" role="dialog" aria-labelledby="cprModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{ cpr.crID }}
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive-sm">
                                <table class="table table-sm table-hover" style="height:26rem; display: -moz-groupbox;    ">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="40%">Item Description</th>
                                            <th width="10%" class="text-center">Price</th>
                                            <th width="10%" class="text-center">Quantity</th>
                                            <th width="10%" class="text-center">Estimated Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody style="overflow-y: scroll; height: 24rem; width: 98.5%;position: absolute;">
                                        <tr v-for="(md, index) in cpr.details" :key="md.id">
                                            <td width="5%">{{ index+1 }}</td>
                                            <td width="40%">{{ md.mds_consignment.cl1desc }}{{ md.mds_consignment.cl2desc }}</td>
                                            <td width="10%" class="text-right">{{ md.itemPrice | currency2}}</td>
                                            <td width="10%" class="text-right">
                                               <span v-if="md.itemQty">{{ md.itemQty }}</span>
                                               <span v-else></span>
                                            </td>
                                            <td width="10%" class="text-right">
                                                <span v-if="md.itemQty">{{ md.itemPrice * md.itemQty | currency2}}</span>
                                                <span v-else></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="">
                                            Hospital Number: {{ cpr.hpercode }}
                                        </label>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="button" @click="search_modal()" class="btn btn-sm btn-primary">
                                            <span v-if="cpr.hpercode">Change Patient</span>
                                            <span v-else>Search Patient</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="">Patient Name: {{ cpr.hperson.fullname }}</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label class="form-label">Purpose: </label>
                                        <span>{{ cpr.purpose }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success btn-sm" @click="store_cpo()">
                                Purchase Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content" id="d_modal_content">
                        <div class="modal-header">
                            Search Patient
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
                                        <button class="btn btn-primary btn-sm mb-1 float-right" @click="search_patient()"><i class="fas fa-search mr-2"></i>Search</button>
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
                                        <table class="table table-sm table-hover mt-1" style="height:8rem; display: -moz-groupbox;">
                                            <thead>
                                                <tr>
                                                    <th>Date/Time</th>
                                                    <th>Type</th>
                                                    <th>Final Diagnosis</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody style="overflow-y: scroll; height: 7rem; width: 98.5%;position: absolute;">
                                                <tr v-for="enc in enccode" :key="enc.enccode" @click="select_enccode(enc.enccode)">
                                                    <td class="font-weight-bold">{{ enc.admdate | myDate3 }}</td>
                                                    <td class="font-weight-bold">{{ enc.toecode }}</td>
                                                    <td></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-success" @click="select_enccode_2(enc.enccode)">
                                                            Submit
                                                        </button>
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
                                            <button class="btn btn-sm btn-success" @click="select_patient_2(patient)">
                                                <i class="fas fa-check-circle mr-2"></i> Select
                                            </button>
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
    </div>
</template>

<script>
export default {
    data(){
        return{
            cprs: [],
            cpr: {
                id: '',
                details: [],
                hperson: {},
                hpercode: '',
                crDate: '',
                crDept: '',
                crSection: '',
                crStat: '',
                crID: '',
                enccode: '',
                entryby: '',
                purpose: '',
                tCreated: '',
                tUpdated: '',
                fullname: '',
            },
            search_word: '',
            search_form:new Form({
                hospnumber: '',
                patlast: '',
                patfirst: '',
                patmiddle: '',
            }),
            form: new Form({
                purpose: '',
                items: {},
                enccode: '',
                hpercode: '',
            }),
            patients: [],
            selected_patient: null,
            enccode: '',
        }
    },
    methods:{
        select_patient(patient){
            this.selected_patient = patient;
            this.cpr.hpercode = patient.hpercode;
            this.get_enccode();
        },
        select_patient_2(patient){
            this.selected_patient = patient;
            this.cpr.hpercode = patient.hpercode;
            this.change_patient();

            
            $('#cprModal').modal('hide');
        },
        change_patient(){
            axios.put('../../api/change_patient/'+this.cpr.id+'/'+this.selected_patient.hpercode).then(() => {
                    toast.fire({
                    type: 'success',
                    title: 'Patient Changed',
                });
                $('#searchModal').modal('hide');
            }).catch(() => {

            });
            this.get_cprs();
        },
        select_enccode(enccode){
            this.cpr.enccode = enccode;
            $('#searchModal').modal('hide');
            this.patients = null;
        },
        select_enccode_2(enccode){
            this.cpr.enccode = enccode;
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
        get_cprs(){
            axios.get('../../api/cprs').then(({data}) => {
                this.cprs = data;
            }).catch(() => {

            });
        },
        view_cpr(crID){
            axios.get('../../../api/cpr/'+crID).then(({data}) => {
                this.cpr = data;
                $('#cprModal').modal('show');
            }).catch(() => {

            });
        },
    },
    created(){
        this.get_cprs();
    },
    computed:{
        filteredPat: function(){
            let matcher = new RegExp(this.search_word, 'i')
            return this.cprs.filter(function(cpr){
                return matcher.test(cpr.fullname);
            });
        },
    },
}
</script>

<style scoped>
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
        height:37rem;             
        display: -moz-groupbox;    
    }
    tbody {
        overflow-y: scroll;      
        height: 35rem;           
        width: 98.5%;
        position: absolute;
    }
</style>
