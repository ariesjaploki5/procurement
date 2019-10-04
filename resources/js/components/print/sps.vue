<template>
<div>
    <button class="btn btn-primary d-print-none button ml-2 mb-2" onclick="print()">Print</button>
    <div v-for="dmd_pr in dmd_pr" :key="dmd_pr.dmd_pr_id">
        <div class="row">
            <div class="col-12">
                <div class="row bottom">
                    <div class="sps col-auto bottom right">
                        <img :src="'/img/bghmc.png'" class="img-thumbnail">
                    </div>
                    <div class="sps col bottom">
                        <div class="row">
                            <div class="col-12">
                                <div class="sps all text-center">Republic of the Philippines</div>
                                <div class="sps all text-center">Department of Health</div>
                                <div class="sps all text-center font-weight-bold">BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER</div>
                                <div class="sps all text-center">Baguio City</div>
                            </div>
                        </div>
                        <div class="row sps left right bottom">
                            <div class="col">
                                <div class="po all text-center text-muted">MATERIALS MANAGEMENT OFFICE</div>
                                <div class="text-center"><h2>STOCK POSITION SHEET</h2></div>
                            </div>
                            <div class="row">
                                <div class="col ml-2 mr-1">
                                    <div class="col sps top bottom right"> Form No.: HS-PS-005</div>
                                    <div class="col sps bottom right mr-2"> Revision No.: Ø</div>
                                    <div class="col sps bottom right mr-2">Effectivity Date: August 1, 2014</div>   
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col sps bottom aheight">
            </div> 
        </div>
        <div class="row">
            <div class="col-2 sps all text-center">
                <div class="row">

                </div>
                <div class="row">
                    <span>Articles: </span>
                </div>
                
            </div>
            <div class="col-6 sps top left right font-weight-bold text-primary ">
                <div class="row">

                </div>
                <div class="row">
                    <h5>{{ dmd_pr.dmddesc }}</h5>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-3 sps all font-weight-bold">UNIT:</div>
                    <div class="col-9 sps top left right text-center font-weight-bold">{{ dmd_pr.unit_desc }}</div>
                </div>
                <div class="row">
                    <div class="col-3 sps all font-weight-bold">SSL:</div>
                    <div class="col-9 sps top left right text-center font-weight-bold">{{ dmd_pr.ssl | numeral3 }}</div>
                </div>
            </div>
                <div class="w-100"></div>

            <div class="col-2 sps all bheight text-center">1.</div>
            <div class="col-7 sps all ">Balance on Hand</div>
            <div class="col sps top left right text-center font-weight-bold">{{ dmd_pr.boh | numeral3 }}</div>

                <div class="w-100"></div>

            <div class="col-2 sps all bheight text-center">2.</div>
            <div class="col-7 sps all">Item in Transit</div>
            <div class="col sps top left right text-center font-weight-bold">{{ dmd_pr.last_iit | numeral3 }}</div>

                <div class="w-100"></div>

            <div class="col-2 sps all bheight text-center">3.</div>
            <div class="col-7 sps all">This Requisition</div>
            <div class="col sps top left right text-center font-weight-bold">{{ dmd_pr.request_quantity | numeral3 }}</div>

                <div class="w-100"></div>

            <div class="col-2 sps all bheight text-center">4.</div>
            <div class="col-7 sps all">Total Expected Stocks (Sum of Lines 1 to 3)</div>
            <div class="col sps top left right text-center font-weight-bold">{{ dmd_pr.total_expect | numeral3 }}</div>
            
                <div class="w-100"></div>

            <div class="col-2 sps all bheight text-center">5.</div>
            <div class="col-7 sps all">Monthly Average Consumption</div>
            <div class="col sps top left right text-center font-weight-bold">{{ dmd_pr.ssl/ 2 | numeral3 }}</div>
            <div class="w-100"></div>

            <div class="col-2 sps all bheight text-center">6.</div>
            <div class="col-7 sps all">Estimated No. of Months to Consume (Line 4 to 5)</div>
            <div class="col sps top left right text-center font-weight-bold"> 2 Months</div>
            <div class="w-100"></div>

            <div class="col-2"></div>
            <div class="col sps all dheight">I certify to the fairness and reasonableness of the the above data.</div>
            <div class="w-100"></div>

            <div class="col-4 sps top left right"></div>
            <div class="col-4 sps all"></div>
            <div class="col-4 sps top left right text-center font-weight-bold">{{ pr.created_at | myDate4 }}</div>
            <div class="w-100"></div>
            
            <div class="col-4 sps all text-center font-weight font-weight-bold">RISCILLA E. LAZATIN, MPA</div>
            <div class="col-6 ml-4 sps all text-right font-weight font-weight-bold">Date</div>
            <div class="w-100"></div>

            <div class="col-4 sps all text-center font-weight font-weight-bold cheight">Head, Pharmacy Section</div>
            <div class="w-100"></div>
            
            <div class="col sps all cheight">Note: Attached written justification for requisition in excess of normal requirements.</div>
            <div class="w-100"></div>

            <div class="col sps" style="border:dotted"></div>
            <div class="w-100"></div>
            <div class="col cheight"></div>
        </div>  
    </div>
</div>
</template>

<script>
export default {
        data(){
        return{
            dmd_pr: [],
            pr: {},
        }
    },
    methods:{
        get_pr(){
            axios.get('../../api/purchase_request/'+this.$route.params.id).then(({data}) => {
                this.dmd_pr = data;
            }).catch(() => {

            });
        },
        get_pr_2(){
                axios.get('../../api/get_pr/'+this.$route.params.id).then(({data}) => {
                    this.pr = data;
                }).catch(() => {

                });
            }


    },
    created(){
        this.get_pr();
        this.get_pr_2();
    },
    mounted() {

    }
}
</script>

<style lang="scss" scoped>
.img-thumbnail{
        margin-top: 0% !important;
    }
@font-face {
        font-family: 'Helvetica';
        src: url('https://fonts.googleapis.com/css?family=Helvetica');
        font-weight: normal;
        font-style: normal;
    }
    .container {
        border: none;
    }

    .img-thumbnail {
        border: none;
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 65%;
    }

    .font {
        font-family: 'Helvetica', sans-serif;
    }

    .sps {
        border-collapse: collapse;
        border: 1px solid black;
    }

    .top {
        border-top: none;
    }

    .bottom {
        border-bottom: none;
    }

    .left {
        border-left: none;
    }

    .right {
        border-right: none;
    }

    .all {
        border-top: none;
        border-right: none;
        border-left: none;
        border-bottom: none;
    }
    .aheight {
        height: 5px;
    }
    .bheight {
        height: 30px;
    }
    .dheight {
        height: 100px;
    }
    .cheight {
        height: 50px;
    }
    #footer {
        position: fixed;
        bottom: 0;
        width: auto;
        margin-left: -1.3%;
    }
</style>
