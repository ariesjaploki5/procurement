<template>
<div id="f01">
     <div class="row">
            <div class="col">
                <router-link to="/request_for_quotation" tag="button" class="btn btn-secondary d-print-none float-left"><i class="fas fa-arrow-left ml-2"></i> Back</router-link>
            </div>
            <div class="col">
                <button class="btn btn-primary d-print-none button float-right" onclick="print()"><i class="fas fa-print ml-2"></i> Print</button>
            </div>
        </div>
    <div id="content-wrapper">
        <div class="col-lg-12">
            <table class="table table-condensed table-sm a" style="margin-top: 1%">
                <tr>
                    <td class="pr1 border-right-0" rowspan="8"><img :src="'/img/bghmc.png'" style="margin-left: 15%; margin-top: 3%" width="150" height="150"></td>
                    <td class="pr1 border-bottom-0" colspan="5" id="pr1">
                        <center>Republic of the Philippines</center>
                    </td>
                </tr>
                <td class="pr1 border-top-0 border-bottom-0" colspan="5">
                    <center>Department of Health</center>
                </td>
                <tr>
                    <td class="pr1 border-top-0 border-bottom-0" colspan="5">
                        <center><b>BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER</b></center>
                    </td>
                </tr>
                <tr>
                    <td class="pr1 border-top-0" colspan="5">
                        <center>Baguio City</center>
                    </td>
                </tr>
                <tr>
                    <td class="pr1" rowspan="3" width="40%">
                        <center><br><b><h3>ABSTRACT OF QUOTATION</h3></b></center>
                    </td>
                    <td class="pr1" colspan="4">Form No.: HS – PS-010</td>
                </tr>
                <td class="pr1" colspan="4">Revision No.: Ø</td>
                <tr>
                    <td class="pr1" colspan="4">Effectivity Date: August 1, 2014</td>
                </tr>
            </table>
            <table class="table table-condensed table-borderless border-0 table-sm" style="margin-top:-1.2%">
                <tr>
                    <td colspan="2"></td>
                    <td width="15%">PR No.:</td>
                    <td class="pr1 border-top-0 border-left-0 border-right-0" width="20%">
                        <span v-if="aoq.pr.purchase_request_id">{{ aoq.pr.created_at | myDate }} - {{ aoq.pr.purchase_request_id | numeral2 }}</span>
                        
                    </td>
                </tr>
                <td colspan="2">Canvassed By:</td>
                <td>AOQ No.:</td>
                <td class="pr1 border-top-0 border-left-0 border-right-0" width="20%">
                    <span v-if="aoq.pr.purchase_request_id">{{ aoq.pr.created_at | myDate }} - {{ aoq.pr.purchase_request_id | numeral2 }}</span>
                        
                </td>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Date:</td>
                    <td class="pr1 border-top-0 border-left-0 border-right-0" width="20%">
                        <span v-if="aoq.pr.created_at">{{ aoq.pr.created_at | myDate3 }}</span>
                        
                    </td>
                </tr>
            </table>
            <table class="table table-condensed border-top-0 border-left-0 border-right-0 table-sm" v-if="aoq.dmd_rfqs.length == 5">
                <tr class="" >
                    <td class="pr1 border-top-0 border-left-0 border-right-0" colspan="4"></td>
                    <td class="pr1 border-top-0 border-left-0 border-right-0" width="10%" v-for="rfq in aoq.dmd_rfqs" :key="rfq.id">
                        <b>
                            <center>
                                <span v-if="rfq.supplier_name">{{ rfq.supplier_name  }}</span>
                                <span v-else></span>
                            </center>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td class="pr1 border-top" width="5%">
                        <center><b>Item No.</b></center>
                    </td>
                    <td class="pr1 border-top" width="5%">
                        <center><b>Qty</b></center>
                    </td>
                    <td class="pr1 border-top" width="10%">
                        <center><b>Unit</b></center>
                    </td>
                    <td class="pr1 border-top" width="25%">
                        <center><b>ARTICLES</b></center>
                    </td>
                    <td class="pr1 border-top">
                        <center><b>1</b></center>
                    </td>
                    <td class="pr1 border-top">
                        <center><b>2</b></center>
                    </td>
                    <td class="pr1 border-top">
                        <center><b>3</b></center>
                    </td>
                    <td class="pr1">
                        <center><b>4</b></center>
                    </td>
                    <td class="pr1">
                        <center><b>5</b></center>
                    </td>
                </tr>
                <tr>
                    <td class="pr1">
                        <center>1</center>
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                    <td class="pr1">
                        <center>{{ aoq.dmddesc }}</center>
                    </td>
                    <td class="pr1" v-for="rfq in aoq.dmd_rfqs" :key="rfq.id">
                        <center>{{ rfq.cost_unit | currency2 }}</center>
                    </td>
                </tr>
            </table>
            <table class="table table-condensed border-top-0 border-left-0 border-right-0 table-sm" v-if="aoq.dmd_rfqs.length == 5">
                <tr class="" >
                    <td class="pr1 border-top-0 border-left-0 border-right-0" colspan="4"></td>
                    <td class="pr1 border-top-0 border-left-0 border-right-0" width="10%" v-for="rfq in aoq.dmd_rfqs" :key="rfq.id">
                        <b>
                            <center>
                                <span v-if="rfq.supplier_name">{{ rfq.supplier_name  }}</span>
                                <span v-else></span>
                            </center>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td class="pr1 border-top" width="5%">
                        <center><b>Item No.</b></center>
                    </td>
                    <td class="pr1 border-top" width="5%">
                        <center><b>Qty</b></center>
                    </td>
                    <td class="pr1 border-top" width="10%">
                        <center><b>Unit</b></center>
                    </td>
                    <td class="pr1 border-top" width="25%">
                        <center><b>ARTICLES</b></center>
                    </td>
                    <td class="pr1 border-top">
                        <center><b>1</b></center>
                    </td>
                    <td class="pr1">
                        <center><b>2</b></center>
                    </td>
                    <td class="pr1">
                        <center><b>3</b></center>
                    </td>
                    <td class="pr1">
                        <center><b>4</b></center>
                    </td>
                    <td class="pr1">
                        <center><b>5</b></center>
                    </td>
                </tr>
                <tr>
                    <td class="pr1">
                        <center>1</center>
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                    <td class="pr1">
                        <center>{{ aoq.dmddesc }}</center>
                    </td>
                    <td class="pr1" v-for="rfq in aoq.dmd_rfqs" :key="rfq.id">
                        <center>{{ rfq.cost_unit | currency2 }}</center>
                    </td>
                </tr>
            </table>
            <table class="table table-condensed border-top-0 border-left-0 border-right-0 table-sm" v-if="aoq.dmd_rfqs.length == 1">
                <tr class="" >
                    <td class="pr1 border-top-0 border-left-0 border-right-0" colspan="4"></td>
                    <td class="pr1 border-top-0 border-left-0 border-right-0" width="10%" v-for="rfq in aoq.dmd_rfqs" :key="rfq.id">
                        <b>
                            <center>
                                <span v-if="rfq.supplier_name">{{ rfq.supplier_name  }}</span>
                                <span v-else></span>
                            </center>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td class="pr1 border-top" width="5%">
                        <center><b>Item No.</b></center>
                    </td>
                    <td class="pr1 border-top" width="5%">
                        <center><b>Qty</b></center>
                    </td>
                    <td class="pr1 border-top" width="10%">
                        <center><b>Unit</b></center>
                    </td>
                    <td class="pr1 border-top" width="25%">
                        <center><b>ARTICLES</b></center>
                    </td>
                    <td class="pr1 border-top">
                        <center><b>1</b></center>
                    </td>
                    <td class="pr1 ">
                        <center><b>2</b></center>
                    </td>
                    <td class="pr1 ">
                        <center><b>3</b></center>
                    </td>
                    <td class="pr1">
                        <center><b>4</b></center>
                    </td>
                    <td class="pr1">
                        <center><b>5</b></center>
                    </td>
                </tr>
                <tr>
                    <td class="pr1">
                        <center>1</center>
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                    <td class="pr1 text-center">
                        {{ aoq.formdesc }}
                    </td>
                    <td class="pr1 text-center">
                        {{ aoq.dmddesc }}
                    </td>
                    <td class="pr1 text-center" v-for="rfq in aoq.dmd_rfqs" :key="rfq.id">
                        {{ rfq.cost_unit | currency2 }}
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                </tr>
            </table>
            <table class="table table-condensed border-top-0 border-left-0 border-right-0 table-sm" v-if="aoq.dmd_rfqs.length == 2">
                <tr class="" >
                    <td class="pr1 border-top-0 border-left-0 border-right-0" colspan="4"></td>
                    <td class="pr1 border-top-0 border-left-0 border-right-0" width="10%" v-for="rfq in aoq.dmd_rfqs" :key="rfq.id">
                        <b>
                            <center>
                                <span v-if="rfq.supplier_name">{{ rfq.supplier_name  }}</span>
                                <span v-else></span>
                            </center>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td class="pr1 border-top" width="5%">
                        <center><b>Item No.</b></center>
                    </td>
                    <td class="pr1 border-top" width="5%">
                        <center><b>Qty</b></center>
                    </td>
                    <td class="pr1 border-top" width="10%">
                        <center><b>Unit</b></center>
                    </td>
                    <td class="pr1 border-top" width="25%">
                        <center><b>ARTICLES</b></center>
                    </td>
                    <td class="pr1 border-top">
                        <center><b>1</b></center>
                    </td>
                    <td class="pr1 border-top">
                        <center><b>2</b></center>
                    </td>
                    <td class="pr1 border-top">
                        <center><b>3</b></center>
                    </td>
                    <td class="pr1">
                        <center><b>4</b></center>
                    </td>
                    <td class="pr1">
                        <center><b>5</b></center>
                    </td>
                </tr>
                <tr>
                    <td class="pr1">
                        <center>1</center>
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                    <td class="pr1">
                        <center>{{ aoq.dmddesc }}</center>
                    </td>
                    <td class="pr1" v-for="rfq in aoq.dmd_rfqs" :key="rfq.id">
                        <center>{{ rfq.cost_unit | currency2 }}</center>
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                </tr>
            </table>
            <table class="table table-condensed border-top-0 border-left-0 border-right-0 table-sm" v-if="aoq.dmd_rfqs.length == 3">
                <tr class="" >
                    <td class="pr1 border-top-0 border-left-0 border-right-0" colspan="4"></td>
                    <td class="pr1 border-top-0 border-left-0 border-right-0" width="10%" v-for="rfq in aoq.dmd_rfqs" :key="rfq.id">
                        <b>
                            <center>
                                <span v-if="rfq.supplier_name">{{ rfq.supplier_name  }}</span>
                                <span v-else></span>
                            </center>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td class="pr1 border-top" width="5%">
                        <center><b>Item No.</b></center>
                    </td>
                    <td class="pr1 border-top" width="5%">
                        <center><b>Qty</b></center>
                    </td>
                    <td class="pr1 border-top" width="10%">
                        <center><b>Unit</b></center>
                    </td>
                    <td class="pr1 border-top" width="25%">
                        <center><b>ARTICLES</b></center>
                    </td>
                    <td class="pr1 border-top">
                        <center><b>1</b></center>
                    </td>
                    <td class="pr1 border-top">
                        <center><b>2</b></center>
                    </td>
                    <td class="pr1 border-top">
                        <center><b>3</b></center>
                    </td>
                    <td class="pr1">
                        <center><b>4</b></center>
                    </td>
                    <td class="pr1">
                        <center><b>5</b></center>
                    </td>
                </tr>
                <tr>
                    <td class="pr1">
                        <center>1</center>
                    </td>
                    <td class="pr1 text-center">
                        
                    </td>
                    <td class="pr1 text-center">
                         {{ aoq.formdesc }}
                    </td>
                    <td class="pr1 text-center">
                        {{ aoq.dmddesc }}
                    </td>
                    <td class="pr1 text-center" v-for="rfq in aoq.dmd_rfqs" :key="rfq.id">
                        {{ rfq.cost_unit | currency2 }}
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                </tr>
            </table>
            <table class="table table-condensed border-top-0 border-left-0 border-right-0 table-sm" v-if="aoq.dmd_rfqs.length == 4">
                <tr class="" >
                    <td class="pr1 border-top-0 border-left-0 border-right-0" colspan="4"></td>
                    <td class="pr1 border-top-0 border-left-0 border-right-0" width="10%" v-for="rfq in aoq.dmd_rfqs" :key="rfq.id">
                        <b>
                            <center>
                                <span v-if="rfq.supplier_name">{{ rfq.supplier_name  }}</span>
                                <span v-else></span>
                            </center>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td class="pr1 border-top" width="5%">
                        <center><b>Item No.</b></center>
                    </td>
                    <td class="pr1 border-top" width="5%">
                        <center><b>Qty</b></center>
                    </td>
                    <td class="pr1 border-top" width="10%">
                        <center><b>Unit</b></center>
                    </td>
                    <td class="pr1 border-top" width="25%">
                        <center><b>ARTICLES</b></center>
                    </td>
                    <td class="pr1 border-top">
                        <center><b>1</b></center>
                    </td>
                    <td class="pr1 border-top">
                        <center><b>2</b></center>
                    </td>
                    <td class="pr1 border-top">
                        <center><b>3</b></center>
                    </td>
                    <td class="pr1">
                        <center><b>4</b></center>
                    </td>
                    <td class="pr1">
                        <center><b>5</b></center>
                    </td>
                </tr>
                <tr>
                    <td class="pr1">
                        <center>1</center>
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                    <td class="pr1">
                        <center>{{ aoq.dmddesc }}</center>
                    </td>
                    <td class="pr1" v-for="rfq in aoq.dmd_rfqs" :key="rfq.id">
                        <center>{{ rfq.cost_unit | currency2 }}</center>
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                </tr>
            </table>
            <table class="table table-condensed border-top-0 border-left-0 border-right-0 table-sm" v-if="aoq.dmd_rfqs.length == 5">
                <tr class="" >
                    <td class="pr1 border-top-0 border-left-0 border-right-0" colspan="4"></td>
                    <td class="pr1 border-top-0 border-left-0 border-right-0" width="10%" v-for="rfq in aoq.dmd_rfqs" :key="rfq.id">
                        <b>
                            <center>
                                <span v-if="rfq.supplier_name">{{ rfq.supplier_name  }}</span>
                                <span v-else></span>
                            </center>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td class="pr1 border-top" width="5%">
                        <center><b>Item No.</b></center>
                    </td>
                    <td class="pr1 border-top" width="5%">
                        <center><b>Qty</b></center>
                    </td>
                    <td class="pr1 border-top" width="10%">
                        <center><b>Unit</b></center>
                    </td>
                    <td class="pr1 border-top" width="25%">
                        <center><b>ARTICLES</b></center>
                    </td>
                    <td class="pr1 border-top">
                        <center><b>1</b></center>
                    </td>
                    <td class="pr1 border-top">
                        <center><b>2</b></center>
                    </td>
                    <td class="pr1 border-top">
                        <center><b>3</b></center>
                    </td>
                    <td class="pr1">
                        <center><b>4</b></center>
                    </td>
                    <td class="pr1">
                        <center><b>5</b></center>
                    </td>
                </tr>
                <tr>
                    <td class="pr1">
                        <center>1</center>
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                    <td class="pr1">
                        <center></center>
                    </td>
                    <td class="pr1">
                        <center>{{ aoq.dmddesc }}</center>
                    </td>
                    <td class="pr1" v-for="rfq in aoq.dmd_rfqs" :key="rfq.id">
                        <center>{{ rfq.cost_unit | currency2 }}</center>
                    </td>
                </tr>
            </table>

            <!--{{--SIGNATORIES  --}}-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm"></div>
                    <div class="col-sm">Approved:</div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm"><b><u>SAMPLE1</u></b></div>
                    <div class="col-sm-5"><b>SAMPLE2</b></div>
                </div>

                <div class="row">
                    <div class="col-sm">BAC Member</div>
                    <div class="col-sm-5">BAC Chairperson</div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data(){
        return{
            aoq: '',
        }
    },
    methods:{
        get_aoq(){
            axios.get('../../../api/dmd_aoq/'+this.$route.params.id+'/'+this.$route.params.rfq_id).then(({data}) => {
                this.aoq = data;
            }).catch(() => {

            });
        },
        print(){
            window.print();
            location.reload();
        },
    },
    created(){
        this.get_aoq();
    }
    
}

</script>

<style lang="scss" scoped>

  @media print{
      .orientation{
          width: 100%;
      }
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
