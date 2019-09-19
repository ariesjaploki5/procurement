<template>
    <div class="container" id="container">
    <button class="btn btn-primary d-print-none button ml-2 mb-2" onclick="print()">Print</button>

    <div class="row">
        <div class="col-12">
            <div class="row bottom">
                <div class="pr col-3 bottom right">
                    <img :src="'/img/bghmc.png'" class="img-thumbnail">
                </div>
                <div class="pr col bottom">
                    <div class="row">
                        <div class="col-12">
                            <div class="pr all text-center">Republic of the Philippines</div>
                            <div class="pr all text-center">Department of Health</div>
                            <div class="pr all text-center font-weight-bold">BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER</div>
                            <div class="pr all text-center">Baguio City</div>
                        </div>
                    </div>
                    <div class="row pr left right bottom">
                        <div class="col mt-3">
                            <div class="text-center"><h1>PURCHASE REQUEST</h1></div>
                        </div>
                        <div class="row">
                            <div class="col ml-2 mr-1">
                                <div class="col pr top bottom right">Form No.: HS - PS - 001</div>
                                <div class="col pr bottom right">Revision No.: 3</div>
                                <div class="col pr bottom right">Effectivity Date: September 1, 2016</div>   
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6 pr all">
            <div class="row">
                <div class="col-3 pr bottom right"><span>Department:</span> </div>
                <div class="col pr right left font-weight-bold"><span>MEDICAL SERVICES</span></div>
            </div>
        </div>
        <div class="col-3 pr all">
            <div class="row">
                <div class="col-5 pr left bottom right"><span>PR No.:</span></div>
                <div class="col pr left right font-weight-bold text-center"><span>{{ pr.pr_id }}</span></div>
            </div>
        </div>
        <div class="col-3 pr all">
            <div class="row">
                <div class="col-3 pr left bottom right"><span>Date:</span></div>
                <div class="col pr left right text-center font-weight-bold">{{ pr.created_at | myDate3 }}</div>
                <div class="col-1 pr left bottom "></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 pr all">
            <div class="row">
                <div class="col-3 pr top bottom right"><span>Section:</span> </div>
                <div class="col pr top right left font-weight-bold"><span>PHARMACY</span></div>
            </div>
        </div>
        <div class="col-3 pr all">
            <div class="row">
                <div class="col-5 pr top left bottom right"><span>SAI No.:</span></div>
                <div class="col pr top left right"></div>
            </div>
        </div>
        <div class="col-3 pr all">
            <div class="row">
                <div class="col-3 pr top left bottom right"><span>Date:</span></div>
                <div class="col pr top left right"></div>
                <div class="col-1 pr top left bottom "></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 pr top bottom right">
            <div class="row">
                <div class="col-3 pr top bottom right"></div>
                <div class="col pr all"></div>
            </div>
        </div>
        <div class="col-3 pr all">
            <div class="row">
                <div class="col-6 pr top left bottom right"><small><span>ORS/BURS No.:</span></small></div>
                <div class="col pr top left right"></div>
            </div>
        </div>
        <div class="col-3 pr all">
            <div class="row">
                <div class="col-3 pr top left bottom right"><span>Date:</span></div>
                <div class="col pr top left right"></div>
                <div class="col-1 pr top left bottom "></div>
            </div>
        </div>
    </div>
    <div class="row"> 
        <div class="col pr top aheight">
        </div> 
    </div>
    <div class="row"> 
        <div class="col pr top right text-center font-weight-bold"><span>Item No.</span></div>
        <div class="col pr top right text-center font-weight-bold"><span>Qty</span></div>
        <div class="col pr top right text-center font-weight-bold"><span>Unit of Issue</span></div>
        <div class="col-4 pr top right text-center font-weight-bold"><span>Item Description</span></div>
        <div class="col pr top right text-center font-weight-bold"><span>Stock No.</span></div>
        <div class="col-2 pr top right text-center font-weight-bold"><span>Estimated Unit Cost</span></div>
        <div class="col-2 pr top text-center font-weight-bold"><span>Estimated Cost</span></div>
    </div>
        <div id="body">
            <div class="row bheight" v-for="dpr in dmd_pr" :key="dpr.dpr_id" id="height"> 
            <div class="col pr top right bottom text-center font-weight-bold"><span>{{ dpr.dmd_id }}</span></div>
            <div class="col pr top right bottom text-center font-weight-bold"><span>{{ dpr.request_quantity | numeral3 }}</span></div>
            <div class="col pr top right bottom text-center font-weight-bold"><span>{{ dpr.unit_desc }}</span></div>
            <div class="col-4 pr top right bottom text-center font-weight-bold"><span>{{ dpr.dmddesc }}</span></div>
            <div class="col pr top right bottom text-center font-weight-bold"><span></span></div>
            <div class="col-2 pr top right bottom text-center font-weight-bold"><span>{{ dpr.cost_price | currency2 }}</span></div>
            <div class="col-2 pr top bottom text-center font-weight-bold"><span>{{ dpr.total_amount | currency2 }}</span></div>
        </div>
    </div>
    <div id="footer">
      <div class="row">
        <div class="col pr top right bottom text-center font-weight-bold"><span></span></div>
        <div class="col pr top right bottom text-center font-weight-bold"><span></span></div>
        <div class="col pr top right bottom text-center font-weight-bold"><span></span></div>
        <div class="col-4 pr top right bottom text-center font-weight-bold"><span></span></div>
        <div class="col pr top right bottom text-center font-weight-bold"><span></span></div>
        <div class="col-2 pr top right bottom text-center font-weight-bold"><span></span></div>
        <div class="col-2 pr top text-center font-weight-bold" style="border-bottom:double"><span>{{ pr.total_amount | currency2 }}</span></div>
    </div>
    <div class="row">
        <div class="col pr top aheight"></div>
    </div>
    <div class="row">
        <div class="col-2 pr right top"><span>Purpose</span></div>
        <div class="col pr left top"><span>{{ pr.purpose }}</span></div>
    </div>
    <div class="row">
        <div class="col-3 pr right top font-weight-bold"><span>Required Attachments:</span></div>
        <div class="col pr left top text-primary font-italic"><span>(For Procurement Management Office only)</span></div>
    </div>
    <div class="row">
        <div class="col pr top bottom right">
            <span style='font-size:22px;'>&#9634;</span><span>Stock Position Sheet for Consumables</span>
            </div>
        <div class="col pr top bottom all">
            <span style='font-size:22px;'>&#9634;</span>
            <span>Acknowledgement Receipt for Equipment</span>
        </div>
        <div class="col pr top bottom left">
            <span style='font-size:22px;'>&#9634;</span>
            <span>Certificate of No suitable subtitute</span>
        </div>
        <div class="w-100"></div>
        <div class="col pr top bottom right">
            <span style='font-size:22px;'>&#9634;</span>
            <span><small>Justification for none inclusion in the PPMP</small></span>
        </div>
        <div class="col pr top bottom all">
            <span style='font-size:22px;'>&#9634;</span>
            <span><small>Biomedical Service Report / MIS Service Report</small></span>
        </div>
        <div class="col pr top bottom left">
            <span style='font-size:22px;'>&#9634;</span>
            <span>Certificate of Exclusive Distributorship</span>
        </div>
        <div class="w-100"></div>
        <div class="col pr top bottom right">
            <span style='font-size:22px;'>&#9634;</span>
            <span><small>Complete generic specification of item/s requested</small></span>
        </div>
        <div class="col pr top bottom all">
            <span style='font-size:22px;'>&#9634;</span>
            <span>Scope of Work / Detailed Estimate</span>
        </div>
        <div class="col pr top bottom left">
            <span style='font-size:22px;'>&#9634;</span>
            <span>Price Quotation</span></div>
        <div class="w-100"></div>
        <div class="col pr top bottom">
            <span style='font-size:22px;'>&#9634;</span>
            <span>Others</span>
        </div>
    </div>
    <div class="row">
        <div class="col pr top aheight"></div>
    </div>
    <div class="row">
        <div class="col-2 pr top right"></div>
        <div class="col-5 pr top"><span>Requested By:</span></div>
        <div class="col-5 pr top left"><span>Approved By:</span></div>
    </div>
    <div class="row">
        <div class="col-2 pr top right"><span>Signature:</span></div>
        <div class="col-5 pr top"></div>
        <div class="col-5 pr top left "></div>
    </div>
    <div class="row">
        <div class="col-2 pr top right"><span>Printed Name:</span></div>
        <div class="col-5 pr top text-center font-weight-bold"><span>RISCILLA E. LAZATIN, MPA</span></div>
        <div class="col-5 pr top left text-center font-weight-bold"><span>RAY P. SUANDING, MD, FPCP, FPCCP</span></div>
    </div>
    <div class="row">
        <div class="col-2 pr top right"><span>Designation:</span></div>
        <div class="col-5 pr top text-center"><span>Pharmacist IV</span></div>
        <div class="col-5 pr top left text-center"><span>Chief Medical Professional Staff II</span></div>
    </div>
    </div>
</div>
</template>

<script>
     export default {
        data(){
            return{
                dmd_pr: [],
                pr: '',
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
        computed:{
            estimated_cost(){
                
                let sum = 0;
                this.pr.dmd_purchase_requests.forEach(function(item) {
                    sum += (parseFloat(item.cost_price) * parseFloat(item.request_quantity));
                });
                    return sum;
                
            
            },

        },
    
    }
    function print(){
        window.print();
        location.reload();
    }
</script>

<style lang="scss">
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

    #container {
        position: relative;
        min-height: 100vh;
    }

    #body {
        padding-bottom: 2.5rem;
    }

    #footer {
        position: absolute;
        bottom: 0;
        width: 97%;
        height: 2.5rem;
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

    .pr {
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
        height: 120px;
    }
    .cheight {
        height: 600px;
    }
</style>
