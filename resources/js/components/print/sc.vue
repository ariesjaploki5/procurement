<template>
    <div id="f01">
      <button class="btn btn-primary d-print-none button" onclick="print()"><i class="fas fa-print ml-2"></i> Print</button>
        <div id="content-wrapper">
            <div class="col-lg-12">

                <table class="table table-condensed table-sm" style="margin-top: 1%">
                    <tr>
                        <td rowspan="8" class="mmsc"><img src="/bghmc.png" style="margin-left: 1.5%; margin-top: 15%"
                                width="150" height="150"></td>
                        <td colspan="5" class="mmsc border-bottom-0 text-center">Republic of the Philippines</td>
                    </tr>
                    <td colspan="5" class="mmsc border-top-0 border-bottom-0 text-center">Department of Health</td>
                    <tr>
                        <td colspan="5" class="mmsc border-top-0 border-bottom-0 text-center">
                            <strong>BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER</strong>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="mmsc border-top-0 text-center">Baguio City </td>
                    </tr>
                    <tr>
                        <td class="mmsc border-bottom-0 text-center">MATERIALS MANAGEMENT OFFICE </td>
                        <td class="mmsc" colspan="3">Form No.:</td>
                    </tr>
                    <tr>
                        <td rowspan="3" class="border-top-0 text-center" width="55%">
                            <strong>
                                <h2>STOCK CARD</h2>
                            </strong>
                        </td>
                    </tr>
                    <td class="mmsc" colspan="4">Revision No.: 1</td>
                    <tr>
                        <td class="mmsc" colspan="4">Effectivity Date: January 4, 2016</td>
                    </tr>
                    <td class="mmsc border-bottom-0" colspan="7"></td>
                </table>

                <table class="table table-condensed table-sm" style="margin-top:-2.2%">
                    <tr>
                        <td class="mmsc" colspan="2" width="15%"><strong>ITEM DESCRIPTION</strong></td>
                        <td class="mmsc" colspan="7"><strong> AIR FRESHNER 280ML/CAN</strong></td>                      
                    </tr>
                    <tr>
                       <td class="mmsc" colspan="2"><strong> UNIT OF MEASURE</strong></td>
                       <td class="mmsc" colspan="2"><strong> TIN</strong></td>                          
                       <td class="mmsc" colspan="3"><strong>STANDARD STOCK LEVEL</strong></td>
                       <td class="mmsc" colspan="2"></td>
                    </tr>
                     <tr>
                       <td class="mmsc" colspan="2"><strong>STOCK NUMBER</strong></td>
                       <td class="mmsc" colspan="2"><strong> 10402990-00-OS-001</strong></td>                          
                       <td class="mmsc" colspan="2"><strong>REORDER POINT</strong></td>
                       <td class="mmsc"></td>
                       <td class="mmsc"></td>
                       <td class="mmsc"></td>
                    </tr>
                      <tr>
                       <td class="mmsc" colspan="2"><strong>CLUSTER</strong></td>
                       <td class="mmsc" colspan="4"><strong>Special Fund </strong></td>                          
                       <td class="mmsc text-center"><strong><small>ROP 1</small></strong></td>
                       <td class="mmsc text-center"><strong><small>ROP 2</small></strong></td>
                       <td class="mmsc text-center"><strong><small>ROP 3</small></strong></td>
                    </tr>
                     <tr>
                        <td class="mmsc text-center" rowspan="2"><small> DATE </small></td>
                        <td class="mmsc text-center" rowspan="2"><small> REF </small></td>
                        <td class="mmsc text-center" rowspan="2" width="25%"><strong><small> RECEIPT:SUPPLIER <br> ISSUE: RESPONSIBILITY CENTER </small></strong></td>
                        <td class="mmsc text-center" rowspan="2" width="5%"><small> LOT/BATCH NUMBER</small></td>
                        <td class="mmsc text-center" rowspan="2" width="5%"><strong><small> Expiry Date</small></strong></td>
                        <td class="mmsc text-center" colspan="3" width="15%"><strong><small> QUANTITY</small></strong></td>
                        <td class="mmsc text-center" rowspan="2" width="5%"><small> DAYS TO CONSUME </small></td>                       
                    </tr>
                    <tr>
                        <td class="mmsc text-center"><strong><small> RECEIVED </small></strong></td>
                        <td class="mmsc text-center"><strong><small> ISSUED </small></strong></td>
                        <td class="mmsc text-center"><strong><small> BALANCE </small></strong></td>
                    </tr>
                    <tr>
                         <!--SAMPLE DATA -->
                        <td class="mmsc border-right-0" colspan="3"><strong><i>BEGINNING BALANCE </i></strong></td>
                        <td class="mmsc border-left-0"><strong><i> DATE</i></strong></td>
                        <td class="mmsc" colspan="3"><strong><i> January 01, 2019 </i></strong></td>
                        <td class="mmsc text-center"><strong><small> 366</small></strong></td>
                        <td class="mmsc"><strong><small> </small></strong></td>
                    </tr>
                    <tr>
                        <td class="mmsc text-center"><small>01-04-2019 </small></td>
                        <td class="mmsc text-center"><small>2019-01-32 </small></td>
                        <td class="mmsc"><small>Budget Office </small></td>
                        <td class="mmsc"><small> </small></td>
                        <td class="mmsc"><small> </small></td>
                        <td class="mmsc"><small> </small></td>
                        <td class="mmsc text-center"><small>3 </small></td>
                        <td class="mmsc text-center"><small>363 </small></td>
                        <td class="mmsc text-center"><small> </small></td>
                    </tr>
              </table>
               <hr class="border border-dark">
                <table class="table table-condensed table-sm">
                    <tr>
                       <td class="mmsc border-0" width="15%"><strong>Prepared by:</strong></td>
                   </tr>
                   <tr>
                       <td class="mmsc border-0" width="5%"></td><br>
                       <td class="mmsc border-top-0 border-left-0 border-right-0" width="35%"></td>
                       <td class="mmsc border-0" width="50%"></td>
                   </tr>
                   <tr>
                       <td class="mmsc border-0"></td><br>
                       <td class="mmsc border-0 text-center">(END USER)</td>
                       <td class="mmsc border-0"></td>
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

<style lang="scss" scoped>
.img-thumbnail{
        margin-top: 0% !important;
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
    td.mmsc {
        border-collapse: collapse;
        border: 1px solid black;
        padding: none;
        padding-top: 0px;
    }
    td.iar2 {
        border-collapse: collapse;
        border: 1px solid black;
        height: 100px;
    }
</style>
