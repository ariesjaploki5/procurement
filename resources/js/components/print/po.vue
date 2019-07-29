<template>
<div id="f01">
     <div class="row">
            <div class="col">
                <router-link to="/budget_po" tag="button" class="btn btn-secondary d-print-none float-left"><i class="fas fa-arrow-left ml-2"></i> Back</router-link>
            </div>
            <div class="col">
                <button class="btn btn-primary d-print-none button float-right" onclick="print()"><i class="fas fa-print ml-2"></i> Print</button>
            </div>
        </div>
    <div id="content-wrapper">
        <div class="col-lg-12">

            <table class="table table-condensed table-sm" style="margin-top: 1%">
                <tr>
                    <td rowspan="8" class="pr1"><img :src="'/img/bghmc.png'" style="margin-left: 5%; margin-top: 7%" width="150" height="150"></td>
                    <td colspan="5" class="pr1 border-bottom-0">
                        <center>Republic of the Philippines</center>
                    </td>
                </tr>
                <td colspan="5" class="pr1 border-top-0 border-bottom-0">
                    <center>Department of Health</center>
                </td>
                <tr>
                    <td colspan="5" class="pr1 border-top-0 border-bottom-0">
                        <center><b>BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="pr1 border-top-0">
                        <center>Baguio City</center>
                    </td>
                </tr>
                <tr>
                    <td class="pr1 border-bottom-0">
                        <center>Procurement Management Office</center>
                    </td>
                    <td class="pr1" colspan="3">Form No.: HS – PS – 006</td>
                </tr>
                <tr>
                    <td rowspan="3" class="border-top-0" width="55%">
                        <center><b><h1>PURCHASE ORDER</h1></b></center>
                    </td>
                </tr>
                <td class="pr1" colspan="4">Revision No.: 1</td>
                <tr>
                    <td class="pr1" colspan="4">Effectivity Date: September 1, 2016</td>
                </tr>
                <td class="pr1 border-bottom-0" colspan="7"></td>
            </table>

            <table class="table table-condensed table-sm" style="margin-top:-2.2%">
                <tr>
                    <td class="pr1 border-right-0 border-bottom-0" width="8%">Supplier:</td>
                    <td class="pr1 border-left-0" width="45%"><b>
                        <span v-if="po.supplier_id">{{ po.supplier.supplier_name }}</span>
                        <span v-else></span>
                    </b></td>
                    <td class="pr1 border-right-0 border-bottom-0" width="20%">Purchase Order Number:</td>
                    <td class="pr1 border-left-0" width="20%">
                        <center><b>{{ po.created_date | myDate}}-{{ po.purchase_order_id | numeral2}}</b></center>
                    </td>
                </tr>
                <td class="pr1 border-top-0 border-bottom-0" colspan="2"></td>
                <td class="pr1 border-top-0 border-right-0 border-bottom-0"> Purchase Order Date</td>
                <td class="pr1 border-left-0">
                    <center><b>{{ po.created_at | myDate3 }}</b></center>
                </td>
                <tr>
                    <td class="pr1 border-right-0 border-top-0 border-bottom-0">Address:</td>
                    <td class="pr1 border-left-0 border-top-0"><b>
                        <span v-if="po.supplier_id">{{ po.supplier.supplier_address }}</span>
                        <span v-else></span>
                    </b></td>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0">Mode of Procurement:</td>
                    <td class="pr1 border-left-0">
                        <center><b>
                            <span v-if="po.mode_id">{{ po.mode.mode_desc }}</span>
                            <span v-else></span>
                            
                        </b></center>
                    </td>
                </tr>
                <td class="pr1 border-top-0" colspan="7"></td>
                <tr>
                    <td class="pr1 border-top-0" colspan="7">GENTLEMEN: Please furnish this office the following articles subject to the terms and conditions contained herein:</td>
                </tr>
            </table>

            <table class="table table-condensed border-bottom-0 table-sm" style="margin-top:-1.6%">
                <tr>
                    <td class="pr1 border-right-0 border-top-0 border-bottom-0" width="8%">Place of Delivery:</td>
                    <td class="pr1 border-left-0 border-top-0" width="25%"><b><center>BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER</center></b></td>
                    <td class="pr1 border-right-0 border-bottom-0 border-top-0" width="10%">Delivery Term:</td>
                    <td class="pr1 border-left-0 border-top-0" width="15%"><b><center>
                        <span v-if="po.delivery_term">{{ po.delivery_term }} Days</span>
                    </center></b></td>
                </tr>
                <tr>
                    <td class=" pr1 border-top-0 border-right-0 border-bottom-0">Date of Delivery:</td>
                    <td class=" pr1 border-left-0"><b><center>
                        <span v-if="!po.date_of_delivery | myDate3"></span>
                        <span v-else>{{ po.date_of_delivery | myDate3 }}</span>
                    </center></b></td>
                    <td class=" pr1 border-top-0 border-right-0 border-bottom-0">Payment Term:</td>
                    <td class=" pr1 border-left-0"><b><center></center></b></td>
                </tr>
                <td class="pr1 border-top-0" colspan="7"> </td>
            </table>

            <table v-if="po" class="table table-condensed table-sm" style="margin-top:-2%">
                <tr>
                    <td class="pr1" width="5%"><b><center>Stock Number</center></b></td>
                    <td class="pr1" width="5%"><b><center>UNIT</center></b></td>
                    <td class="pr1" width="5%"><b><center>QUANTITY</center></b></td>
                    <td class="pr1" width="25%"><b><center>DESCRIPTION</center></b></td>
                    <td class="pr1" width="9%"><b><center>UNIT COST</center></b></td>
                    <td class="pr1" width="9%"><b><center>AMOUNT</center></b></td>
                </tr>
              
                <tr v-for="item in po.dmd_purchase_orders" :key="item.id">
                    <td class="pr1 border-bottom-0 border-top-0"><center></center></td>
                    <td class="pr1 border-bottom-0 border-top-0 text-center"><span v-if="item.packaging_id">{{ item.packaging.packaging_desc }}</span></td>
                    <td class="pr1 border-bottom-0 border-top-0"><center>{{ item.order_quantity }}</center></td>
                    <td class="pr1 border-bottom-0 border-top-0">
                        <div class="row" style="margin-left:3%">
                            {{ item.new_dmd.dmddesc }}
                        </div>
                        <div class="row" style="margin-left:3%">
                            <tr><td class="border-top-0 border-bottom-0">Brand:</td><td class="border-top-0 border-bottom-0">{{ item.brand.brand_desc }}</td></tr>
                        </div>
                        <div class="row" style="margin-left:3%">
                            <tr><td class="border-top-0 border-bottom-0">Packaging:</td><td class="border-top-0 border-bottom-0"><span v-if="item.packaging_id">{{ item.packaging.packaging_desc }}</span></td></tr>
                        </div>
                        <div class="row" style="margin-left:3%">
                            <tr><td class="border-top-0 border-bottom-0">Manufacturer:</td><td class="border-top-0 border-bottom-0">{{ item.manufacturer.manufacturer_desc }}</td></tr>
                        </div>
                        <div class="row" style="margin-left:3%">
                            <tr><td class="border-top-0 border-bottom-0">Country of Origin:</td><td class="border-top-0 border-bottom-0"><span v-if="item.country_id"> {{ item.country.country_desc }}</span></td></tr>
                        </div>
                        <div class="row" style="margin-left:3%">
                            <tr><td class="border-top-0 border-bottom-0">CPR:</td><td class="border-top-0 border-bottom-0"> </td></tr>
                        </div>
                    </td>
                    <td class="pr1 align-middle border-bottom-0 border-top-0">
                        <center>{{ item.cost_price | currency2}}</center>
                    </td>
                    <td class="pr1 align-middle border-bottom-0 border-top-0">
                        <center>{{ item.cost_price * item.order_quantity | currency2}}</center>
                    </td>
                </tr>
               
                <td class="pr1 text-center border-left-0 border-right-0 border-bottom-0" colspan="6">
                    <h6><b><i>***Remarks<!-- Remarks-->***</i></b></h6>
                </td>
            </table>
            <table v-else></table>
            <table class="table table-condensed table-borderless table-sm" style="margin-top: 10%">
                <tr>
                    <td class="pr1"><b>Total Amount in Words: <i> {{ estimated_cost | num_words }} pesos</i></b></td>
                    <td class="pr1 text-right"><b>{{ estimated_cost | currency2 }}</b></td>
                </tr>
            </table>
            <table class="table table-condensed table-borderless table-sm" style="margin-top: -2%">
                <tr>
                    <td class="pr1 text-justify border-bottom-0" colspan="2" style="height:50px">
                        <p>Non-delivery of the above-mentioned item/s, partial, or completely delivery, within the prescribed
                            delivery term shall have the effect of cancellation of the Purchase Order and Subsequent orders. In case
                            you will be allowed to deliver beyond the delivery term, partial or completely delivery, a penalty of one-tenth(1/10)
                            of one percent (1%) for everyday of delay shall be imposed.</p>
                    </td>
                </tr>
                <tr>
                    <td class="pr1 border-right-0 border-top-0 border-bottom-0"></td>
                    <td class="pr1 border-left-0 border-top-0 border-bottom-0" width="40%">Very truly yours,</td>
                </tr>
                <tr>
                    <td class="pr1 border-right-0 border-bottom-0 border-top-0">Conforme:</td>
                    <td class="pr1 border-left-0 border-top-0 border-bottom-0" width="40%"></td>
                </tr>
                <tr>
                    <td class="pr1 border-right-0 border-top-0 border-bottom-0"></td>
                    <td class="pr1 border-left-0 border-top-0 border-bottom-0" width="40%"></td>
                </tr>
                <tr>
                    <td class="pr1 border-right-0 border-top-0 border-bottom-0" width="-10%">
                        <!-- <center>{{po.user.user}}</center> -->
                    </td>
                    <td class="pr1 border-left-0 border-top-0 border-bottom-0">
                        <center><b><u>RICARDO B. RUNEZ JR.,MD,FPCS,MHA,CESE</u></b></center>
                    </td>
                </tr>
                <tr>
                    <td class="pr1 border-right-0 border-top-0 border-bottom-0" width="0%">
                        <center>Signature Over Printed Name</center>
                    </td>
                    <td class="pr1 border-left-0 border-top-0 border-bottom-0">
                        <center>Medical Center Chief II</center>
                    </td>
                </tr>
                <tr>
                    <td width="-10%" class="pr1 border-right-0 border-top-0 border-bottom-0">
                        <center><b><u>{{ po.created_date | myDate3}}</u></b></center>
                    </td>
                    <td class="pr1 border-left-0 border-top-0 border-bottom-0"></td>
                </tr>
                <tr>
                    <td width="0%" class="pr1 border-right-0 border-top-0">
                        <center>Date</center>
                    </td>
                    <td class="pr1 border-left-0 border-top-0"></td>
                </tr>
            </table>

            <table class="table table-condensed table-sm" style="margin-top:-2.2%">
                <tr>
                    <td class="pr1 border-right-0 border-bottom-0" width="10%"><b>FUND CLUSTER:</b></td>
                    <td class="pr1 border-left-0" width="30%">
                        <span v-if="po.fund_source">0{{ po.fund_source.id }}</span>
                        <span v-else></span>    
                    </td>
                    <td class="pr1 border-right-0 border-bottom-0" width="15%"></td>
                    <td class="pr1 border-left-0 border-bottom-0" width="20%"></td>
                </tr>
                <td class="pr1 border-top-0 border-right-0 border-bottom-0" width="15%"><b>FUNDS AVAILABLE:</b></td>
                <td class="pr1 border-left-0" width="30%">{{ estimated_cost | currency2}}</td>
                <td class="pr1 border-top-0 border-right-0 border-bottom-0" width="15%"></td>
                <td class="pr1 border-top-0 border-left-0 border-bottom-0" width="20%"></td>
                <tr>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0"></td>
                    <td class="pr1 border-left-0 border-bottom-0"></td>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0" width="15%">ORS / BURS No.:</td>
                    <td class="pr1 border-top-0 border-left-0" width="20%">
                        
                        <center><b>
                            <span v-if="po.fund_source">{{ po.fund_source.acronym }}-0{{ po.allotment.allotment_code }}-{{ po.uacs.current_appropriations }}-{{ po.obrs_date | myDate}}-{{ po.purchase_order_id | numeral2}}</span>
                            <span v-else></span>
                        </b></center>
                    </td>
                </tr>
                <tr>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0"></td>
                    <td class="pr1 border-top-0 border-left-0 border-bottom-0">
                        <center><b><u>CECILIA J. PUGONG, CPA</u></b></center>
                    </td>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0" width="15%">Date of ORS / BURS:</td>
                    <td class="pr1 border-left-0">
                        <center><b>
                            <span v-if="po.obrs_date ">{{ po.obrs_date | myDate3 }}</span>
                            </b></center>
                    </td>
                </tr>
                <tr>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0"></td>
                    <td class="pr1 border-top-0 border-left-0 border-bottom-0">
                        <center><small>Accountant IV</small></center>
                    </td>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0">Amount:</td>
                    <td class="pr1 border-left-0 text-center font-weight-bold">{{ estimated_cost | currency2}}</td>
                </tr>
                <tr>
                    <td class="pr1 border-right-0 border-top-0"></td>
                    <td class="pr1 border-top-0 border-left-0">
                        <center><small>Head, Accounting Section</small></center>
                    </td>
                    <td class="pr1 border-top-0 border-right-0"></td>
                    <td class="pr1 border-left-0"></td>
                </tr>
            </table>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data(){
            return{
                po: {
                    dmd_purchase_orders: [],
                },

            }
        },
        methods:{
            get_po(){
                axios.get('../../api/purchase_order/'+this.$route.params.id).then(({data}) => {
                    this.po = data;
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
        },
        computed:{
            estimated_cost(){
                let sum = 0;
                    this.po.dmd_purchase_orders.forEach(function(item) {
                        sum += (parseFloat(item.cost_price) * parseFloat(item.order_quantity));
                    });
                return sum;
            }

            
        },
    mounted() {

    }
}
</script>

<style lang="scss" scoped>
#content-wrapper {
        background-color: rgb(255, 255, 255) !important;
    }
@font-face {
    font-family: 'Helvetica';
    src: url('https://fonts.googleapis.com/css?family=Helvetica');
    font-weight: normal;
    font-style: normal;
}

div#f01 {
    font-family: 'Helvetica', sans-serif;
}

td.pr1 {
    border-collapse: collapse;
    border: 1px solid black;
    margin: 0px;
    padding: none;
    padding-top: 0px;
}

td.p01 {
    border-collapse: collapse;
    border: 1px solid black;
    height: 150px;
}

table#t01 th {
    background-color: rgb(184, 172, 172) !important;
    border: 1px solid black;
    color: black;
    margin: 0px;
    padding: none;
}
</style>
