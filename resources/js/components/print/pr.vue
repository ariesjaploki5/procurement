<template>
    <div id="pr1">
        <div class="row">
            <div class="col">
                <router-link to="/pr_dmd" tag="button" class="btn btn-secondary d-print-none float-left"><i class="fas fa-arrow-left ml-2"></i> Back</router-link>
            </div>
            <div class="col">
                <button class="btn btn-primary d-print-none button float-right" onclick="print()"><i class="fas fa-print ml-2"></i> Print</button>
            </div>
        </div>
        <div id="content-wrapper">
            <div class="col-lg-12">
                <table class="table table-condensed table-sm a" style="margin-top: 1%">
                    <tr>
                        <td rowspan="7" class="pr1 border-right-0"><img :src="'/img/bghmc.png'" style="margin-left: 0%; margin-top: 15%" width="150" height="150"></td>
                        <td colspan="5" class="pr1 border-bottom-0 text-center" id="pr1">Republic of the Philippines</td>
                    </tr>
                    <td colspan="5" class="pr1 border-top-0 border-bottom-0 text-center">Department of Health</td>
                    <tr>
                        <td colspan="5" class="pr1 border-top-0 border-bottom-0 text-center"><b>BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER</b></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="pr1 border-top-0 text-center">Baguio City</td>
                    </tr>
                    <tr>
                        <td rowspan="3" class="pr1 text-center" width="40%"><br><b><h2>PURCHASE REQUEST</h2></b></td>
                        <td class="pr1" colspan="4">Form No.: HS - PS - 001</td>
                    </tr>
                    <td class="pr1" colspan="4">Revision No.: 3</td>
                    <tr>
                        <td class="pr1" colspan="4">Effectivity Date: September 1, 2016</td>
                    </tr>
                    <td class="pr1" colspan="7"></td>
                    <tr>
                        <td class="pr1 border-right-0 border-bottom-0" colspan="1" width="15%">Department: </td>
                        <td class="pr1 border-left-0 border-right-0" width="10%"><b>MEDICAL SERVICES</b></td>
                        <td class="pr1 border-left-0 border-right-0 border-bottom-0" width="12.5%">PR No.:</td>
                        <td class="pr1 border-left-0 border-right-0 text-left" width="11%"><b>{{ pr.pr_id }}</b></td>
                        <td class="pr1 border-left-0 border-right-0 border-bottom-0" width="1%">Date: </td>
                        <td class="pr1 border-left-0" width=""><b>{{ pr.created_at | myDate3 }}</b></td>
                    </tr>
                    <tr>
                        <td class="pr1 border-right-0 border-top-0 border-bottom-0" colspan="1" width="15%">Section: </td>
                        <td class="pr1 border-left-0 border-right-0"><b>PHARMACY</b></td>
                        <td class="pr1 border-0">SAI No.:</td>
                        <td class="pr1 border-left-0 border-right-0" width=""></td>
                        <td class="pr1 border-0" width="">Date: </td>
                        <td class="pr1 border-left-0"></td>
                    </tr>
                    <tr>
                        <td class="pr1 border-right-0 border-top-0 border-bottom-0" colspan="1" width="15%"></td>
                        <td class="pr1 border-left-0 border-right-0 border-bottom-0"><b></b></td>
                        <td class="pr1 border-0"><small>ORS No./BURS No:</small></td>
                        <td class="pr1 border-left-0 border-right-0"></td>
                        <td class="pr1 border-0" width="">Date: </td>
                        <td class="pr1 border-left-0"></td>
                    </tr>
                    <td class="pr1 border-top-0" colspan="7"></td>
                </table>
                <table id="table_height" class="table table-condensed table-sm table-sm" style="margin-top: -1.65%; height: 47rem;">
                    <tr style="height: 1rem;">
                        <td class="pr1 text-center" width="5%"><b>Item No.</b></td>
                        <td class="pr1 text-center" width="5%"><b>Qty.</b></td>
                        <td class="pr1 text-center" width="7%"><b>Unit of Issue</b></td>
                        <td class="pr1 text-center"><b>Item Description</b></td>
                        <td class="pr1 text-center" width="5%"><b>Stock No.</b></td>
                        <td class="pr1 text-center" width="15%"><b>Estimated Unit Cost</b></td>
                        <td class="pr1 text-center" width="15%"><b>Estimated Cost</b></td>
                    </tr>
                    <!--Line 1 -->
                    <tr class="prpr" v-for="(item, index) in pr.dmd_purchase_requests" :key="item.id">
                        <td class="pr border-top-0 border-bottom-0 text-center" width="5%">{{ index+1 }}</td>
                        <td class="pr border-top-0 border-bottom-0 text-center" width="5%">{{ item.request_quantity | numeral3 }}</td>
                        <td class="pr border-top-0 border-bottom-0 text-center" width="7%"></td>
                        <td class="pr border-top-0 border-bottom-0 text-center"><h6>{{ item.dmddesc }}</h6></td>
                        <td class="pr border-top-0 border-bottom-0 text-center" width="7%"></td>
                        <td class="pr border-top-0 border-bottom-0 text-center" width="15%">
                            <span >{{ item.cost_price | currency2 }}</span>
                        </td>
                        <td class="pr border-top-0 border-bottom-0 text-center" width="15%">
                            
                            <span >{{ item.request_quantity * item.cost_price | currency2 }}</span>
                        </td>
                    </tr>
                     <!--Name of Supplier  -->
                    <tr>
                        <td class="pur border-top-0 border-bottom-0 text-center" width="5%"></td>
                        <td class="pur border-top-0 border-bottom-0 text-center" width="5%"></td>
                        <td class="pur border-top-0 border-bottom-0 text-center" width="7%"></td>
                        <td class="pur border-top-0 border-bottom-0 text-center"><b><span v-if="pr.mode_id == 1">{{ pr.supplier.supplier_name }}</span><span v-else></span></b></td>
                        <td class="pur border-top-0 border-bottom-0 text-center" width="7%"></td>
                        <td class="pur border-top-0 border-bottom-0 text-center" width="15%"></td>
                        <td class="pur border-top-0 border-bottom-0 text-center" width="15%"><b></b></td>
                    </tr>
                     <!--Total Amount  -->
                    <tr>
                        <td class="pur border-top-0 border-bottom-0"></td>
                        <td class="pur border-top-0 border-bottom-0"></td>
                        <td class="pur border-top-0 border-bottom-0"></td>
                        <td class="pur border-top-0 border-bottom-0"></td>
                        <td class="pur border-top-0 border-bottom-0"></td>
                        <td class="pur border-top-0 border-bottom-0"></td>
                        <td class="pr1 border-top-0 border-left-0 text-center align-bottom" style="border-bottom:double" width="15%"><b><span v-if="pr.mode_id == 1">{{ estimated_cost | currency2 }}</span><span v-else></span></b></td>
                    </tr>
                    
                </table>
                <table class="table table-condensed table-borderless table-sm a" style="margin-top: -1.7%">
                    <tr>
                        <td class="pr1 border-top-0" colspan="6"></td>
                    </tr>
                    <tr>
                        <td class="pr1 border-right-0 border-top-0">Purpose:</td>
                        <td class="pr1 border-left-0 border-top-0 text-center text-uppercase" colspan="5"><b>{{ pr.purpose }}</b></td>
                    </tr>
                    <tr>
                        <td class="pr1 border-top-0" colspan="6"><b>Required Attachments:</b> <i class="text-primary">(For Procurement Management Office use only)</i></td>
                    </tr>
                    <tr>
                        <td class="pr1 border-top-0 border-right-0 border-bottom-0" width="3%">
                            <input type="checkbox" style="width: 25px; height: 25px">
                        </td>
                        <td class="pr1 border-0">Stock Position Sheet for Consumables</td>
                        <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                        <td>Acknowledgement Receipt for Equipment</td>
                        <td class="pr1 border-0" width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                        <td class="pr1 border-top-0 border-left-0 border-bottom-0">Certificate of No suitable subtitute</td>
                    </tr>
                    <!-- {{-- ROW 2 --}} -->
                    <tr>
                        <td class="pr1 border-top-0 border-right-0 border-bottom-0" width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                        <td class="pr1 border-0">Justification for none inclusion in the PPMP</td>
                        <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                        <td><small>Biomedical Service Report / MIS Service Report</small></td>
                        <td class="pr1 border-0" width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                        <td class="pr1 border-top-0 border-left-0 border-bottom-0"><small>Certificate of Exclusive Distributorship</small></td>
                    </tr>
                    <!-- {{-- ROW 3 --}} -->
                    <tr>
                        <td class="pr1 border-top-0 border-right-0 border-bottom-0" width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                        <td class="pr1 border-0"><small>Complete generic specification of item/s requested</small></td>
                        <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                        <td>Scope of Work / Detailed Estimate</td>
                        <td class="pr1 border-0" width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                        <td class="pr1 border-top-0 border-left-0 border-bottom-0">Price Quotation</td>
                    </tr>
                    <tr>
                        <td class="pr1 border-top-0 border-right-0 border-bottom-0" width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                        <td class="pr1 border-0">Others:</td>
                        <td class="pr1 border-top-0 border-left-0 border-bottom-0" colspan="4"></td>
                    </tr>
                </table>
                <table class="table table-condensed table-sm table-sm a" style="margin-top: -1.7%">
                    <tr>
                        <td class="pr1" width="20%"></td>
                        <td class="pr1">Requested By:</td>
                        <td class="pr1">Approved By:</td>
                    </tr>
                    <tr>
                        <td class="pr1">Signature:</td>
                        <td class="pr1"></td>
                        <td class="pr1"></td>
                    </tr>
                    <tr>
                        <td class="pr1">Printed Name:</td>
                        <td class="pr1 text-center"><b>RISCILLA E. LAZATIN, MPA</b></td>
                        <td class="pr1 text-center"><b>RAY P. SUANDING, MD, FPCP, FPCCP</b></td>
                    </tr>
                    <tr>
                        <td class="pr1">Designation:</td>
                        <td class="pr1 text-center">Pharmacist IV</td>
                        <td class="pr1 text-center">Chief Medical Professional Staff II</td>
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
        computed:{
            estimated_cost(){
                
                let sum = 0;
                this.pr.dmd_purchase_requests.forEach(function(item) {
                    sum += (parseFloat(item.cost_price) * parseFloat(item.request_quantity));
                });
                    return sum;
                
            
            },

        },
    
    }
    function print(){
        window.print();
        location.reload();
    }
</script>

<style lang="scss">
  #content-wrapper {
        background-color: rgb(255, 255, 255) !important;
    }
    @font-face {
        font-family: 'Helvetica';
        src: url('https://fonts.googleapis.com/css?family=Helvetica');
        font-weight: normal;
        font-style: normal;
    }

    div#pr1 {
        font-family: 'Helvetica', sans-serif;
    }
    tr.prpr{
        padding-top: none;
        padding-bottom: none;
    }

    td.pr1 {
        border-collapse: collapse;
        border: 1px solid black;
        margin: 0px;
        padding: none;
        padding-top: 0px;
    }

    td.pr {
        border-collapse: collapse;
        border: 1px solid black;
        margin: 0px;
        padding: none;
        padding-bottom: 0px;
    }

    td.pur {
        border-collapse: collapse;
        border: 1px solid black;
        margin: 0px;
        padding: none;
        padding-bottom: 15px;
    }

    table #t01 th {
        background-color: rgb(184, 172, 172) !important;
        border: 1px solid black;
        color: black;
        margin: 0px;
        padding: none;
    }

</style>
