<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Terminated
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
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
            terminateds: {},
        }
    },
    methods:{
        get_terminated(){
            axios.get('../../api/terminated').then(({data}) =>{
                this.terminateds = data;
            });
        },

    },
    created(){
        this.get_terminated();

    },
    computed:{


    },
    mounted(){


    }
}
</script>

<style scoped>

</style>
