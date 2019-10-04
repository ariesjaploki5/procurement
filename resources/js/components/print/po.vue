<template>
<div class="">
     <button class="btn btn-primary d-print-none button ml-2 mb-2" onclick="print()">Print</button>
    <div class="row border border-bottom-0 border-dark">
        <div class="col-12">
            <div class="row ">
                <div class="col-auto border-right border-dark text-center">
                    <img :src="'/img/bghmc.png'">
                </div>
                <div class="col">
                    <div class="row border-bottom border-dark">
                        <div class="col-12">
                            <div class="text-center">Republic of the Philippines</div>
                            <div class="text-center">Department of Health</div>
                            <div class="text-center font-weight-bold">BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER</div>
                            <div class="text-center">Baguio City</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7 border-right border-dark">
                            <div class="text-center">Procurement Management Office</div>
                            <div class="text-center"><h1>PURCHASE ORDER</h1></div>
                        </div>
                        <div class="col-5">
                            <div class="row ">  
                                <div class="col">Form No.: HS – PS – 006</div>
                            </div>
                            <div class="row border-bottom border-top border-dark">  
                                <div class="col">Revision No.: 1</div>
                            </div>
                            <div class="row">  
                                <div class="col">Effectivity Date: September 1, 2016</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row border border-dark">
        <div class="col-6 border-dark border-right">
            <div class="row">
                <div class="col-auto">
                    <span>Supplier:</span>
                </div>
                <div class="col border-bottom border-dark">
                   {{ purchase_order.supplier_name }}
                    
                </div>
                <div class="col-1">

                </div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <span>Address: </span>
                </div>
                <div class="col border-bottom border-dark">
                    {{ purchase_order.supplier_address }}
                    
                </div>
                <div class="col-1">

                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-auto">
                    <span>Purchase Order Number:</span>
                </div>
                <div class="col border-bottom border-dark text-center">
                    {{ purchase_order.po_id }}
                </div>
                <div class="col-1"></div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <span>Purchase Order Date: </span>
                </div>
                <div class="col border-bottom border-dark text-center">
                    {{ purchase_order.created_at | myDate4 }}
                </div>
                <div class="col-1"></div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <span>Mode of Procurement: </span>
                </div>
                <div class="col border-bottom border-dark mb-1 text-center">
                    {{ purchase_order.mode_desc }}
                </div>
                <div class="col-1"></div>
            </div>

        </div>
    </div>
    <div class="row border border-dark border-top-0">
        <div class="col-12 aheight"></div>
        <div class="col">
            <span>GENTLEMEN: Please furnish this office the following articles subject to the terms and
                conditions
                contained herein:</span>
        </div>
    </div>
    <div class="row border border-top-0 border-bottom-0 border-dark">
        <div class="col-6 border-dark border-right">
            <div class="row">
                <div class="col-auto">
                    <span>Place of Delivery:</span>
                </div>
                <div class="col border-bottom border-dark">
                    BGHMC
                </div>
                <div class="col-1">

                </div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <span>Date of Delivery: </span>
                </div>
                <div class="col border-bottom border-dark mb-1">

                </div>
                <div class="col-1">

                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-auto">
                    <span>Delivery Term:</span>
                </div>
                <div class="col border-bottom border-dark">
                    FOB Destination
                </div>
                <div class="col-1">

                </div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <span>Payment Term: </span>
                </div>
                <div class="col border-bottom border-dark mb-1">
                    {{ purchase_order.payment_term_desc }}
                </div>
                <div class="col-1"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 aheight"></div>
    </div>
    <div class="table_1">
        <div class="row">
            <table class="table table-lg">
                <thead class="text-center">
                    <tr>
                        <th>STOCK NUMBER</th>
                        <th>UNIT</th>
                        <th>QUANTITY</th>
                        <th width="30%">DESCRIPTION</th>
                        <th>UNIT COST</th>
                        <th>AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in dmd_purchase_orders" :key="index">
                        <td class="text-center text-bold">{{ item.code }}</td>
                        <td class="text-center text-bold">{{ item.unit_desc }}</td>
                        <td class="text-right text-bold">{{ item.order_quantity }}</td>
                        <td width="35%">
                            <span class="text-bold">{{ item.dmddesc }}</span>
                            <div class="w-100"></div>
                            <span><span class="text-bold">Brand: </span>{{ item.brand_desc }}</span>
                            <div class="w-100"></div>
                            <span><span class="text-bold">Manufacturer: </span>{{ item.manufacturer_desc }}</span>
                            <div class="w-100"></div>
                            <span><span class="text-bold">Packaging: </span>{{ item.packaging_desc }}</span>
                            <div class="w-100"></div>
                            <span><span class="text-bold">Country of Origin: </span>{{ item.country_desc }}</span>
                        </td>
                        <td class="text-right text-bold">
                            {{ item.cost_price | currency2 }}
                        </td>
                        <td class="text-right text-bold" width="20%">
                            {{ item.cost_price * item.order_quantity | currency2 }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col  text-center">
                ***<span class="text-bold text-italic">{{ purchase_order.purpose }} - {{ purchase_order.user_name }}</span>***
            </div>
        </div>
    </div>
    <div class="row">
        <table class="table table-lg table_2">
            <tbody>
                <tr>
                    <td>Total Amount in Words: 
                        <span class="text-capitalize text-bold">{{ purchase_order.amount | num_words }} Pesos</span>
                        <span class="text-capitalize text-bold text-italic" v-if="purchase_order.cent == 0"></span>
                        <span class="text-capitalize text-bold text-italic" v-else>And {{ purchase_order.cent | num_words }} Centavos</span> 
                        Only
                    </td>
                    <td  width="20%" class="text-right text-bold">
                        {{ purchase_order.total_amount | currency2 }}
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>
    <div class="row border border-bottom-0 border-top-0 border-dark">
        <div class="col-12 text-justify">
            Non-delivery of the above-mentioned item/s, partial, or completely delivery, within the prescribed delivery term shall have the effect of cancellation of the Purchase Order and Subsequent orders. In case you will be allowed to deliver beyond the delivery term, partial or completely delivery, a penalty of one-tenth(1/10) of one percent (1%) for everyday of delay shall be imposed.
        </div>
    </div>
    <div class="row border border-top-0 border-bottom-0 border-dark">
        <div class="col-6 mt-2"></div><div class="col-6 mt-2">Very Truly yours,</div>
    </div>
    <div class="row border border-top-0 border-bottom-0 border-dark">
        <div class="col-6 mb-3">Conforme:</div><div class="col-6"></div>
    </div>
    <div class="row border border-top-0 border-dark">
        <div class="col-6">
            <div class="row">
                <div class="col-3"></div>
                <div class="col border-bottom border-dark"></div>
                <div class="col-2"></div>
            </div>
            <div class="row">
                <div class="col-3"></div>
                <div class="col text-center"> Signature Over Printed Name</div>
                <div class="col-2"></div>
            </div>
            <div class="row">
                <div class="col mt-4"></div>
            </div>
            <div class="row">
                <div class="col-4"></div>
                <div class="col border-bottom border-dark"></div>
                <div class="col-3"></div>
            </div>
            <div class="row">
                <div class="col-3"></div>
                <div class="col text-center"> Date</div>
                <div class="col-2"></div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-1"></div>
                <div class="col border-bottom border-dark text-center text-bold">RICARDO B. RUNEZ Jr., MD, FPCS, MHA, CESE</div>
                <div class="col-1"></div>
            </div>
            <div class="row">
                <div class="col-3"></div>
                <div class="col text-center">Medical Center Chief II</div>
                <div class="col-2"></div>
            </div>
        </div>
    </div>
    <div class="row border-top-0 border border-dark">
        <div class="col-6  border-right border-dark">
            <div class="row">
                <div class="col-5">FUND CLUSTER:</div>
                <div class="col-6 border-bottom border-dark"></div>
                <div class="col-1"></div>
            </div>
            <div class="row">
                <div class="col-5">FUNDS AVAILABLE:</div>
                <div class="col-6 border-bottom border-dark "></div>
                <div class="col-1"></div>
            </div>
            <div class="row mt-4">
                <div class="col-5"></div>
                <div class="col-6 border-bottom border-dark text-center text-bold">CECILIA J. PUGONG, CPA</div>
                <div class="col-1"></div>
            </div>
            <div class="row">
                <div class="col-5"></div>
                <div class="col-6 text-center">Accountant IV</div>
                <div class="col-1"></div>
            </div>
            <div class="row">
                <div class="col-5"></div>
                <div class="col-6 text-center">Head, Accounting Section</div>
                <div class="col-1"></div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-5">ORS / BURS No.:</div>
                <div class="col-6 border-dark border-bottom"></div>
                <div class="col-1"></div>
            </div>
            <div class="row">
                <div class="col-5">Date of ORS / BURS:</div>
                <div class="col-6 border-bottom border-dark"></div>
                <div class="col-1"></div>
            </div>
            <div class="row">
                <div class="col-5">Amount:</div>
                <div class="col-6 border-bottom border-dark text-right text-bold">{{ purchase_order.total_amount | currency2 }}</div>
                <div class="col-1"></div>
            </div>
            <div class="row mt-1">
                <div class="col border-bottom border-dark"></div>
            </div>
            <div class="row">
                <div class="col-5 mt-4"><span class="text-bold">PR No.:</span>  <span class="font-italic">{{ purchase_order.pr_id }}</span></div>
                <div class="col-4 mt-4">Date {{ purchase_order.created_at | myDate4 }}</div>
                <div class="col-3 mt-4">Time {{ purchase_order.created_at | time1 }}</div>
            </div>
        </div>
    </div>
    <div class="row mb-2"></div>
</div>  
   
</template>

<script>
    export default {
        data() {
            return {
                dmd_purchase_orders: [],
                purchase_order: '',
            }
        },
        methods: {
            get_po() {
                axios.get('../../api/purchase_order/' + this.$route.params.id).then(({
                    data
                }) => {
                    this.dmd_purchase_orders = data;
                }).catch(() => {

                });
            },
            po_show() {
                axios.get('../../api/po_show/' + this.$route.params.id).then(({
                    data
                }) => {
                    this.purchase_order = data;
                }).catch(() => {

                });
            }
        },
        print() {
            window.print();
            location.reload();
        },
        created() {
            this.get_po();
            this.po_show();
        },
        computed: {

        },
        mounted() {

        }
    }

</script>

<style lang="css" scoped>
    img{
        padding: 0.25rem;
        background-color: #f8fafc00;
        border: 1px solid #dee2e600;
        border-radius: 0.25rem;
        max-width: 100%;
        height: auto;
        width: 65%;
    }
    table {
        width: 100%;
        border-top: 0px;
        border: 1px solid black;

    }
    .table_2{
        margin-bottom: 0px !important;
    }
    .table_1{
        height: 620px;
        margin-bottom: 0px !important;
    }
    tbody
    {   
        width: 100%;
    }
    .table thead th {
        border-top: 1px solid #000!important;
        border-bottom: 1px solid #000!important;
        border-left: 1px solid #000;
        border-right: 1px solid #000;
    }
    .table td {
        border-left: 1px solid #000;
        border-right: 1px solid #000;
        border-top: none!important;
    }
</style>