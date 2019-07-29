<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row b-1 shadow p-3 mb-3 bg-white rounded">
                <div class="col-md-6">
                    <h4><i class="fas fa-warehouse mr-2"></i>Suppliers</h4>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-primary" @click="create_supplier()">Add <i
                            class="fas fa-truck-pickup"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="40%">Name</th>
                                <th width="45%">Address</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="s in suppliers" :key="s.supplier_id">
                                <td width="5%">{{ s.supplier_id}}</td>
                                <td width="40%">{{ s.supplier_name }}</td>
                                <td width="45%">{{ s.supplier_address }}</td>
                                <td width="10%">    
                                    <button type="button" data-toggle="tooltip" data-placement="left" title="Edit" class="btn btn-sm btn-success"
                                        @click="edit_supplier(s)"><i class="fas fa-edit"></i></button>
                                    <button type="button" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-sm btn-danger"
                                        @click="delete_supplier(s.supplier_id)"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="supplierModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 v-show="!editmode" class="modal-title text-bold" id="supplierModalLabel">New Supplier
                            </h6>
                            <h6 v-show="editmode" class="modal-title text-bold" id="supplierModalLabel">Edit Supplier
                            </h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="editmode ? update_supplier() : store_supplier()">
                                <div class="form-group">
                                    <label for="supplier_name" class="form-label">Name</label>
                                    <input type="text" class="form-control form-control-sm"
                                        v-model="form.supplier_name">
                                </div>
                                <div class="form-group">
                                    <label for="supplier_name" class="form-label">Address</label>
                                    <input type="text" class="form-control form-control-sm"
                                        v-model="form.supplier_address">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {
        mapGetters,
        mapActions
    } from "vuex";
    export default {
        data() {
            return {
                form: new Form({
                    supplier_id: '',
                    supplier_name: '',
                    supplier_address: '',
                }),
                editmode: false,

            }
        },
        methods: {
            ...mapActions([
                'get_suppliers'
            ]),
            create_supplier() {
                this.editmode = false;
                $('#supplierModal').modal('show');
            },
            edit_supplier() {
                this.editmode = true;
                $('#supplierModal').modal('show');
            },
            store_supplier() {
                this.form.post('../../api/supplier').then(() => {

                }).catch(() => {

                });
            },
            update_supplier() {
                this.form.put('../../api/supplier/' + this.form.supplier_id).then(() => {

                }).catch(() => {

                });
            },
            delete_supplier(id) {
                axios.delete('../../api/supplier/' + id).then(() => {

                }).catch(() => {

                });
            },
        },

        created() {
            this.get_suppliers();
        },
        computed: {
            ...mapGetters([
                'suppliers'
            ]),
        },
        mounted() {

        }
    }
    

</script>


<style scoped>
    #d_modal_content {
        background-color: #4a5ea5fa;
        color: #d5e8e2;
    }

    .modal-content {
        background-color: #4a5ea5fa;
        color: #d5e8e2;
    }

    .modal-body {
        background-color: white;
        color: black;
    }
    tr {
        width: 100%;
        display: inline-table;
        table-layout: fixed;
    }

    table {
        height: 33rem;
        display: -moz-groupbox;
    }

    tbody {
        overflow-y: scroll;
        height: 31rem;
        width: 98.5%;
        position: absolute;
    }

</style>
