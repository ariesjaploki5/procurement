<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row shadow mb-1 bg-white rounded">
                <h6><i class="fas fa-capsules"></i> Drugs and Medicines</h6>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control form-control-sm">
                </div>
                <div class="col-md-auto">
                    <button type="button" class="btn btn-sm btn-primary" @click="search()">Search</button>
                </div>
                <div class="col-md-12 mt-2">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="35%">Description</th>
                                <th width="5%">Unit</th>
                                <th width="25%">Stock No</th>
                                <th width="15%">Brand</th>
                                <th width="10%">Quantity</th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(dmd, index) in dmds" :key="dmd.du_id">
                                <td width="5%" class="text-right">{{ index + 1 }}</td>
                                <td width="35%">{{ dmd.dmddesc }}</td>
                                <td width="5%"></td>
                                <td width="25%">10402030-00-{{ dmd.code }}</td>
                                <td width="15%">{{ dmd.brand_desc }}</td>
                                <td width="10%">{{ dmd.stock }}</td>
                                <td width="10%">
                                    <button type="button" class="btn btn-sm btn-success" @click="edit_mmo_stock(dmd)"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-primary"><i class="fas fa-dolly-flatbed"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="stockModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                   <h5> {{ form.dmddesc }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div> 
                                <form action="" @submit.prevent="submit_beg_bal()">
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="" class="form-label">
                                                    Stock No:
                                                </label>
                                            </div>
                                            <div class="col-md-8">
                                                10402030-00-{{ form.code }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="" class="form-label">Stock Quantity:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control form-control-sm text-right" v-model="form.stock_quantity">
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
                du_id: '',
                dmddesc: '',
                code: '',
                stock_quantity: '',
            }),
        }
    },
    methods:{
        search(){

        },
        get_dmds(){
            axios.get('../../api/dmd_uacs').then(({data}) => {
                this.dmds = data;

            }).catch(() => {

            });
        },
        edit_mmo_stock(dmd){
            this.form.fill(dmd);
            $('#stockModal').modal('show');
        },
        submit_beg_bal(){
            axios.post('../../api/beg_bal',{
                dmdcomb: this.form.dmdcomb,
                dmdctr: this.form.dmdctr,
                stock: this.form.stock,
            }).then(() => {
                this.get_dmds();
                $('#stockModal').modal('hide');
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
