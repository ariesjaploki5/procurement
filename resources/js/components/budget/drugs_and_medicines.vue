<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row mb-1">
                <div class="col-md-6">
                    Drugs And Medicines
                </div>

            </div>
            <div class="row mb-1">
                <div class="col-md-auto text-right">Search:</div>
                <div class="col-md-4"><input type="text" class="form-control form-control-sm" v-model="search_word"></div>
            </div>
            <div class="table-responsive-sm">
                <table class="table table-fixed table-sm table-hover table-condensed">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <!-- <th width="10%">ID</th> -->
                            <th width="30%">Description</th>
                            <th width="10%" class="text-center">Balance On Hand</th>
                            <th class="text-center">SSL</th>
                            <th class="text-center">ROP</th>
                            <th class="text-center">Item In Transit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(d, index) in filteredDmds" :key="d.dmd_id" :class="{ 'table-warning' : d.boh_iit < d.ssl/2 , 'table-danger' : d.ssl == 0 , 'table-success' : d.boh > d.ssl/2, 'table-primary' : d.boh_iit > d.ssl/2}" >
                            <td width="5%">{{ index + 1}}</td>
                            <!-- <td width="10%">{{ d.dmdcomb }}-{{ d.dmdctr}}</td> -->
                            <td width="30%">{{ d.gendesc }} {{ d.dmdnost }} {{ d.stredesc }} {{ d.formdesc }} {{ d.brandname }}</td>
                            <td width="10%" class="text-right">{{ d.boh | numeral3 }}</td>
                            <td class="text-right">{{ d.ssl | numeral3 }}</td>
                            <td class="text-right">{{ d.rop | numeral3 }}</td>
                            <td class="text-right">{{ d.item_in_transit | numeral3 }}</td>

                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</template>
<script>

export default {

    data(){
        return{

            dmds: [],
            search_word: '',
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
                return matcher.test(dmd.gendesc)
            });
        },

        
    },
    mounted(){
        
        
    },

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
