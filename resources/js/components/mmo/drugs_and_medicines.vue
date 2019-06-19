<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row mb-1">
                <div class="col-md-6">
                    Drugs And Medicines
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="30%">Description</th>
                                <th>SSL</th>
                                <th>ROP</th>
                                <th>BOH</th>
                                <th>Item in Transit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(d, index) in dmds" :key="d.dmd_id">
                                <td width="5%">{{ index + 1}}</td>
                                <td width="30%">{{ d.gendesc }} {{ d.dmdnost }} {{ d.stredesc }} {{ d.formdesc }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
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
            dmds: {},
        }
    },
    methods:{
        get_dmds(){
            axios.get('../../api/dmd').then(({data}) => {
                this.dmds = data;
            }).catch(() => {

            });
        },
    },
    created(){
        this.get_dmds();
    },
    computed:{

    },
}
</script>

<style scoped>

tr {
    width: 100%;
    display: inline-table;
    table-layout: fixed;
}

table {
    height:36rem;             
    display: -moz-groupbox;    
}

tbody {
    overflow-y: scroll;      
    height: 34rem;           
    width: 98.5%;
    position: absolute;
}
</style>
