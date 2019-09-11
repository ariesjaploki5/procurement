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
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <th></th>
                </tr>
            </tbody>
          </table>
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
                brand_id: '',
                code: '',
            })
        }
    },
    methods:{
        get_items(){
            axios.get('../../api/get_needed_code').then(({data}) => {

            }).catch(() => {

            });
        },
        create_code(){

        },
        store_code(){
            this.form.post('../../api/').then(() => {

            }).catch(() => {

            });
        },
        edit_code(){

        }
    },
    created(){

    }
}
</script>

<style>

</style>