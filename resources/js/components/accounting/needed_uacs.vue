<template>
  <div class="row">
      <div class="col-md-12">
          <span><h6>Needed Stock No.</h6></span>
      </div>
      <div class="col-md-12">
          <table class="table table-sm table-hover">
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th>Brand</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(du, index) in items" :key="index">
                    <td>{{ du.dmddesc }}</td>
                    <td>{{ du.brand_desc }}</td>
                    <th>
                        <button class="btn btn-sm btn-primary" type="button" @click="create_code(du)">
                            Create Uacs Code
                        </button>
                    </th>
                </tr>
            </tbody>
          </table>
      </div>
      <div class="modal fade" id="uacsModal" tabindex="-1" role="dialog" aria-labelledby="uacsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Uacs Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="store_uacs()">
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-4 text-right"><label class="form-label">Description: </label></div>
                            <div class="col-md-8">
                                <label class="form-label">{{ form.dmddesc }}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4 text-right"><label class="from-label">Brand: </label></div>
                            <div class="col-md-8">
                                <label class="form-label">{{ form.brand_desc }}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4 text-right"><label class="form-label">Uacs Code: </label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control form-control-sm" v-model="form.code">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
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
            items: [],
            form: new Form({
                dmd_id: '',
                dmddesc: '',
                brand_id: '',
                brand_desc: '',
                code: '',
            })
        }
    },
    methods:{
        get_items(){
            axios.get('../../api/get_needed_code').then(({data}) => {
                this.items = data;
            }).catch(() => {    

            });
        },
        create_code(du){
            this.form.fill(du);
            $('#uacsModal').modal('show');
        },
        store_code(){
            this.form.post('../../api/dmd_uacs').then(() => {
                    $('#uacsModal').modal('hide');
                    this.get_items();
                }).catch(() => {

                });
        },
        edit_code(){

        }
    },
    created(){
        this.get_items();
    }
}
</script>

<style>

</style>