<template>
    <div id="f01">
      <button class="btn btn-primary d-print-none button" onclick="print()"><i class="fas fa-print ml-2"></i> Print</button>
        <div id="content-wrapper">
            <div class="col-lg-12">
                <table class="table table-condensed table-sm a" style="margin-top: 1%">
                    <tr>
                        <td class="pr1 border-right-0" rowspan="8"><img :src="'/img/bghmc.png'" style="margin-left: 15%; margin-top: 10%" width="150" height="150"></td>
                        <td class="pr1 border-bottom-0 text-center" colspan="5" id="pr1">Republic of the Philippines</td>
                    </tr>
                    <td class="pr1 border-top-0 border-bottom-0 text-center" colspan="5">Department of Health</td>
                    <tr>
                        <td class="pr1 border-top-0 border-bottom-0 text-center" colspan="5"><b>BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER</b></td>
                    </tr>
                    <tr>
                        <td class="pr1 border-top-0 text-center" colspan="5">Baguio City</td>
                    </tr>
                    <tr>
                        <td class="pr1 text-center" rowspan="3" width="40%"><br><b><h3>REQUEST FOR QUOTATION</h3></b></td>
                        <td class="pr1" colspan="4">Form No.: HS - PS - 007</td>
                    </tr>
                    <td class="pr1" colspan="4">Revision No.: 1</td>
                    <tr>
                        <td class="pr1" colspan="4">Effectivity Date: December 1, 2015</td>
                    </tr>
                </table>

                <table class="table table-condensed table-borderless border-0 table-sm" style="margin-top:-1.2%">
                    <tr>
                        <td class="pr1 border-top-0 border-right-0 border-left-0"></td>
                        <!--{{-- NAME OF COMPANY --}}-->
                        <td width="15%">Date Prepared:</td>
                        <td width="20%">{{ rfq.created_at | myDate3 }}</td>
                    </tr>
                    <tr>
                        <td class="pr1 border-top-0 border-right-0 border-left-0"></td>
                        <td width="15%">Requisition No.:</td>
                        <td width="20%"></td>
                    </tr>
                    <tr>
                        <td class="border-bottom-0"></td>
                        <td width="15%">R.F.Q. No.:</td>
                        <td width="20%">{{ rfq.created_at | myDate }} - {{ rfq.id | numeral2 }}</td>
                    </tr>
                </table>
                <table class="table table-condensed table-borderless border-0 table-sm" style="margin-top:-1.2%">
                    <tr>
                        <td>
                            <h5>Gentlemen:</h5>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-indent: 50px; text-align:justify">
                            <h5>Please quote your least price most advantageous to the Government for the following item
                                and/or items for immediate delivery upon notice.</h5>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-indent: 50px"><i class="text-danger">
                                <h5>Please indicate the brand and the manufacturer of the item being offered.</h5>
                            </i></td>
                    </tr>
                </table>

                <table class="table table-condensed table-sm" style="margin-top:-1.2%">
                    <tr>
                        <td class="pr1 text-center" rowspan="2" width="5%">ITEM NO.</td>
                        <td class="pr1 text-center" rowspan="2" width="5%"><br>QTY</td>
                        <td class="pr1 text-center" rowspan="2" width="5%"><br>UNIT</td>
                        <td class="pr1 text-center" rowspan="2" width="35"><h5><br><b>ARTICLE AND DESCRIPTION</b></h5></td>
                        <td class="pr1 text-center" rowspan="2" width="10%"><small>Approved Budget for the Contact</small></td>
                        <td class="pr1 text-center" rowspan="2" width="10%"><br>Brand Name</td>
                        <td class="pr1 text-center" rowspan="2" width="10%"><br>Manufacturer</td>
                        <td class="pr1 text-center" colspan="2" width="20%">PRICE</td>
                    </tr>
                    <tr>
                        <td class="pr1 text-center" width="10%">UNIT</td>
                        <td class="pr1 text-center" width="10%">TOTAL</td>
                    </tr>
                    <tr>
                        <td class="pr1 text-center">1</td>
                        <td class="pr1 text-center">{{ rfq.request_quantity | numeral3 }}</td>
                        <td class="pr1 text-center"> </td>
                        <td class="pr1 text-center">{{ rfq.dmddesc }}</td>
                        <td class="pr1 text-center">{{ rfq.cost | currency2 }}</td>
                        <td class="pr1 text-center">{{ rfq.brand_desc }}</td>
                        <td class="pr1 text-center">{{ rfq.manufacturer_desc }}</td>
                        <td class="pr1 text-center">{{ rfq.cost_unit | currency2 }}</td>
                        <td class="pr1 text-center">{{ rfq.cost_unit * rfq.request_quantity |currency2 }}</td>
                    </tr>
                </table>
                <table class="table table-condensed table-borderless border-0 table-sm">
                    <tr>
                        <td style="text-align:justify"><h5>NOTE: This Request for Quotation be submitted by the canvasser<b><u> at the BGHMC BAC Office sealed</u></b></h5> or before _______________________________________.</td>
                    </tr>
                </table>
                <table class="table table-condensed table-borderless border-0 table-sm" style="margin-top: 10%">
                    <tr>
                        <td style="text-align:justify"><h5>Requested By:</h5></td>
                    </tr>
                    <tr>
                        <td style="text-indent: 50px"><br><br><br>___________________________________________________________</td>
                        <td><br><br><br>_________________________________________________________</td>
                    </tr>
                    <tr>
                        <td class="align-bottom" style="text-indent: 90px"><b><h5>FELICIDAD F. ATOS, MPA</h5></b></td>
                        <td style="text-indent: 155px"><h5>BAC Member</h5></td>
                    </tr>
                    <tr>
                        <td class="align-top" style="text-indent: 90px"><small>SAO, Procurement Management Office</small></td>
                    </tr>
                    <tr>
                        <td style="text-align:justify">This is to certify that I personally distributed the Request for
                            Price Quotation and that the entries herein provided are true and correct of my own personal
                            knowledge and belief, under pain of action for falsification / Perjury.</td>
                        <td style="text-align:justify">This is to certify that I / We personally received the Request
                            for Price Quotation and that the entries herein provided are true and correct of my own
                            personal knowledge and belief.</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>________________________________________________________</td>
                    </tr>
                    <tr>
                        <td style="text-indent: 90px"><h5> </h5></td>
                        <td class="align-bottom" style="text-indent: 155px"><h5>Supplier</h5></td>
                    </tr>
                    <tr>
                        <td style="text-indent: 100px"><h5> </h5></td>
                        <td class="align-top" style="text-indent: 80px"><h6>(Signature over Printed Name)</h6></td>
                    </tr>
                    <tr>
                        <td style="text-indent: 100px"><h5> </h5></td>
                        <td><h6>Address: <u>{{ rfq.supplier_address }}</u></h6></td>
                    </tr>
                    <tr>
                        <td>___________________________________________________________</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-indent: 150px"><b>
                                <h5>Canvasser</h5>
                            </b></td>
                        <td>
                            <h6>Telephone Number: <u>{{ rfq.tel_no }}</u></h6>
                        </td>
                    </tr>
                    <tr>
                        <td><b><h5>Email:<i class="text-primary"> bghmcprocurement@gmail.com</i></h5></b></td>
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
                rfq: '',
            }
        },
        methods:{
            get_rfq(){
                axios.get('../../api/dmd_rfq/'+this.$route.params.id).then(({data}) => {
                    this.rfq = data;
                }).catch(() => {

                });
            },
        },
        created(){
            this.get_rfq();
        },
        mounted() {

        }
    }
    function print(){
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
