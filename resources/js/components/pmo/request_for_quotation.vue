<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Request for Quotations
                </div>
                <div class="card-body">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="rfq in rfqs" :key="rfq.rfq_id">
                                <td>{{ rfq.rfq_id }}</td>
                                <td>{{ rfq.created_at }}</td>
                                <td><button class="btn btn-sm" type="button" @click="view_rfq(rfq)">View</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="rfqModal" tabindex="-1" role="dialog" aria-labelledby="rfqModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            (RFQ ID)
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="">
                                <table class="table table-sm table-hover">
                                    <thead>
                                        
                                        <tr>
                                            <th rowspan="2">Item No</th>
                                            <th rowspan="2">QTY</th>
                                            <th rowspan="2">UNIT</th>
                                            <th rowspan="2">Article Description</th>
                                            <th rowspan="2">Approved Budget for the Contact</th>
                                            <th rowspan="2">Brand Name</th>
                                            <th rowspan="2">Manufacturer</th>
                                            <th>Price</th>
                                        </tr>
                                        <tr>
                                            <th>Unit</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
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
            rfqs: {},
            form: new Form({

            }),
        }
    },
    methods:{
        get_rfqs(){
            axios.get('../../api/rfq').then(({data}) => {
                this.rfqs = data;
            }).catch(() => {

            });
        },
        view_rfq(){

        },
    },
    created(){

    },
    computed:{

    },
}
</script>
<style>

</style>
