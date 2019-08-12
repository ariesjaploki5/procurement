<template>
<div>
    <button class="btn btn-primary d-print-none button ml-2 mb-2" onclick="print()">Print</button>
    <div class="row">
        <div class="col-12">
            <div class="row bottom">
                <div class="po col-auto right">
                    <img :src="'/img/bghmc.png'" class="img-thumbnail">
                </div>
                <div class="po col bottom">
                    <div class="row">
                        <div class="col-12">
                            <div class="po all text-center">Republic of the Philippines</div>
                            <div class="po all text-center">Department of Health</div>
                            <div class="po all text-center font-weight-bold">BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER</div>
                            <div class="po all text-center">Baguio City</div>
                        </div>
                    </div>
                    <div class="row po left right">
                        <div class="col">
                            <div class="font-weight-bold text-center mt-3"><h6>NOTICE OF ADJUSTMENT</h6> </div>
                            <div class="form-check mb-2">
                                <span style='font-size:22px;' v-if="noa.ors">&#9746;</span>
                                <span style='font-size:22px;' v-else>&#9634;</span>
                                <label class="form-check-label font-weight-bold ml-2 mt-2" for="defaultCheck1"><h6>OBLIGATION REQUEST AND STATUS</h6></label>
                            </div>
                            <div class="form-check">
                                <span style='font-size:22px;' v-if="noa.burs">&#9746;</span>
                                <span style='font-size:22px;' v-else>&#9634;</span>
                                <label class="form-check-label font-weight-bold ml-2 mt-2" for="defaultCheck2"><h6>BUDGET UTILIZATION REQUEST AND STATUS</h6></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col ml-2 mr-1">
                                <div class="po top bottom right"><small>Form No.: FS-ACC-068</small></div>
                                <div class="po top bottom right"><small>Revision No.: Ø</small></div>
                                <div class="po top right"><small>Effectivity Date: September 1, 2016</small></div>  
                                <div class="po top bottom right"><small><span class="mt-2">No. <b>(2019-series)</b></span></small></div> 
                                <div class="po top bottom right"><small>Date: (Date Today)</small></div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col top bottom po">For: <span class="ml-3">Budget Officer <br></span><span class="ml-5">Budget Unit</span></div>
            </div>
            <div class="row">
                <div class="col top bottom po"></div>
            </div>
            <div class="row">
                <div class="col-4 po top bottom right form-check">
                    <span style='font-size:22px;' v-if="noa.adjust_ors_burs_no">&#9746;</span>
                    <span style='font-size:22px;' v-else>&#9634;</span>
                    <label class="form-check-label ml-4 mt-1">
                        <span class="ml-2">Please adjust ORS / BURS No. </span>
                    </label>
                </div>
                <div class="col-3 po top left right text-center font-weight-bold text-primary">
                    {{ noa.obrs_no }}
                </div>
                <div class="col-2 po all">dated</div>
                <div class="col po left top text-center font-weight-bold text-primary">{{ noa.obrs_date | myDate3 }}</div>
            </div>
            <div class="row">
                <div class="col po top bottom right form-check">
                    <label class="form-check-label ml-4 mt-1">
                        <span>due to the following changes: </span>
                    </label>
                </div>
                <div class="col po all"></div>
                <div class="col po top bottom left text-center font-weight-bold text-danger">REMARKS</div>
            </div>
            <div class="row">
                <div class="col-4 po top bottom right form-check">
                    <span style='font-size:22px;' v-if="noa.resp_center_to">&#9746;</span>
                    <span style='font-size:22px;' v-else>&#9634;</span>
                        <label class="form-check-label mt-1" style="margin-left: 25%">
                            <span>Responsibility Center to </span>
                        </label>
                </div>
                <div class="col po top left right text-center">{{ noa.resp_center_to }}</div>
                <div class="col po top bottom left"></div>
            </div>
            <div class="row">
                <div class="col-4 po top bottom right form-check">
                    <span style='font-size:22px;' v-if="noa.particulars_to">&#9746;</span>
                    <span style='font-size:22px;' v-else>&#9634;</span>
                        <label class="form-check-label mt-1" style="margin-left: 25%">
                            <span>Particulars to </span>
                        </label>
                </div>
                <div class="col po top left right text-center">{{ noa.particulars_to }}</div>
                <div class="col po top bottom left"></div>
            </div>
            <div class="row">
                <div class="col-4 po top bottom right form-check">
                    <span style='font-size:22px;' v-if="noa.mfo_pap_to">&#9746;</span>
                    <span style='font-size:22px;' v-else>&#9634;</span>
                        <label class="form-check-label mt-1" style="margin-left: 25%">
                            <span>MFO/PAP to </span>
                        </label>
                </div>
                <div class="col po top left right text-center">{{ noa.mfo_pap_to }}</div>
                <div class="col po top bottom left"></div>
            </div>
            <div class="row">
                <div class="col-4 po top bottom right form-check">
                    <span style='font-size:22px;' v-if="noa.account_code_to">&#9746;</span>
                    <span style='font-size:22px;' v-else>&#9634;</span>
                        <label class="form-check-label mt-1" style="margin-left: 25%">
                            <span>Account Code to </span>
                        </label>
                </div>
                <div class="col po top left right text-center">{{ noa.account_code_to }}</div>
                <div class="col po top bottom left"></div>
            </div>
            <div class="row">
                <div class="col-4 po top bottom right form-check">
                    <span style='font-size:22px;' v-if="noa.amount_to_p">&#9746;</span>
                    <span style='font-size:22px;' v-else>&#9634;</span>
                    <label class="form-check-label mt-1" style="margin-left: 25%">
                        <span>Amount to P </span>
                    </label>
                </div>
                <div class="col po top left right text-right">{{ noa.total_amount | currency }}</div>
                <div class="col po top bottom left"></div>
            </div>
            <div class="row">
                <div class="col-9 po top bottom right form-check">
                    <span style='font-size:22px;' v-if="noa.adjust_raod">&#9746;</span>
                    <span style='font-size:22px;' v-else>&#9634;</span>
                    <label class="form-check-label mt-1" style="margin-left: 5%">
                        <span>Please adjust RAOD / RBUD for excess / under obligation per attached JEV No. </span>
                    </label>
                </div>
                <div class="col-2 po top left right">{{ noa.remarks }}</div>
                <div class="col po top bottom left"></div>
            </div>
            <div class="row">
                <div class="col-3 po top bottom right">
                    <span style="margin-left: 20%">dated</span>
                </div>
                <div class="col-3 po top left right">{{ noa.adjust_raod }}</div>
                <div class="col po top bottom left"></div>
            </div>
            <div class="row">
                <div class="col top po aheight"></div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-1 po top text-center font-weight-bold ">
                            <span>A</span>
                        </div>
                        <div class="col po top bottom left">Prepared by:</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-1 po top left text-center font-weight-bold ">
                            <span>B</span>
                        </div>
                        <div class="col po top bottom left">Approved by:</div>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-6 po top bottom bheight"></div>
                    <div class="col-6 po top bottom left bheight"></div>
                </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-9 po top right text-center font-weight-bold ">End User</div>
                        <div class="col po top left bottom text-white">1</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-9 po top left right text-center font-weight-bold ">CECILIA J. PUGONG</div>
                        <div class="col po top left bottom text-white">1</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-9 po top right text-center font-weight-bold"><small>End User Position</small></div>
                        <div class="col po top left text-white">1</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-9 po top left right text-center font-weight-bold "><small>Head, Accounting Section</small></div>
                        <div class="col po top left text-white">1</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-1 po top text-center font-weight-bold ">
                            <span>C</span>
                        </div>
                        <div class="col po top bottom left">Certified Correct:</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-1 po top left text-center font-weight-bold ">
                            <span>D</span>
                        </div>
                        <div class="col po top bottom left">Verified by:</div>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-6 po top bottom bheight"></div>
                    <div class="col-6 po top bottom left bheight"></div>
                </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-9 po top right text-center font-weight-bold ">EDWARD C. PUDLAO, CPA, MBA</div>
                        <div class="col po top left bottom text-center"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-9 po top left right text-center font-weight-bold ">EDNA L. MOGAMOG, CPA, MBA</div>
                        <div class="col po top left bottom text-white">1</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-9 po top right text-center font-weight-bold"><small>Financial & Management Officer II <br><span class="text-white">fsdf</span></small></div>
                        <div class="col po top left text-white">1</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-9 po top left right text-center font-weight-bold "><small>Supervising Administrative Officer <br>Head, Budget Office</small></div>
                        <div class="col po top left text-white">1</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col po all aheight"></div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="row bottom">
                <div class="po col-auto right">
                    <img :src="'/img/bghmc.png'" class="img-thumbnail">
                </div>
                <div class="po col bottom">
                    <div class="row">
                        <div class="col-12">
                            <div class="po all text-center">Republic of the Philippines</div>
                            <div class="po all text-center">Department of Health</div>
                            <div class="po all text-center font-weight-bold">BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER</div>
                            <div class="po all text-center">Baguio City</div>
                        </div>
                    </div>
                    <div class="row po left right">
                        <div class="col">
                            <div class="font-weight-bold text-center mt-3"><h6>NOTICE OF ADJUSTMENT</h6> </div>
                            <div class="form-check mb-2">
                                <span style='font-size:22px;' v-if="noa.ors">&#9746;</span>
                                <span style='font-size:22px;' v-else>&#9634;</span>
                                <label class="form-check-label font-weight-bold ml-2 mt-2" for="defaultCheck1"><h6>OBLIGATION REQUEST AND STATUS</h6></label>
                            </div>
                            <div class="form-check">
                                <span style='font-size:22px;' v-if="noa.burs">&#9746;</span>
                                <span style='font-size:22px;' v-else>&#9634;</span>
                                <label class="form-check-label font-weight-bold ml-2 mt-2" for="defaultCheck2"><h6>BUDGET UTILIZATION REQUEST AND STATUS</h6></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col ml-2 mr-1">
                                <div class="po top bottom right"><small>Form No.: FS-ACC-068</small></div>
                                <div class="po top bottom right"><small>Revision No.: Ø</small></div>
                                <div class="po top right"><small>Effectivity Date: September 1, 2016</small></div>  
                                <div class="po top bottom right"><small><span class="mt-2">No. <b>(2019-series)</b></span></small></div> 
                                <div class="po top bottom right"><small>Date: (Date Today)</small></div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col top bottom po">For: <span class="ml-3">Budget Officer <br></span><span class="ml-5">Budget Unit</span></div>
            </div>
            <div class="row">
                <div class="col top bottom po"></div>
            </div>
            <div class="row">
                <div class="col-4 po top bottom right form-check">
                    <span style='font-size:22px;' v-if="noa.adjust_ors_burs_no">&#9746;</span>
                    <span style='font-size:22px;' v-else>&#9634;</span>
                    <label class="form-check-label ml-4 mt-1">
                        <span class="ml-2">Please adjust ORS / BURS No. </span>
                    </label>
                </div>
                <div class="col-3 po top left right text-center font-weight-bold text-primary">
                    {{ noa.obrs_no }}
                </div>
                <div class="col-2 po all">dated</div>
                <div class="col po left top text-center font-weight-bold text-primary">{{ noa.obrs_date | myDate3 }}</div>
            </div>
            <div class="row">
                <div class="col po top bottom right form-check">
                    <label class="form-check-label ml-4 mt-1">
                        <span>due to the following changes: </span>
                    </label>
                </div>
                <div class="col po all"></div>
                <div class="col po top bottom left text-center font-weight-bold text-danger">REMARKS</div>
            </div>
            <div class="row">
                <div class="col-4 po top bottom right form-check">
                    <span style='font-size:22px;' v-if="noa.resp_center_to">&#9746;</span>
                    <span style='font-size:22px;' v-else>&#9634;</span>
                        <label class="form-check-label mt-1" style="margin-left: 25%">
                            <span>Responsibility Center to </span>
                        </label>
                </div>
                <div class="col po top left right text-center">{{ noa.resp_center_to }}</div>
                <div class="col po top bottom left"></div>
            </div>
            <div class="row">
                <div class="col-4 po top bottom right form-check">
                    <span style='font-size:22px;' v-if="noa.particulars_to">&#9746;</span>
                    <span style='font-size:22px;' v-else>&#9634;</span>
                        <label class="form-check-label mt-1" style="margin-left: 25%">
                            <span>Particulars to </span>
                        </label>
                </div>
                <div class="col po top left right text-center">{{ noa.particulars_to }}</div>
                <div class="col po top bottom left"></div>
            </div>
            <div class="row">
                <div class="col-4 po top bottom right form-check">
                    <span style='font-size:22px;' v-if="noa.mfo_pap_to">&#9746;</span>
                    <span style='font-size:22px;' v-else>&#9634;</span>
                        <label class="form-check-label mt-1" style="margin-left: 25%">
                            <span>MFO/PAP to </span>
                        </label>
                </div>
                <div class="col po top left right text-center">{{ noa.mfo_pap_to }}</div>
                <div class="col po top bottom left"></div>
            </div>
            <div class="row">
                <div class="col-4 po top bottom right form-check">
                    <span style='font-size:22px;' v-if="noa.account_code_to">&#9746;</span>
                    <span style='font-size:22px;' v-else>&#9634;</span>
                        <label class="form-check-label mt-1" style="margin-left: 25%">
                            <span>Account Code to </span>
                        </label>
                </div>
                <div class="col po top left right text-center">{{ noa.account_code_to }}</div>
                <div class="col po top bottom left"></div>
            </div>
            <div class="row">
                <div class="col-4 po top bottom right form-check">
                    <span style='font-size:22px;' v-if="noa.amount_to_p">&#9746;</span>
                    <span style='font-size:22px;' v-else>&#9634;</span>
                    <label class="form-check-label mt-1" style="margin-left: 25%">
                        <span>Amount to P </span>
                    </label>
                </div>
                <div class="col po top left right text-right">{{ noa.total_amount | currency }}</div>
                <div class="col po top bottom left"></div>
            </div>
            <div class="row">
                <div class="col-9 po top bottom right form-check">
                    <span style='font-size:22px;' v-if="noa.adjust_raod">&#9746;</span>
                    <span style='font-size:22px;' v-else>&#9634;</span>
                    <label class="form-check-label mt-1" style="margin-left: 5%">
                        <span>Please adjust RAOD / RBUD for excess / under obligation per attached JEV No. </span>
                    </label>
                </div>
                <div class="col-2 po top left right">{{ noa.remarks }}</div>
                <div class="col po top bottom left"></div>
            </div>
            <div class="row">
                <div class="col-3 po top bottom right">
                    <span style="margin-left: 20%">dated</span>
                </div>
                <div class="col-3 po top left right">{{ noa.adjust_raod }}</div>
                <div class="col po top bottom left"></div>
            </div>
            <div class="row">
                <div class="col top po aheight"></div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-1 po top text-center font-weight-bold ">
                            <span>A</span>
                        </div>
                        <div class="col po top bottom left">Prepared by:</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-1 po top left text-center font-weight-bold ">
                            <span>B</span>
                        </div>
                        <div class="col po top bottom left">Approved by:</div>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-6 po top bottom bheight"></div>
                    <div class="col-6 po top bottom left bheight"></div>
                </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-9 po top right text-center font-weight-bold ">End User</div>
                        <div class="col po top left bottom text-white">1</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-9 po top left right text-center font-weight-bold ">CECILIA J. PUGONG</div>
                        <div class="col po top left bottom text-white">1</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-9 po top right text-center font-weight-bold"><small>End User Position</small></div>
                        <div class="col po top left text-white">1</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-9 po top left right text-center font-weight-bold "><small>Head, Accounting Section</small></div>
                        <div class="col po top left text-white">1</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-1 po top text-center font-weight-bold ">
                            <span>C</span>
                        </div>
                        <div class="col po top bottom left">Certified Correct:</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-1 po top left text-center font-weight-bold ">
                            <span>D</span>
                        </div>
                        <div class="col po top bottom left">Verified by:</div>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-6 po top bottom bheight"></div>
                    <div class="col-6 po top bottom left bheight"></div>
                </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-9 po top right text-center font-weight-bold ">EDWARD C. PUDLAO, CPA, MBA</div>
                        <div class="col po top left bottom text-center"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-9 po top left right text-center font-weight-bold ">EDNA L. MOGAMOG, CPA, MBA</div>
                        <div class="col po top left bottom text-white">1</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-9 po top right text-center font-weight-bold"><small>Financial & Management Officer II <br><span class="text-white">fsdf</span></small></div>
                        <div class="col po top left text-white">1</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-9 po top left right text-center font-weight-bold "><small>Supervising Administrative Officer <br>Head, Budget Office</small></div>
                        <div class="col po top left text-white">1</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data(){
        return{
            noa: {},
        }
    },
    methods: {
        get_noa(){
            axios.get('../../api/notice_of_adjustment/'+this.$route.params.id).then(({data}) => {
                this.noa = data;
            }).catch(() => {

            });
        }
    },
    created(){
        this.get_noa();
    }
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

    input.box {
        height: 20px;
        width: 20px;
    }

    .img-thumbnail {
        border: none;
        display: block;
        margin-top: 10%;
        margin-left: auto;
        margin-right: auto;
        width: 65%;
    }

    div.font {
        font-family: 'Helvetica', sans-serif;
    }

    div.po {
        border-collapse: collapse;
        border: 1px solid black;
    }

    div.top {
        border-top: none;
    }

    div.bottom {
        border-bottom: none;
    }

    div.left {
        border-left: none;
    }

    div.right {
        border-right: none;
    }

    div.all {
        border-top: none;
        border-right: none;
        border-left: none;
        border-bottom: none;
    }
    div.aheight {
        height: 15px;
    }
    div.bheight {
        height: 25px;
    }




</style>
