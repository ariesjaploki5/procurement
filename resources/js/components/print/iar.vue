<template>
    <div id="f01">
      <button class="btn btn-primary d-print-none button" onclick="print()"><i class="fas fa-print ml-2"></i> Print</button>
        <div id="content-wrapper">
            <div class="col-lg-12">

                <table class="table table-condensed table-sm" style="margin-top: 1%">
                    <tr>
                        <td rowspan="8" class="iar1"><img src="/bghmc.png" style="margin-left: 1.5%; margin-top: 20%"
                                width="150" height="150"></td>
                        <td colspan="5" class="iar1 border-bottom-0 text-center">Republic of the Philippines</td>
                    </tr>
                    <td colspan="5" class="iar1 border-top-0 border-bottom-0 text-center">Department of Health</td>
                    <tr>
                        <td colspan="5" class="iar1 border-top-0 border-bottom-0 text-center">
                            <strong>BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER</strong>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="iar1 border-top-0 text-center">Baguio City </td>
                    </tr>
                    <tr>
                        <td class="iar1 border-bottom-0 text-center">MATERIALS MANAGEMENT OFFICE </td>
                        <td class="iar1" colspan="3">Form No.: HS – MMO – 004</td>
                    </tr>
                    <tr>
                        <td rowspan="3" class="border-top-0 text-center" width="55%">
                            <strong>
                                <h4>INSPECTION AND ACCEPTANCE REPORT</h4>
                            </strong>
                        </td>
                    </tr>
                    <td class="iar1" colspan="4">Revision No.: 1</td>
                    <tr>
                        <td class="iar1" colspan="4">Effectivity Date: September 1, 2016</td>
                    </tr>
                    <td class="iar1 border-bottom-0" colspan="7"></td>
                </table>

                <table class="table table-condensed table-sm" style="margin-top:-2.2%">
                    <tr>
                        <td class="iar1 border-right-0 border-bottom-0" width="15%">SUPPLIER:</td>
                        <td class="iar1 border-left-0" width="40%"><strong>(Supplier Name)</strong></td>
                        <td class="iar1 border-right-0 border-bottom-0" width="15%">IAR Number:</td>
                        <td class="iar1 border-left-0 text-center" width="20%"><strong> </strong></td>
                    </tr>
                    <tr>
                        <td class="iar1 border-top-0 border-right-0 border-bottom-0" width="8%">PO Number:</td>
                        <td class="iar1 border-left-0" width="45%"><b>(year-month-series)</b></td>
                        <td class="iar1 border-top-0 border-right-0 border-bottom-0"> IAR Date: </td>
                        <td class="iar1 border-left-0 text-center"><strong> </strong></td>
                    </tr>
                    <tr>
                        <td class="iar1 border-right-0 border-top-0 border-bottom-0">PO Date:</td>
                        <td class="iar1 border-left-0 border-top-0"><strong>(date)</strong></td>
                        <td class="iar1 border-top-0 border-bottom-0" colspan="2"></td>
                    </tr>
                    <tr>
                        <td class="iar1 border-top-0 border-right-0 border-bottom-0" width="8%">Resp Center:</td>
                        <td class="iar1 border-left-0" width="45%"><strong> </strong></td>
                        <td class="iar1 border-top-0 border-right-0 border-bottom-0">DR/Invoice Number:</td>
                        <td class="iar1 border-left-0 border-top-0 text-center"><strong> </strong></td>
                    </tr>
                    <tr>
                        <td class="iar1 border-top-0 border-right-0 border-bottom-0" width="8%">ObRequest:</td>
                        <td class="iar1 border-left-0" width="45%"><strong> </strong></td>
                        <td class="iar1 border-top-0 border-right-0 border-bottom-0"> DR/Invoice Date:</td>
                        <td class="iar1 border-left-0 text-center"><strong> </strong></td>
                    </tr>
                    <tr>
                        <td class="iar1 border-top-0 border-bottom-0" colspan="2"></td>
                        <td class="iar1 border-top-0 border-bottom-0" colspan="2"></td>
                    </tr>
                    <tr>
                        <td class="iar1 border-top-0 border-bottom-0" colspan="2"></td>
                        <td class="iar1 border-top-0 border-bottom-0" colspan="2"></td>
                    </tr>
                </table>

                <table class="table table-condensed table-sm" style="margin-top:-2.2%" >
                    <tr>
                        <td class="iar1 text-center" width="3%"><strong><small>Stock/Property No.</small></strong></td>
                        <td class="iar1 text-center" width="27.2%"><strong><small>Description</small></strong></td>
                        <td class="iar1 text-center" width="3%"><strong><small>Unit</small></strong></td>
                        <td class="iar1 text-center" width="3%"><strong><small>Quantity</small></strong></td>
                        <td class="iar1 text-center" width="3%"><strong><small>Unit Cost</small></strong></td>
                        <td class="iar1 text-center" width="3.5%"><strong><small>Total Cost</small></strong></td>
                        <td class="iar1 text-center" width="3%"><strong><small>Lot/Batch No.</small></strong></td>
                    </tr>
                    <tr>
                        <td class="iar1 text-center"><small>1</small></td>
                        <td class="iar1 text-center"><small></small></td>
                        <td class="iar1 text-center"><small></small></td>
                        <td class="iar1 text-center"><small></small></td>
                        <td class="iar1 text-center"><small></small></td>
                        <td class="iar1 text-center"><small></small></td>
                        <td class="iar1 text-center"><small></small></td>
                    </tr>
                    <tr>
                        <td class="iar1 text-center" colspan="3"><strong>INSPECTION</strong></td>
                        <td class="iar1 text-center" colspan="4"><strong>ACCEPTANCE</strong></td>
                    </tr>
                    <tr>
                        <td class="iar1 text-justify" colspan="3" rowspan="3" style="text-indent:30px">
                            <p>Inspected, verified and found in order as to quanitity, specifications, and expiry date
                                (if applicable).</p>
                        </td>
                        <td class="iar1 border-bottom-0 border-right-0" colspan="2">Date Recieved:</td>
                        <td class="iar1 border-left-0" colspan="2"></td>
                    </tr>
                    <tr>
                        <td class="iar1 border-top-0 border-right-0 border-bottom-0" colspan="2">Partial/Complete?</td>
                        <td class="iar1 border-left-0" colspan="2"></td>
                    </tr>
                    <tr>
                        <td class="pr1 border-top-0" colspan="4"></td>
                    </tr>
                </table>
                <table class="table table-condensed table-sm" style="margin-top:-2%">
                    <tr>
                        <td class="iar1 border-bottom-0" width="10%"><small><strong>Inspection Officer</strong></small></td>
                        <td class="iar1 border-bottom-0" width="10%"><small><strong>Requisitioning Officer</strong></small></td>
                        <td class="iar1 border-bottom-0" width="10.2%" colspan="2"><small><strong>Supply and/or Property Custodian</strong></small>
                        </td>
                    </tr>
                    <tr>
                        <td class="iar2 border-top-0"></td>
                        <td class="iar2 border-top-0"></td>
                        <td class="iar2 border-top-0 text-center" colspan="2"><br><strong><h5>TEOFILO M. RIVERA JR.</h5>
                        <small>Supervising Administrative Officer<br>
                        Head, Materials Management Office</small></strong></td>
                    </tr>
                    <tr>
                        
                    </tr>
                </table>
                <table class="table table-condensed table-sm" style="margin-top:-4%">
                    <tr>
                        <td class="iar1 border-top-0 border-bottom-0 border-right-0" width="15%"><small><strong>Date Inspected: </strong></small></td>
                        <td class="iar1 border-top-0 border-left-0" width="18.3%"></td>
                        <td class="iar1 border-top-0 border-bottom-0 border-right-0" width="15%"><small><strong>Date Inspected: </strong></small></td>
                        <td class="iar1 border-top-0 border-left-0" width="18.25%"></td>
                        <td class="iar1 border-top-0 border-bottom-0"></td>
                    </tr>
                   <tr>
                       <td class="iar1 border-top-0" colspan="2"></td>
                       <td class="iar1 border-top-0" colspan="2"></td>
                       <td class="iar1 border-top-0"></td>
                   </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {

        }
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

    div#f01 {
        font-family: 'Helvetica', sans-serif;
    }
    td.iar1 {
        border-collapse: collapse;
        border: 1px solid black;
        margin: 0px;
        padding: none;
        padding-top: 0px;
    }
    td.iar2 {
        border-collapse: collapse;
        border: 1px solid black;
        height: 100px;
    }
    table#t01 th {
        background-color: rgb(184, 172, 172) !important;
        border: 1px solid black;
        color: black;
        margin: 0px;
        padding: none;
    }

</style>
