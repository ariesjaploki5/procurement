<template>
  <div class="row">
      <div class="h6">Disbursement Voucher List</div>
      <div class="w-100"></div>
      <div class="col-md-12">
          <table class="table table-sm table-hover">
              <thead>
                  <tr>
                      <th>No.</th>
                      <th>Date/Time</th>
                      <th>PO Number</th>
                      <th>PO Date</th>
                      <th>Date Faxed</th>
                      <th>Supplier</th>
                      <th>Mode of Procurement</th>
                      <th>PR Number</th>
                      <th>ORS/BURS No.</th>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="dv in dvs" :key="dv.id" @click="view_dv(dv.id)">
                      <td>{{ dv.dv_id }}</td>
                      <td>{{ dv.dv_date | myDate6 }}</td>
                      <td>{{ dv.po_id }}</td>
                      <td>{{ dv.po_date | myDate4 }}</td>
                      <td></td>
                      <td>{{ dv.supplier_name }}</td>
                      <td>{{ dv.mode_desc }}</td>
                      <td>{{ dv.pr_date }}</td>
                      <td>{{ dv.obrs_no }}</td>
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
            dvs: [],
            dv: {
                dv_attachment: [],
                dv_liquidated_damages: [],
                dv_id: '',
                id: '',
                dmddesc: '',
                obrs_no: '',
                mode_desc: '',
                total_amount: '',
            },
        }
    },
    methods:{
        get_dvs(){
            axios.get('../../api/dv').then(({data}) => {
                this.dvs = data;
            }).catch(() => {

            })
        },
        view_dv(id){
            this.$router.push({name: 'dv', params: {id: id} });
        }
    },
    created(){
        this.get_dvs();

    },
    computed:{

    },
}
</script>

<style scoped>
</style>