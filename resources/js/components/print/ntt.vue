<template>
<div class="" >
    <button class="btn btn-primary d-print-none button ml-2 mb-2" onclick="print()">Print</button>
    <div class="row">
        <div class="col nt text-center font-weight-bold all"><h3>NOTICE TO TERMINATE</h3></div>
        <div class="w-100"></div>
        <div class="col nt text-center font-weight-bold all"><h6>(NT No.: NT-2019-08-151)</h6></div>
        <div class="w-100"></div>
        <div class="col nt font-weight-bold all">August 14, 2019</div>
        <div class="w-100"></div>
        <div class="col nt dheight all"></div>
        <div class="w-100"></div>
        <div class="col nt font-weight-bold all">{{ purchase_order.supplier_name }}</div>
        <div class="w-100"></div>
        <div class="col-2 nt all">{{ purchase_order.supplier_address }}</div>
        <div class="w-100"></div>
        <!-- <div class="col nt all">Metro Manila</div> -->
        <div class="w-100"></div>
        <div class="col nt dheight all"></div>
        <div class="w-100"></div>
        <div class="col nt font-weight-bold all">Sir/Madam:</div>
        <div class="w-100"></div>
        <div class="col nt dheight all"></div>
        <div class="w-100"></div>
        <div class="col nt all">Please be informed that BGHMC intends to terminate the following Purchase Order(s).</div>
        <div class="w-100"></div>
        <div class="col nt dheight all"></div>
        <div class="w-100"></div>
    </div>
    <div class="row">
        <div class="col nt top right bottom">
            <div class="row">
                <div class="col-2 nt text-center font-weight-bold left right bottom">NO.</div>
                <div class="col-2 nt text-center font-weight-bold right bottom">PURCHASE ORDER</div>
                <div class="col-5 nt text-center font-weight-bold right bottom">ITEM DESCRIPTION</div>
                <div class="col-1 nt text-center font-weight-bold right bottom">UNIT</div>
                <div class="col-1 nt text-center font-weight-bold right bottom">QTY</div>
                <div class="col-1 nt text-center font-weight-bold bottom">DUE DATE</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col nt">
            <div class="row" v-for="p in po" :key="p.dmd_po_id">
                <div class="col-2 text-center nt all"></div>
                <div class="col-2 nt text-center top right bottom">{{ p.po_id }}</div>
                <div class="col-5 nt top right bottom"><small>{{ p.dmddesc }}<br>
                    Brand Name: {{ p.brand_desc }}<br>
                    Dosage Strength & Form: 5mg Film-Coated Tablet<br>
                    Packaging: {{ p.packaging_desc }}<br>
                    Manufacturer: {{ p.manufacturer_desc }}<br>
                    Country of Origin: {{ p.country_desc }}<br>
                    CPR VALIDITY: </small></div>
                <div class="col-1 nt text-center top right bottom"></div>
                <div class="col-1 nt text-center top right bottom">{{ p.order_quantity }}</div>
                <div class="col-1 nt text-center top right bottom"><small>{{ p.date_of_delivery }}</small></div>
            </div>
            
        </div>
        
    </div>
    <div class="row">
        <div class="col-12">
            <div class="w-100"></div>
            <div class="col nt dheight all"></div>
            <div class="col nt dheight all"></div>
            <div class="col nt all">Pursuant to the Guidelines on Termination of Contracts of the IRR of R.A. 9184, the following is (are)
                the ground(s) for termination:
            </div>
            <div class="w-100"></div>
            <div class="col nt all ml-3">1. Default in the performance of your obligations under the Contract.</div>
            <div class="w-100"></div>
            <div class="col nt all ml-5">a. You have failed to deliver after the due date.</div>
            <div class="w-100"></div>
            <div class="col nt dheight all"></div>
            <div class="col nt all font-weight-bold text-justify">You are hereby given a period of SEVEN (7) CALENDAR DAYS from the receipt of this notice to show
                cause as to why the contract should not be terminated. However, you may deliver the items before the lapse of the aforementioned period or issuance of
                Order of Termination</div>

            <div class="w-100"></div>
            <div class="col nt dheight all"></div>
            <div class="col nt all text-justify">Non -compliance shall cause the issuance of <b>ORDER OF TERMINATION</b> of the contract and without prejudice to the
            imposition of <b>ADMINISTRATIVE PENALTIES</b> pursuant to Section 69 (6) of R.A. 9184.</div>

            <div class="w-100"></div>
            <div class="col nt dheight all"></div>
            <div class="col nt all text-justify">The termination is not limited to the aforementioned Purchase Order(s) but shall cover ALL unperformed portion in the contract
                of the above listed items awarded to your Company. This includes Purchase Order(s) prepared or approved prior to this Notice.
            </div>

            <div class="w-100"></div>
            <div class="col nt dheight all"></div>
            <div class="col nt all font-weight-bold text-justify">Please disregard this notice for the item(s) already delivered.</div>

            <div class="w-100"></div>
            <div class="col nt dheight all"></div>
            <div class="col nt all text-justify">Very truly yours,</div>

            <div class="w-100"></div>
            <div class="col nt dheight all"></div>
            <div class="col nt all font-weight-bold">RICARDO B. RUNEZ, JR., MD, FPCS, MHA, CESE</div>
            <div class="w-100"></div>
            <div class="col nt all">Medical Center Chief II</div>

            <div class="w-100"></div>
            <div class="col nt dheight all"></div>
            <div class="col nt all"><small>VR No.: 2018-07-76 (07-13-2018)</small></div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data(){
            return{
                po: [],
                purchase_order: {}
            }
        },
        methods:{
            get_po(){
                axios.get('../../api/purchase_order/'+this.$route.params.id).then(({data}) => {
                    this.po = data;
                }).catch(() => {

                });
            },
            get_po_show(){
                axios.get('../../api/po_show/'+this.$route.params.id).then(({data}) => {
                    this.purchase_order = data;
                });
            },
            print() {
                window.print();
                location.reload();
            },
        },
        
        created(){
            this.get_po();
            this.get_po_show();
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
        font-family: 'Roboto', sans-serif;
        src: url('https://fonts.googleapis.com/css?family=Roboto&display=swap');
        font-weight: normal;
        font-style: normal;
    }
    .container {
        border: none;
    }

    .img-thumbnail {
        border: none;
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 65%;
    }

    .font {
        font-family: 'Helvetica', sans-serif;
    }

    .nt {
        border-collapse: collapse;
        border: 1px solid black;
    }

    .top {
        border-top: none;
    }

    .bottom {
        border-bottom: none;
    }

    .left {
        border-left: none;
    }

    .right {
        border-right: none;
    }

    .all {
        border-top: none;
        border-right: none;
        border-left: none;
        border-bottom: none;
    }
    .aheight {
        height: 5px;
    }
    .bheight {
        height: 20px;
    }
    .cheight {
        height: 600px;
    }
    .dheight {
        height: 25px;
    }
    #footer {
        position: fixed;
        bottom: 0;
        width: auto;
        margin-left: -1.3%;
    }
    @media print {
        .height {
            margin-top: 10%;
        }
    }
</style>
