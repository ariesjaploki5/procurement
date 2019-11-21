<template>
    <div class="">
        <button class="btn btn-primary d-print-none button ml-2 mb-2" @click="print()">Print</button> 
        <div class="row">
            <div class="col-12">
                <div class="row bottom">
                    <div class=" col-3 iar col-auto bottom right"><img :src="'/img/bghmc.png'" class="img-thumbnail"></div>
                    <div class="iar col bottom">
                        <div class="row">
                            <div class="col-12">
                                <div class="iar all text-center">Republic of the Philippines</div>
                                <div class="iar all text-center">Department of Health</div>
                                <div class="iar all text-center font-weight-bold">BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER
                                </div>
                                <div class="iar all text-center">Baguio City</div>
                            </div>
                        </div>
                        <div class="row iar left right bottom">
                            <div class="col">
                                <div class="iar all text-center font-weight-bold">MATERIALS MANAGEMENT OFFICE</div>
                                <div class="text-center font-weight-bold">
                                    <h4>INSPECTION AND ACCEPTANCE REPORT</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col ml-2 mr-1">
                                    <div class="col iar top bottom right">Form No.: HS – MMO – 004</div>
                                    <div class="col iar bottom right mr-2">Revision No.: 1</div>
                                    <div class="col iar bottom right mr-2">Effectivity Date: September 1, 2016 </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <div class="row">
            <div class="col-6 iar right bottom">
                <div class="row">
                    <div class="col-3 iar all">SUPPLIER:</div>
                    <div class="col-8 iar top left right font-weight-bold">{{ iar.supplier_name }}</div>
                    <div class="col-1 iar all"></div>
                    <div class="w-100"></div>

                    <div class="col-3 iar all">PO Number:</div>
                    <div class="col-8 iar top left right font-weight-bold">{{ iar.po_id }}</div>
                    <div class="col-1 iar all"></div>
                    <div class="w-100"></div>

                    <div class="col-3 iar all">PO Date:</div>
                    <div class="col-8 iar top left right font-weight-bold">{{ iar.po_date | myDate4 }}</div>
                    <div class="col-1 iar all"></div>
                    <div class="w-100"></div>

                    <div class="col-3 iar all">Resp. Center:</div>
                    <div class="col-8 iar top left right font-weight-bold">Main Pharmacy</div>
                    <div class="col-1 iar all"></div>
                    <div class="w-100"></div>

                    <div class="col-3 iar all">ObRequest:</div>
                    <div class="col-8 iar top left right font-weight-bold"> {{ iar.obrs_no }} </div>
                    <div class="col-1 iar all"></div>
                    <div class="w-100"></div>
                </div>
            </div>
            
            <div class="col-6 iar bottom">
                <div class="row">
                    <div class="col-5 iar all">IAR Number:</div>
                    <div class="col-6 iar top left right font-weight-bold">{{ iar.iar_no }}</div>
                    <div class="col-1 iar all"></div>
                    <div class="w-100"></div>

                    <div class="col-5 iar all">IAR Date:</div>
                    <div class="col-6 iar top left right font-weight-bold">{{ iar.iar_date | myDate4 }}</div>
                    <div class="col-1 iar all"></div>
                    <div class="w-100"></div>

                    <div class="col-5 iar all eheight"></div>
                    <div class="col-6 iar all"></div>
                    <div class="col-1 iar all"></div>
                    <div class="w-100"></div>

                    <div class="col-5 iar all">DR/Invoice Number:</div>
                    <div class="col-6 iar top left right font-weight-bold">{{ iar.invoice_no }}</div>
                    <div class="col-1 iar all"></div>
                    <div class="w-100"></div>

                    <div class="col-5 iar all">DR/Invoice Date:</div>
                    <div class="col-6 iar top left right font-weight-bold">
                        <span v-if="iar.invoice_date">{{ iar.invoice_date | myDate4 }}</span>
                    </div>
                    <div class="col-1 iar all"></div>
                    <div class="w-100"></div>
                </div>
            </div>
            <div class="col-6 iar top right aheight"></div>
            <div class="col-6 iar top aheight"></div>
        </div>

        <div class="row">
            <div class="col-6 iar top right">
                <div class="row">
                    <div class="col-3 iar top bottom left text-center">Stock / Property No.</div>
                    <div class="col iar all text-center mt-2">Description</div>
                </div>
            </div>
            <div class="col-6 iar top">
                <div class="row">
                    <div class="col-2 iar top bottom left text-center">Unit</div>
                    <div class="col-3 iar top bottom left text-center">Quantity</div>
                    <div class="col-3 iar top bottom left text-center">Unit Cost</div>
                    <div class="col-2 iar top bottom left text-center">Total</div>
                    <div class="col-2 iar all text-center">Lot/Batch No.</div>
                </div>
            </div>
        </div>

        <div class="row" v-for="b in batches" :key="b.batch_no">
            <div class="col-6 iar top right">
                <div class="row">
                    <div class="col-3 iar top bottom left cheight">{{ b.code }}</div>
                    <div class="col iar all">{{ b.dmddesc }}</div>
                </div>
            </div>
            <div class="col-6 iar top">
                <div class="row">
                    <div class="col-2 iar top bottom left cheight">{{ b.unit_desc }}</div>
                    <div class="col-3 iar top bottom left text-right">{{ b.received_quantity }}</div>
                    <div class="col-3 iar top bottom left text-right">{{ b.cost_price | currency2 }}</div>
                    <div class="col-2 iar top bottom left text-right">{{ b.total_cost | currency2 }}</div>
                    <div class="col-2 iar all text-center">{{ b.batch_no }}</div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-7">
                <div class="row">
                    <div class="col iar top right text-center font-weight-bold">INSPECTION</div>
                </div>
            </div>
            <div class="col-5">
                <div class="row">
                    <div class="col iar top text-center font-weight-bold">ACCEPTANCE</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-7 iar top right">
                <span>Inspected, verified and foind in order as to quantity, specifications, and expiry date (if applicable).</span>
            </div>
            <div class="col-5 iar top">
                <div class="row">
                    <div class="col-5 iar all">Date Received</div>
                    <div class="col iar top left right">{{ iar.date_received }}</div>
                    <div class="col-1 iar all"></div>
                    <div class="w-100"></div>

                    <div class="col-5 iar all">Partial / Complete ?</div>
                    <div class="col iar top left right"></div>
                    <div class="col-1 iar all"></div>
                    <div class="w-100"></div>

                    <div class="col iar all aheight"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-4 iar top">
                <div class="row">
                    <div class="col font-weight-bold">Inspection Officer</div>
                    <div class="w-100"></div>
                    <div class="col bheight"></div>
                    <div class="w-100"></div>
                    <div class="col text-center font-weight-bold eheight"><h5>{{ iar.inspector_name }}</h5></div>
                    <div class="w-100"></div>
                    <div class="col text-center eheight">{{ iar.inspector_pos }}</div>
                    <div class="w-100"></div>
                    <div class="col-5 font-weight-bold">Date Inspected</div>
                    <div class="col-6 top left right iar">{{ iar.inspector_inspected }}</div>
                    <div class="w-100"></div>
                    <div class="col aheight"></div>
                </div>
            </div>
            <div class="col-4 iar top left right">
                <div class="row">
                    <div class="col font-weight-bold">Requisitioning Officer</div>
                    <div class="w-100"></div>
                    <div class="col bheight"></div>
                    <div class="w-100"></div>
                    <div class="col text-center font-weight-bold eheight"><h5> {{ iar.user_name }} </h5></div>
                    <div class="w-100"></div>
                    <div class="col text-center eheight">  </div>
                    <div class="w-100"></div>
                    <div class="col-5 font-weight-bold">Date Inspected</div>
                    <div class="col-6 top left right iar">{{ iar.officer_inspected }}</div>
                    <div class="w-100"></div>
                    <div class="col aheight"></div>
                </div>
            </div>
            <div class="col-4 iar top">
                <div class="row">
                    <div class="col font-weight-bold">Supply and/or Property Custodian </div>
                    <div class="w-100"></div>
                    <div class="col bheight"></div>
                    <div class="w-100"></div>
                    <div class="col text-center font-weight-bolder eheight"><h4>TEOFILO M. RIVERA JR.</h4></div>
                    <div class="w-100"></div>
                    <div class="col text-center">Supervising Administrative Officer</div>
                    <div class="w-100"></div>
                    <div class="col text-center">Head, Materials Management Office</div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data(){
            return{
                
                iar: {},
                batches: [],
            }
        },
        methods:{
            get_iar(){

            },
            get_iar(){
                axios.get('../../api/iar_batch_2/'+this.$route.params.id).then(({data}) => {
                    this.iar = data;
                }).catch(() => {

                });
            },
            get_batches(){
                axios.get('../../api/iar_batch_3/'+this.$route.params.id).then(({data}) => {
                    this.batches = data;
                }).catch(() => {

                });
            },
            print(){
                window.print();
                // location.reload();
            },
        },
        computed:{

        },
        created(){
            this.get_batches();
            this.get_iar();
            
        },
        mounted() {

        }
    }
     

</script>
<style lang="scss" scoped>
    @font-face {
        font-family: 'Helvetica';
        src: url('https://fonts.googleapis.com/css?family=Helvetica');
        font-weight: normal;
        font-style: normal;
    }

    .container {
        border: none;
    }

    @media print {
        .img-thumbnail {
            margin-top: 5%;
        }
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

    .iar {
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
        height: 40px;
    }

    .eheight {
        height: 25px;
    }

    .cheight {
        height: 800px;
    }

    .dheight {
        height: 23.5px;
    }

    #footer {
        position: relative;
        bottom: 0;
        width: auto;
        margin-left: -1.3%;
    }

</style>
