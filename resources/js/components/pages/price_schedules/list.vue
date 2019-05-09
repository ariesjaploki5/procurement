<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Price Schedules
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-sm btn-primary" @click="create_ps()">
                                <i class="fas fa-plus"></i> Create
                            </button>
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
                                    <th>Created By</th>
                                    <th>Created At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="ps in price_schedules" :key="ps.id">
                                    <td>{{ ps.price_schedule_id }}</td>
                                    <td>{{ ps.price_schedule_year }}</td>
                                    <td>{{ ps.created_by.employee.lastname }}, {{ ps.created_by.employee.firstname }}</td>
                                    <td>{{ ps.created_at }}</td>
                                    <td class="text-center" width="20%">
                                        <router-link class="btn btn-sm btn-primary" to=""><i class="fas fa-eye"></i></router-link>
                                        <button type="button" class="btn btn-sm btn-success" @click="edit_ps(ps)"><i class="fas fa-edit"></i></i></button>
                                        <button type="button" class="btn btn-sm btn-danger" @click="delete_ps(ps.id)"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="psModal" tabindex="-1" role="dialog" aria-labelledby="psModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editmode"  class="modal-title" id="psModalLabel">New Price Schedule</h5>
                            <h5 v-show="editmode" class="modal-title" id="psModalLabel">Update Price Schedule</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form  @submit.prevent="editmode ? update_ps() : store_ps()">
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
                                        <input type="number" class="form-control form-control-sm" v-model="form.price_schedule_year">
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
                price_schedule_id: '',
                category_id: '',
                price_schedule_year: '',
                user_id: '',
            }),

        }
    },
    methods:{
        ...mapActions([
            'get_categories', 'get_price_schedules'
        ]),
        get_ps(){
            axios.get('../../api/price_schedule').then(({data}) => {
                this.price_schedules = data;
            }).catch(() => {

            });
        },
        create_ps(){
            this.editmode = false;
            $('#psModal').modal('show')
        },
        store_ps(){
            this.form.post('../../api/price_schedule').then(() => {

                $('#psModal').modal('hide')
            }).catch(() => {

            });
        },
        edit_ps(ps){
            this.editmode = true;
            this.form.fill(ps);
            $('#psModal').modal('show')
        },
        update_ps(){
            this.form.put('../../api/price_schedule/'+this.form.price_schedule_id).then(() => {
                $('#psModal').modal('hide')
            }).catch(() => {

            });
        },
        delete_ps(id){
            axios.delete('../../api/price_schedule/'+id).then(() => {

            }).catch(() => {

            });
        },
        user_id(){
            this.form.user_id = this.current_user.user_id;
        }
    },
    computed:{
        ...mapGetters([
            "categories", "price_schedules"
        ]),
        current_user(){
            return this.$store.getters.current_user
        },

    },
    created(){
        this.get_price_schedules();
        this.get_categories();
        this.user_id();
    },
    mounted(){
        window.Echo.channel("ps_created").listen(".price_schedule.created", (e) => {
            this.get_price_schedules();
        });
        window.Echo.channel("ps_updated").listen(".price_schedule.updated", (e) => {
            this.get_price_schedules();
        });
    },
}
</script>

<style>

</style>
