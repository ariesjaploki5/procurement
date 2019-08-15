<template>
    <div class="row">
        <div class="col-md-12">
            Purchase Orders
        </div>
        <div class="w-100 mb-1"></div>
            <div class="col-md-12">
                <form  @submit.prevent="search()">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" class="form-control form-control-sm" v-model="search_form.word"> 
                        </div>
                        <div class="col-md-5">
                            <button type="submit" class="btn btn-sm btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        <div class="w-100 mb-2"></div>
        <div class="col-md-12">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>PO #</th>
                        <th>
                            Item Description
                        </th>
                        <th>
                            Ordered Qty
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="dp in dmd_po" :key="dp.dmd_po_id">
                        <td>{{ dp.po_id }}</td>
                        <td>{{ dp.dmddesc }}</td>
                        <td>{{ dp.order_quantity }}</td>
                        <td>
                            <div class="btn-group dropleft btn-sm">
                                <button type="button" class="btn btn-light btn-outline-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button class="dropdown-item">Receive</button>
                                    <button class="dropdown-item">Terminate</button>
                                </div>
                            </div>
                        </td>
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
            dmd_po: [],
            search_form: new Form({
                word: '',
            }),
        }
    },
    methods:{
        get_dmd_po(){
            axios.get('../../api/mmo_dmd_po').then(({data}) => {
                this.dmd_po = data;
            }).catch(() => {

            });
        },
        search(){
            this.search_form.post('../../api/mmo_dmd_po_search').then(({data}) => {
                this.dmd_po = data;
            }).catch(() => {

            });
        },
        
    },
    created(){
        this.get_dmd_po();
    }
}
</script>
<style>

</style>