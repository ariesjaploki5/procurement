<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row mb-1">
                <div class="col-md-6">
                    Drugs And Medicines
                </div>
            </div>
            <form @submit.prevent="search()">
                <div class="row mb-1">
                    <div class="col-md-4">
                        <input type="text" class="form-control form-control-sm" v-model="search_form.word">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-sm btn-primary">Search</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th width="3%">#</th>
                                <th width="57%">Description</th>
                                <th width="30%">Unit</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(dmd, index) in dmds" :key="index">
                                <td width="3%" class="text-right">{{ index + 1 }}</td>
                                <td width="57%">{{ dmd.dmddesc }}</td>
                                <td width="30%">{{ dmd.unit_desc }}</td>
                                <td width="10%">
                                    <button class="btn btn-sm btn-success" type="button" @click="edit(dmd)">Edit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="modal fade" id="unitModal" tabindex="-1" role="dialog" aria-labelledby="unitModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6  class="modal-title text-bold" id="unitModalLabel">Edit Unit</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="store()">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="" class="form-label">Description</label>
                                    </div>
                                    <div class="col-md-">
                                        {{ form.dmddesc }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label class="form-label">
                                            Unit:
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <select name="" id="" class="form-control form-control-sm" v-model="form.unit_id">
                                            <option v-for="unit in units" :key="unit.unit_id" :value="unit.unit_id">{{ unit.unit_desc }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-sm btn-success">Submit</button>
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
            dmds: {},
            form: new Form({
                dmd_id: '',
                dmddesc: '',
                unit_id: '',
            }),
            search_form: new Form({
                word: '',
            }),
        }
    },
    methods:{
        ...mapActions([
            'get_units'
        ]),
        get_dmds(){
            axios.get('../../api/dmd').then(({data}) => {
                this.dmds = data;
            }).catch(() => {

            });
        },
        search(){
            this.search_form.post('../../api/dmd_search').then(({data}) => {
                this.dmds = data;
            });
        },
        edit(dmd){
            this.form.fill(dmd);
            $('#unitModal').modal('show');
        },
        store(){
            this.form.post('../../api/dmd_unit').then(() => {
                $('#unitModal').modal('hide');
                this.get_dmds();
            });
        }
    },
    created(){
        this.get_dmds();
        this.get_units();
    },
    computed:{
        ...mapGetters([
            'units',
        ])
    },
}
</script>

<style scoped>

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
