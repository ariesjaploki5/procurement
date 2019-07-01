<template>
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center">CONSIGNMENTS</h3>
        </div>
        <div class="col-md-12">
            <form action="">
                <div class="form-group row">
                    <div class="col-auto">
                        <label for="" class="form-label">Supplier: </label>
                    </div>
                    <div class="col-6">
                        <select class="form-control form-control-sm" v-model="supplier_id" @change="get_dmds()">
                            <option v-for="s in suppliers" :key="s.supplier_id" :value="s.supplier_id">{{ s.supplier_name }}</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Description</th>
                        <th></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="dmd in dmds" :key="dmd.dmd_id">
                        <td>{{ dmd.dmd_id }}</td>
                        <td>{{ dmd.gendesc }} {{ dmd.dmdnost }} {{ dmd.stredesc }} {{ dmd.formdesc }} {{ dmd.brandname }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
    data(){
        return{
            dmds:{},
            supplier_id: '',
        }
    },
    methods:{
        ...mapActions([
            'get_suppliers'
        ]),
        get_dmds(){
            axios.get('../../api/consignment/'+this.supplier_id).then(({data}) => {
                this.dmds = data;
            }).catch(() => {

            });
        }
    },
    created(){
        this.get_suppliers();
    },
    computed:{
        ...mapGetters([
            'suppliers'
        ]),
    },
    mounted(){


    },
}
</script>

<style>

</style>
