<template>
    <div id="f01">
        <button class="btn btn-primary d-print-none button" @click="print()"><i class="fas fa-print ml-2"></i>
            Print</button>
        <div id="content-wrapper">
            <div class="col-lg-12">
                <table class="table table-condensed table-sm" style="margin-top: 5%">
                    <tr>
                        <td class="vr1 border-0 text-center" colspan="10">
                            <h2>NOTICE TO TERMINATE</h2>
                        </td>
                    </tr>
                    <tr>
                        <td class="vr1 border-0 text-center font-weight-bolder align-top" colspan="10"><small>(NT No.: NT-2019-07-427)</small></td>
                    </tr>
                    <p class="font-weight-bold" colspan="10">{{po.created_at | myDate3}}</p><br>
                    <p class="font-weight-bold" colspan="10">
                        <span v-if="po.purchase_request.supplier">{{ po.purchase_request.supplier.supplier_name }}</span>
                        <span v-else></span>
                    </p>
                    <p style="margin-top: -1%" colspan="10">
                        <span v-if="po.purchase_request.supplier">{{ po.purchase_request.supplier.supplier_address }}</span>
                        <span v-else></span>
                    </p>
                    <!-- <p style="margin-top: -1%" colspan="10">Metro Manila</p><br> -->
                    <p class="font-weight-bold" colspan="10">Sir/Madam:</p><br>
                    <p colspan="10">Please be informed that BGHMC intends to terminate the following Purchase Order(s):</p><br>
                </table>
                <table class="table table-condensed table-sm" style="margin-top: -2%">
                    <tr>
                        <td class="vr1 text-center font-weight-bold align-middle" width="5%">No.</td>
                        <td class="vr1 text-center font-weight-bold align-middle" width="10%">PURCHASE ORDER</td>
                        <td class="vr1 text-center font-weight-bold align-middle" width="15%">ITEM DESCRIPTION</td>
                        <td class="vr1 text-center font-weight-bold align-middle" width="5%">UNIT</td>
                        <td class="vr1 text-center font-weight-bold align-middle" width="5%">QTY</td>
                        <td class="vr1 text-center font-weight-bold align-middle" width="7%">DUE DATE</td>
                    </tr>
                    <tr v-for="item in po.purchase_request.view_dmd_purchase_requests" :key="item.id">
                        <td class="vr1 text-center align-middle" width="5%">1-2019-3252</td>
                        <td class="vr1 text-center align-middle" width="10%">{{ po.created_at | myDate }} - {{ po.purchase_order_id | numeral2 }}</td>
                        <td class="vr1"><small>
                                        <div>{{ item.gendesc }} {{ item.dmdnost }} {{ item.stredesc }} {{ item.formdesc }}</div>
                                        <div>Brand: {{ item.dmd_price_schedule.brand_desc }}</div>
                                        <div>Dosage Strength & Form: {{ item.stredesc }} {{ item.formdesc }}</div>
                                        <div>Packaging: {{ item.dmd_price_schedule.packaging_desc }}</div>
                                        <div>Manufacturer: {{ item.dmd_price_schedule.manufacturer_desc }}</div>
                                        <div>Country of Origin: {{ item.dmd_price_schedule.country_desc }}</div>
                                        <div>CPR VALIDITY:</div></small></td>
                        <td class="vr1 text-center align-middle" width="5%">{{ item.formdesc }}</td>
                        <td class="vr1 text-center align-middle" width="5%">{{ item.request_quantity }}</td>
                        <td class="vr1 text-center align-middle" width="7%">06/27/2019</td>
                    </tr>
                    
                </table>
                    <p colspan="5" class="text-justify">Pursuant to the Guidelines on Termination of Contracts of the IRR of R.A. 9184, the following is (are) the ground(s) for termination:</p>
                    <p style="text-indent: 2%; margin-top: -1.5%">1. Default in the performance of your obligations under the Contract.</p>
                    <p style="text-indent: 5%; margin-top: -1.5%">a. You have failed to deliver after the due date.</p>
                    <p class="font-weight-bold text-justify">You are hereby given a period of SEVEN (7) CALENDAR DAYS from the receipt of this notice
                        to show cause as to why the contract shoud not be terminated. However, you may deliver the items before the lapse of the aforementioned period or issuance of Order of Termination.</p>
                    <p class="text-justify">Non-compliance shall cause the issuance of <b>ORDER OF TERMINATION</b> of the contract and without prejudice to the imposition
                    of <b>ADMINISTRATIVE PENALTIES</b> pursuant to Section 69 (6) of R.A. 9184.</p>
                    <p class="text-justify">The termination is not limited to the aforementioned Purchase Order(s) but shall cover ALL unperformed
                        portion in the contract of the above listed items awarded to your Company. This includes Purchase Order(s) prepared or approved prior to this Notice.</p>
                    <p class="font-weight-bold">Please disregard this notice for the item(s) already delivered.</p><br><br>
                    <p>Very truly yours,</p><br>
                    <p class="font-weight-bold">RICARDO B. RUNEZ, JR., MD, FPCS, MHA, CESE</p>
                    <p style="margin-top:-1.5%">Medical Center Chief II</p><br><br>

                    <p><small>VR No.: 2018-07-76 (07-13-2018)</small></p>
                    <p class="text-right" style="margin-top: -4%"><small>Date/Time Printed: {{po.obrs_date | myDate4}} / {{ po.obrs_date | time1}}</small></p>
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
            print() {
                window.print();
                location.reload();
            },
        },
        
        created(){
            this.get_po();
        },
        computed:{
            estimated_cost(){
            let sum = 0;
            if(this.po.purchase_request){
                this.po.purchase_request.view_dmd_purchase_requests.forEach(function(item) {
                    sum += (parseFloat(item.dmd_price_schedule.bid_price) * parseFloat(item.order_quantity));
                });
                    return sum;
                }
            }
        },
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
