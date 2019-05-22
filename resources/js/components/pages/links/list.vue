<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <div class="table-responseive-sm">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th width="3%">ID</th>
                                    <th width="45%">App Description</th>
                                    <th width="45%">Homis Description</th>
                                    <th class="text-center" width="7%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in items" :key="item.item_id">
                                    <td>{{ item.item_id }}</td>
                                    <td>{{ item.item_desc }}</td>
                                    <td>
                                        <div v-if="item.item_homis_link">
                                            {{ item.item_homis_link.gendesc }} 
                                            {{ item.item_homis_link.dmdnost }} 
                                            {{ item.item_homis_link.stredesc }}, 
                                            {{ item.item_homis_link.formdesc }}, 
                                            {{ item.item_homis_link.brandname }}
                                        </div>
                                        <div v-else>

                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" @click="edit_link(item)">Edit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="linkModal" tabindex="-1" role="dialog" aria-labelledby="linkModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5  class="modal-title" id="linkModalLabel">{{ form.item_desc }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="update_link()">
                                <div class="form-group">
                                    <label for="ssl" class="form-label">Homis Drugs and Medicines</label>
                                    <select name="" id="" class="form-control form-control-sm" v-model="form.item_homis_link">
                                        <option v-for="d in homis_dmds" :key="d.id" :value="d">
                                            {{ d.gendesc }} 
                                            {{ d.dmdnost }} 
                                            {{ d.stredesc }}, 
                                            {{ d.formdesc }}, 
                                            {{ d.brandname }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
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
export default {
    data(){
        return{
            form: new Form({
                item_id: '',
                item_desc: '',
                item_homis_link: {},
            }),
            items: {},
            homis_dmds: {},
        }
    },
    methods:{
        get_items(){
            axios.get('../../api/item_links').then(({data}) => {
                this.items = data;
            }).catch(() => {

            });
        },
        get_homis_dmds(){
            axios.get('../../api/homis_drugs_and_medicines').then(({data}) => {
                this.homis_dmds = data;
            }).catch(() => {

            });
        },
        edit_link(item){
            this.form.fill(item);
            $('#linkModal').modal('show');
        },
        update_link(){
            this.form.put('../../api/item_homis_link/'+this.form.item_id).then(() => {

            }).catch(() => {

            });
        }
    },
    created(){
        this.get_items();
        this.get_homis_dmds();

    },  
    computed:{

    },
}
</script>

<style>

</style>
