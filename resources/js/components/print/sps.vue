    <template>
    <div id="f01">
        <div class="row">
            <div class="col">
                <router-link to="/pr_dmd" tag="button" class="btn btn-secondary d-print-none float-left"><i class="fas fa-arrow-left ml-2"></i> Back</router-link>
            </div>
            <div class="col">
                <button class="btn btn-primary d-print-none button float-right" onclick="print()"><i class="fas fa-print ml-2"></i> Print</button>
            </div>
        </div>
        <div id="content-wrapper" v-for="item in pr.dmd_purchase_requests" :key="item.dmd_id">
            <div class="col-lg-12" style="height: 43rem">
                <table class="table table-condensed table-sm a" style="margin-top: 1%">
                    <tr>
                        <td rowspan="7" class="pr1 border-right-0"><img :src="'/img/bghmc.png'"
                                style="margin-left: 10%; margin-top: 3%" width="150" height="150"></td>
                        <td colspan="5" class="pr1 border-bottom-0" id="pr1">
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
                        <td class="pr1 text-center border-bottom-0 align-top text-muted" rowspan="" width="50%">MATERIALS MANAGEMENT OFFICE</td>
                        <td class="pr1" colspan="4">Form No.: HS-PS-005</td>
                    </tr>
                    <td class="pr1 text-center border-top-0 align-bottom" rowspan="2" width="50%"><strong><h2>STOCK POSITION SHEET</h2></strong></td>
                        <td class="pr1" colspan="4">Revision No.: Ø</td>
                    <tr>
                        <td class="pr1" colspan="4">Effectivity Date: August 1, 2014</td>
                    </tr>
                </table>
                <table class="table table-condensed border-0 table-sm" style="margin-top:-1%">
                    <tr class="table table-borderless">
                        <td class="border-top-0 border-bottom-0" width="5%" style="text-align: center">Articles:</td>
                        <td class="pr1 border-top-0 border-left-0 border-right-0 text-primary align-middle text-bold" rowspan="2" width="25%"><h5>{{ item.dmd.dmddesc }}</h5></td>
                        <td class="border-top-0 border-bottom-0" width="10%" style="text-align: right"><strong>UNIT:</strong></td>
                        <td class="pr1 border-top-0 border-left-0 border-right-0 text-center align-bottom" width="10%"><b>{{ item.dmd.formdesc }}</b></td>
                
                    </tr>
                    <tr class="table table-borderless">
                        <td class="border-top-0 border-bottom-0"></td>
                        <td class="border-top-0 border-bottom-0" width="10%" style="text-align: right"><strong>SSL:</strong></td>
                        <td class="pr1 border-top-0 border-left-0 border-right-0 text-center align-bottom text-bold" width="10%">{{ item.dmd.ssl | numeral3  }}</td>
                    </tr>
                    <tr class="table table-borderless">
                        <td class="border-top-0 border-bottom-0"></td>
                        <td class="border-bottom-0"></td>
                        <td class="border-top-0 border-bottom-0"></td>
                        <td class="border-bottom-0 text-center"></td>
                    </tr>
                    <tr class="table table-borderless">
                        <td class="border-top-0 border-bottom-0">
                            <center>1.</center>
                        </td>
                        <td class="border-top-0 border-bottom-0">Balance on Hand</td>
                        <td class="border-top-0 border-bottom-0"></td>
                        <td class="pr1 border-top-0 border-left-0 border-right-0 align-bottom text-center text-bold">
                            <span v-if="item.dmd.boh == .00">0</span>
                            <span v-else>{{ item.dmd.boh | numeral3 }}</span>
                        </td>
                    </tr>
                    <tr class="table table-borderless">
                        <td class="border-top-0 border-bottom-0">
                            <center>2.</center>
                        </td>
                        <td class="border-top-0 border-bottom-0">Item in Transit</td>
                        <td class="border-top-0 border-bottom-0"></td>
                        <td class="pr1 border-top-0 border-left-0 border-right-0 align-bottom text-center text-bold">
                            {{ item.dmd.iit | numeral3 }}
                        </td>
                    </tr>
                    <tr class="table table-borderless">
                        <td class="border-top-0 border-bottom-0">
                            <center>3.</center>
                        </td>
                        <td class="border-top-0 border-bottom-0">This Requisition</td>
                        <td class="border-top-0 border-bottom-0"></td>
                        <td class="pr1 border-top-0 border-left-0 border-right-0 align-bottom text-center text-bold">{{ item.dmd.tr | numeral3 }}</td>
                    </tr>
                    <tr class="table table-borderless">
                        <td class="border-top-0 border-bottom-0">
                            <center>4.</center>
                        </td>
                        <td class="border-top-0 border-bottom-0">Total Expected Stocks (Sum of Lines 1 to 3)</td>
                        <td class="border-top-0 border-bottom-0"></td>
                        <td class="pr1 border-top-0 border-left-0 border-right-0 align-bottom text-center text-bold">{{ item.dmd.es | numeral3 }}</td>
                    </tr>
                    <tr class="table table-borderless">
                        <td class="border-top-0 border-bottom-0">
                            <center>5.</center>
                        </td>
                        <td class="border-top-0 border-bottom-0">Monthly Average Consumption</td>
                        <td class="border-top-0 border-bottom-0"></td>
                        <td class="pr1 border-top-0 border-left-0 border-right-0 align-bottom text-center text-bold">{{ item.dmd.tr / 2 | numeral3 }}</td>
                    </tr>
                    <tr class="table table-borderless">
                        <td class="border-top-0 border-bottom-0">
                            <center>6.</center>
                        </td>
                        <td class="border-top-0 border-bottom-0">Estimated No. of Months to Consume (Line 4 to 5)</td>
                        <td class="border-top-0 border-bottom-0"></td>
                        <td class="pr1 border-top-0 border-left-0 border-right-0 align-bottom text-center text-bold">2 Months</td>
                    </tr>
                </table>
                <table class="table table-condensed border-0 table-sm" style="margin-top: -1.35%">
                        <tr class="table table-borderless">
                            <td class="border-top-0"></td>
                        </tr>
                        <td style="text-indent: 80px" colspan="4" class="text-justify border-0">
                            <p>I certify to the fairness and reasonableness of the the above data.</p>
                        </td>
                        <tr class="table table-borderless">
                            <td width="2%"></td>
                            <td width="10%" class="pr1 border-top-0 border-left-0 border-right-0"></td>
                            <td width="15%" class="pr1 border-0"></td>
                            <td width="10%" class="pr1 border-top-0 border-left-0 border-right-0 text-center text-bold">{{ pr.created_at | myDate3 }}</td>
                        </tr>
                        <tr class="table table-borderless">
                            <td width="2%"></td>
                            <td width="10%" class="pr1 border-0 text-center"><strong>RISCILLA E. LAZATIN, MPA</strong></td>
                            <td width="15%" class="pr1 border-0"></td>
                            <td width="10%" class="pr1 border-0 text-center">Date</td>
                        </tr>
                        <tr class="table table-borderless">
                            <td width="2%"></td>
                            <td width="10%" class="pr1 border-0 text-center"><strong>Head, Pharmacy Section</strong></td>
                            <td width="15%" class="pr1 border-0"></td>
                            <td width="10%" class="pr1 border-0 text-center"></td>
                        </tr>
                        <tr>
                            <td style="text-indent: 80px" colspan="4" class="text-justify border-0">
                                <p>Note: Attach writes justification for requisition in excess of normal requirements.</p>
                                <!-- <p>Note: Requisition in excess of normal requirements is due to packaging of
                                    medicine/medical supply.</p> -->
                            </td>
                        </tr>
                </table>
                 <br>
                        <td class="pr1 border-0" colspan="22">
                            ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                        </td>
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
                },
                print(){
                window.print();
                location.reload();
                },
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
