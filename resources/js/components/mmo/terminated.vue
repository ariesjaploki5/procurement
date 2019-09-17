<template>
  <div class="row">
      <div class="col-md-12">
          List of Terminated
      </div>
      <div class="col-md-12">
          <table class="table table-sm table-hover">
              <thead>
                  <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
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
            terminateds: [],
            form: new Form({
                date_from: '',
                date_to: '',
            })
        }
    },
    methods:{
        get_terminateds(){

        }
    },
    created(){
        this.get_terminateds();
    }
}
</script>

<style>

</style>