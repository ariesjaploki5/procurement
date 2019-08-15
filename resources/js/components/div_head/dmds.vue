<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row mb-2 bg-white rounded">
                <div class="col">
                    <h6> <i class="fas fa-capsules"></i> Drugs And Medicines</h6>
                </div>
                <div class="col-md-auto">Legend:</div>
                <div class="col-md-auto">
                    <i class="fas fa-stop" style="color:yellow"></i> - Below ROP
                </div>
                <div class="col-md-auto">
                    <i class="fas fa-stop" style="color:red"></i> - No SSL
                </div>
                <div class="col-md-auto">
                    <i class="fas fa-stop" style="color:green"></i> - Above SSL
                </div>
                <div class="col-md-auto">
                    <i class="fas fa-stop" style="color:blue"></i> - Item in Transit
                </div>
                <div class="col-md-auto text-right">
                    <button class="btn btn-sm btn-primary" :disabled="cart_item == 0" @click="cart_modal()">
                        <i class="fas fa-shopping-cart"></i> <span class="badge badge-light">{{ cart_item }}</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="table-responsive-sm">
                <table class="table table-fixed table-sm table-hover table-condensed">
                    <thead>
                        <tr>
                            <th width="2%" class="text-center">#</th>
                            <th width="30%" class="text-left">Description</th>
                            <th width="5%" class="text-center">Balance On Hand</th>
                            <th width="5%" class="text-center">SSL</th>
                            <th width="5%" class="text-center">ROP</th>
                            <th width="5%" class="text-center">Item In Transit</th>
                            <th width="5%" class="text-center">Last PR</th>
                        </tr>
                    </thead>
                    <tbody class="table-bordered">
                        <tr v-for="(d, index) in filteredDmds" :key="d.dmd_id" :class="{ 'table-warning' : d.rop >= d.boh , 'table-danger' : d.ssl == 0 , 'table-success' : d.boh > d.ssl/2, 'table-primary' : d.boh > d.ssl/2}" >
                            <td width="2%" class="text-right bg-white">{{ index + 1}}</td>
                            <td width="30%" class="text-left">{{ d.dmddesc }}</td>
                            <td width="5%" class="text-right">{{ d.boh | numeral3 }}</td>
                            <td width="5%" class="text-right">{{ d.ssl | numeral3 }}</td>
                            <td width="5%" class="text-right">{{ d.rop | numeral3 }}</td>
                            <td width="5%" class="text-right">{{ d.iit | numeral3 }}</td>
                            <td width="5%" class="text-center"><span v-if="d.last_pr">{{ d.last_pr | myDate3 }}</span><span v-else></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
import {Money} from 'v-money'
export default {
    components: {Money},
    data(){
        return{
            dmds: [],
            search_form: new Form({
                word: '',
            }),
        }
    },
    methods:{
        
        get_dmds(){
            axios.get('../../api/dmd').then(({data}) => {
                this.dmds = data;
            }).catch(() => {

            });
        },
        search(){
            this.search_form.post('../../api/dmd_search').then(({data}) => {
                this.dmds = data;
            }).catch(() => {

            });
        },
    },
    created(){
        this.get_dmds();
    },
    computed:{
        current_user() {
            return this.$store.getters.current_user;
        },
        filteredDmds: function(){
            let matcher = new RegExp(this.search_word, 'i')
            return this.dmds.filter(function(dmd){
                return matcher.test(dmd.dmddesc)
            });
        },
    },
    mounted(){
        window.Echo.channel("cart_dmd_created").listen(".cart_dmd.created", (e) => {
            this.get_dmds();
        });
        window.Echo.channel("cart_dmd_updated").listen(".cart_dmd.updated", (e) => {
            this.get_dmds();
        });
    },
}   

</script>
<style scoped>
    .nav-tabs .nav-link.active{
        color: white;
        background-color: #4a5ea5fa;
        
    }
    .custom-btn{
        background-color: Transparent;
        background-repeat:no-repeat;
        border: none; 
        cursor:pointer; 
        overflow: hidden; 
        outline:none;
    }

    @media (min-width: 768px) {
        .modal-xl {
            width: 90%;
            max-width:1400px;
        }
    }

    tbody.table-bordered > tr > td{
        border:1px solid black;
    }

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
        height:35rem;             
        display: -moz-groupbox;    
    }

    tbody {
        overflow-y: scroll;      
        height: 34rem;           
        width: 98.5%;
        position: absolute;
    }
</style>
