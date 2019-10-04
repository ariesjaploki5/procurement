<template>
    <div id="f01">
        <button class="btn btn-primary d-print-none button" onclick="print()"><i class="fas fa-print ml-2"></i>
            Print</button>
        <div id="content-wrapper">
            <div class="col-lg-12">
                <table class="table table-condensed table-sm" style="margin-top: 5%">
                    <tr>
                        <td class="vr1 border-0 text-center" colspan="10">
                            <h2>ORDER OF TERMINATION</h2>
                        </td>
                    </tr>
                    <tr>
                        <td class="vr1 border-0 text-center font-weight-bolder align-top" colspan="10"><small>(OT No.: OT-2019-07-161)</small></td>
                    </tr>
                    <p class="font-weight-bold" colspan="10">July 01, 2019</p><br>
                    <p class="font-weight-bold" colspan="10">ZEULLIG PHARMA CORPORATION</p>
                    <p style="margin-top: -1%">Km. 14 West Service Rd. South Superhighway corner Edison Ave.</p>
                    <p style="margin-top: -1%">Brgy. Sun Valley, Parañaque City</p><br><br>
                    <p class="font-weight-bold" colspan="10">Sir/Madam:</p><br>
                    <p colspan="10">We regret to inform you that the contract for the following item has been terminated. Despite the issuance of Notice of Termination
                        (see remarks), you have failed to show cause within the prescribed period as to why the contract should not be terminated.</p><br>
                </table>
                <table class="table table-condensed table-sm" style="margin-top: -2%">
                    <tr>
                        <td class="vr1 text-center font-weight-bold align-middle" width="5%">PURCHASE ORDER</td>
                        <td class="vr1 text-center font-weight-bold align-middle" width="15%">ITEM DESCRIPTION</td>
                        <td class="vr1 text-center font-weight-bold align-middle" width="5%">UNIT</td>
                        <td class="vr1 text-center font-weight-bold align-middle" width="5%">QTY</td>
                        <td class="vr1 text-center font-weight-bold align-middle" width="7%">DUE DATE</td>
                        <td class="vr1 text-center font-weight-bold align-middle" width="7%">NOTICE TO TERMINATE</td>
                    </tr>
                    <tr>
                        <td class="vr1 text-center align-middle">2019-05-2352</td>
                        <td class="vr1"><small>
                                       CILOSTAZOL 100mg, tablet<br>
                                       Brand Name: Ciletin<br>
                                       Dosage Strength & FormL 100 mg tablet<br>
                                       Packaging: Blister pack x 10's (Box of 100's)<br>
                                       Manufacturer: Korea United Pharm., Inc.<br>
                                       Country of Origin: Korea<br>
                                       CPR VALIDITY: 12 NOVEMBER 2019</small></td>
                        <td class="vr1 text-center align-middle">tablet</td>
                        <td class="vr1 text-center align-middle">2900</td>
                        <td class="vr1 text-center align-middle">06/27/2019</td>
                        <td class="vr1 text-center align-middle"><small>With waiver recieved on 6/25/2019</small></td>
    
                    </tr>
                    
                </table>
                    <p colspan="5" class="text-justify">The ground/cause of termination is the following pursuant to the Guidelines on Termination of Contracts of the IRR of RA 9184:</p>
                    <p style="text-indent: 2%; margin-top: -1.5%">1. Default in the performance of your obligations under the Contract.</p>
                    <p style="text-indent: 5%; margin-top: -1.5%">a. You have failed to deliver after the due date.</p>
                    <p class="text-justify">The termination is not limited to the aforementioned Purchase Order(s) but shall cover ALL unperformed poriton in the contract of the above
                        listed items awarded to your Company. This includes Purchase Order(s) prepared or approved prior to this ORder of Termination.</p>
                    
                    <p>Very truly yours,</p><br>
                    <p class="font-weight-bold">RICARDO B. RUNEZ, JR., MD, FPCS, MHA, CESE</p>
                    <p style="margin-top:-1.5%">Medical Center Chief II</p><br><br>

                    <p class="text-right"><small>Date/Time Printed: 07-05-2019(Fri) / 01:56 PM</small></p>
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
