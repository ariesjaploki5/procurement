<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            APP
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-sm btn-primary" @click="create_app()"><i class="fas fa-plus"></i> Create</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Year</td>
                                    <td>Category</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="app in apps" :key="app.app_id">
                                    <td>{{ app.app_id }}</td>
                                    <td>{{ app.app_year }}</td>
                                    <td>{{ app.category.category_desc }}</td>
                                    <td>
                                        <router-link class="btn btn-sm btn-primary" :to="{ name: 'app_show', params: { id: app.app_id }}"><i class="fas fa-eye"></i></router-link>
                                        <button type="button" class="btn btn-sm btn-success" @click="edit_app(app)"><i class="fas fa-pen"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger" @click="delete_app(app.id)"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="appModal" tabindex="-1" role="dialog" aria-labelledby="appModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editmode"  class="modal-title" id="appModalLabel">New APP</h5>
                            <h5 v-show="editmode" class="modal-title" id="appModalLabel">Update APP</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form  @submit.prevent="editmode ? update_app() : store_app()">
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
                                        <input type="number" class="form-control form-control-sm" v-model="form.app_year">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="year" class="col-sm-2 col-form-label">Budget</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control form-control-sm" v-model="form.app_budget">
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
            form: new Form({
                app_id: '',
                app_year: '',
                app_budget: '',
                user_id: '',
            }),

        }
    },
    methods:{
        ...mapActions([
            'get_apps', 'get_categories'
        ]),
        create_app(){
            this.editmode = false;
            this.form.user_id = this.current_user.user_id;
            $('#appModal').modal('show');
        },
        store_app(){
            this.form.post('../../api/app').then(() => {
                $('#appModal').modal('hide');
            }).catch(() => {

            });
        },
        edit_app(app){
            this.editmode = true;
            this.form.fill(app);
            $('#appModal').modal('show');
        },
        update_app(){
            this.form.put('../../api/app').then(() => {
                $('#appModal').modal('hide');
            }).catch(() => {

            });
        },
        delete_app(id){
            axios.delete('../../api/app/'+id).then(() => {

            }).catch(() => {

            });
        }
    },
    computed:{
        ...mapGetters([
            'apps', 'categories'
        ]),
        current_user(){
            return this.$store.getters.current_user
        },

    },
    created(){
        this.get_apps();
        this.get_categories();
    },
    mounted(){
        window.Echo.channel("app_created").listen(".app.created", (e) => {
            this.get_apps();
        });
        window.Echo.channel("app_updated").listen(".app.updated", (e) => {
            this.get_apps();
        });
    },
}
</script>

<style>

</style>
