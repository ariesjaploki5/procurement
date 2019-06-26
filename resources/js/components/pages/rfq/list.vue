<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Request For Quotation   
                </div>
                <div class="card-body">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>PR ID</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="rfq in rfqs" :key="rfq.rfq_id">
                                <td>{{ rfq.rfq_id }}</td>
                                <td>{{ rfq.purchase_request.created_at | myDate }} - {{ rfq.purchase_request_id | numeral2 }}</td>
                                <td>
                                    <router-link class="btn btn-sm btn-primary" :to="{ name: 'request_for_quotation_show', params: { id: rfq.rfq_id }}"><i class="fas fa-eye"></i> View</router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            rfqs: {},
            rfq: {},
        }
    },
    methods:{
        get_rfqs(){
            axios.get('../../api/rfq').then(({data}) => {
                this.rfqs = data;
            }).catch(() => {

            });
        },
        get_rfq(id){
            axios.get('../../api/rfq/'+id).then(({data}) => {
                this.rfq = data;
            }).catch(() => {

            });
        },
    },
    created(){
        this.get_rfqs();
    },
    computed:{
        
    }
}
</script>

<style>

</style>
