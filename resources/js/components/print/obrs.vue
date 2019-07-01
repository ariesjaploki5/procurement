<template>
<div id="f01">
    <div id="content-wrapper">
        <div class="col-lg-12">
            <table class="table table-condensed table-sm a">
                <tr>
                    <td rowspan="8" class="pr1 border-top-0 border-right-0"><img :src="'/img/bghmc.png'" style="margin-left: 15%; margin-top: 15%" width="150" height="150"></td>
                    <td colspan="5" class="pr1 border-top-0 border-bottom-0" id="pr1"><center>Republic of the Philippines</center></td>
                </tr>
                <td colspan="5" class="pr1 border-top-0 border-bottom-0"><center>Department of Health</center></td>
                <tr>
                    <td colspan="5" class="pr1 border-top-0 border-bottom-0"><center><b>BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER</b></center></td>
                </tr>
                <tr>
                    <td colspan="5" class="pr1 border-top-0"><center>Baguio City</center></td>
                </tr>
                <tr>
                    <td class="border-bottom-0"><h5><input type="checkbox" style="width: 25px; height: 20px"> <b>OBLIGATION REQUEST AND STATUS</b></h5></td>
                    <td class="pr1 align-bottom">Form No.: <b>FS-BUD-001</b></td>
                </tr>
                <tr>
                    <td rowspan="3" class="border-top-0" width="50%"><h5><input type="checkbox" style="width: 25px; height: 20px"> <b>BUDGET UTILIZATION REQUEST AND STATUS</b></h5></td>
                </tr>
                <td class="pr1 align-bottom" colspan="4">Revision No.: 2</td>
                <tr>
                    <td class="pr1 align-bottom" colspan="4">Effectivity Date: September 1, 2016</td>
                </tr>
                <td class="pr1" colspan="7"></td>
            </table>

            <table class="table table-condensed table-sm" style="margin-top:-1.6%">
                <tr>
                    <td class="pr1 border-right-0 border-top-0 border-bottom-0" width="8%"><b>Payee:</b></td>
                    <td class="pr1 border-left-0 border-top-0" width="45%"></td>
                    <td class="pr1 border-right-0 border-top-0 border-bottom-0" width="10%"> <b>Serial No:</b></td>
                    <td class="pr1 border-left-0 border-top-0" width="25%">{{ po.fund_source.acronym }}-0{{ po.allotment.allotment_code }}-{{ po.uacs.current_appropriations }}-{{ po.obrs_date | myDate}}-{{ po.purchase_order_id | numeral2}}</td>
                </tr>
                <tr>
                    <td class="pr1 border-right-0 border-top-0 border-bottom-0"><b>Office:</b></td>
                    <td class="pr1 border-left-0 border-top-0"></td>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0"> <b>Date:</b></td>
                    <td class="pr1 border-left-0"></td>
                </tr>
                <tr>
                    <td class="pr1 border-right-0 border-top-0 border-bottom-0"><b>Address:</b></td>
                    <td class="pr1 border-left-0 border-top-0"></td>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0"> <b>Fund Cluster:</b></td>
                    <td class="pr1 border-left-0">0{{ po.fund_source.id }}</td>
                </tr>
                <td colspan="7" class="pr1 border-top-0 border-bottom-0"></td>
            </table>

            <table class="table table-condensed table-sm" style="margin-top:-1.6%">
                <thead>
                    <td class="pr1" width="10%"><b><center>Responsibility Center</center></b></td>
                    <td class="pr1" width="30%"><b><center>Particulars</center></b></td>
                    <td class="pr1" width="10%"><b><center>MFO/PAP</center></b></td>
                    <td class="pr1" width="10%"><b><center>UACS Object Code/Expenditures</center></b></td>
                    <td class="pr1" width="10%"><b><center>Amount</center></b></td>
                </thead>
                <tr>
                    <td class="pr1 border-bottom-0"><center>1</center></td>
                    <td class="pr1 border-bottom-0"></td>
                    <td class="pr1 border-bottom-0"></td>
                    <td class="pr1 border-bottom-0"></td>
                    <td class="pr1 border-bottom-0"></td>
                </tr>
                <tr>
                    <td class="pr1 border-top-0 border-bottom-0"><center>2</center></td>
                    <td class="pr1 border-top-0 border-bottom-0"></td>
                    <td class="pr1 border-top-0 border-bottom-0"></td>
                    <td class="pr1 border-top-0 border-bottom-0"></td>
                    <td class="pr1 border-top-0 border-bottom-0"></td>
                </tr>
                <tr>
                    <td class="pr1 border-top-0 border-bottom-0"><center>3</center></td>
                    <td class="pr1 border-top-0 border-bottom-0"></td>
                    <td class="pr1 border-top-0 border-bottom-0"></td>
                    <td class="pr1 border-top-0 border-bottom-0"></td>
                    <td class="pr1 border-top-0 border-bottom-0"></td>
                </tr>
                <tr>
                    <td class="pr1 border-top-0"><center></center></td>
                    <td class="pr1 border-top-0" style="text-align:right"><b>Total</b></td>
                    <td class="pr1 border-top-0"></td>
                    <td class="pr1 border-top-0"></td>
                    <td class="pr1 border-top-0 "><center><b>(-)</b></center></td>
                </tr>
            </table>
            <table class="table table-condensed border-top-0 border-bottom-0 table-sm" style="margin-top:-1.7%">
                <tr>
                    <td class="pr1 border-top-0" width="3%"><center><b>A</b></center></td>
                    <td class="pr1 border-top-0 border-bottom-0" width="40%"></td>
                    <td class="pr1 border-top-0" width="3%"><center><b>B</b></center></td>
                    <td class="pr1 border-top-0 border-bottom-0" width="40%"></td>
                </tr>
                <tr>
                    <td class="pr1 border-right-0 border-bottom-0"></td>
                    <td class="pr1 border-left-0 border-top-0 border-bottom-0 text-justify"><h5>Certified: Charges to appropriation/allotment/budget necessary, lawful and under my direct supervision; and supporting documents valid, proper and legal.</h5></td>
                    <td class="pr1 border-right-0 border-bottom-0"></td>
                    <td class="pr1 border-left-0 border-top-0 border-bottom-0 text-justify"><h5>Certified: Allotment / Budget available and obligated / utilized for the purpose / adjustment necessary as indicated above.</h5></td>
                </tr>
            </table>
            <table class="table table-condensed border-top-0 border-bottom-0 table-sm" style="margin-top:-2.2%">
                <tr>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0" width="20%"><h5>Signature:</h5></td>
                    <td class="pr1 border-left-0 border-top-0"></td>
                    <td class="pr1 border-0"><h5>Signature:</h5></td>
                    <td class="pr1 border-left-0 border-top-0" width="30%"></td>
                </tr>
                <tr>
                    <td class="pr1 border-0pr1 border-top-0 border-right-0 border-bottom-0"><h5>Printed Name:</h5></td>
                    <td class="pr1 border-left-0 border-top-0 align-bottom" width="30%"></td>
                    <td class="pr1 border-0"><h5>Printed Name:</h5></td>
                    <td class="pr1 border-left-0 border-top-0 align-bottom" width="30%"><center><b>EDNA L. MOGAMOG, CPA, MBA</b></center></td>
                </tr>
                <tr>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0"><h5>Position:</h5></td>
                    <td class="pr1 border-left-0"></td>
                    <td class="pr1 border-0"><h5>Position:</h5></td>
                    <td class="pr1 border-left-0"><center>Supervising Administrative Officer<br>Head, Budget Office</center></td>
                </tr>
                <tr>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0"><h5>Date:</h5></td>
                    <td class="pr1 border-left-0"></td>
                    <td class="pr1 border-0"><h5>Date:</h5></td>
                    <td class="pr1 border-left-0"></td>
                </tr>
                <tr>
                    <td class="pr1 border-top-0 border-bottom-0" colspan="4"></td>
                </tr>
            </table>
            <table class="table table-condensed border-top-0 border-bottom-0 table-sm" style="margin-top:-1.5%">
                <tr>
                    <td class="pr1" width="3%"><center><b>C</b></center></td>
                    <td class="pr1 text-center align-bottom" width="80%"><b><h5>STATUS OF OBLIGATION / UTILIZATION</h5></b></td>
                </tr>
            </table>
            <table class="table table-condensed table-sm" style="margin-top:-2%">
                <tr>
                    <td class="pr1" colspan="3"><b><center>Reference</center></b></td>
                    <td class="pr1" colspan="5"><b><center>Amount</center></b></td>
                </tr>
                <tr>
                    <td class="pr1" rowspan="3"><center><b>Date</b></center></td>
                    <td class="pr1" rowspan="3"><center><b>Particulars</b></center></td>
                    <td class="pr1" rowspan="3"><center><b>ORS/BURS/JEV/Check /RCI/ADA</b></center></td>
                    <td class="pr1" rowspan="2"><center><b>Obligation / Utilization</b></center></td>
                    <td class="pr1" rowspan="2"><center><b>Payable</b></center></td>
                    <td class="pr1" rowspan="2"><center><b>Payment</b></center></td>
                    <td class="pr1" colspan="2"><center><b>Balance</b></center></td>
                </tr>
                <tr>
                    <td class="pr1" width="8%"><center><b>Not Yet Due</b></center></td>
                    <td class="pr1" width="5%"><center><b>Due and Demandable</b></center></td>
                </tr>
                <tr>
                    <td class="pr1"><center><small>(a)</small></center></td>
                    <td class="pr1"><center><small>(b)</small></center></td>
                    <td class="pr1"><center><small>(c)</small></center></td>
                    <td class="pr1"><center><small>(a-b)</small></center></td>
                    <td class="pr1"><center><small>(b-c)</small></center></td>
                </tr>
                <tr>
                    <td class="pr1"><center><b>1</b></center></td>
                    <td class="pr1"><center><b></b></center></td>
                    <td class="pr1"><center><b></b></center></td>
                    <td class="pr1"><center><b>(-)</b></center></td>
                    <td class="pr1"><center><b></b></center></td>
                    <td class="pr1"><center><b></b></center></td>
                    <td class="pr1"><center><b>(-)</b></center></td>
                    <td class="pr1"><center><b></b></center></td>
                </tr>
                <!-- -->
                <tr>
                    <td class="pr1"><center><b>2</b></center></td>
                    <td class="pr1"><center><b></b></center></td>
                    <td class="pr1"><center><b></b></center></td>
                    <td class="pr1"><center><b>(-)</b></center></td>
                    <td class="pr1"><center><b></b></center></td>
                    <td class="pr1"><center><b></b></center></td>
                    <td class="pr1"><center><b>(-)</b></center></td>
                    <td class="pr1"><center><b></b></center></td>
                </tr>
                <!-- -->
                <tr>
                    <td class="pr1"><center><b>3</b></center></td>
                    <td class="pr1"><center><b></b></center></td>
                    <td class="pr1"><center><b></b></center></td>
                    <td class="pr1"><center><b>(-)</b></center></td>
                    <td class="pr1"><center><b></b></center></td>
                    <td class="pr1"><center><b></b></center></td>
                    <td class="pr1"><center><b>(-)</b></center></td>
                    <td class="pr1"><center><b></b></center></td>
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
            },
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

<style lang="scss">
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
