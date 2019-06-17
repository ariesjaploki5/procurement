<template>
<div id="f01">
    <div id="content-wrapper" v-for="item in pr.dmd_purchase_requests" :key="item.dmd_id">
        <div class="col-lg-12">
            <table class="table table-condensed table-sm a">
                <tr>
                    <td rowspan="7" class="pr1 border-top-0 border-right-0"><img :src="'/img/bghmc.png'"
                                style="margin-left: 15%; margin-top: 8%" width="150" height="150"></td>
                    <td colspan="5" class="pr1 border-top-0 border-bottom-0" id="pr1">
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
                    <td class="pr1" rowspan="3" width="40%">
                        <center><br><b>
                                    <h2>STOCK POSITION SHEET</h2>
                                </b></center>
                    </td>
                    <td class="pr1" colspan="4">Form No.: HS-PS-005</td>
                </tr>
                <td class="pr1" colspan="4">Revision No.: Ø</td>
                <tr>
                    <td class="pr1" colspan="4">Effectivity Date: August 1, 2014</td>
                </tr>
            </table>
            <table class="table table-condensed border-0 table-sm" style="margin-top:-1%">
                <tr class="table table-borderless">
                    <td class="border-top-0 border-bottom-0" width="5%" style="text-align: center">Articles:</td>
                    <td class="border-top-0 border-bottom border-left-0" width="25%"><b>{{ item.gendesc }} {{ item.dmdnost }} {{ item.stredesc }} {{ item.formdesc }} {{ item.brandname }}</b></td>
                    <td class="border-top-0 border-bottom-0" width="10%" style="text-align: right">Standard Stock
                        Level</td>
                    <td class="border-top-0 border-bottom" width="10%">
                        <center><b>{{ item.ssl }}</b></center>
                    </td>
                </tr>
                <tr class="table table-borderless">
                    <td class="border-top-0 border-bottom-0"></td>
                    <td class="border-bottom-0"></td>
                    <td class="border-top-0 border-bottom-0"></td>
                    <td class="border-bottom-0">
                        <center><b></b></center>
                    </td>
                </tr>
                <tr class="table table-borderless">
                    <td class="border-top-0 border-bottom-0">
                        <center>1.</center>
                    </td>
                    <td class="border-top-0 border-bottom-0">Balance on Hand</td>
                    <td class="border-top-0 border-bottom-0"></td>
                    <td class="border-bottom">
                        <center><b>{{ item.boh }}</b></center>
                    </td>
                </tr>
                <tr class="table table-borderless">
                    <td class="border-top-0 border-bottom-0">
                        <center>2.</center>
                    </td>
                    <td class="border-top-0 border-bottom-0">Item in Transit</td>
                    <td class="border-top-0 border-bottom-0"></td>
                    <td class="border-bottom">
                        <center><b>(Item on process)</b></center>
                    </td>
                </tr>
                <tr class="table table-borderless">
                    <td class="border-top-0 border-bottom-0">
                        <center>3.</center>
                    </td>
                    <td class="border-top-0 border-bottom-0">This Requisition no. RIV.</td>
                    <td class="border-top-0 border-bottom-0"></td>
                    <td class="border-bottom">
                        <center><b>{{ item.request_quantity }}</b></center>
                    </td>
                </tr>
                <tr class="table table-borderless">
                    <td class="border-top-0 border-bottom-0">
                        <center>4.</center>
                    </td>
                    <td class="border-top-0 border-bottom-0">Total Expected Stocks (Sum of Lines 1 to 3)</td>
                    <td class="border-top-0 border-bottom-0"></td>
                    <td class="border-bottom">
                        <center><b></b></center>
                    </td>
                </tr>
                <tr class="table table-borderless">
                    <td class="border-top-0 border-bottom-0">
                        <center>5.</center>
                    </td>
                    <td class="border-top-0 border-bottom-0">Monthly Average Consumption</td>
                    <td class="border-top-0 border-bottom-0"></td>
                    <td class="border-bottom">
                        <center><b></b></center>
                    </td>
                </tr>
                <tr class="table table-borderless">
                    <td class="border-top-0 border-bottom-0">
                        <center>6.</center>
                    </td>
                    <td class="border-top-0 border-bottom-0">Estimated no. of months to Consume (Line 4 to 5)</td>
                    <td class="border-top-0 border-bottom-0"></td>
                    <td class="border-bottom">
                        <center><b></b></center>
                    </td>
                </tr>
            </table>
            <table class="table table-condensed border-0 table-sm" style="margin-top: -1.35%">
                <tr class="table table-borderless">
                    <td class="border-top-0"></td>
                </tr>
                <td style="text-indent: 150px" colspan="3" class="text-justify border-0">
                    <p>I certify to the fairness and reasonable of the the above data.</p>
                </td>
                <tr class="table table-borderless">
                    <td></td>
                    <td style="text-indent: 150px">___________________________________</td>
                    <td width="50%">
                        <center>
                            <h5><b><u>(END USER)</u></b></h5>
                        </center>
                    </td>
                </tr>
                <tr class="table table-borderless">
                    <td></td>
                    <td style="text-indent: 250px">DATE</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="text-indent: 100px" colspan="3" class="text-justify border-0">
                        <p>Note: Attach writes justification for requisition in excess of normal requirements.</p>
                    </td>
                </tr>
                <td class="pr1 border-0" colspan="20">
                    ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                </td>
            </table>
        </div>
    </div>
</div>
</template>

<script>
export default {
        data(){
            return{
                pr: {},

            }
        },
        methods:{
            get_pr(){
                axios.get('../../api/purchase_request/'+this.$route.params.id).then(({data}) => {
                    this.pr = data;
                }).catch(() => {

                });
            }
        },
        created(){
            this.get_pr();
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

table#t01 th {
    background-color: rgb(184, 172, 172) !important;
    border: 1px solid black;
    color: black;
    margin: 0px;
    padding: none;
}
</style>
