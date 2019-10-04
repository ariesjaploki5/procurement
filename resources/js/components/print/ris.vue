<template>
  <div class="">
    <button class="btn btn-primary d-print-none button ml-2 mb-2" onclick="print()">Print</button>

    <div class="row">
        <div class="col-12">
            <div class="row bottom">
                <div class="ris col-auto bottom right">
                    <img :src="'/img/bghmc.png'" class="img-thumbnail">
                </div>
                <div class="ris col bottom">
                    <div class="row">
                        <div class="col-12">
                            <div class="ris all text-center">Republic of the Philippines</div>
                            <div class="ris all text-center">Department of Health</div>
                            <div class="ris all text-center font-weight-bold">BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER
                            </div>
                            <div class="ris all text-center">Baguio City</div>
                        </div>
                    </div>
                    <div class="row ris left right bottom">
                        <div class="col">
                            <div class="ris all text-center font-weight-bold">MATERIALS MANAGEMENT OFFICE</div>
                            <div class="text-center">
                                <h3>REQUISITION AND ISSUE SLIP</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col ml-2 mr-1">
                                <div class="col ris top bottom right"> Form No.: HS – MMO – 023</div>
                                <div class="col ris bottom right mr-2"> Revision No.: 1</div>
                                <div class="col ris bottom right mr-2">Effectivity Date: September 1, 2016
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-8 ris right bottom">
            <div class="row">
                <div class="col-3 ris all">Division:</div>
                <div class="col-8 ris top left right"></div>
                <div class="col-1 ris all"></div>
                <div class="w-100"></div>

                <div class="col-3 ris all">Office:</div>
                <div class="col-8 ris top left right"></div>
                <div class="col-1 ris all"></div>
                <div class="w-100"></div>

                <div class="col-3 ris all">Resp. Center Code:</div>
                <div class="col-8 ris top left right"></div>
                <div class="col-1 ris all"></div>
                <div class="w-100"></div>
            </div>
        </div>
        <div class="col-4 ris bottom">
            <div class="row">
                <div class="col-5 ris all">RIS No.:</div>
                <div class="col-6 ris top left right"></div>
                <div class="col-1 ris all"></div>
                <div class="w-100"></div>

                <div class="col-5 ris all">RIS Date:</div>
                <div class="col-6 ris top left right"></div>
                <div class="col-1 ris all"></div>
                <div class="w-100"></div>

                <div class="col-5 ris all">Fund Cluster:</div>
                <div class="col-6 ris top left right"></div>
                <div class="col-1 ris all"></div>
                <div class="w-100"></div>

            </div>
        </div>
        <div class="col-8 ris top right aheight"></div>
        <div class="col-4 ris top aheight"></div>
    </div>

    <div class="row">
        <div class="col-8 ris top right text-center font-weight-bold">Requisition</div>
        <div class="col-4 ris top text-center font-weight-bold">Issuance</div>
    </div>

    <div class="row">
        <div class="col-8 ris top right">
            <div class="row">
                <div class="col-2 ris all text-center">Stock No.</div>
                <div class="col-2 ris top bottom text-center">Quantity</div>
                <div class="col-2 ris top bottom left text-center">Unit</div>
                <div class="col ris all text-center">Description</div>
            </div>
        </div>
        <div class="col-4 ris top">
            <div class="row">
                <div class="col-3 ris top bottom left text-center">Quantity</div>
                <div class="col-2 ris top bottom left text-center">Unit</div>
                <div class="col-4 ris top bottom left text-center">Unit Cost</div>
                <div class="col-2 ris all text-center">Lot/Batch</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8 ris top right">
            <div class="row">
                <div class="col-2 ris all cheight"></div>
                <div class="col-2 ris top bottom"></div>
                <div class="col-2 ris top bottom left"></div>
                <div class="col ris all"></div>
            </div>
        </div>
        <div class="col-4 ris top">
            <div class="row">
                <div class="col-3 ris top bottom left cheight"></div>
                <div class="col-2 ris top bottom left"></div>
                <div class="col-4 ris top bottom left"></div>
                <div class="col-2 ris all"></div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-8 ris top right">
            <div class="row">
                <div class="col-4 ris all">Purpose</div>
                <div class="col-8 ris top bottom right text-center font-weight-bold"></div>
            </div>
        </div>
        <div class="col-4 ris top left">
            <div class="row">
                <div class="col ris all"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col ris top right">
            <div class="row">
                <div class="col ris all bheight"></div>
                <div class="w-100"></div>
                <div class="col ris all">Signature</div>
                <div class="w-100"></div>
                <div class="col ris left bottom right">Printed Name</div>
                <div class="w-100"></div>
                <div class="col ris left bottom right">Designation</div>
                <div class="w-100"></div>
                <div class="col ris left bottom right">Date</div>
                <div class="w-100"></div>
            </div>
        </div>
        <div class="col ris top left right">
            <div class="row">
                <div class="col ris top bottom right bheight">Requested by:</div>
                <div class="w-100"></div>
                <div class="col ris bottom right dheight"></div>
                <div class="w-100"></div>
                <div class="col ris bottom right dheight"></div>
                <div class="w-100"></div>
                <div class="col ris bottom right dheight"></div>
                <div class="w-100"></div>
                <div class="col ris bottom right dheight"></div>
                <div class="w-100"></div>
            </div>
        </div>
        <div class="col ris top left right">
            <div class="row">
                <div class="col ris top bottom right bheight">Aprroved by:</div>
                <div class="w-100"></div>
                <div class="col ris bottom right dheight"></div>
                <div class="w-100"></div>
                <div class="col ris bottom right dheight"></div>
                <div class="w-100"></div>
                <div class="col ris bottom right dheight"></div>
                <div class="w-100"></div>
                <div class="col ris bottom right dheight"></div>
                <div class="w-100"></div>
            </div>
        </div>
        <div class="col ris top left right">
            <div class="row">
                <div class="col ris top bottom right bheight">Issued by:</div>
                <div class="w-100"></div>
                <div class="col ris bottom right dheight"></div>
                <div class="w-100"></div>
                <div class="col ris bottom right dheight"></div>
                <div class="w-100"></div>
                <div class="col ris bottom right dheight"></div>
                <div class="w-100"></div>
                <div class="col ris bottom right dheight"></div>
                <div class="w-100"></div>
            </div>
        </div>
        <div class="col ris top left">
            <div class="row">
                <div class="col ris top bottom right bheight">Received by:</div>
                <div class="w-100"></div>
                <div class="col ris bottom right dheight"></div>
                <div class="w-100"></div>
                <div class="col ris bottom right dheight"></div>
                <div class="w-100"></div>
                <div class="col ris bottom right dheight"></div>
                <div class="w-100"></div>
                <div class="col ris bottom right dheight"></div>
                <div class="w-100"></div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {

}
</script>

<style scoped>
@font-face {
        font-family: 'Helvetica';
        src: url('https://fonts.googleapis.com/css?family=Helvetica');
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

    .ris {
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
        height: 29px;
    }
    .cheight {
        height: 900px;
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