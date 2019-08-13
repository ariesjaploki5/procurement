<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row mb-1 shadow p-3 mb-3 bg-white rounded">
                <h4><i class="fas fa-capsules"></i> Drugs and Medicines</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="35%">Item Description</th>
                                <th>Beginning Balance</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(dmd, index) in dmds" :key="dmd.dmd_id">
                                <td>{{ index++ }}</td>
                                <td width="35%">{{ dmd.gendesc }} {{ dmd.dmdnost }} {{ dmd.stredesc }} {{ dmd.formdesc }} {{ dmd.brandname }}</td>
                                <td>{{ dmd.begbal }}</td>
                                <td>{{ dmd.mmo_stock }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success" @click="edit_beg_bal(dmd)"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modal fade" id="begbalModal" tabindex="-1" role="dialog" aria-labelledby="begbalModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                   <h5> {{ form.gendesc }} {{ form.dmdnost }} {{ form.stredesc }} {{ form.formdesc }} {{ form.brandname }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div> 
                                <form action="" @submit.prevent="submit_beg_bal()">
                                    <div class="modal-body">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Beginning Balance</label>
                                                    <input type="number" class="form-control form-control-sm" v-model="form.begbal">
                                                </div>
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
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            dmds: {},
            form: new Form({
                gendesc: '',
                formdesc: '',
                stredesc: '',
                dmdnost: '',
                brandname: '',
                dmdctr: '',
                dmdcomb: '',
                begbal: '',
            }),
        }
    },
    methods:{
        get_dmds(){
            axios.get('../../api/for_mmo').then(({data}) => {
                this.dmds = data;

            }).catch(() => {

            });
        },
        edit_beg_bal(dmd){
            this.form.fill(dmd);
            $('#begbalModal').modal('show');
        },
        submit_beg_bal(){
            axios.post('../../api/beg_bal',{
                dmdcomb: this.form.dmdcomb,
                dmdctr: this.form.dmdctr,
                begbal: this.form.begbal,
            }).then(() => {
                this.get_dmds();
                $('#begbalModal').modal('hide');
            }).catch(() => {

            });
        }
    },
    created(){
        this.get_dmds();
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
