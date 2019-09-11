<template>
<div class="container">
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
                            <div class="text-center"><h1>CONSIGNMENT REQUEST</h1></div>
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
        <div class="col pr bottom aheight">
        </div> 
    </div>
    <div class="row">
        <div class="col-6 pr all">
            <div class="row">
                <div class="col-3 pr bottom right"><span>Department:</span> </div>
                <div class="col-5 pr right left font-weight-bold">MEDICAL SERVICES</div>
            </div>
        </div>
        <div class="col-3 pr all">
            <div class="row">
                <div class="col-6 pr left bottom right"><span>PR No.:</span></div>
                <div class="col pr left right font-weight-bold"><small>{{ cpr.crID}}</small></div>
            </div>
        </div>
        <div class="col-3 pr all">
            <div class="row">
                <div class="col-3 pr left bottom right"><span>Date:</span></div>
                <div class="col pr left right font-weight-bold">{{ cpr.crDate | myDate3 }}</div>
                <div class="col-1 pr left bottom "></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 pr all">
            <div class="row">
                <div class="col-3 pr top bottom right"><span>Section:</span> </div>
                <div class="col-5 pr top right left font-weight-bold">PHARMACY</div>
            </div>
        </div>
        <div class="col-3 pr all">
            <div class="row">
                <div class="col-6 pr top left bottom right"><span>SAI No.:</span></div>
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
        <div class="col-6 pr all">
            <div class="row">
                <div class="col-3 pr top bottom right text-white">1</div>
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
    <div class="row cheight" v-for="(md, index) in cpr.details" :key="md.id"> 
        <div class="col pr top right bottom text-center font-weight-bold"><span>{{ index+1 }}</span></div>
        <div class="col pr top right bottom text-center font-weight-bold"><span>{{ md.itemQty }}</span></div>
        <div class="col pr top right bottom text-center font-weight-bold"><span></span></div>
        <div class="col-4 pr top right bottom text-center font-weight-bold"><span>{{ md.mds_consignment.cl1desc }}{{ md.mds_consignment.cl2desc }}</span></div>
        <div class="col pr top right bottom text-center font-weight-bold"><span></span></div>
        <div class="col-2 pr top right bottom text-center font-weight-bold"><span>{{ md.itemPrice | currency2 }}</span></div>
        <div class="col-2 pr top bottom text-center font-weight-bold">
                <span v-if="md.itemQty">{{ md.itemQty * md.itemPrice | currency2 }}</span>
                <span v-else></span></div>
    </div>
    <div class="row">
        <div class="col pr top right bottom text-center font-weight-bold"><span></span></div>
        <div class="col pr top right bottom text-center font-weight-bold"><span></span></div>
        <div class="col pr top right bottom text-center font-weight-bold"><span></span></div>
        <div class="col-4 pr top right bottom text-center font-weight-bold"><span></span></div>
        <div class="col pr top right bottom text-center font-weight-bold"><span></span></div>
        <div class="col-2 pr top right bottom text-center font-weight-bold"><span></span></div>
        <div class="col-2 pr top text-center font-weight-bold" style="border-bottom:double"><span>{{ estimated_cost | currency2 }}</span></div>
    </div>
    <div class="row">
        <div class="col pr top aheight"></div>
    </div>
    <div class="row">
        <div class="col-2 pr right top"><span>Purpose</span></div>
        <div class="col pr left top"><span>{{ cpr.purpose }} - {{ cpr.hperson.patfirst }} {{ cpr.hperson.patmiddle }} {{ cpr.hperson.patlast }} - {{ cpr.hperson.hpercode }}</span></div>
    </div>
    <div class="row">
        <div class="col-3 pr right top font-weight-bold"><span>Required Attachments:</span></div>
        <div class="col pr left top text-primary font-italic"><span>(For Procurement Management Office only)</span></div>
    </div>
    <div class="row">
        <div class="col pr top bottom right"><input type="checkbox"><span> Stock Position Sheet for Consumables</span></div>
        <div class="col pr top bottom all"><input type="checkbox"><span> Acknowledgement Receipt for Equipment</span></div>
        <div class="col pr top bottom left"><input type="checkbox"><span> Certificate of No suitable subtitute</span></div>
        <div class="w-100"></div>
        <div class="col pr top bottom right"><input type="checkbox"><span> Justification for none inclusion in the PPMP</span></div>
        <div class="col pr top bottom all"><input type="checkbox"><span> Biomedical Service Report / MIS Service Report</span></div>
        <div class="col pr top bottom left"><input type="checkbox"><span> Certificate of Exclusive Distributorship</span></div>
        <div class="w-100"></div>
        <div class="col pr top bottom right"><input type="checkbox"><span> Complete generic specification of item/s requested</span></div>
        <div class="col pr top bottom all"><input type="checkbox"><span> Scope of Work / Detailed Estimate</span></div>
        <div class="col pr top bottom left"><input type="checkbox"><span> Price Quotation</span></div>
        <div class="w-100"></div>
        <div class="col pr top"><input type="checkbox"><span> Others</span></div>
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
        <div class="col-2 pr top right"><span>Printed Name:</span></div>
        <div class="col-5 pr top text-center"><span>Pharmacist IV</span></div>
        <div class="col-5 pr top left text-center"><span>Chief Medical Professional Staff II</span></div>
    </div>
</div>
</template>

<script>
     export default {
        data(){
            return{
                cpr: [],

            }
        },
        methods:{
            get_cpr(){
                axios.get('../../api/cpr/'+this.$route.params.id).then(({data}) => {
                    this.cpr = data;
                }).catch(() => {

                });
            }
        },
        created(){
            this.get_cpr();
        },
        computed:{
            estimated_cost(){
                let sum = 0;
                this.cpr.details.forEach(function(md) {
                    sum += (parseFloat(md.itemPrice) * parseFloat(md.itemQty));
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
        height: 20px;
    }
    .cheight {
        height: 300px;
    }   
</style>
