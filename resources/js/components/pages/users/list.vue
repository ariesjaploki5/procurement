<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">Users</div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-sm btn-primary">Add</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key="user.user_id">
                                    <td>{{ user.user_id }}</td>
                                    <td>{{ user.username }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-success" @click="edit_user(user)">Edit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editmode"  class="modal-title" id="userModalLabel">New User</h5>
                            <h5 v-show="editmode" class="modal-title" id="userModalLabel">Update User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form  @submit.prevent="editmode ? update_user() : store_user()">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="username" class="col-sm-4 col-form-label">Username</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" v-model="form.username">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-4 col-form-label" v-show="!editmode">Password</label>
                                    <label for="username" class="col-sm-4 col-form-label" v-show="editmode">New Password</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" v-model="form.password">
                                    </div>
                                </div>
                                <div class="form-group row" v-show="editmode">
                                    <label for="username" class="col-sm-4 col-form-label">Old Password</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" v-model="form.old_password">
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
export default {
    data(){
        return{
            editmode: false,
            users: {},
            roles: {},
            form: new Form({
                user_id: '',
                username: '',
                password: '',
                old_password: '',
                role_id: '',
            }),
        }
    },
    methods:{
        get_roles(){
            axios.get('../../api/role').then(({data}) => {
                this.roles = data;
            }).catch(() => {

            });
        },
        get_users(){
            axios.get('../../api/user').then(({data}) => {
                this.users = data;
            }).catch(() => {

            });
        },
        create_user(){
            
        },
        store_user(){
            this.form.post('../../api/user').then(() => {

            }).catch(() => {

            });
        },
        edit_user(user){
            this.editmode = true;
            this.form.fill(user);
            $('#userModal').modal('show');
        },
        update_user(){
            this.form.put('../../api/user/'+this.form.user_id).then(() => {

            }).catch(() => {

            });
        }

    },
    created(){
        this.get_users();

    },
    computed:{


    },
    mounted(){


    }
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
