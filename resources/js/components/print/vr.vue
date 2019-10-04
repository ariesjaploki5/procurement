<template>
    <div id="f01">
        <button class="btn btn-primary d-print-none button" onclick="print()"><i class="fas fa-print ml-2"></i>
            Print</button>
        <div id="content-wrapper">
            <div class="col-lg-12">
                <table class="table table-condensed table-sm" style="margin-top: 5%">
                    <tr>
                        <td class="vr1 border-0 text-center" colspan="10">
                            <h2>VERIFIED REPORT</h2>
                        </td>
                    </tr>
                    <tr>
                        <td class="vr1 border-0 text-center font-weight-bolder align-top" colspan="10"><small>(Verified
                                Report No.: 2019-07-71)</small></td>
                    </tr>
                    <p class="font-weight-bold" colspan="10">July 02, 2019</p><br>
                    <p colspan="10">RICARDO B. RUNEZ JR., MD, FPCS, MHA, CESE</p>
                    <p style="margin-top: -1%" colspan="10">Medical Center Chief II</p><br>
                    <p class="font-weight-bold" colspan="10">Sir:</p><br>
                    <p colspan="10">The Supplier(s) of the following Purchase Order(s) failed to deliver the items being
                        procured after the due date hence, this report.</p><br>
                    <p class="text-justify" colspan="10">Pursuant to the Guidelines on Termination of Contracts of the
                        IRR of R.A. 9184, we recommend for the issuance of <b>NOTICE TO TERMINATE</b> to cover the
                        following Purchase Order(s)
                        including any unperformed portion of the award and contract of the same items to the same
                        Supplier(s).</p>
                    <p class="align-bottom text-right">(Verified Report No.: 2019-07-21)</p>
                </table>
                <table class="table table-condensed table-sm" style="margin-top: -2%">
                    <tr>
                        <td class="vr1 text-center align-middle" width="1%">Seq.</td>
                        <td class="vr1 text-center align-middle" width="6%"># List</td>
                        <td class="vr1 text-center align-middle" width="2%"># NT</td>
                        <td class="vr1 text-center font-weight-bold align-middle" width="12%">SUPPLIER</td>
                        <td class="vr1 text-center font-weight-bold align-middle" width="10%">PO Number</td>
                        <td class="vr1 text-center font-weight-bold align-middle" width="15%">ITEM DESCRIPTION</td>
                        <td class="vr1 text-center font-weight-bold align-middle" width="5%">UNIT</td>
                        <td class="vr1 text-center font-weight-bold align-middle" width="5%">QTY</td>
                        <td class="vr1 text-center font-weight-bold align-middle" width="5%">DUE DATE</td>
                        <td class="vr1 text-center font-weight-bold align-middle" width="8%">MODE</td>
                    </tr>
                    <tr>
                        <td class="vr1 text-center align-middle">1</td>
                        <td class="vr1 text-center align-middle"><small>2019-3252</small></td>
                        <td class="vr1 text-center align-middle"><small>427</small></td>
                        <td class="vr1 align-middle">METRO DRUG,INC.</td>
                        <td class="vr1 text-center align-middle">2019-05-2229</td>
                        <td class="vr1"><small>
                                        FINASTERIDE, 5mg tablet 
                                        Brand Name: Eosteride
                                        Dosage Strength & Form: 5mg Film-Coated Tablet
                                        Packaging: Alu-PVC Blister Pack x 10's(Box of 10's, 30's and 100's)
                                        Manufacturer: Helviina Pharmaceuticals Pvt. Ltd.
                                        Country of Origin: India
                                        CPR VALIDITY: 14 MAY 2020</small></td>
                        <td class="vr1 text-center align-middle"><small>tablet</small></td>
                        <td class="vr1 text-center align-middle">1440</td>
                        <td class="vr1 text-center align-middle"><small>06/27/2019</small></td>
                        <td class="vr1 text-center align-middle"><small>Public Bidding 2019</small></td>
                    </tr>
                </table>
                <table class="table table-condensed table-sm">
                    <p>Thank you very much.</p><br>
                    <p>Very truly yours,</p><br>
                    <p class="font-weight-bold">TEOFILO M. RIVERA JR.</p>
                    <p style="margin-top: -2%">Head, Materials Management Office</p><br>
                    <tr>
                        <td class="vr1 border-0 font-weight-bold" width="35%">Recommending Approval:</td>
                        <td class="vr1 border-0 font-weight-bold" width="25%">Approved:</td>
                        <td class="vr1 border-0" width="5%"></td>
                    </tr>
                    <br>
                    <tr>
                        <td class="vr1 border-0 font-weight-bold">PRISCILLA P. GALISTE, MPA</td>
                        <td class="vr1 border-0 font-weight-bold">RICARDO B. RUNEZ, JR., MD, FPCS, MHA, CESE</td>
                    </tr>
                    <tr>
                        <td class="vr1 border-0 font-weight-bold"><small>Chief Administrative Officer</small></td>
                        <td class="vr1 border-0 font-weight-bold"><small>Medical Center Chief II</small></td>
                    </tr>
                    <tr>
                        <td class="vr1 border-0 font-weight-bold"><small>Hospital Operations and Patient Support Service</small></td>
                        
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

    function print() {
        window.print();
        location.reload();
    }

</script>

<style lang="scss" scoped>
    @font-face {
        font-family: 'Helvetica';
        src: url('https://fonts.googleapis.com/css?family=Helvetica');
        font-weight: normal;
        font-style: normal;
    }

    div#f01 {
        font-family: 'Helvetica', sans-serif;
    }

    td.vr1 {
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
