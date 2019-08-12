<template>
<div >
    <button class="btn btn-primary d-print-none button ml-2 mb-2" onclick="print()">Print</button>
    <div class="row">
        <div class="col-12">
            <div class="row bottom">
                <div class="po col-auto bottom right">
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
                    <div class="row po left right bottom">
                        <div class="col">
                            <div class="form-check">
                                <span style='font-size:20px;'>&#9634;</span>
                                    <label class="form-check-label font-weight-bold" for="defaultCheck1">
                                            <h5>OBLIGATION REQUEST AND STATUS</h5>
                                    </label>
                            </div>
                            <div class="form-check">
                                <span style='font-size:20px;'>&#9634;</span>
                                    <label class="form-check-label font-weight-bold" for="defaultCheck2">
                                            <h5>BUDGET UTILIZATION REQUEST AND STATUS</h5>
                                    </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col ml-2 mr-1">
                                <div class="po top bottom right">Form No.: FS-BUD-001</div>
                                <div class="po bottom right">Revision No.: 2</div>
                                <div class="po bottom right">Effectivity Date: September 1, 2016</div>   
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
   

    <div class="row">
        <div class="col-12">
            <div class="row po bottom">
                <div class="col po all">
                    <div class="row ">
                        <div class="col-2 po all">
                           <span>Payee: </span> 
                        </div>
                        <div class="col po top left right font-weight-bold">
                            <span>{{ purchase_order.supplier_name }}</span>
                        </div>
                        <div class="col-1 po all"></div>
                    </div>
                </div>
                <div class="col po top bottom right">
                    <div class="row">
                        <div class="col-5 po all">Serial No: </div>
                        <div class="col po top left right font-weight-bold"><div>
                        <div class="col-1 po all"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row po top bottom">
                <div class="col po all ">
                    <div class="row">
                        <div class="col-2 po all">Office</div>
                        <div class="col po top left right"></div>
                        <div class="col-1 po all"></div>
                    </div>
                </div>
                <div class="col po top bottom right">
                    <div class="row">
                        <div class="col-5 po all">Date: </div>
                        <div class="col po top left right font-weight-bold"></div>
                        <div class="col-1 po all"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row po top bottom">
                <div class="col po all">
                    <div class="row">
                        <div class="col-2 po all">
                            <span>Address: </span> 
                        </div>
                        <div class="col po top left right font-weight-bold">
                            {{ purchase_order.supplier_address }}
                        </div>
                        <div class="col-1 po all"></div>
                    </div>
                </div>
                <div class="col po top bottom right">
                    <div class="row">
                        <div class="col-5 po all">Fund Cluster: </div>
                        <div class="col po top left right font-weight-bold"></div>
                        <div class="col-1 po all"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 po top aheight"></div>
    </div>
  
    <div class="row">
        <div class="col-2 po top right text-center font-weight-bold">
            <span>Responsibility Center</span>
        </div>
        <div class="col-4 po top right text-center font-weight-bold">
            <span>Particulars</span>
        </div>
        <div class="col po top right text-center font-weight-bold">
            <span>MFO/PAP</span>
        </div>
        <div class="col po top right text-center font-weight-bold">
            <span>UACS Object Code/Expenditures</span>
        </div>
        <div class="col po top text-center font-weight-bold">
            <span>Amount</span>
        </div>
    </div>
   
    <div class="row">
        <div class="col-2 po top bottom right text-center font-weight-bold">
            <span>Main Pharmacy</span>
        </div>
        <div class="col-4 po top right bottom font-weight-bold">
            <span>{{  dmd_purchase_orders.dmddesc }}<br>
                Brand:	{{ dmd_purchase_orders.brand_desc }}<br>
                Packaging:	{{ dmd_purchase_orders.packaging_desc }}<br>
                Manufacturer:	{{ dmd_purchase_orders.manufacturer_desc }}<br>
                Country of Origin:	{{ dmd_purchase_orders.country_desc }}<br>
                CPR:	
            </span>
        </div>
        <div class="col po top bottom right text-center font-weight-bold">
            <span></span>
        </div>
        <div class="col po top bottom right text-center font-weight-bold">
            <span></span>
        </div>
        <div class="col po top bottom text-center font-weight-bold">
            <span>{{ purchase_order.total_amount | currency2 }}</span>
        </div>
    </div>

    <div class="row">
        <div class="col-2 po top right text-center font-weight-bold">
            <span></span>
        </div>
        <div class="col-4 po top right text-right font-weight-bold">
            <span>Total</span>
        </div>
        <div class="col po top right text-center font-weight-bold">
            <span></span>
        </div>
        <div class="col po top right text-center font-weight-bold">
            <span></span>
        </div>
        <div class="col po top text-center font-weight-bold">
            <span>{{ purchase_order.total_amount | currency2 }}</span>
        </div>
        </div>
        <div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-1 po text-center font-weight-bold ">
                            <span>A</span>
                        </div>
                        <div class="col po bottom left right"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-1 po text-center font-weight-bold">
                            <span>B</span>
                        </div>
                        <div class="col po bottom left"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-1 po top bottom right"></div>
                            <div class="col po all"><span>Certified: Charges to appropriation/allotment/budget
                                necessary, lawful and under my direct supervision;
                                and supporting documents valid, proper and legal.</span>
                            </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-1 po top bottom right"></div>
                        <div class="col po top bottom left"><span>Certified: Allotment / Budget available and obligated /
                            utilized for the purpose / adjustment necessary as
                            indicated above. </span>
                        <span class="text-white"><br>sdfsdf</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="row po top bottom">
                        <div class="col po all">
                            <div class="row">
                                <div class="col-3 po all">
                                    <span>Signature </span> 
                                </div>
                                <div class="col po top left right">
                                    <span></span>
                                </div>
                                <div class="col-1 po all"></div>
                            </div>
                        </div>
                        <div class="col po top bottom right">
                            <div class="row">
                                <div class="col-5 po all">Signature: </div>
                                <div class="col po top left right"></div>
                                <div class="col-1 po all"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row po top bottom">
                        <div class="col po all">
                            <div class="row">
                                <div class="col-3 po all">Printed Name:</div>
                                <div class="col po top left right text-center font-weight-bold">RAY P. SUANDING, MD, FPCP, FPCCP</div>
                                <div class="col-1 po all"></div>
                            </div>
                        </div>
                        <div class="col po top bottom right">
                            <div class="row">
                                <div class="col-5 po all">Printed Name:</div>
                                <div class="col po top left right text-center font-weight-bold">EDNA L. MOGAMOG, CPA, MBA</div>
                                <div class="col-1 po all"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row po top bottom">
                        <div class="col po all">
                            <div class="row">
                                <div class="col-3 po all">Position:</div>
                                <div class="col po top left right text-center">Chief Medical Professional Staff II</div>
                                <div class="col-1 po all"></div>
                            </div>
                        </div>
                        <div class="col po top bottom right">
                            <div class="row">
                                <div class="col-5 po all">Position:</div>
                                <div class="col po top left right text-center"><small>Supervising Administrative Officer<br>
                                    Head, Budget Office</small>
                                    </div>
                                <div class="col-1 po all"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row po top bottom">
                        <div class="col po all">
                            <div class="row">
                                <div class="col-3 po all">Date:</div>
                                <div class="col po top left right"></div>
                                <div class="col-1 po all"></div>
                            </div>
                        </div>
                        <div class="col po top bottom right">
                            <div class="row">
                                <div class="col-5 po all">Date:</div>
                                <div class="col po top left right"></div>
                                <div class="col-1 po all"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 po top aheight "></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-auto po top text-center font-weight-bold ">
                            <span>C</span>
                        </div>
                        <div class="col po top left text-center font-weight-bold">STATUS OF OBLIGATION / UTILIZATION</div>
                    </div>
                    <div class="row">
                        <div class="col po top right bottom text-center font-weight-bold">
                            <span>Reference</span>
                            <div class="row">
                                <div class="col-2 po left right bottom text-center font-weight-bold">Date</div>
                                <div class="col-3 po right bottom text-center font-weight-bold">Particulars</div>
                                <div class="col po right bottom text-center font-weight-bold">ORS/BURS/JEV/Check /RCI/ADA</div>
                            </div>
                        </div>
                        <div class="col po top right bottom text-center font-weight-bold">
                            <span>Amount</span>
                            <div class="row">
                                <div class="col-4 po bottom left"><small><span>Obligation / Utilization</span></small></div>
                                <div class="col-2 po bottom left right"><small><span>Payable</span></small></div>
                                <div class="col-2 po bottom right"><small><span>Payment</span></small></div>
                                <div class="col po bottom"><span>Balance</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col po top right bottom">
                            <div class="row">
                                <div class="col-2 po all"></div>
                                <div class="col-3 po top bottom right"></div>
                                <div class="col po right top  bottom mt-2"><p class="text-white">1</p></div>
                            </div>
                        </div>
                        <div class="col po top right bottom">
                            <div class="row">
                                <div class="col-4 po top left"></div>
                                <div class="col-2 po top left right"></div>
                                <div class="col-2 po top right"></div>
                                <div class="col po bottom">
                                    <div class="row">
                                        <div class="col-6 po top left text-center"><small><span>Not Yet Due</span></small></div>
                                        <div class="col-6 po text-center top left right"><small><span>Due and Demandable</span></small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col po top right">
                            <div class="row">
                                <div class="col-2 po all"></div>
                                <div class="col-3 po top bottom right"></div>
                                <div class="col po right bottom top"><span class="text-white">1</span></div>
                            </div>
                        </div>
                        <div class="col po top right bottom">
                            <div class="row">
                                <div class="col-4 po top left text-center">(a)</div>
                                <div class="col-2 po top left right text-center">(b)</div>
                                <div class="col-2 po top right text-center">(c)</div>
                                <div class="col po top">
                                    <div class="row">
                                        <div class="col-6 po top left bottom text-center"><small><span>(a-b)</span></small></div>
                                        <div class="col-6 po text-center all"><small><span>(b-c)</span></small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col po top right">
                            <div class="row">
                                <div class="col-2 po all text-white">1</div>
                                <div class="col-3 po top bottom right"></div>
                                <div class="col po right bottom top"><span></span></div>
                            </div>
                        </div>
                        <div class="col po top right bottom">
                            <div class="row">
                                <div class="col-4 po top left text-center"></div>
                                <div class="col-2 po top left right text-center"></div>
                                <div class="col-2 po top right text-center"></div>
                                <div class="col po top">
                                    <div class="row">
                                        <div class="col-6 po top left bottom text-center"><small><span> </span></small></div>
                                        <div class="col-6 po text-center all"><small><span class="text-white">1</span></small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col po top right">
                            <div class="row">
                                <div class="col-2 po all text-white">1</div>
                                <div class="col-3 po top bottom right"></div>
                                <div class="col po right bottom top"><span></span></div>
                            </div>
                        </div>
                        <div class="col po top right bottom">
                            <div class="row">
                                <div class="col-4 po top left text-center"></div>
                                <div class="col-2 po top left right text-center"></div>
                                <div class="col-2 po top right text-center"></div>
                                <div class="col po top">
                                    <div class="row">
                                        <div class="col-6 po top left bottom text-center"><small><span> </span></small></div>
                                        <div class="col-6 po text-center all"><small><span class="text-white"> 2</span></small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col po top right">
                            <div class="row">
                                <div class="col-2 po all text-white">3</div>
                                <div class="col-3 po top bottom right"></div>
                                <div class="col po right bottom top"><span></span></div>
                            </div>
                        </div>
                        <div class="col po top right bottom">
                            <div class="row">
                                <div class="col-4 po top left text-center"></div>
                                <div class="col-2 po top left right text-center"></div>
                                <div class="col-2 po top right text-center"></div>
                                <div class="col po top">
                                    <div class="row">
                                        <div class="col-6 po top left bottom text-center"><small><span> </span></small></div>
                                        <div class="col-6 po text-center all"><small><span class="text-white">3</span></small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col po top right">
                            <div class="row">
                                <div class="col-2 po all text-white">3</div>
                                <div class="col-3 po top bottom right"></div>
                                <div class="col po right bottom top"><span></span></div>
                            </div>
                        </div>
                        <div class="col po top right bottom">
                            <div class="row">
                                <div class="col-4 po top left text-center"></div>
                                <div class="col-2 po top left right text-center"></div>
                                <div class="col-2 po top right text-center"></div>
                                <div class="col po top">
                                    <div class="row">
                                        <div class="col-6 po top left bottom text-center"><small><span> </span></small></div>
                                        <div class="col-6 po text-center all"><small><span class="text-white">3</span></small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col po top right">
                            <div class="row">
                                <div class="col-2 po all text-white">3</div>
                                <div class="col-3 po top bottom right"></div>
                                <div class="col po right bottom top"><span></span></div>
                            </div>
                        </div>
                        <div class="col po top right bottom">
                            <div class="row">
                                <div class="col-4 po top left text-center"></div>
                                <div class="col-2 po top left right text-center"></div>
                                <div class="col-2 po top right text-center"></div>
                                <div class="col po top">
                                    <div class="row">
                                        <div class="col-6 po top left bottom text-center"><small><span> </span></small></div>
                                        <div class="col-6 po text-center all"><small><span class="text-white">3</span></small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col po top right">
                            <div class="row">
                                <div class="col-2 po all text-white">3</div>
                                <div class="col-3 po top bottom right"></div>
                                <div class="col po right bottom top"><span></span></div>
                            </div>
                        </div>
                        <div class="col po top right bottom">
                            <div class="row">
                                <div class="col-4 po top left text-center"></div>
                                <div class="col-2 po top left right text-center"></div>
                                <div class="col-2 po top right text-center"></div>
                                <div class="col po top">
                                    <div class="row">
                                        <div class="col-6 po top left bottom text-center"><small><span> </span></small></div>
                                        <div class="col-6 po text-center all"><small><span class="text-white">3</span></small></div>
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
</div>
</template>
<script>
export default {
    data(){
        return{
                
                dmd_purchase_orders: {},

                purchase_order: '',

            }
        },
        methods:{
            get_po(){
                axios.get('../../api/purchase_order_obrs/'+this.$route.params.id).then(({data}) => {
                    this.dmd_purchase_orders = data;
                }).catch(() => {

                });
            },
            po_show(){
                axios.get('../../api/po_show/'+this.$route.params.id).then(({data}) => {
                    this.purchase_order = data;
                }).catch(() => {

                });
            }
        },
        print(){
            window.print();
            location.reload();
            },
        created(){
            this.get_po();
            this.po_show();
        },
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
        height: 5px;
    }
    div.bheight {
        height: 20px;
    }
    #footer {
        position: fixed;
        bottom: 0;
        width: auto;
        margin-left: -0.6%;
        margin-bottom: 5%;
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

