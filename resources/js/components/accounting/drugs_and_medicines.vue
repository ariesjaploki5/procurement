<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row mb-2 bg-white rounded">
                <div class="col-md-5">
                    <h6> <i class="fas fa-capsules"></i> Drugs And Medicines</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form @submit.prevent="search()">
                        <div class="form-group row">
                            <div class="col-md-3">
                                <input type="text" class="form-control form-control-sm" v-model="search_form.word">
                            </div>
                            <div class="col-md-auto">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="30%">Description</th>
                                <th id="uacs_1">
                                    <div id="uacs_2">
                                        <div id="brand">Brand Name</div>
                                        <div id="code">Uacs Code</div>
                                        <div id="action"></div>
                                    </div>
                                </th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(d, index) in dmds" :key="d.dmd_id">
                                <td width="5%">{{ index + 1}}</td>
                                <td width="30%">{{ d.dmddesc }}</td>
                                <td id="uacs_1">
                                    <div id="uacs_2" v-for="uc in d.dmd_uacs" :key="uc.dmd_uacs_id">
                                        <div id="brand">{{ uc.brand_desc }}</div>
                                        <div id="code">10402030-00-{{ uc.code }}</div>
                                        <div id="action"><button type="button" class="btn btn-success btn-sm" @click="edit_uacs(uc, d.dmddesc)">Edit</button></div>
                                    </div>
                                </td>
                                <td width="5%">
                                    <button type="button" class="btn btn-primary btn-sm" @click="create_uacs(d)">Add</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="uacsModal" tabindex="-1" role="dialog" aria-labelledby="uacsModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editmode" class="modal-title">New Uacs Code</h5>
                            <h5 v-show="editmode" class="modal-title">Update Uacs Code</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="editmode ? update_uacs() : store_uacs()">
                                <div class="form-group">
                                    <h4><label class="form-label">{{ form.dmddesc }}</label></h4>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">UACS CODE</label>
                                    <input type="text" class="form-control form-control-sm" v-model="form.code">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Brand</label>
                                    <select class="form-control form-control-sm" v-model="form.brand_id">
                                        <option v-for="b in brands" :key="b.brand_id" :value="b.brand_id">{{ b.brand_desc }}</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
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
                dmds: {},
                editmode: false,
                form: new Form({
                    dmd_uacs_id: '',
                    code: '',
                    dmd_id: '',
                    brand_id: '',
                    dmddesc: '',
                }),
                search_form: new Form({
                    word: '',
                }),
                
            }
        },
        methods:{
            ...mapActions([
                'get_brands',
            ]),
            get_dmds(){
                axios.get('../../api/dmd_uacs_2').then(({data}) => {
                    this.dmds = data;
                }).catch(() => {

                });
            },
            create_uacs(d){
                this.editmode = false;
                this.form.fill(d);
                $('#uacsModal').modal('show');
            },
            store_uacs(){
                this.editmode = false;
                this.form.post('../../api/dmd_uacs').then(() => {
                    $('#uacsModal').modal('hide');
                    this.get_dmds();
                }).catch(() => {

                });
            },
            edit_uacs(d, dmddesc){
                this.editmode = true;
                this.form.fill(d);
                this.form.dmddesc = dmddesc;
                $('#uacsModal').modal('show');
            },
            update_uacs(){
                this.form.put('../../api/dmd_uacs/'+this.form.dmd_uacs_id).then(() => {
                    $('#uacsModal').modal('hide');
                    this.get_dmds();
                }).catch(() => {

                });
            },
            search(){
                this.search_form.post('../../api/search_dmd_uacs').then(({data}) => {
                    this.dmds = data;
                }).catch(() => {

                });
            }
            
        },
        created(){
            this.get_dmds();
            this.get_brands();
        },
        computed:{
            ...mapGetters([
            'brands'
        ]),
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
#uacs_1{
    width: 40%;
    font-size: 12px;
    font-weight: 700;
}
#uacs_2{
    display: flex;
    flex-wrap: wrap;
    width: 100%;
}
#brand{
    position: relative;
    width: 60% !important;
}
#code{
    position: relative;
    width: 30% !important;
}
#action{
    position: relative;
    width: 10% !important;
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
