<template>
<div id="f01">
    <div id="content-wrapper">
        <div class="col-lg-12">

            <table class="table table-condensed table-sm">
                <tr>
                    <td rowspan="8" class="pr1"><img :src="'/img/bghmc.png'" style="margin-left: 1.5%; margin-top: 20%" width="150" height="150"></td>
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
                    <td class="pr1 border-left-0" width="45%"><b>{{ po.purchase_request.supplier.supplier_name }}</b></td>
                    <td class="pr1 border-right-0 border-bottom-0" width="20%">Purchase Order Number:</td>
                    <td class="pr1 border-left-0" width="20%">
                        <center><b>(year-month-series)</b></center>
                    </td>
                </tr>
                <td class="pr1 border-top-0 border-bottom-0" colspan="2"></td>
                <td class="pr1 border-top-0 border-right-0 border-bottom-0"> Pruchase Order Date</td>
                <td class="pr1 border-left-0">
                    <center><b>(Date Today)</b></center>
                </td>
                <tr>
                    <td class="pr1 border-right-0 border-top-0 border-bottom-0">Address:</td>
                    <td class="pr1 border-left-0 border-top-0"><b>{{ po.purchase_request.supplier.supplier_address }}</b></td>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0">Mode of Procurement:</td>
                    <td class="pr1 border-left-0">
                        <center><b>{{ po.purchase_request.mode.mode_desc }}</b></center>
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
                    <td class="pr1 border-left-0 border-top-0" width="15%"><b><center>10 Working Days</center></b></td>
                </tr>
                <tr>
                    <td class=" pr1 border-top-0 border-right-0 border-bottom-0">Date of Delivery:</td>
                    <td class=" pr1 border-left-0"><b><center>(Date of delivery)</center></b></td>
                    <td class=" pr1 border-top-0 border-right-0 border-bottom-0">Payment Term:</td>
                    <td class=" pr1 border-left-0"><b><center></center></b></td>
                </tr>
                <td class="pr1 border-top-0" colspan="7"> </td>
            </table>

            <table class="table table-condensed table-sm" style="margin-top:-2%">
                <tr>
                    <td class="pr1" width="10%"><b><center>Stock Number</center></b></td>
                    <td class="pr1" width="10%"><b><center>UNIT</center></b></td>
                    <td class="pr1" width="10%"><b><center>QUANTITY</center></b></td>
                    <td class="pr1" width="30%"><b><center>DESCRIPTION</center></b></td>
                    <td class="pr1" width="10%"><b><center>UNIT COST</center></b></td>
                    <td class="pr1" width="10%"><b><center>AMOUNT</center></b></td>
                </tr>
                <tr v-for="item in po.purchase_request.view_dmd_purchase_requests" :key="item.id">
                    <td class="pr1"><center></center></td>
                    <td class="pr1"></td>
                    <td class="pr1"><center>{{ item.order_quantity }}</center></td>
                    <td class="pr1">
                        <div class="row">
                            {{ item.gendesc }} {{ item.dmdnost }} {{ item.stredesc }} {{ item.formdesc }}
                        </div>
                        <div class="row">
                            {{ item.dmd_price_schedule.brand_desc }}
                        </div>
                    </td>
                    <td class="pr1">
                        <center>{{ item.dmd_price_schedule.bid_price | currency2}}</center>
                    </td>
                    <td class="pr1">
                        <center>{{ item.dmd_price_schedule.bid_price * item.order_quantity | currency2}}</center>
                    </td>
                </tr>

                <td class="pr1 text-center border-0" colspan="6">
                    <h6><b><i>***Remarks<!-- Remarks-->***</i></b></h6>
                </td>
            </table>
            <table class="table table-condensed table-borderless table-sm" style="margin-top: 10%">
                <tr>
                    <td class="pr1"><b>Total Amount in Words: <i>{{ estimated_cost | num_words }} pesos</i></b></td>
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
                        <center>______________________________________________________</center>
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
                        <center><b><u>(Current Date)</u></b></center>
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
                    <td class="pr1 border-left-0" width="30%"></td>
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
                        <center><b>XXXX-00-000000-0000-00-0000</b></center>
                    </td>
                </tr>
                <tr>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0"></td>
                    <td class="pr1 border-top-0 border-left-0 border-bottom-0">
                        <center><b><u>CECILIA J. PUGONG, CPA</u></b></center>
                    </td>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0" width="15%">Date of ORS / BURS:</td>
                    <td class="pr1 border-left-0">
                        <center><b>getDate</b></center>
                    </td>
                </tr>
                <tr>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0"></td>
                    <td class="pr1 border-top-0 border-left-0 border-bottom-0">
                        <center><small>Accountant IV</small></center>
                    </td>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0">Amount:</td>
                    <td class="pr1 border-left-0"></td>
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
                po: {},

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
        created(){
            this.get_po();
        },
        computed:{
            estimated_cost(){
            let sum = 0;
            this.po.purchase_request.view_dmd_purchase_requests.forEach(function(item) {
                sum += (parseFloat(item.dmd_price_schedule.bid_price) * parseFloat(item.order_quantity));
            });
                return sum;
            },

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
