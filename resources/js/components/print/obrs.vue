<template>
<div id="f01">
  <div class="row">
        <div class="col">
            <router-link to="/budget_po" tag="button" class="btn btn-secondary d-print-none float-left"><i class="fas fa-arrow-left ml-2"></i> Back</router-link>
        </div>
        <div class="col">
            <button class="btn btn-primary d-print-none button float-right" onclick="print()"><i class="fas fa-print ml-2"></i> Print</button>
        </div>
    </div>
    <div id="content-wrapper">
        <div class="col-lg-12">
            <table class="table table-condensed table-sm a" style="margin-top: 1%">
                <tr>
                    <td rowspan="8" class="pr1 border-right-0"><img :src="'/img/bghmc.png'" style="margin-left: 12%; margin-top: 8%" width="150" height="150"></td>
                    <td colspan="5" class="pr1 border-bottom-0" id="pr1"><center>Republic of the Philippines</center></td>
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
                    <td class="pr1 align-bottom">Form No.: FS-BUD-001</td>
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
                    <td class="pr1 border-left-0 border-top-0" width="45%">
                        <span v-if="po.supplier_id">{{ po.supplier.supplier_name }}</span>
                        
                    </td>
                    <td class="pr1 border-right-0 border-top-0 border-bottom-0" width="10%"> <b>Serial No:</b></td>
                    <td class="pr1 border-left-0 border-top-0 font-weight-bold" width="25%">
                        <span v-if="po.fund_source_id && po.allotment_id && po.uacs_id">
                        {{ po.fund_source.acronym }}-0{{ po.allotment.allotment_code }}-{{ po.uacs.current_appropriations }}-{{ po.obrs_date | myDate}}-{{ po.purchase_order_id | numeral2}}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="pr1 border-right-0 border-top-0 border-bottom-0"><b>Office:</b></td>
                    <td class="pr1 border-left-0 border-top-0"></td>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0"> <b>Date:</b></td>
                    <td class="pr1 border-left-0 font-weight-bold">{{po.created_at | myDate3}}</td>
                </tr>
                <tr>
                    <td class="pr1 border-right-0 border-top-0 border-bottom-0"><b>Address:</b></td>
                    <td class="pr1 border-left-0 border-top-0">
                        <span v-if="po.supplier_id">{{ po.supplier.supplier_address }}</span>
                        
                    </td>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0"> <b>Fund Cluster:</b></td>
                    <td class="pr1 border-left-0 font-weight-bold">0{{ po.fund_source_id }}</td>
                </tr>
                <td colspan="7" class="pr1 border-top-0 border-bottom-0"></td>
            </table>

            <table class="table table-condensed table-sm" style="margin-top:-1.6%">
                <thead>
                    <td class="pr1 text-center font-weight-bold" width="10%">Responsibility Center</td>
                    <td class="pr1 text-center font-weight-bold" width="30%">Particulars</td>
                    <td class="pr1 text-center font-weight-bold" width="10%">MFO/PAP</td>
                    <td class="pr1 text-center font-weight-bold" width="10%">UACS Object Code/Expenditures</td>
                    <td class="pr1 text-center font-weight-bold" width="10%">Amount</td>
                </thead>
                <tr v-for="item in po.dmd_purchase_orders" :key="item.id">
                    <td class="pr1 border-bottom-0 border-top-0 text-center">MAIN PHARMACY</td>
                    <td class="pr1border-bottom-0 border-top-0">
                        <div class="font-weight-bold border-bottom-0 text-center">{{ item.new_dmd.dmddesc }}</div>
                        <tr>
                            <td class="text-right border-bottom-0 border-top-0 font-weight-bold">Brand:</td><td class="border-bottom-0 border-top-0">
                                <span v-if="item.brand_id">{{ item.brand.brand_desc }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right border-bottom-0 border-top-0 font-weight-bold">Packaging:</td><td class="border-bottom-0 border-top-0">
                                 <span v-if="item.packaging_id">{{ item.packaging.packaging_desc }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right border-bottom-0 border-top-0 font-weight-bold">Manufacturer:</td><td class="border-bottom-0 border-top-0">
                                 <span v-if="item.manufacturer_id">{{ item.manufacturer.manufacturer_desc }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right border-bottom-0 border-top-0 font-weight-bold">Country of Origin:</td><td class="border-bottom-0 border-top-0">
                                 <span v-if="item.country_id">{{ item.country.country_desc }}</span>
                            </td>
                        </tr>
                        <tr><td class="text-right border-bottom-0 border-top-0 font-weight-bold">CPR:</td><td class="border-bottom-0 border-top-0"></td></tr>
                    </td>
                    <td class="pr1 border-bottom-0 border-top-0 text-center">002</td>
                    <td class="pr1 border-bottom-0 border-top-0 text-center"></td>
                    <td class="pr1 border-bottom-0 border-top-0 text-center">{{ estimated_cost | currency2 }}</td>
                </tr>
                <tr>
                    <td class="pr1 border-top-0"><center></center></td>
                    <td class="pr1 border-top-0" style="text-align:right"><b>Total</b></td>
                    <td class="pr1 border-top-0"></td>
                    <td class="pr1 border-top-0"></td>
                    <td class="pr1 border-top-0 text-center font-weight-bold">{{ estimated_cost | currency2 }}</td>
                </tr>
            </table>
            <table class="table table-condensed border-top-0 border-bottom-0 table-sm" style="margin-top:-1.7%">
                <tr>
                    <td class="pr1 align-middle border-top-0" width="3%"><center><b>A</b></center></td>
                    <td class="pr1 border-top-0 border-bottom-0" width="40%"></td>
                    <td class="pr1 align-middle border-top-0" width="3%"><center><b>B</b></center></td>
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
                    <td class="pr1 border-left-0 border-top-0 align-bottom text-center font-weight-bold" width="30%">RAY P. SUANDING, MD, FPCP, FPCCP</td>
                    <td class="pr1 border-0"><h5>Printed Name:</h5></td>
                    <td class="pr1 border-left-0 border-top-0 align-bottom text-center font-weight-bold" width="30%">EDNA L. MOGAMOG, CPA, MBA</td>
                </tr>
                <tr>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0"><h5>Position:</h5></td>
                    <td class="pr1 border-left-0 text-center align-middle">Chief Medical Professional Staff II</td>
                    <td class="pr1 border-0"><h5>Position:</h5></td>
                    <td class="pr1 border-left-0 text-center">Supervising Administrative Officer<br>Head, Budget Office</td>
                </tr>
                <tr>
                    <td class="pr1 border-top-0 border-right-0 border-bottom-0"><h5>Date:</h5></td>
                    <td class="pr1 border-left-0 text-center align-middle">{{ po.created_at | myDate3 }}</td>
                    <td class="pr1 border-0"><h5>Date:</h5></td>
                    <td class="pr1 border-left-0 text-center align-middle">{{ po.created_at | myDate3 }}</td>
                </tr>
                <tr>
                    <td class="pr1 border-top-0 border-bottom-0" colspan="4"></td>
                </tr>
            </table>
            <table class="table table-condensed border-top-0 border-bottom-0 table-sm" style="margin-top:-1.5%">
                <tr>
                    <td class="pr1 align-middle" width="3%"><center><b>C</b></center></td>
                    <td class="pr1 text-center align-middle" width="80%"><b><h5>STATUS OF OBLIGATION / UTILIZATION</h5></b></td>
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
                    <td class="pr1" width="10%"><center><b>Not Yet Due</b></center></td>
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
                    <td class="pr1"><center>{{ po.created_at | myDate3 }}</center></td>
                    <td class="pr1"><center>Obligation</center></td>
                    <td class="pr1">
                        <center v-if="po.fund_source_id && po.allotment_id && po.uacs_id && po.obrs_date">
                        {{ po.fund_source.acronym }}-0{{ po.allotment.allotment_code }}-{{ po.uacs.current_appropriations }}-{{ po.obrs_date | myDate}}-{{ po.purchase_order_id | numeral2 }}
                        </center>
                    </td>
                    <td class="pr1"><center>{{ estimated_cost | currency2 }}</center></td>
                    <td class="pr1"><center></center></td>
                    <td class="pr1"><center></center></td>
                    <td class="pr1"><center>{{ estimated_cost | currency2 }}</center></td>
                    <td class="pr1"><center></center></td>
                </tr>
                <!-- -->
                <tr>
                    <td class="pr1"><center></center></td>
                    <td class="pr1"><center></center></td>
                    <td class="pr1"><center></center></td>
                    <td class="pr1"><center>(-)</center></td>
                    <td class="pr1"><center></center></td>
                    <td class="pr1"><center></center></td>
                    <td class="pr1"><center>(-)</center></td>
                    <td class="pr1"><center></center></td>
                </tr>
                <!-- -->
                <tr>
                    <td class="pr1"><center></center></td>
                    <td class="pr1"><center></center></td>
                    <td class="pr1"><center></center></td>
                    <td class="pr1"><center>(-)</center></td>
                    <td class="pr1"><center></center></td>
                    <td class="pr1"><center></center></td>
                    <td class="pr1"><center>(-)</center></td>
                    <td class="pr1"><center></center></td>
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
                po: {
                    dmd_purchase_orders: [],
                }               
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
            this.po.dmd_purchase_orders.forEach(function(item) {
                sum += (parseFloat(item.cost_price) * parseFloat(item.order_quantity));
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
