<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row shadow mb-1 bg-white rounded">
                <h6><i class="fas fa-capsules"></i> Drugs and Medicines</h6>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-sm">
                </div>
                <div class="col-md-auto">
                    <button type="button" class="btn btn-sm btn-primary" @click="search()">Search</button>
                </div>
                <div class="col-md-12">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="35%">Item Description</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(dmd, index) in dmds" :key="dmd.dmd_id">
                                <td width="5%">{{ index++ }}</td>
                                <td width="35%">{{ dmd.dmddesc }}</td>
                                <td>{{ dmd.stock }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success" @click="edit_mmo_stock(dmd)"><i class="fas fa-edit"></i></button>
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
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Stock</label>
                                                    <input type="number" class="form-control form-control-sm" v-model="form.stock">
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
                dmddesc: '',
                dmdctr: '',
                dmdcomb: '',
                stock: '',
            }),
        }
    },
    methods:{
        search(){

        },
        get_dmds(){
            axios.get('../../api/for_mmo').then(({data}) => {
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
