<template>
    <div class="container landscape">
        <button class="btn btn-primary d-print-none button ml-2 mb-2" onclick="print()">Print</button>
        <div class="row">
            <div class="col-12">
                <div class="row bottom">
                    <div class="aoq col-3 bottom right">
                        <img :src="'/img/bghmc.png'" class="img-thumbnail" />
                    </div>
                    <div class="aoq col bottom">
                        <div class="row">
                            <div class="col-12">
                                <div class="aoq all text-center">Republic of the Philippines</div>
                                <div class="aoq all text-center">Department of Health</div>
                                <div class="aoq all text-center font-weight-bold">BAGUIO GENERAL HOSPITAL AND MEDICAL
                                    CENTER</div>
                                <div class="aoq all text-center">Baguio City</div>
                            </div>
                        </div>
                        <div class="row aoq left right bottom">
                            <div class="col mt-3">
                                <div class="text-center">
                                    <h1>ABSTRACT OF QUOTATION</h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col ml-2 mr-1">
                                    <div class="col aoq top bottom right">Form No.: HS – PS-010</div>
                                    <div class="col aoq bottom right">Revision No.: Ø</div>
                                    <div class="col aoq bottom right">Effectivity Date: August 1, 2014</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 aoq all">
                <div class="row">
                    <div class="col-3 aoq left right bottom bheight"></div>
                    <div class="col-4 aoq left right bottom"></div>
                    <div class="col-1 aoq left right bottom"></div>
                    <div class="col-1 aoq left right bottom"></div>
                    <div class="col-2 aoq left bottom right"></div>
                    <div class="col-1 aoq left right bottom"></div>
                    <div class="w-100"></div>

                    <div class="col-3 aoq all">Canvassed by:</div>
                    <div class="col-4 aoq top left right"></div>
                    <div class="col-1 aoq all"></div>
                    <div class="col-2 aoq all">PR No.:</div>
                    <div class="col-2 aoq top left right font-weight-bold">
                        <span v-if="aoq.pr.purchase_request_id">{{ aoq.pr.created_at | myDate }} -
                            {{ aoq.pr.purchase_request_id | numeral2 }}</span>
                    </div>
                    <div class="col-1 aoq all"></div>
                    <div class="w-100"></div>

                    <div class="col-3 aoq all"></div>
                    <div class="col-4 aoq top left right"></div>
                    <div class="col-1 aoq all"></div>
                    <div class="col-2 aoq all">AOQ No.:</div>
                    <div class="col-2 aoq top left right"></div>
                    <div class="col-1 aoq all"></div>
                    <div class="w-100"></div>

                    <div class="col-3 aoq all"></div>
                    <div class="col-4 aoq all"></div>
                    <div class="col-1 aoq all"></div>
                    <div class="col-2 aoq all">Date:</div>
                    <div class="col-2 aoq top left right font-weight-bold">
                        <span v-if="aoq.pr.created_at">{{ aoq.pr.created_at | myDate3 }}</span>
                    </div>
                    <div class="col-1 aoq all"></div>
                </div>
            </div>

            <div class="col-12 bheight"></div>

            <div class="row" v-if="aoq.dmd_rfqs.length == 1">
                <div class="col-12 aoq all">
                    <div class="row">
                        <div class="col-1 aoq all"></div>
                        <div class="col-1 aoq all"></div>
                        <div class="col-1 aoq all"></div>
                        <div class="col-4 aoq all"></div>
                        <div class="col-1 aoq all font-weight-bold left right text-center" v-for="rfq in aoq.dmd_rfqs"
                            :key="rfq.id">
                            <i><small><span v-if="rfq.supplier_name">{{ rfq.supplier_name }}</span>
                                    <span v-else></span></small></i>
                        </div>
                        <div class="col-1 aoq all font-weight-bold text-center"></div>
                        <div class="col-1 aoq all font-weight-bold left text-center">

                        </div>
                    </div>
                </div>
                <div class="col-12 aoq">
                    <div class="row">
                        <div class="col-1 aoq all font-weight-bold right text-center" width="5%">Item No.</div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center" width="5%">Qty</div>
                        <div class="col-1 aoq all font-weight-bold left right text-center" width="10%">Unit</div>
                        <div class="col-4 aoq top bottom font-weight-bold text-center" width="25%">Articles</div>
                        <div class="col-1 aoq all font-weight-bold left right text-center">1</div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center">2</div>
                        <div class="col-1 aoq all font-weight-bold left right text-center">3</div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center">4</div>
                        <div class="col-1 aoq all font-weight-bold left text-center">5</div>
                    </div>
                </div>
                <div class="col-12 aoq top">
                    <div class="row">
                        <div class="col-1 aoq all font-weight-bold right text-center" width="5%"></div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center" width="5%"></div>
                        <div class="col-1 aoq all font-weight-bold left right text-center" width="10%"></div>
                        <div class="col-4 aoq top bottom font-weight-bold text-center" width="25%">{{ aoq.dmddesc }}
                        </div>
                        <div class="col-1 aoq all font-weight-bold left right text-center" v-for="rfq in aoq.dmd_rfqs"
                            :key="rfq.id"><small>{{ rfq.cost_unit | currency2 }}</small></div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center"></div>
                        <div class="col-1 aoq top bottom font-weight-bold left text-center"></div>
                    </div>
                </div>
            </div>

            <div class="row" v-if="aoq.dmd_rfqs.length == 2">
                <div class="col-12 aoq all">
                    <div class="row">
                        <div class="col-1 aoq all"></div>
                        <div class="col-1 aoq all"></div>
                        <div class="col-1 aoq all"></div>
                        <div class="col-4 aoq all"></div>
                        <div class="col-1 aoq all font-weight-bold left right text-center" v-for="rfq in aoq.dmd_rfqs"
                            :key="rfq.id">
                            <i><small><span v-if="rfq.supplier_name">{{ rfq.supplier_name }}</span>
                                    <span v-else></span></small></i>
                        </div>
                        <div class="col-1 aoq all font-weight-bold text-center"></div>
                        <div class="col-1 aoq all font-weight-bold left text-center">

                        </div>
                    </div>
                </div>
                <div class="col-12 aoq">
                    <div class="row">
                        <div class="col-1 aoq all font-weight-bold right text-center" width="5%">Item No.</div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center" width="5%">Qty</div>
                        <div class="col-1 aoq all font-weight-bold left right text-center" width="10%">Unit</div>
                        <div class="col-4 aoq top bottom font-weight-bold text-center" width="25%">Articles</div>
                        <div class="col-1 aoq all font-weight-bold left right text-center">1</div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center">2</div>
                        <div class="col-1 aoq all font-weight-bold left right text-center">3</div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center">4</div>
                        <div class="col-1 aoq all font-weight-bold left text-center">5</div>
                    </div>
                </div>
                <div class="col-12 aoq top">
                    <div class="row">
                        <div class="col-1 aoq all font-weight-bold right text-center" width="5%"></div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center" width="5%"></div>
                        <div class="col-1 aoq all font-weight-bold left right text-center" width="10%"></div>
                        <div class="col-4 aoq top bottom font-weight-bold text-center" width="25%">{{ aoq.dmddesc }}
                        </div>
                        <div class="col-1 aoq all font-weight-bold left right text-center" v-for="rfq in aoq.dmd_rfqs"
                            :key="rfq.id"><small>{{ rfq.cost_unit | currency2 }}</small></div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center"></div>
                        <div class="col-1 aoq top bottom font-weight-bold left text-center"></div>
                    </div>
                </div>
            </div>

            <div class="row" v-if="aoq.dmd_rfqs.length == 3">
                <div class="col-12 aoq all">
                    <div class="row">
                        <div class="col-1 aoq all"></div>
                        <div class="col-1 aoq all"></div>
                        <div class="col-1 aoq all"></div>
                        <div class="col-4 aoq all"></div>
                        <div class="col-1 aoq all font-weight-bold left right text-center" v-for="rfq in aoq.dmd_rfqs"
                            :key="rfq.id">
                            <i><small><span v-if="rfq.supplier_name">{{ rfq.supplier_name }}</span>
                                    <span v-else></span></small></i>
                        </div>
                        <div class="col-1 aoq all font-weight-bold text-center"></div>
                        <div class="col-1 aoq all font-weight-bold left text-center">

                        </div>
                    </div>
                </div>
                <div class="col-12 aoq">
                    <div class="row">
                        <div class="col-1 aoq all font-weight-bold right text-center" width="5%">Item No.</div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center" width="5%">Qty</div>
                        <div class="col-1 aoq all font-weight-bold left right text-center" width="10%">Unit</div>
                        <div class="col-4 aoq top bottom font-weight-bold text-center" width="25%">Articles</div>
                        <div class="col-1 aoq all font-weight-bold left right text-center">1</div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center">2</div>
                        <div class="col-1 aoq all font-weight-bold left right text-center">3</div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center">4</div>
                        <div class="col-1 aoq all font-weight-bold left text-center">5</div>
                    </div>
                </div>
                <div class="col-12 aoq top">
                    <div class="row">
                        <div class="col-1 aoq all font-weight-bold right text-center" width="5%"></div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center" width="5%"></div>
                        <div class="col-1 aoq all font-weight-bold left right text-center" width="10%"></div>
                        <div class="col-4 aoq top bottom font-weight-bold text-center" width="25%">{{ aoq.dmddesc }}
                        </div>
                        <div class="col-1 aoq all font-weight-bold left right text-center" v-for="rfq in aoq.dmd_rfqs"
                            :key="rfq.id"><small>{{ rfq.cost_unit | currency2 }}</small></div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center"></div>
                        <div class="col-1 aoq all font-weight-bold left text-center"></div>
                    </div>
                </div>
            </div>

            <div class="row" v-if="aoq.dmd_rfqs.length == 4">
                <div class="col-12 aoq all">
                    <div class="row">
                        <div class="col-1 aoq all"></div>
                        <div class="col-1 aoq all"></div>
                        <div class="col-1 aoq all"></div>
                        <div class="col-4 aoq all"></div>
                        <div class="col-1 aoq all font-weight-bold left right text-center" v-for="rfq in aoq.dmd_rfqs"
                            :key="rfq.id">
                            <i><small><span v-if="rfq.supplier_name">{{ rfq.supplier_name }}</span>
                                    <span v-else></span></small></i>
                        </div>
                        <div class="col-1 aoq all font-weight-bold text-center"></div>
                        <div class="col-1 aoq all font-weight-bold left text-center">

                        </div>
                    </div>
                </div>
                <div class="col-12 aoq">
                    <div class="row">
                        <div class="col-1 aoq all font-weight-bold right text-center" width="5%">Item No.</div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center" width="5%">Qty</div>
                        <div class="col-1 aoq all font-weight-bold left right text-center" width="10%">Unit</div>
                        <div class="col-4 aoq top bottom font-weight-bold text-center" width="25%">Articles</div>
                        <div class="col-1 aoq all font-weight-bold left right text-center">1</div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center">2</div>
                        <div class="col-1 aoq all font-weight-bold left right text-center">3</div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center">4</div>
                        <div class="col-1 aoq all font-weight-bold left text-center">5</div>
                    </div>
                </div>
                <div class="col-12 aoq top">
                    <div class="row">
                        <div class="col-1 aoq all font-weight-bold right text-center" width="5%"></div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center" width="5%"></div>
                        <div class="col-1 aoq all font-weight-bold left right text-center" width="10%"></div>
                        <div class="col-4 aoq top bottom font-weight-bold text-center" width="25%">{{ aoq.dmddesc }}
                        </div>
                        <div class="col-1 aoq top bottom left font-weight-bold left right text-center"
                            v-for="rfq in aoq.dmd_rfqs" :key="rfq.id"><small>{{ rfq.cost_unit | currency2 }}</small>
                        </div>
                        <div class="col-1 aoq top bottom right font-weight-bold left text-center"></div>
                    </div>
                </div>
            </div>

            <div class="row" v-if="aoq.dmd_rfqs.length == 5">
                <div class="col-12 aoq all">
                    <div class="row">
                        <div class="col-1 aoq all"></div>
                        <div class="col-1 aoq all"></div>
                        <div class="col-1 aoq all"></div>
                        <div class="col-4 aoq all"></div>
                        <div class="col-1 aoq all font-weight-bold left right text-center" v-for="rfq in aoq.dmd_rfqs"
                            :key="rfq.id">
                            <i><small><span v-if="rfq.supplier_name">{{ rfq.supplier_name }}</span>
                                    <span v-else></span></small></i>
                        </div>
                        <div class="col-1 aoq all font-weight-bold text-center"></div>
                        <div class="col-1 aoq all font-weight-bold left text-center">

                        </div>
                    </div>
                </div>
                <div class="col-12 aoq">
                    <div class="row">
                        <div class="col-1 aoq all font-weight-bold right text-center" width="5%">Item No.</div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center" width="5%">Qty</div>
                        <div class="col-1 aoq all font-weight-bold left right text-center" width="10%">Unit</div>
                        <div class="col-4 aoq top bottom font-weight-bold text-center" width="25%">Articles</div>
                        <div class="col-1 aoq all font-weight-bold left right text-center">1</div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center">2</div>
                        <div class="col-1 aoq all font-weight-bold left right text-center">3</div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center">4</div>
                        <div class="col-1 aoq all font-weight-bold left text-center">5</div>
                    </div>
                </div>
                <div class="col-12 aoq top">
                    <div class="row">
                        <div class="col-1 aoq all font-weight-bold right text-center" width="5%"></div>
                        <div class="col-1 aoq top bottom font-weight-bold text-center" width="5%"></div>
                        <div class="col-1 aoq all font-weight-bold left right text-center" width="10%"></div>
                        <div class="col-4 aoq top bottom font-weight-bold text-center" width="25%">{{ aoq.dmddesc }}
                        </div>
                        <div class="col-1 aoq top bottom font-weight-bold left right text-center"
                            v-for="rfq in aoq.dmd_rfqs" :key="rfq.id"><small>{{ rfq.cost_unit | currency2 }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 aheight"></div>

            <div class="col-12 aoq all">
                <div class="row">
                    <div class="col-7 aoq text-right all">Approved:</div>
                </div>
            </div>

            <div class="col-12 bheight"></div>
            <div class="col-12 aoq all">
                <div class="row">
                    <div class="col-7 aoq all font-weight-bold">Sample1</div>
                    <div class="col-5 aoq all font-weight-bold">Sample2</div>
                    <div class="w-100"></div>
                    <div class="col-7 aoq all">BAC Member</div>
                    <div class="col-5 aoq all">BAC Chairperson</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                aoq: ""
            };
        },
        methods: {
            get_aoq() {
                axios
                    .get(
                        "../../../api/dmd_aoq/" +
                        this.$route.params.id +
                        "/" +
                        this.$route.params.rfq_id
                    )
                    .then(({
                        data
                    }) => {
                        this.aoq = data;
                    })
                    .catch(() => {});
            },
            print() {
                window.print();
                location.reload();
            }
        },
        created() {
            this.get_aoq();
        }
    };

</script>

<style type="text/css" media="print" scoped>
    .landscape {
        width: 276mm;
        height: 190mm;
    }

    @media print {
        div.landscape {
            transform: rotate(270deg) translate(-276mm, 0);
            transform-origin: 0 0;
        }
    }

    @font-face {
        font-family: "Helvetica";
        src: url("https://fonts.googleapis.com/css?family=Helvetica");
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
        font-family: "Helvetica", sans-serif;
    }

    .aoq {
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
        height: 50px;
    }

    .bheight {
        height: 30px;
    }

    .cheight {
        height: 600px;
    }

</style>
