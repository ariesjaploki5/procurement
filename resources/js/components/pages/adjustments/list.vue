<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-center">Adjustments</h4>
                        </div>
                        <div class="col-md-auto">
                            <label for="" class="form-label">End User</label>
                        </div>
                        <div class="col-md-auto">
                            <select class="form-control form-control-sm" @change="on_change()" v-model="end_user">
                                <option v-for="end_user in end_users" :key="end_user.chrgcode" :value="end_user">{{ end_user.chrgdesc }}</option>
                            </select>
                        </div>
                        <div class="col-md-4" v-show="end_user">
                            <input class="form-control form-control-sm" v-model="search_form.word" placeholder="Description">
                        </div>
                        <div class="col-md-auto" v-show="end_user">
                            <button type="button" class="btn btn-sm btn-primary" @click="search()">Search</button>
                        </div>
                        <div class="col-md-3 text-right" v-show="end_user">
                            <button type="button" class="btn btn-sm btn-primary" @click="add_medicine()">Add</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-sm table-hover" id="adjustment_table">
                            <thead>
                                <tr>
                                    <th id="adjustiment_id">#</th>
                                    <th id="adjustiment_desc">Description</th>
                                    <th id="adjustiment_sb" class="text-center">Stock Balance</th>
                                    <th id="adjustiment_act" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in items" :key="item.item_id" v-show="item.gendesc" v-bind:class="{ 'table-danger' : !item.item_desc }">
                                    <td id="adjustiment_id">
                                        {{ index + 1 }}
                                    </td>
                                    <td id="adjustiment_desc">
                                        {{ item.gendesc }}, {{ item.dmdnost}} {{ item.stredesc }} {{ item.formdesc }} {{ item.brandname }}
                                    </td>
                                    <td id="adjustiment_sb" class="text-right">
                                        {{ item.stockbal | numeral3 }}
                                    </td>
                                    <td id="adjustiment_act" class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary" @click="adjust(item)">Adjust</button>
                                        <button type="button" class="btn btn-sm btn-success" @click="transfer(item)">Transfer</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="adjustModal" tabindex="-1" role="dialog" aria-labelledby="adjustModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="text-center" id="adjustModalLabel">Adjust</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form  @submit.prevent="store_adjust()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <h6 v-if="form.item_desc" class="" id="adjustModalLabel">{{ form.item_desc }}</h6>
                                    <h6 v-else class="" id="adjustModalLabel">{{ form.gendesc }}, {{ form.dmdnost}} {{ form.stredesc }} {{ form.formdesc }}</h6>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-5 col-form-label">Stock Balance: </label>
                                    <div class="col-sm-7 text-right">
                                        {{ form.stockbal | numeral3}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Operation</label>
                                    <div class="col-sm-10">
                                        <select v-model="form.operation" class="form-control form-control-sm">
                                            <option value="+">Add</option>
                                            <option value="-">Subtract</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Value</label>
                                    <div class="col-sm-10">
                                        <input v-if="form.operation == null" type="number" class="form-control form-control-sm text-right" disabled>
                                        <input v-else type="number" class="form-control form-control-sm text-right" v-model="form.value">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Remarks</label>
                                    <div class="col-sm-10">
                                        <input v-if="form.operation == null" type="text" class="form-control form-control-sm" disabled>
                                        <input v-else type="text" class="form-control form-control-sm" v-model="form.remarks">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="text-center" id="addModalLabel">Add Medicine</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form  @submit.prevent="store_medicine()">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="" class="col-sm-10 col-form-label">{{ end_user.chrgdesc }}</label>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <select class="form-control form-control-sm" v-model="medicine_form">   
                                            <option v-for="meds in medicines" :value="meds" :key="meds.id">
                                                {{ meds.gendesc }}, {{ meds.dmdnost}} {{ meds.stredesc }} {{ meds.formdesc }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Add</button>
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-labelledby="transferModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="text-center" id="transferModalLabel">Transfer Medicine</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form  @submit.prevent="transfer_medicine()">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Receiver</label>
                                    <div class="col-sm-8">
                                        <select v-model="transfer_form.transfer_receiver" class="form-control form-control-sm">
                                            <option v-for="end_user in end_users" :key="end_user.chrgcode" :value="end_user">{{ end_user.chrgdesc }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Value</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control form-control-sm" v-model="transfer_form.transfer_value">   
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Add</button>
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            items: {},
            end_users: {},
            end_user: '',
            isLoading: false,
            search_form: new Form({
                word: '',
            }),
            medicine_form: new Form({
                dmdctr: '',
                dmdcomb: '',
            }),
            form: new Form({
                operation: '',
                item_desc: '',
                gendesc: '',
                dmdnost: '',
                stredesc: '',
                formdesc: '',
                remarks: '',
                value: '',
                dmdcomb: '',
                dmdctr: '',
                chrgcode: '',
                stockbal: '',
            }),
            transfer_form: new Form({
                dmdctr: '',
                dmdcomb: '',
                transfer_sender: '',
                transfer_receiver: '',
                transfer_value: '',
            }), 
            medicines:{},
        }   
    },
    methods:{
        get_items(){
            axios.get('../api/adjustment/'+this.end_user.chrgcode).then(({data}) =>{
                this.items = data;
                this.isLoading = false;
            }).catch(() => {

            });
        },
        on_change(){
            this.isLoading = true;
            this.get_items();
            this.search_form.reset();
            
        },
        get_homis_end_user(){
            axios.get('../../api/homis_end_user').then(({data}) => {
                this.end_users = data;
            }).catch(() => {

            });
        },
        search(){
            this.search_form.post('../../api/adjustment/'+this.end_user.chrgcode).then(({data}) => {
                this.items = data;
            }).catch(() => {

            });
        },
        adjust(item){
            this.form.fill(item);
            $('#adjustModal').modal('show');
        },
        store_adjust(){
            this.form.post('../../api/adjust').then(() => {

            }).catch(() => {

            });
        },
        get_medicines(){
            axios.get('../../api/get_medicines').then(({data}) => {
                this.medicines = data;
            }).catch(() => {

            });
        },
        store_medicine(){
            axios.post('../../api/add_medicine/'+this.end_user.chrgcode, {
                dmdctr: this.medicine_form.dmdctr,
                dmdcomb: this.medicine_form.dmdcomb,
            }).then(() => {
                $('#addModal').modal('hide');
            }).catch(() => {

            });
        },
        add_medicine(){
            $('#addModal').modal('show');
        },
        transfer(item){
            $('#transferModal').modal('show');
        },
        transfer_medicine(){
            axios.post('../../api/transfer_medicine',{
                dmdctr: this.transfer_form.dmdctr,
                dmdcomb: this.transfer_form.dmdcomb,
                transfer_receiver: this.transfer_form.transfer_receiver,
                transfer_sender: this.transfer_form.transfer_sender,
                transfer_value: this.transfer_value,
            }).then(() => {

            }).catch(() => {

            });
        }
        
    },
    created(){
        this.get_homis_end_user();
        this.get_medicines();
    },
}
</script>

<style>
#adjustment_table{
    table-layout: fixed;
    width: 100%;
}
#adjustment_thead{
    display: block;
    width: 100%;
}
#adjustment_tbody{
    display: block;
    width: 100%;
}
#adjustiment_id{
    width: 5%;
}

#adjustiment_desc{
    width: 55%;
}

#adjustiment_sb{
    width: 25%;
}
#adjustiment_act{
    width: 15%;
}

</style>
