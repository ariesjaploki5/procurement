<template>
    <div class="row">
        <div class="col-md-12">
            <div>
                <h3>Consignment Purchase Request</h3>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="20%">crID</th>
                        <th width="60%">Purpose</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="cpr in cprs" :key="cpr.crID">
                        <td width="20%">{{ cpr.crID }}</td>
                        <td width="60%">{{ cpr.purpose }}</td>
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
                                <div class="form-group">
                                    <label class="form-label">Purpose: </label>
                                    <span>{{ cpr.purpose }}</span>
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
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            cprs: {},
            cpr: '',
        }
    },
    methods:{
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
