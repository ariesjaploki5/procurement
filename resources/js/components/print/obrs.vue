<template>
    <div>
        <button class="btn btn-primary d-print-none button ml-2 mb-2" onclick="print()">Print</button>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="row bottom">
                    <div class="ors col-auto bottom right">
                      <img :src="'/img/bghmc.png'" class="img-thumbnail">
                    </div>
                    <div class="ors col bottom">
                        <div class="row">
                            <div class="col-12">
                                <div class="ors all text-center">Republic of the Philippines</div>
                                <div class="ors all text-center">Department of Health</div>
                                <div class="ors all text-center font-weight-bold">BAGUIO GENERAL HOSPITAL AND MEDICAL
                                    CENTER</div>
                                <div class="ors all text-center">Baguio City</div>
                            </div>
                        </div>
                        <div class="row ors left right bottom">
                            <div class="col" v-if="purchase_order.to_id == 2">
                                <div class="form-check">
                                 
                                <span style='font-size:22px;'>&#9634;</span>
                                    <label class="form-check-label font-weight-bold" for="defaultCheck1">
                                        <h6>OBLIGATION REQUEST AND STATUS</h6>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <span style='font-size:22px;' >&#9746;</span>
                              
                                    <label class="form-check-label font-weight-bold" for="defaultCheck2">
                                        <h6>BUDGET UTILIZATION REQUEST AND STATUS</h6>
                                    </label>
                                </div>
                            </div>
                            <div class="col" v-else>
                                <div class="form-check">
                                    <span style='font-size:22px;'>&#9746;</span>
                                
                                    <label class="form-check-label font-weight-bold" for="defaultCheck1">
                                        <h6>OBLIGATION REQUEST AND STATUS</h6>
                                    </label>
                                </div>
                                <div class="form-check">
                                    
                                <span style='font-size:22px;'>&#9634;</span>
                                    <label class="form-check-label font-weight-bold" for="defaultCheck2">
                                        <h6>BUDGET UTILIZATION REQUEST AND STATUS</h6>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col ml-2 mr-1">
                                    <div class="col ors top bottom right">Form No.: FS-BUD-001</div>
                                    <div class="col ors bottom right">Revision No.: 2</div>
                                    <div class="col ors bottom right">Effectivity Date: September 1, 2016</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6 ors bottom right">
                <div class="row">
                    <div class="col-3 ors all">Payee:</div>
                    <div class="col-8 ors top left right"><span>{{ purchase_order.supplier_name }}</span></div>
                    <div class="col ors all"></div>
                    <div class="w-100"></div>

                    <div class="col-3 ors all">Office:</div>
                    <div class="col-8 ors top left right"></div>
                    <div class="col ors all"></div>
                    <div class="w-100"></div>

                    <div class="col-3 ors all">Address:</div>
                    <div class="col-8 ors top left right"> {{ purchase_order.supplier_address }}</div>
                    <div class="col ors all"></div>
                    <div class="w-100"></div>
                </div>
            </div>
            <div class="col-6 ors bottom">
                <div class="row">
                    <div class="col-3 ors all">Serial No:</div>
                    <div class="col-8 ors top left right">{{ purchase_order.obrs_no }}</div>
                    <div class="col ors all"></div>
                    <div class="w-100"></div>

                    <div class="col-3 ors all">Date:</div>
                    <div class="col-8 ors top left right">
                        <span v-if="purchase_order.obrs_date">{{ purchase_order.obrs_date | myDate3 }}</span>
                        
                    </div>
                    <div class="col ors all"></div>
                    <div class="w-100"></div>

                    <div class="col-3 ors all">Fund Cluster:</div>
                    <div class="col-8 ors top left right">{{ purchase_order.fund_cluster }}</div>
                    <div class="col ors all"></div>
                    <div class="w-100"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6 ors top right aheight"></div>
            <div class="col-6 ors top aheight"></div>
        </div>

        <div class="row">
            <div class="col-2 ors top right text-center font-weight-bold">
                <span>Responsibility Center</span>
            </div>
            <div class="col-4 ors top right text-center font-weight-bold">
                <span>Particulars</span>
            </div>
            <div class="col ors top right text-center font-weight-bold">
                <span>MFO/PAP</span>
            </div>
            <div class="col ors top right text-center font-weight-bold">
                <span>UACS Object Code/Expenditures</span>
            </div>
            <div class="col ors top text-center font-weight-bold">
                <span>Amount</span>
            </div>
        </div>

        <div id="body">
            <div class="row">
                <div class="col-2 ors top right text-center font-weight-bold">
                    <span>Main Pharmacy</span>
                </div>
                <div class="col-4 ors top right font-weight-bold">
                    <span>{{  dmd_purchase_orders.dmddesc }}<br>
                    Brand: {{ dmd_purchase_orders.brand_desc }}<br>
                    Packaging: {{ dmd_purchase_orders.packaging_desc }}<br>
                    Manufacturer: {{ dmd_purchase_orders.manufacturer_desc }}<br>
                    Country of Origin: {{ dmd_purchase_orders.country_desc }}<br>
                    CPR:
                    </span>
                </div>
                <div class="col ors top right text-center font-weight-bold">
                    <span>3</span>
                </div>
                <div class="col ors top right text-center font-weight-bold">
                    <span>
                        <div v-for="(uc, index) in uacs_codes" :key="index">{{ uc.uacs_code }}</div>
                    </span>
                </div>
                <div class="col ors top text-center font-weight-bold">
                    <span>
                        <div v-for="(uc, index) in uacs_codes" :key="index">{{ uc.amount | currency2 }}</div>
                    </span>
                </div>
            </div>
        </div>
        
        <div id="body">
            <div class="row">
                <div class="col-2 ors right text-center font-weight-bold">
                    <span></span>
                </div>
                <div class="col-4 ors right text-right font-weight-bold">
                    <span>Total</span>
                </div>
                <div class="col ors right text-center font-weight-bold">
                    <span></span>
                </div>
                <div class="col ors right text-center font-weight-bold">
                    <span></span>
                </div>
                <div class="col ors text-center font-weight-bold">
                 <span>{{ purchase_order.total_amount | currency2 }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-auto ors right text-center font-weight-bold ">
                            <span>A</span>
                        </div>
                        <div class="col ors top bottom right"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-auto ors top text-center font-weight-bold">
                            <span>B</span>
                        </div>
                        <div class="col ors top bottom left"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-1 ors top bottom right"></div>
                        <div class="col ors all"><span>Certified: Charges to appropriation/allotment/budget necessary,
                                lawful and under my direct supervision; and supporting documents valid, proper and
                                legal.</span></div>
                        <div class="w-100"></div>

                        <div class="col-3 ors top bottom right">Signature:</div>
                        <div class="col ors top left right"></div>
                        <div class="col-1 ors all"></div>
                        <div class="w-100"></div>

                        <div class="col-3 ors top bottom right">Printed Name:</div>
                        <div class="col ors top left right text-center font-weight-bold">RAY P. SUANDING, MD, FPCP, FPCCP
                        </div>
                        <div class="col-1 ors all"></div>
                        <div class="w-100"></div>

                        <div class="col-3 ors top bottom right">Position:</div>
                        <div class="col ors top left right text-center">Chief Medical Professional Staff II</div>
                        <div class="col-1 ors all"></div>
                        <div class="w-100"></div>

                        <div class="col ors top right bottom bheight"></div>
                        <div class="w-100"></div>

                        <div class="col-3 ors top bottom right">Date:</div>
                        <div class="col ors top left right"></div>
                        <div class="col-1 ors all"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-1 ors top bottom right"></div>
                        <div class="col ors top bottom left"><span>Certified: Allotment / Budget available and obligated /
                                utilized for the purpose / adjustment necessary as indicated above. </span></div>
                        <div class="w-100"></div>
                        <div class="col ors top bottom dheight"></div>
                        <div class="w-100"></div>

                        <div class="col-3 ors top bottom right">Signature:</div>
                        <div class="col ors top left right"></div>
                        <div class="col-1 ors top left bottom"></div>
                        <div class="w-100"></div>

                        <div class="col-3 ors top bottom right">Printed Name:</div>
                        <div class="col ors top left right text-center font-weight-bold">EDNA L. MOGAMOG, CPA, MBA</div>
                        <div class="col-1 ors top left bottom"></div>
                        <div class="w-100"></div>

                        <div class="col-3 ors top bottom right">Position:</div>
                        <div class="col ors top left right text-center"><small>Supervising Administrative Officer<br>
                                Head, Budget Office</small></div>
                        <div class="col-1 ors top left bottom"></div>
                        <div class="w-100"></div>

                        <div class="col-3 ors top bottom right">Date:</div>
                        <div class="col ors top left right"></div>
                        <div class="col-1 ors top bottom left"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 ors top aheight "></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-auto ors top text-center font-weight-bold ">
                            <span>C</span>
                        </div>
                        <div class="col ors top left text-center font-weight-bold">STATUS OF OBLIGATION /
                            UTILIZATION</div>
                    </div>
                    <div class="row">
                        <div class="col ors top right bottom text-center font-weight-bold">
                            <span>Reference</span>
                            <div class="row">
                                <div class="col-2 ors left right bottom text-center font-weight-bold">Date</div>
                                <div class="col-3 ors right bottom text-center font-weight-bold">Particulars
                                </div>
                                <div class="col ors right bottom text-center font-weight-bold">ORS/BURS/JEV/Check
                                    /RCI/ADA</div>
                            </div>
                        </div>
                        <div class="col ors top bottom text-center font-weight-bold">
                            <span>Amount</span>
                            <div class="row">
                                <div class="col-4 ors bottom left"><small><span>Obligation / Utilization</span></small>
                                </div>
                                <div class="col-2 ors bottom left right"><small><span>Payable</span></small>
                                </div>
                                <div class="col-2 ors bottom right"><small><span>Payment</span></small></div>
                                <div class="col ors right bottom"><span>Balance</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col ors bottom">
                            <div class="row">
                                <div class="col-2 ors all"></div>
                                <div class="col-3 ors top bottom right"></div>
                                <div class="col ors right top  bottom eheight"> </div>
                            </div>
                        </div>
                        <div class="col ors left bottom">
                            <div class="row">
                                <div class="col-4 ors top left"></div>
                                <div class="col-2 ors top left right"></div>
                                <div class="col-2 ors top right"></div>
                                <div class="col ors top bottom right">
                                    <div class="row">
                                        <div class="col-6 ors top left text-center">
                                            <small>
                                                <span>Not Yet Due</span>
                                            </small>
                                        </div>
                                        <div class="col-6 ors text-center top left right">
                                            <small>
                                                <span>Due and Demandable</span>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col ors top right">
                            <div class="row">
                                <div class="col-2 ors all dheight"></div>
                                <div class="col-3 ors top bottom right"></div>
                                <div class="col ors right bottom top"><span></span></div>
                            </div>
                        </div>
                        <div class="col ors top right bottom">
                            <div class="row">
                                <div class="col-4 ors top left text-center">(a)</div>
                                <div class="col-2 ors top left right text-center">(b)</div>
                                <div class="col-2 ors top right text-center">(c)</div>
                                <div class="col ors top">
                                    <div class="row">
                                        <div class="col-6 ors top left bottom text-center">
                                            <small><span>(a-b)</span></small></div>
                                        <div class="col-6 ors text-center all"><small><span>(b-c)</span></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col ors top right">
                            <div class="row">
                                <div class="col-2 ors all dheight">{{ purchase_order.obrs_date | myDate6 }}</div>
                                <div class="col-3 ors top bottom right">
                                    <span v-if="purchase_order.to_id == 1">Obligation</span>
                                    <span v-else>Utilization</span>
                                </div>
                                <div class="col ors right bottom top">
                                    <span>{{ purchase_order.obrs_no }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col ors top right bottom">
                            <div class="row">
                                <div class="col-4 ors top left text-center">
                                    <span>{{ purchase_order.total_amount }}</span>
                                </div>
                                <div class="col-2 ors top left right text-center">
                                    <span>{{ purchase_order.total_amount }}</span>
                                </div>
                                <div class="col-2 ors top right text-center"></div>
                                <div class="col ors top">
                                    <div class="row">
                                        <div class="col-6 ors top left bottom text-center">
                                            <small>
                                                <span></span>
                                            </small>
                                        </div>
                                        <div class="col-6 ors text-center all dheight">
                                            <small>
                                                <span>
                                                {{ purchase_order.total_amount }}
                                                </span>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col ors top right">
                            <div class="row">
                                <div class="col-2 ors all dheight"></div>
                                <div class="col-3 ors top bottom right"></div>
                                <div class="col ors right bottom top"><span></span></div>
                            </div>
                        </div>
                        <div class="col ors top right bottom">
                            <div class="row">
                                <div class="col-4 ors top left text-center"></div>
                                <div class="col-2 ors top left right text-center"></div>
                                <div class="col-2 ors top right text-center"></div>
                                <div class="col ors top">
                                    <div class="row">
                                        <div class="col-6 ors top left bottom text-center"><small><span>
                                                </span></small></div>
                                        <div class="col-6 ors text-center all dheight"><small><span></span></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col ors top right">
                            <div class="row">
                                <div class="col-2 ors all dheight"></div>
                                <div class="col-3 ors top bottom right"></div>
                                <div class="col ors right bottom top"><span></span></div>
                            </div>
                        </div>
                        <div class="col ors top right bottom">
                            <div class="row">
                                <div class="col-4 ors top left text-center"></div>
                                <div class="col-2 ors top left right text-center"></div>
                                <div class="col-2 ors top right text-center"></div>
                                <div class="col ors top">
                                    <div class="row">
                                        <div class="col-6 ors top left bottom text-center"><small><span>
                                                </span></small></div>
                                        <div class="col-6 ors text-center all dheight"><small><span></span></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col ors top right">
                            <div class="row">
                                <div class="col-2 ors all dheight"></div>
                                <div class="col-3 ors top bottom right"></div>
                                <div class="col ors right bottom top"><span></span></div>
                            </div>
                        </div>
                        <div class="col ors top right bottom">
                            <div class="row">
                                <div class="col-4 ors top left text-center"></div>
                                <div class="col-2 ors top left right text-center"></div>
                                <div class="col-2 ors top right text-center"></div>
                                <div class="col ors top">
                                    <div class="row">
                                        <div class="col-6 ors top left bottom text-center"><small><span>
                                                </span></small></div>
                                        <div class="col-6 ors text-center all dheight"><small><span></span></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col ors top right">
                            <div class="row">
                                <div class="col-2 ors all dheight"></div>
                                <div class="col-3 ors top bottom right"></div>
                                <div class="col ors right bottom top"><span></span></div>
                            </div>
                        </div>
                        <div class="col ors top right bottom">
                            <div class="row">
                                <div class="col-4 ors top left text-center"></div>
                                <div class="col-2 ors top left right text-center"></div>
                                <div class="col-2 ors top right text-center"></div>
                                <div class="col ors top">
                                    <div class="row">
                                        <div class="col-6 ors top left bottom text-center"><small><span>
                                                </span></small></div>
                                        <div class="col-6 ors text-center all dheight"><small><span></span></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col ors top right">
                            <div class="row">
                                <div class="col-2 ors all dheight"></div>
                                <div class="col-3 ors top bottom right"></div>
                                <div class="col ors right bottom top"><span></span></div>
                            </div>
                        </div>
                        <div class="col ors top right bottom">
                            <div class="row">
                                <div class="col-4 ors top left text-center"></div>
                                <div class="col-2 ors top left right text-center"></div>
                                <div class="col-2 ors top right text-center"></div>
                                <div class="col ors top">
                                    <div class="row">
                                        <div class="col-6 ors top left bottom text-center">
                                            <small>
                                                <span></span>
                                            </small>
                                        </div>
                                        <div class="col-6 ors text-center all dheight">
                                            <small>
                                                <span></span>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                dmd_purchase_orders: {},
                purchase_order: '',
                uacs_codes: [],
            }
        },
        methods: {
            get_ors() {
                axios.get('../../api/purchase_order_obrs/' + this.$route.params.id).then(({data}) => {
                    this.dmd_purchase_orders = data;
                }).catch(() => {

                });
            },
            po_show() {
                axios.get('../../api/po_show/' + this.$route.params.id).then(({data}) => {
                    this.purchase_order = data;
                }).catch(() => {

                });
            },
            get_uacs_codes(){
                axios.get('../../api/uacs_code/' + this.$route.params.id).then(({data}) =>{
                    this.uacs_codes = data;
                });
            }
        },
        print() {
            window.print();
            location.reload();
        },
        created() {
            this.get_ors();
            this.po_show();
            this.get_uacs_codes();
        },
    }

</script>

<style lang="scss" scoped>
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
        height: 15.5rem;
    }

    .img-thumbnail {
        border: none;
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 65%;
    }

    div.font {
        font-family: 'Helvetica', sans-serif;
    }

    div.ors {
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
        height: 5px;
    }

    div.bheight {
        height: 24px;
    }

    div.eheight {
        height: 48px;
    }

    .dheight {
        height: 23.5px;
    }

    @media print {
        div.div2 * {
            visibility: hidden;
            border: none;
        }

        div.div1 * {
            visibility: visible;
            border: 1px solid black;
        }
    }

</style>