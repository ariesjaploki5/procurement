<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Drugs And Medicine APP</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-auto text-right">
                            Search:
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control form-control-sm" v-model="search">
                        </div>
                    </div>
                    <div v-show="dmds.length">
                        
                        <table class="table table-sm table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="45%">Description</th>
                                    <th>Unit of Issue</th>
                                    <th>Quantity</th>
                                    <th>Mode of Procurement</th>
                                    <th>Budget</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(dmd, index) in filteredDmds" :key="dmd.dmd_id" id="app_data">
                                    <td width="5%">{{ index + 1}}</td>
                                    <td width="45%">{{ dmd.gendesc }} {{ dmd.dmdnost }} {{ dmd.stredesc }} {{ dmd.formdesc }} {{ dmd.brandname }}</td>
                                    <td class="text-center">{{ dmd.formdesc }}</td>
                                    <td class="text-right">{{ dmd.quantity }}</td>
                                    <td class="text-center">
                                        {{ dmd.mode_desc }}
                                    </td>
                                    <td class="text-right">
                                        {{ dmd.budget | currency2 }}
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary" @click="edit_app_dmd(dmd)">Edit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
            <div class="modal fade" id="appDmdModal" tabindex="-1" role="dialog" aria-labelledby="appDmdModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            
                            <h5 class="modal-title" id="appDmdModalLabel">{{ form.gendesc }} {{ form.dmdnost }} {{ form.stredesc }} {{ form.formdesc }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form  @submit.prevent="update_app_dmd()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="" class="form-label">Unit of Issue</label>
                                    <select class="form-control form-control-sm" v-model="form.unit_id">
                                        <option v-for="unit in units" :value="unit.unit_id" :key="unit.unit_id">{{ unit.unit_desc }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Budget</label>
                                    <input type="number" class="form-control form-control-sm text-right" v-model="form.budget" min="0" step="1">
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Quantity</label>
                                    <input type="number" class="form-control form-control-sm text-right" v-model="form.quantity" min="0" step="1">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success btn-sm">Save</button>
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
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
            editmode: false,
            form: new Form({
                gendesc: '',
                dmdnost: '',
                stredesc: '',
                formdesc: '',
                brandname: '',
                id: '',
                budget: '',
                mode_id: '',
                unit_id: '',
                quantity: '',
            }),
            dmds: [],
            search: '',
            mode_id: '',
            budget: '',
        }
    },
    methods:{
        ...mapActions([
            'get_modes', 'get_units'
        ]),
        get_app(){
            axios.get('../../api/app/'+this.$route.params.id).then(({data}) => {
                this.budget = data;
            }).catch(() => {

            });
        },
        get_dmds(){
            axios.get('../../api/app_dmd/'+this.$route.params.id).then(({data}) => {
                this.dmds= data;
            }).catch(() => {

            });
        },
        edit_app_dmd(dmd){
            this.editmode = true;
            this.form.fill(dmd);
            $('#appDmdModal').modal('show');
        },
        update_app_dmd(){
            this.form.put('../../api/app_dmd/'+this.form.id).then(() => {
                $('#appDmdModal').modal('hide');
            }).catch(() => {

            });
        }

    },
    computed:{
        ...mapGetters([
            'modes', 'units'
        ]),
        filteredDmds: function(){
            let matcher = new RegExp(this.search, 'i')
            return this.dmds.filter(function(dmd){
                return matcher.test(dmd.gendesc)
            })
        },
    },
    created(){
        this.get_dmds();
        this.get_modes();
        this.get_app();
        this.get_units();
    },
    mounted(){
        window.Echo.channel("app_dmd_updated").listen(".app_dmd.updated", (e) => {
            this.get_dmds();
        });
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
    height:33rem;             
    display: -moz-groupbox;    
}

tbody {
    overflow-y: scroll;      
    height: 31rem;           
    width: 98.5%;
    position: absolute;
}
</style>

