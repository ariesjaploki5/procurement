<template>
    <div id="f01">
        <div id="content-wrapper">
            <div class="col-lg-12">
                <table class="table table-condensed table-sm a">
                    <tr>
                        <td rowspan="7" class="pr1 border-top-0 border-right-0"><img :src="'/img/bghmc.png'"
                                style="margin-left: -1%; margin-top: 15%" width="150" height="150"></td>
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
                        <td rowspan="3" class="pr1" width="40%">
                            <center><br><b>
                                    <h1>PURCHASE REQUEST</h1>
                                </b></center>
                        </td>
                        <td class="pr1" colspan="4">Form No.: HS - PS - 001</td>
                    </tr>
                    <td class="pr1" colspan="4">Revision No.: 3</td>
                    <tr>
                        <td class="pr1" colspan="4">Effectivity Date: September 1, 2016</td>
                    </tr>
                    <td class="pr1" colspan="7"></td>
                    <tr>
                        <td class="pr1 border-right-0" colspan="1" width="15%">Department: </td>
                        <td class="pr1 border-left-0" width="10%"><b>getDivision()</b></td>
                        <td class="pr1 border-right-0" width="12.5%">PR No.:</td>
                        <td class="pr1 border-left-0" width="11%"><b>(year-month-series)</b></td>
                        <td class="pr1 border-right-0" width="1%">Date: </td>
                        <td class="pr1 border-left-0" width=""><b>getDate()</b></td>
                    </tr>
                    <tr>
                        <td class="pr1 border-right-0" colspan="1" width="15%">Section: </td>
                        <td class="pr1 border-left-0"><b>getDepartment()</b></td>
                        <td class="pr1 border-right-0">SAI No.:</td>
                        <td class="pr1 border-left-0" width=""></td>
                        <td class="pr1 border-right-0" width="">Date: </td>
                        <td class="pr1 border-left-0"></td>
                    </tr>
                    <tr>
                        <td class="pr1 border-left-0" colspan="2" width="15%"></td>
                        <td class="pr1 border-right-0">ORS No./BURS No:</td>
                        <td class="pr1 border-left-0" width=""></td>
                        <td class="pr1 border-right-0" width="">Date: </td>
                        <td class="pr1 border-left-0"></td>
                    </tr>
                    <td colspan="7"></td>
                </table>
                <table class="table table-condensed table-sm table-sm" style="margin-top:-1.7%">
                    <tr>
                        <td class="pr1 border-top-0" width="5%">
                            <center><b>Item No.</b></center>
                        </td>
                        <td class="pr1 border-top-0" width="5%">
                            <center><b>Qty.</b></center>
                        </td>
                        <td class="pr1 border-top-0" width="7%">
                            <center><b>Unit of Issue</b></center>
                        </td>
                        <td class="pr1 border-top-0">
                            <center><b>Item Description</b></center>
                        </td>
                        <td class="pr1 border-top-0" width="5%">
                            <center><b>Stock No.</b></center>
                        </td>
                        <td class="pr1 border-top-0" width="15%">
                            <center><b>Estimated Unit Cost</b></center>
                        </td>
                        <td class="pr1 border-top-0" width="15%">
                            <center><b>Estimated Cost</b></center>
                        </td>
                    </tr>
                    <tr v-for="item in pr.view_dmd_purchase_requests" :key="item.dmd_id">
                        <td class="pr1 border-top-0" width="5%">
                            <center>{{ item.dmd_id }}</center>
                        </td>
                        <td class="pr1 border-top-0" width="5%">
                            <center>{{ item.request_quantity }}</center>
                        </td>
                        <td class="pr1 border-top-0" width="7%">
                            <center>(unit_of_issue)</center>
                        </td>
                        <td class="pr1 border-top-0"><b>{{ item.gendesc }} {{ item.dmdnost }} {{ item.stredesc }} {{ item.formdesc }} {{ item.brandname }}</b>
                            <!-- <br><br>(added description) -->
                        </td>
                        <td class="pr1 border-top-0" width="7%">
                            <center>(batch_no)</center>
                        </td>
                        <td class="pr1 border-top-0" width="15%">
                            <center>{{ item.dmd_price_schedule.bid_price | currency2 }}</center>
                        </td>
                        <td class="pr1 border-top-0" width="15%">
                            <center>{{ item.request_quantity * item.dmd_price_schedule.bid_price | currency2 }}</center>
                        </td>
                    </tr>
                    <tr>
                        <td class="pr1 border-right-0 border-top-0">Purpose:</td>
                        <td class="pr1 border-left-0 border-top-0" colspan="7"><b>(Purpose)</b></td>
                    </tr>
                    <tr>
                        <td class="pr1 border-top-0" colspan="7"><b>Required Attachments:</b> <i
                                class="text-primary">(For Procurement Management Office use only)</i></td>
                    </tr>
                </table>
                <table class="table table-condensed table-borderless border-bottom-0 table-sm a"
                    style="margin-top:-1.7%">
                    <tr>
                        <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                        <td>Stock Position Sheet for Consumables</td>

                        <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                        <td>Acknowledgement Receipt for Equipment</td>

                        <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                        <td>Certificate of No suitable subtitute</td>
                    </tr>
                    <!-- {{-- ROW 2 --}} -->
                    <tr>
                        <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                        <td>Justification for none inclusion in the PPMP</td>

                        <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                        <td>Biomedical Service Report / MIS Service Report</td>

                        <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                        <td>Certificate of Exclusive Distributorship</td>
                    </tr>
                    <!-- {{-- ROW 3 --}} -->
                    <tr>
                        <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                        <td>Complete generic specification of item/s requested</td>

                        <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                        <td>Scope of Work / Detailed Estimate</td>

                        <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                        <td>Price Quotation</td>
                    </tr>
                </table>
                <table class="table table-condensed table-borderless border-top-0 table-sm table-sm a"
                    style="margin-top:-1.7%">
                    <tr>
                        <td><input type="checkbox" style="width: 25px; height: 25px"></td>
                        <td>Others:</td>
                        <td></td>
                        <td class="pr1 border-0" width="100%"><u>
                                <!--{{-- insert other content here --}}--></u></td>

                    </tr>
                </table>
                <table class="table table-condensed table-sm table-sm a" style="margin-top:-1.7%">
                    <tr>
                        <td class="pr1 border-top-0" width="20%"></td>
                        <td class="pr1 border-top-0">Requested By:</td>
                        <td class="pr1 border-top-0">Approved By:</td>
                    </tr>
                    <tr>
                        <td class="pr1">Signature:</td>
                        <td class="pr1"></td>
                        <td class="pr1"></td>
                    </tr>
                    <tr>
                        <td class="pr1">Printed Name:</td>
                        <td class="pr1">
                            <center><b></b></center>
                        </td>
                        <td class="pr1">
                            <center><b>RICARDO B. RUNEZ, J.R., MD,FPCS,MHA,CESE</b></center>
                        </td>
                    </tr>
                    <tr>
                        <td class="pr1">Designation:</td>
                        <td class="pr1">
                            <center>, MIS Division</center>
                        </td>
                        <td class="pr1">
                            <center>Medical Center Chief II</center>
                        </td>
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
