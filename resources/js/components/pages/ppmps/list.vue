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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="ppmp in ppmps" :key="ppmp.id">
                                    <td>{{ ppmp.id }}</td>
                                    <td>{{ ppmp.year }}</td>
                                    <td>{{ ppmp.created_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger" @click="delete_ppmp(ppmp.id)"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
            ppmps:{},
            form: new Form({
                id: '',
                year: '',
                user_id: '',
            }),

        }
    },
    methods:{
        get_ps(){
            axios.get('../../api/ppmp').then(({data}) => {
                this.ppmps = data;
            }).catch(() => {

            });
        },
        create_ps(){

        },
        store_ps(){
            this.form.post('../../api/ppmp').then(() => {

            }).catch(() => {

            });
        },
        edit_ps(){
            
        },
        update(){
            this.form.put('../../api/ppmp').then(() => {

            }).catch(() => {

            });
        },
        delete_ps(id){
            axios.delete('../../api/ppmp/'+id).then(() => {

            }).catch(() => {

            });
        },
    },
    computed:{

    },
}
</script>

<style>

</style>
