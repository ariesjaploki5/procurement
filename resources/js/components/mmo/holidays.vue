<template>
    <div class="row">
        <div class="col-md-12">
            Holidays
        </div>
        <div class="col-md-12 text-right">
            <button type="button" class="btn btn-sm btn-primary" @click="create_holiday()">Add</button>
        </div>
        <div class="col-md-12">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(h, index) in holidays" :key="h.holiday_id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ h.holiday_name }}</td>
                        <td>{{ h.holiday_date }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-success" @click="edit_holiday(h)">
                                Edit
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="holidayModal" tabindex="-1" role="dialog" aria-labelledby="holidayModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>
                            <span v-show="editmode">Update Holiday</span>
                            <span v-show="!editmode">New Holiday</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
                    <form action="" @submit.prevent="editmode ? update_holiday() : store_holiday()">
                        <div class="modal-body">    
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="" class="form-label">Name</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-sm" v-model="form.holiday_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="" class="form-label">Date</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="date" class="form-control form-control-sm" v-model="form.holiday_date">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-warning">Cancel</button>
                            <button v-show="!editmode" type="submit" class="btn btn-sm btn-success">Submit</button>
                            <button v-show="editmode" type="submit" class="btn btn-sm btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            holidays:[],
            editmode: false,
            form: new Form({
                holiday_id: '',
                holiday_name: '',
                holiday_date: '',
            }),
        }
    },
    methods:{
        get_holidays(){
            axios.get('../../api/holiday').then(({data})=> {
                this.holidays = data;
            }).catch(() => {

            });
        },
        create_holiday(){
            this.editmode = false;
            this.form.reset();
            $('#holidayModal').modal('show');
        },
        store_holiday(){
            this.form.post('../../api/holiday').then(() => {
                this.get_holidays();
                $('#holidayModal').modal('hide');
            });
        },
        edit_holiday(h){
            this.editmode = true;
            this.form.fill(h);
            $('#holidayModal').modal('show');
        },
        update_holiday(){
            this.form.put('../../api/holiday/'+this.form.holiday_id).then(() => {
                this.get_holidays();
                $('#holidayModal').modal('hide');
            }).catch(() => {

            });
        },
        delete_holiday(id){
            axios.get.delete('../../api/holiday/'+id).then(() => {
                this.get_holidays();
            });
        }
    },
    created(){
        this.get_holidays();
    }
}
</script>

<style scoped>

</style>