<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row mb-2 bg-white">
                <h6><i class="fas fa-capsules"></i> Purchase Requests</h6>
            </div>
        </div>
        <div class="col-md-12">
            <form >
                <div class="form-group row">
                    <div class="col-md-auto">
                        <label for="" class="form-label">PR #</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-contro form-control-sm">
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-sm btn-primary">Search</button>
                    </div>
                </div>
            </form>
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>PR #</th>
                        <th>Item Desc</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
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
            dmd_pr: [],
        }
    },
    methods:{
        get_dmd_pr(){
            axios.get('../../api/get_pmo_dmd_pr').then(({data}) => {
                this.dmd_pr = data;
            }).catch(() => {

            });
        },
    },
    created(){
        this.get_dmd_pr();
    },
    computed:{
        current_user() {
            return this.$store.getters.current_user;
        }
    },
    mounted(){

    }
}
</script>

<style scoped>

    .text-link{
        color: rgba(#085fc2e3) !important;
        padding: 0.25rem 0.5rem;
        font-size: 0.7rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }
    .text-link:hover{
        color: rgba(#5093df93) !important;
        text-decoration:underline;
        display:inline-block;
        /* background: #38c172;
        color: white; */
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
        /* line-height: 20px;
        min-height: 20px;
        height: 20px; */
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

    #pr_tbody {
        overflow-y: scroll;      
        height: 22rem;           
        width: 98.5%;
        position: absolute;
    }

    #pr_table {
        height:24rem;             
        display: -moz-groupbox;    
    }
</style>
