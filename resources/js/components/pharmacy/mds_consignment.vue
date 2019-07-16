<template>
    <div class="row">
        <div class="col-md-12 mt-0">
            <div><h4>Medical Supply Consignment</h4> </div>
            <div class="row mb-2">
                <div class="col-2"> Search:</div> 
                <div class="col-6"><input type="text" class="form-control form-control-sm" v-model="search_word"></div>
                <div class="col-4 text-right">
                    <button type="button" class="btn btn-sm btn-success" :disabled="!form.items.length" @click="cart()"><i class="fas fa-shopping-cart"></i> PR <span class="badge badge-light">{{ cart_item }}</span></button>
                </div>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Item Description</th>
                        <th>CostPrice</th>
                        <th>Retail Price</th>
                        <th width="5%"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(md, index) in filteredMds" :key="md.id">
                        <td width="5%">{{ index+1 }}</td>
                        <td>{{ md.cl1desc }} {{ md.cl2desc }}</td>
                        <td>{{ md.costprc | currency2 }}</td>
                        <td>{{ md.cl2retprc | currency2 }}</td>
                        <td width="5%">
                            <button type="button" class="btn btn-sm btn-primary" @click="add_to_cart(md)">
                                <i class="fas fa-cart-plus"></i> 
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content" id="d_modal_content">
                        <div class="modal-header">
                            Consignment Request
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="pr_submit()">
                            <div class="modal-body">
                                <table class="table table-sm table-hover" style="height:26rem; display: -moz-groupbox;    ">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="40%">Item Description</th>
                                            <th width="10%" class="text-center">Price</th>
                                            <th width="10%" class="text-center">Quantity</th>
                                            <th width="10%" class="text-center">Estimated Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody style="overflow-y: scroll; height: 24rem; width: 98.5%;position: absolute;">
                                        <tr v-for="(md, index) in form.items" :key="md.id">
                                            <td width="5%">{{ index+1 }}</td>
                                            <td width="40%">{{ md.cl1desc }}{{ md.cl2desc }}</td>
                                            <td width="10%" class="text-right">{{ md.cl2retprc | currency2}}</td>
                                            <td width="10%" class="text-right">
                                                <input type="number" class="form-control form-control-sm text-right" v-model="md.itemQty" required>
                                            </td>
                                            <td width="10%" class="text-right">
                                                <span v-if="md.itemQty">{{ md.cl2retprc * md.itemQty | currency2}}</span>
                                                <span v-else></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <label class="form-label">Purpose: </label>
                                    <textarea type="text" class="form-control form-control-sm" rows="2" v-model="form.purpose"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-success" @click="pr_submit()">Submit</button>
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
            mds: [],
            search_word: '',
            form: new Form({
                purpose: '',
                items: {},
            }),
        }
    },
    methods:{
        cart(){
            $('#cartModal').modal('show');
        },
        get_mds(){
            axios.get('../../api/mds_consignment').then(({data}) => {
                this.mds = data;
            }).catch(() => {

            });
        },
        get_cart(){
            axios.get('../../api/mds_cart').then(({data}) => {
                this.form.items = data;
            }).catch(() => {

            });
        },
        add_to_cart(md){
            axios.get('../../api/add_to_mds_cart/'+md.cl2comb+'/'+md.costprc).then(() => {
                this.get_cart();
                this.item_added();
            }).catch(() => {

            });
        },
        
        pr_submit(){
            this.form.post('../../api/mds_c_pr_submit').then(() => {
                $('#cartModal').modal('hide');
                this.get_cart();
                this.success_pr();
                this.$router.push({path: '/consignment_requests'});
            }).catch(() => {

            });
        },
        item_added(){
            toast.fire({
                type: 'success',
                title: 'Item added',
            });
        },
        success_pr(){
            toast.fire({
                type: 'success',
                title: 'Purchase Request Created Successfully',
            });

        },
    },
    created(){
        this.get_mds();
        this.get_cart();

    },
    computed:{
        filteredMds: function(){
            let matcher = new RegExp(this.search_word, 'i');
            return this.mds.filter(function(md){
                return matcher.test(md.cl1desc)
            });
        },
        cart_item: function(){
            let sum = 0;
            sum += (parseFloat(this.form.items.length));
            return sum;
        }

    }
}
</script>

<style scoped>
#d_modal_content{
        background-color: #4a5ea5fa;
        color: #d5e8e2;
    }
    .modal-content{
        background-color: #4a5ea5fa;
        color: #d5e8e2;
    }
    .modal-body{
        background-color: white;
        color: black;
    }
tr {
    width: 100%;
    display: inline-table;
    table-layout: fixed;
}
table {
    height:37rem;             
    display: -moz-groupbox;    
}
tbody {
    overflow-y: scroll;      
    height: 35rem;           
    width: 98.5%;
    position: absolute;
}
</style>
