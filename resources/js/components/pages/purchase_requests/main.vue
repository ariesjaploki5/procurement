<template>
    <div class="row">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="public_bidding-tab" data-toggle="tab" href="#public_bidding" role="tab" aria-controls="public_bidding" aria-selected="true">Public Bidding</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="shopping-tab" data-toggle="tab" href="#shopping" role="tab" aria-controls="shopping" aria-selected="false">Shopping</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="public_bidding" role="tabpanel" aria-labelledby="public_bidding-tab">
                <publicbidding></publicbidding>
            </div>
            <div class="tab-pane fade" id="shopping" role="tabpanel" aria-labelledby="shopping-tab">
                <shopping></shopping>
            </div>
        </div>
    </div>
</template>
<script>

import publicbidding from './public_bidding.vue';
import shopping from './shopping.vue';

export default {
    components: {publicbidding, shopping},
    date(){
        return{

        }
    },
    methods:{

    },
    created(){

    },
    computed:{

    },
}
</script>
<style>

</style>
