<template>
  <div class="row">
      <div class="col-md-12">
          <h6>SUMMARY OF INSPECTION AND ACCEPTANCE REPORT</h6>
      </div>
      <div class="col-md-12">
        <table class="table table-sm table-hover">
            <thead>
                <tr>
                    <th width="8%">IAR No.:</th>
                    <th width="6%">IAR Date</th>
                    <th width="8%">PO No.:</th>
                    <th width="6%">PO Date</th>
                    <th width="5%">Days Delayed</th>
                    <th width="">Supplier</th>
                    <th width="7%">Batch No.:</th>
                    <th width="">Item Description</th>
                    <th width="8%">Total Cost</th>
                </tr>
            </thead>
            <tbody class="table-bordered">
                <tr v-for="(iar, index) in iars" :key="index" @click="view_iar(iar.iar_no)"> 
                    <td width="8%" class="text-center">{{ iar.iar_no }}</td>
                    <td width="6%" class="text-center">{{ iar.iar_date | myDate6 }}</td>
                    <td width="8%" class="text-center">{{ iar.po_id }}</td>
                    <td width="6%" class="text-center">{{ iar.po_date | myDate6 }}</td>
                    <td width="5%" class="text-right">{{ iar.days_delayed }}</td>
                    <td width="">{{ iar.supplier_name }}</td>
                    <td width="7%">{{ iar.batch_no }}</td>
                    <td width="">{{ iar.dmddesc }}</td>
                    <td width="8%" class="text-right">{{ iar.total_cost | currency2 }}</td>
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
        view_iar(iar_no){
            this.$router.push({name: 'iar', params: {id: iar_no} });
        },
    },
    created(){
        this.get_iars();
    },
    computed:{

    }
}
</script>

<style scoped>

</style>