<template>
<div id="f01">
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
                            <div class="po all text-center">Procurement Management Office</div>
                            <div class="text-center"><h1>PURCHASE ORDER</h1></div>
                        </div>
                        <div class="row">
                            <div class="col ml-2 mr-1">
                                <div class="po top bottom right">Form No.: HS – PS – 006</div>
                                <div class="po bottom right">Revision No.: 1</div>
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
                    <div class="row">
                        <div class="col-2 po all">
                           <span>Supplier: </span> 
                        </div>
                        <div class="col po top left right">
                            <span>{{ purchase_order.supplier_name }}</span>
                        </div>
                        <div class="col-1 po all"></div>
                    </div>
                </div>
                <div class="col po top bottom right">
                    <div class="row">
                        <div class="col-5 po all">Purchase Order Number: </div>
                        <div class="col po top left right">{{ purchase_order.po_id }}</div>
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
                        <div class="col-2 po all"></div>
                        <div class="col po all"></div>
                        <div class="col-1 po all"></div>
                    </div>
                </div>
                <div class="col po top bottom right">
                    <div class="row">
                        <div class="col-5 po all">Purchase Order Date: </div>
                        <div class="col po top left right">{{ purchase_order.created_at | myDate3 }}</div>
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
                        <div class="col po top left right">
                            <span>{{ purchase_order.supplier_address }}</span>
                        </div>
                        <div class="col-1 po all"></div>
                    </div>
                </div>
                <div class="col po top bottom right">
                    <div class="row">
                        <div class="col-5 po all">Mode of Procurement: </div>
                        <div class="col po top left right">{{ purchase_order.mode_desc }}</div>
                        <div class="col-1 po all"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 po top aheight"></div>
        <div class="col po top">
            <span>GENTLEMEN: Please furnish this office the following articles subject to the terms and conditions contained herein:</span>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row po top bottom">
                <div class="col po all">
                    <div class="row">
                        <div class="col-4 po all">
                            <span>Place of Delivery: </span> 
                        </div>
                        <div class="col po top left right">
                            <span>{{ purchase_order.place_of_delivery }}</span>
                        </div>
                        <div class="col-1 po all"></div>
                    </div>
                </div>
                <div class="col po top bottom right">
                    <div class="row">
                        <div class="col-5 po all">Delivery Term: </div>
                        <div class="col po top left right"><span>{{ purchase_order.delivery_term }}</span></div>
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
                        <div class="col-4 po all">
                            <span>Date of Delivery: </span> 
                        </div>
                        <div class="col po top left right">
                            <span>{{ purchase_order.date_of_delivery }}</span>
                        </div>
                        <div class="col-1 po all"></div>
                    </div>
                </div>
                <div class="col po top bottom right">
                    <div class="row">
                        <div class="col-5 po all">Payment Term:</div>
                        <div class="col po top left right">{{ purchase_order.payment_term_desc }}</div>
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
            <span>Stock Number</span>
        </div>
        <div class="col po top right text-center font-weight-bold">
            <span>UNIT</span>
        </div>
        <div class="col po top right text-center font-weight-bold">
            <span>QUANTITY</span>
        </div>
        <div class="col-4 po top right text-center font-weight-bold">
            <span>DESCRIPTION</span>
        </div>
        <div class="col po top right text-center font-weight-bold">
            <span>UNIT COST</span>
        </div>
        <div class="col-2 po top text-center font-weight-bold">
            <span>AMOUNT</span>
        </div>
    </div>
    <div class="row" v-for="item in dmd_purchase_orders" :key="item.dmd_po_id">
        <div class="col-2 po top right text-center">
            <span></span>
        </div>
        <div class="col po top right text-center">
            <span></span>
        </div>
        <div class="col po top right text-center">
            <span>{{ item.order_quantity | numeral3 }}</span>
        </div>
        <div class="col-4 po top right text-center">
            <div class="row col">
                <span>{{ item.dmddesc }}</span>
            </div>
            <div class="row col">
                <span>Brand: {{item.brand_desc }}</span>
            </div>
            <div class="row col">
                <span>Manufacturer: {{item.manufacturer_desc }}</span>
            </div>
            <div class="row col">
                <span>Packaging: {{item.packaging_desc }}</span>
            </div>
            <div class="row col">
                <span>Country of Origin: {{item.country_desc }}</span>
            </div>
        </div>
        <div class="col po top right text-center">
            <span>{{ item.cost_price | currency2 }}</span>
        </div>
        <div class="col-2 po top text-center">
            <span>{{ item.cost_price * item.order_quantity | currency2 }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-12 po font-italic text-center all cheight">
            <span>***Remarks***</span>
        </div>
    </div>

    <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-3 po right font-weight-bold">Total Amount in Words:</div>
                    <div class="col po left right font-weight-bold">
                        <span v-if="purchase_order.amount">{{ purchase_order.amount | num_words }} pesos <span v-if="purchase_order.cent > 0">and {{ purchase_order.cent | num_words  }}</span> centavos</span>
                        
                    </div>
                    <div class="col-2 po font-weight-bold">{{ purchase_order.total_amount | currency2 }}</div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 po top bottom">
                <span>
                    Non-delivery of the above-mentioned item/s, partial, or completely delivery, within the prescribed delivery term shall have the effect of
                    cancellation of the Purchase Order and Subsequent orders. In case you will be allowed to deliver beyond the delivery term, partial or completely
                    delivery, a penalty of one-tenth(1/10) of one percent (1%) for everyday of delay shall be imposed.
                </span>
            </div>
                <div class="col-6 po top right bottom"></div>
                <div class="col po top left bottom">Very truly yours,</div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col po top right bottom">
                        <div class="row">
                            <div class="col-3 po all">Conforme:</div>
                            <div class="col po all"></div>
                            <div class="col po all"></div>
                        </div>
                    </div>
                    <div class="col po top left bottom">
                        <div class="row">
                            <div class="col-3 po all"></div>
                            <div class="col po all"></div>
                            <div class="col-1 po all"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col po top right bottom">
                            <div class="row">
                                <div class="col-3 po all"></div>
                                <div class="col po all"></div>
                                <div class="col po all"></div>
                            </div>
                        </div>
                        <div class="col po top left bottom">
                            <div class="row">
                                <div class="col-3 po all"></div>
                                <div class="col po all font-weight-bold text-center">RICARDO B. RUNEZ JR.,MD,FPCS,MHA,CESE</div>
                                <div class="col-1 po all"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col po top right bottom">
                        <div class="row">
                            <div class="col-3 po all"></div>
                            <div class="col po top"></div>
                            <div class="col-1 po all"></div>
                        </div>
                    </div>
                    <div class="col po top left bottom">
                        <div class="row">
                            <div class="col-3 po all"></div>
                            <div class="col po top left right"></div>
                            <div class="col-1 po all"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col po top right bottom">
                        <div class="row">
                            <div class="col-3 po all"></div>
                            <div class="col po all text-center">Signature over Printed Name</div>
                            <div class="col-1 po all"></div>
                        </div>
                    </div>
                    <div class="col po top left bottom">
                        <div class="row">
                            <div class="col-3 po all"></div>
                            <div class="col po all text-center">Medical Center Chief II</div>
                            <div class="col-1 po all"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col po top right bottom">
                        <div class="row">
                            <div class="col-3 po all"></div>
                            <div class="col po all text-center font-weight-bold">(Current Date)</div>
                            <div class="col-1 po all"></div>
                        </div>
                    </div>
                    <div class="col po top left bottom">
                        <div class="row">
                            <div class="col-3 po all"></div>
                            <div class="col po all"></div>
                            <div class="col-1 po all"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col po top right">
                        <div class="row">
                            <div class="col-3 po all"></div>
                            <div class="col po all text-center">Date</div>
                            <div class="col-1 po all"></div>
                        </div>
                    </div>
                    <div class="col po top left">
                        <div class="row">
                            <div class="col-3 po all"></div>
                            <div class="col po all"></div>
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
                            <div class="col-4 po all font-weight-bold">
                                <span>FUND CLUSTER: </span> 
                            </div>
                            <div class="col po top left right">
                                <span></span>
                            </div>
                            <div class="col-1 po all"></div>
                        </div>
                    </div>
                    <div class="col po top bottom right">
                        <div class="row">
                            <div class="col-5 po all"></div>
                            <div class="col po all"></div>
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
                            <div class="col-4 po all font-weight-bold">
                                <span>FUNDS AVAILABLE:</span> 
                            </div>
                            <div class="col po top left right">
                                <span></span>
                            </div>
                            <div class="col-1 po all"></div>
                        </div>
                    </div>
                    <div class="col po top bottom right">
                        <div class="row">
                            <div class="col-5 po all"></div>
                            <div class="col po all"></div>
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
                            <div class="col-4 po all"></div>
                            <div class="col po all"></div>
                            <div class="col-1 po all"></div>
                        </div>
                    </div>
                    <div class="col po top bottom right">
                        <div class="row">
                            <div class="col-5 po all">ORS / BURS No.:</div>
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
                            <div class="col-4 po all"></div>
                            <div class="col po top left right text-center font-weight-bold">CECILIA J. PUGONG, CPA</div>
                            <div class="col-1 po all"></div>
                        </div>
                    </div>
                    <div class="col po top bottom right">
                        <div class="row">
                            <div class="col-5 po all">Date of ORS / BURS: </div>
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
                            <div class="col-4 po all"></div>
                            <div class="col po all text-center">Accountant IV</div>
                            <div class="col-1 po all"></div>
                        </div>
                    </div>
                    <div class="col po top bottom right">
                        <div class="row">
                            <div class="col-5 po all">Amount: </div>
                            <div class="col po top left right">{{ purchase_order.amount | currency2 }}</div>
                            <div class="col-1 po all"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row po top">
                    <div class="col po all">
                        <div class="row">
                            <div class="col-4 po all"></div>
                            <div class="col po all text-center">Head, Accounting Section</div>
                            <div class="col-1 po all"></div>
                        </div>
                    </div>
                    <div class="col po top bottom right">
                        <div class="row">
                            <div class="col-5 po all"></div>
                            <div class="col po all"></div>
                            <div class="col-1 po all"></div>
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
                
                dmd_purchase_orders: [],

                purchase_order: '',

            }
        },
        methods:{
            get_po(){
                axios.get('../../api/purchase_order/'+this.$route.params.id).then(({data}) => {
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
        computed:{
            // estimated_cost(){
            //     let sum = 0;
            //         this.dmd_purchase_orders.forEach(function(item) {
            //             sum += (parseFloat(item.cost_price) * parseFloat(item.order_quantity));
            //         });
            //     return sum;
            // }

            
        },
    mounted() {

    }
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

    .po {
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
        height: 150px;
    }
    #footer {
        position: relative;
        bottom: 0;
        width: auto;
        margin-left: -1.3%;
    }
</style>
