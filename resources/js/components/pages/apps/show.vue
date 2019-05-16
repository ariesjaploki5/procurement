<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Annual Procurement Plan</h3>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-hover table-bordered" id="app_table">
                        <thead class="text-center">
                            <tr>
                                <th rowspan="2">Code(PAP)</th>
                                <th rowspan="2">Procurement Program/Project</th>
                                <th rowspan="2">PMO/End-User</th>
                                <th rowspan="2">Mode of Procurement</th>
                                <th colspan="4">Schedule for Each Procurement Activity</th>
                                <th rowspan="2">Source of Funds</th>
                                <th colspan="3">Estimated Budget(PhP)</th>
                                <th rowspan="2">Remarks</th>
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr>
                                <th>Ads/Post of IAEB</th>
                                <th>Sub/Open of Bids</th>
                                <th>Notice of Award</th>
                                <th>Contract Signing</th>
                                <th>Total</th>
                                <th>MOOE</th>
                                <th>CO</th>
                            </tr>
                        </thead>    
                        <tbody>
                            <tr v-for="category in categories" :key="category.category_id">
                                <td></td>
                                <td>{{ category.category_desc }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <router-link class="btn btn-sm btn-primary" :to="{ name: 'app_show', params: { id: category.app.app_id }}"><i class="fas fa-eye"></i></router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal fade" id="appModal" tabindex="-1" role="dialog" aria-labelledby="appModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content text-left">
                            <div class="modal-header">
                                <h5 class="modal-title" id="appModalLabel">{{ form.description }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="" class="form-label">
                                            Estimated Budget
                                        </label>
                                        <input type="text" class="form-control form-control-sm" v-model="form.budget">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label">
                                            Remarks
                                        </label>
                                        <input type="text" class="form-control form-control-sm" v-model="form.remarks">
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm">Save</button>
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
import { mapGetters, mapActions } from "vuex";
export default {
    data(){
        return{
            editmode: false,
            form: new Form({
                description: '',
                app_id: '',
                app_year: '',
                app_budget: '',
                category_id: '',
            }),
        }
    },
    methods:{
        ...mapActions([
            'get_categories',
        ]),
        edit_app(){

        },
    },
    computed:{
        ...mapGetters([
            'categories'
        ]),
    },
    created(){

        this.get_categories();
    },
}
</script>

<style>

</style>
