<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            PPMP
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-sm btn-primary" @click="create_ppmp()"><i class="fas fa-plus"></i> Create</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Year</th>
                                    <th>Created At</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="ppmp in ppmps" :key="ppmp.id">
                                    <td>{{ ppmp.ppmp_id }}</td>
                                    <td>{{ ppmp.ppmp_year }}</td>
                                    <td>{{ ppmp.created_at }}</td>
                                    <td>{{ ppmp.category.category_desc }}</td>
                                    <td>
                                        <router-link class="btn btn-sm btn-primary" :to="{ name: 'ppmp_show', params: { id: ppmp.ppmp_id }}"><i class="fas fa-eye"></i></router-link>
                                        <button type="button" class="btn btn-sm btn-success" @click="edit_ppmp(ppmp)"><i class="fas fa-pen"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger" @click="delete_ppmp(ppmp.id)"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="ppmpModal" tabindex="-1" role="dialog" aria-labelledby="ppmpModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editmode"  class="modal-title" id="ppmpModalLabel">New PPMP</h5>
                            <h5 v-show="editmode" class="modal-title" id="ppmpModalLabel">Update PPMP</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form  @submit.prevent="editmode ? update_ppmp() : store_ppmp()">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="category" class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                        <select class="form-control form-control-sm" v-model="form.category_id">
                                            <option v-for="cat in categories" :key="cat.category_id" :value="cat.category_id">{{ cat.category_desc }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="year" class="col-sm-2 col-form-label">Year</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control form-control-sm" v-model="form.ppmp_year">
                                    </div>
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
            ppmps: {},
            form: new Form({
                ppmp_id: '',
                ppmp_year: '',
                user_id: '',
                category_id: '',
            }),
        }
    },
    methods:{
        ...mapActions([
            'get_categories',
        ]),
        get_ppmps(){
            axios.get('../../api/get_ppmp/'+this.current_user.user_id).then(({data}) => {
                this.ppmps = data;
            }).catch(() => {

            });
        },
        create_ppmp(){
            this.editmode = false;
            this.form.user_id = this.current_user.user_id;
            $('#ppmpModal').modal('show');
        },
        store_ppmp(){
            this.form.post('../../api/ppmp').then(() => {

                $('#ppmpModal').modal('hide');
            }).catch(() => {

            });
        },
        edit_ppmp(ppmp){
            this.editmode = true;
            this.form.fill(ppmp);
            $('#ppmpModal').modal('show');
        },
        update_ppmp(){
            this.form.put('../../api/ppmp').then(() => {

            }).catch(() => {

            });
        },
        delete_ppmp(id){
            axios.delete('../../api/ppmp/'+id).then(() => {

            }).catch(() => {

            });
        },

    },
    computed:{
        ...mapGetters([
            'categories'
        ]),
        current_user(){
            return this.$store.getters.current_user
        },
    },
    created(){
        this.get_categories();
        this.get_ppmps();
    },
    mounted(){
        window.Echo.channel("ppmp_created").listen(".ppmp.created", (e) => {
            this.get_ppmps();
        });
        window.Echo.channel("ppmp_updated").listen(".ppmp.updated", (e) => {
            this.get_ppmps();
        });
    },
}
</script>
<style>

</style>
