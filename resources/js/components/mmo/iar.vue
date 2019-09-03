<template>
  <div class="row">
      <div class="col-md-12">
          <h6>SUMMARY OF INSPECTION AND ACCEPTANCE REPORT</h6>
      </div>
      <div class="col-md-12">
          <table class="table table-sm table-hover">
              <thead>
                  <tr>
                      <th>IAR No.:</th>
                      <th>IAR Date</th>
                      <th>Date of Delivery</th>
                      <th>PO No.:</th>
                      <th>PO Date</th>
                      <th>Days Delayed</th>
                      <th>Supplier</th>
                      <th>Item Description</th>
                      <th>Total Cost</th>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="(iar, index) in iars" :key="index"> 
                      <td>{{ iar.iar_no }}</td>
                      <td>{{ iar.iar_date | myDate6 }}</td>
                      <td>{{ iar.date_of_delivery }}</td>
                      <td>{{ iar.po_id }}</td>
                      <td>{{ iar.po_date | myDate6 }}</td>
                      <td>{{ iar.days_delayed }}</td>
                      <td>{{ iar.supplier_name }}</td>
                      <td>{{ iar.dmddesc }}</td>
                      <td>{{ iar.total_amount | currency2 }}</td>
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
            iars: [],

        }
    },
    methods:{
        get_iars(){
            axios.get('../../api/get_all_iar').then(({data}) => {
                this.iars = data;
            }).catch(() => {

            });
        },

    },
    created(){
        this.get_iars();
    },
    computed:{

    }
}
</script>

<style>

</style>