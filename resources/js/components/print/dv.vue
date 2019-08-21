<template>
<div>
    <button class="btn btn-primary d-print-none button ml-2 mb-2" onclick="print()">Print</button>
    <div class="row">
        <div class="col-12">
            <div class="row bottom">
                <div class="dv col-3 bottom right">
                    <img src="/bghmc.png" class="img-thumbnail">
                </div>
                <div class="dv col bottom">
                    <div class="row">
                        <div class="col-12">
                            <div class="dv all text-center">Republic of the Philippines</div>
                            <div class="dv all text-center">Department of Health</div>
                            <div class="dv all text-center font-weight-bold">BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER</div>
                            <div class="dv all text-center">Baguio City</div>
                        </div>
                    </div>
                    <div class="row dv left right bottom">
                        <div class="col mt-3">
                            <div class="text-center"><h2>DISBURSEMENT VOUCHER</h2></div>
                        </div>
                        <div class="row">
                            <div class="col ml-2 mr-1">
                                <div class="col dv top bottom right"> Form No.: FS-ACC-001</div>
                                <div class="col dv bottom right mr-2"> Revision No.: 1</div>
                                <div class="col dv bottom right mr-2">Effectivity Date: September 1, 2016
                                </div>   
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="w-100"></div> 
        <div class="col dv bottom aheight">
        </div> 
        <div class="w-100"></div>
        <div class="col-7 dv text-center bottom font-weight-bold"><span>MODE OF PAYMENT</span>
            <div class="row">
                <div class="col dv all"><input type="checkbox"><span> MDS Check</span></div>
                <div class="col-4 dv all"><input type="checkbox"><span> Commercial Check</span></div>
                <div class="col dv all"><input type="checkbox"><span> ADA</span></div>
                <div class="col dv all"><input type="checkbox"><span> Others</span></div>
            </div>
        </div>
        <div class="col dv text-center left right bottom font-weight-bold">FUND CLUSTER</div>
        <div class="col-3">
            <div class="row">
                <div class="col-5 dv bottom right font-weight-bold">DV NO.:</div>
                <div class="col dv bottom left"></div>
                <div class="w-100"></div>
                <div class="col-4 dv bottom top right font-weight-bold">DATE:</div>
                <div class="col dv left"></div>
            </div>
        </div>
        <div class="w-100"></div> 
        <div class="col-7 dv top right aheight"></div>
        <div class="col-2 dv top right aheight"></div>
        <div class="col dv top aheight"></div>
        <div class="w-100"></div>
        <div class="col-7 dv font-weight-bold top right"><span>PAYEE:</span></div>
        <div class="col dv top right text-center"><span>TIN/Employee No.</span></div>
        <div class="col-3 text-center">
            <div class="row">
                <div class="col dv top bottom"><span>Obligation Request/BUR</span></div>
                <div class="w-100"></div>
                <div class="col-4 dv top bottom right">No.:</div>
                <div class="col dv top left bottom"></div>
                <div class="w-100"></div>
                <div class="col-4 dv top bottom right">Date:</div>
                <div class="col dv left"></div>
                <div class="w-100"></div>
                <div class="col dv top height"></div>
            </div>
        </div>
        <div class="w-100"></div>
        <div class="col-7 dv top right bottom font-weight-bold">ADDRESS:</div>
        <div class="col-3 dv top right bottom text-center font-weight-bold">Responsibility Center</div>
        <div class="col-1 dv top right bottom text-center font-weight-bold"><small><span>RC CODE</span></small></div>
        <div class="col-1 dv top bottom text-center font-weight-bold">MFO/PAP</div>
        <div class="w-100"></div>

        <div class="col-7 dv top right bheight text-primary">Governor Pack Road, Baguio City</div>
        <div class="col-3 dv top right"></div>
        <div class="col dv top right text-center font-weight-bold"></div>
        <div class="col dv top text-center font-weight-bold">3</div>
        <div class="w-100"></div>

        <div class="col-10 dv text-center font-weight-bold top right">PARTICULARS</div>
        <div class="col dv text-center font-weight-bold top">AMOUNT</div>
        <div class="w-100"></div>

        <div class="col-10 dv top bottom right eheight"></div>
        <div class="col dv top bottom"></div>
        <div class="w-100"></div>

        <div class="col-10 dv top font-weight-bold text-right">AMOUNT DUE</div>
        <div class="col dv left top"></div>
        <div class="w-100"></div>
        
            <div class="col-12">
                <div class="row">
                    <div class="col-1 text-center font-weight-bold">
                        <div class="row">
                            <div class="col-auto dv top right"><span>A</span></div>
                            <div class="col dv top bottom right"></div>
                        </div>
                    </div>
                    <div class="col-auto dv all emargin"><span class="font-weight-bold font-italic">CERTIFIED:</span> Expenses/Cash Advance necessary, lawful and incurred under my direct supervision.</div>
                    <div class="col dv top left bottom "></div>
                </div>
            </div>
            <div class="w-100"></div>

            <div class="col-12 dv bheight top bottom"></div>
            <div class="col-4 dv top bottom right"></div>
            <div class="col-4 dv top left right font-weight-bold text-center">RAY P. SUANDING,MD.,FPCP, FPCCP</div>
            <div class="col-4 dv top bottom left"></div>
            <div class="w-100"></div>

            <div class="col-4 dv top right"></div>
            <div class="col-4 dv top left right text-center">Chief, Medical Professional Staff</div>
            <div class="col-4 dv top left"></div>
            <div class="w-100"></div>

            <div class="col-6 dv top bottom left">
                <div class="row">
                    <div class="col-auto dv top font-weight-bold">B</div>
                    <div class="col-3 dv all font-weight-bold font-italic"><span>CERTIFIED:</span></div>
                    <div class="col dv all"><input type="checkbox"> Cash Available</div>                 
                    <div class="w-100"></div>

                    <div class="col-1 dv top right bottom"></div>
                    <div class="col-3 dv all"></div>
                    <div class="col dv all"><input type="checkbox"> Subject to ADA (when applicable)</div> 
                    <div class="w-100"></div>

                    <div class="col-1 dv top right bottom"></div>
                    <div class="col-3 dv all"></div>
                    <div class="col dv all"><input type="checkbox"> Supporting document complete</div> 
                    <div class="w-100"></div>
                    
                    <div class="col-1 dv top right bottom bheight"></div>
                    <div class="col dv all bheight">Bank Account:</div>
                    <div class="col-5 dv top left right"></div> 
                    <div class="col dv all"></div>
                </div>
            </div>
            <div class="col-6 dv top bottom left">
                <div class="row">
                    <div class="col-auto dv top left font-weight-bold">C</div>
                    <div class="col dv all font-weight-bold"><span>Approved for Payment</span></div>
                    <div class="w-100"></div>
                    <div class="col dv all cheight"></div>
                    <div class="w-100"></div>

                    <div class="col-2 dv top left right bottom"></div>
                    <div class="col-8 dv top left right text-center font-weight-bold">Pesos Only</div> 
                    <div class="col dv all"></div>
                </div>
            </div>
            <div class="col-6 dv top bottom right"></div>
            <div class="col-6 dv top bottom text-center cheight">Amount in Words</div>
            <div class="w-100"></div>       
            <div class="col-6 dv top bottom right">
                <div class="row">
                    <div class="col-2 dv all aheight"></div>
                    <div class="col dv top left right"></div>
                    <div class="col-2 dv all"></div>
                </div>
            </div>
            <div class="col-6 dv top bottom">
                <div class="row">
                    <div class="col-2 dv all aheight"></div>
                    <div class="col dv top left right"></div>
                    <div class="col-2 dv all"></div>
                </div>
            </div>
            <div class="col-6 dv top bottom right">
                    <div class="row">
                        <div class="col-2 dv all"></div>
                        <div class="col dv all text-center font-weight-bold">CECILIA J. PUGONG</div>
                        <div class="col-2 dv top all"></div>
                    </div>
                </div>
            <div class="col-6 dv top bottom">
                <div class="row">
                    <div class="col-2 dv all"></div>
                    <div class="col dv all text-center font-weight-bold">RICARDO B. RUNEZ JR.,MD,FPCS,MHA,CESE</div>
                    <div class="col-2 dv all"></div>
                </div>
            </div>
            <div class="col-6 dv top bottom right">
                    <div class="row">
                        <div class="col-2 dv all"></div>
                        <div class="col dv all text-center">Accountant IV</div>
                        <div class="col-2 dv top all"></div>
                    </div>
                </div>
            <div class="col-6 dv top bottom">
                <div class="row">
                    <div class="col-2 dv all"></div>
                    <div class="col dv all text-center">Medical Center Chief II</div>
                    <div class="col-2 dv all"></div>
                </div>
            </div>
            <div class="col-6 dv top bottom right">
                <div class="row">
                    <div class="col-2 dv all cheight"></div>
                    <div class="col dv top left right"></div>
                    <div class="col-2 dv all"></div>
                </div>
            </div>
            <div class="col-6 dv top bottom">
                <div class="row">
                    <div class="col-2 dv all cheight"></div>
                    <div class="col dv top left right"></div>
                    <div class="col-2 dv all"></div>
                </div> 
            </div>
            <div class="col-6 dv top right">
                <div class="row">
                    <div class="col-2 dv all"></div>
                    <div class="col dv all text-center">Date</div>
                    <div class="col-2 dv top all"></div>
                </div>
            </div>
        <div class="col-6 dv top">
            <div class="row">
                <div class="col-2 dv all"></div>
                <div class="col dv all text-center">Date</div>
                <div class="col-2 dv all"></div>
            </div>
        </div>
        <div class="col-8 dv top left">
            <div class="row">
                <div class="col-auto dv top font-weight-bold">D</div>
                <div class="col-3 dv all font-weight-bold"><span>Recieved Payment</span></div>
                <div class="col dv all"></div>                 
                <div class="w-100"></div>

                <div class="col-1 dv top right bottom"></div>
                <div class="col-2 dv all"> Signature:</div> 
                <div class="col-3 dv top left right"></div> 
                <div class="col-3 dv all"> Check/ADA No.</div>
                <div class="col-2 dv top left right"></div>
                <div class="col-1 dv all"></div>
                <div class="w-100"></div>

                <div class="col-1 dv top right bottom"></div>
                <div class="col-2 dv all"></div> 
                <div class="col-3 dv all"></div> 
                <div class="col-3 dv all"> Date:</div>
                <div class="col-2 dv top left right"></div>
                <div class="col-1 dv all"></div>
                <div class="w-100"></div>

                <div class="col-1 dv top right bottom"></div>
                <div class="col-2 dv all"> <small>Printed Name:</small></div> 
                <div class="col-3 dv top left right"></div> 
                <div class="col-3 dv all"> Bank Name:</div>
                <div class="col-2 dv top left right"></div>
                <div class="col-1 dv all"></div>
                <div class="w-100"></div>
                
                <div class="col-1 dv top right bottom"></div>
                <div class="col-2 dv all"> Date:</div> 
                <div class="col-3 dv top left right"></div> 
                <div class="col-3 dv all"> O.R. No.:</div>
                <div class="col-2 dv top left right"></div>
                <div class="col-1 dv all"></div>
                <div class="w-100"></div>

                <div class="col dv top bottom right aheight"></div>
            </div>
        </div>
        <div class="col-4 dv top left">
            <div class="row">
                <div class="col dv all text-center font-weight-bold">Journal Entry Voucher</div>
                <div class="w-100"></div>

                <div class="col-3 dv all"></div>
                <div class="col-8 dv all text-white"></div>
                <div class="col dv all bheight"></div>
                <div class="w-100"></div>

                <div class="col-3 dv all">No.:</div>
                <div class="col-8 dv top left right"></div>
                <div class="col dv all"></div>
                <div class="w-100"></div>

                <div class="col-3 dv all">Date:</div>
                <div class="col-8 dv top left right"></div>
                <div class="col dv all aheight"></div>
                <div class="w-100"></div>
                
                <div class="col dv all height"></div>
            </div>
        </div>
        <div class="col-8 dv top bottom left">
            <div class="row">
                <div class="col-auto dv top bottom font-weight-bold aheight">E</div>
                <div class="col dv all font-weight-bold he"><span>ACCOUNTING ENTRY:</span></div>
            </div>
        </div>
        <div class="col-4 top bottom left">
            <div class="row">
                <div class="col-12 dv top bottom left aheight"></div>
            </div>
        </div>
        <div class="col-6 dv bottom right">
            <div class="row">
                <div class="col dv all text-center font-weight-bold">ACCOUNT TITLE</div>
            </div>
        </div>
        <div class="col-2 dv bottom right">
            <div class="row">
                <div class="col dv all text-center font-weight-bold mt-2">UACS CODE</div>
            </div>
        </div>
        <div class="col-4 dv">
            <div class="row">
                <div class="col dv all text-center font-weight-bold">Amount</div>
            </div>
        </div>
        <div class="col-6 dv top right">
            <div class="row">
                <div class="col dv all font-weight-bold">JEV 1 OF 2</div>
            </div>
        </div>
        <div class="col-2 dv top right">
            <div class="row">
                <div class="col dv all text-center font-weight-bold"></div>
            </div>
        </div>
        <div class="col-2 dv top right">
            <div class="row">
                <div class="col dv all text-center font-weight-bold">Amount</div>
            </div>
        </div>
        <div class="col-2 dv top">
            <div class="row">
                <div class="col dv all text-center font-weight-bold">Amount</div>
            </div>
        </div>

 
        <div class="col-6 dv top">
            <div class="row">
                <div class="col dv aheight all"></div>
                <div class="w-100"></div>
                <div class="col dv aheight left bottom right"></div>
                <div class="w-100"></div>
                <div class="col dv aheight left bottom right"></div>
            </div>
        </div>
        <div class="col-2 dv top left">
            <div class="row">
                <div class="col dv aheight top all"></div>
                <div class="w-100"></div>
                <div class="col dv aheight left bottom right"></div>
                <div class="w-100"></div>
                <div class="col dv aheight left bottom right"></div>
            </div>
        </div>
        <div class="col-2 dv top left">
            <div class="row">
                <div class="col dv aheight all"></div>
                <div class="w-100"></div>
                <div class="col dv aheight left bottom right"></div>
                <div class="w-100"></div>
                <div class="col dv aheight left bottom right"></div>
            </div>
        </div>
        <div class="col-2 dv top left">
            <div class="row">
                <div class="col dv aheight all"></div>
                <div class="w-100"></div>
                <div class="col dv aheight left bottom right"></div>
                <div class="w-100"></div>
                <div class="col dv aheight left bottom right"></div>
            </div>
        </div>


        <div class="col-6 dv top">
            <div class="row">
                <div class="col-6 dv all font-weight-bold">PREPARED BY:</div>
                <div class="col-6 dv all font-weight-bold">CHECKED BY:</div>
                <div class="w-100"></div>
                <div class="col aheight text-center font-weight-bold"></div>
                <div class="col aheight text-center font-weight-bold"></div>
                <div class="col"></div>
            </div>
        </div>
        <div class="col-6 dv left top">
            <div class="row">
                <div class="col-12 dv all font-weight-bold">APRROVED BY:</div>
                <div class="w-100"></div>
                
                <div class="col text-center font-weight-bold">CECILIA J. PUGONG</div>
                <div class="w-100"></div>

                <div class="col text-center">Accountant IV</div>
                <div class="w-100"></div>

                <div class="col text-center">Head, Accounting Section</div>
            </div>
        </div>

    </div>
</div>  
</template>

<script>
export default {

}
</script>

<style lang="scss">
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
        margin-top: 10px;
        margin-left: auto;
        margin-right: auto;
        width: 65%;
    }

    .font {
        font-family: 'Helvetica', sans-serif;
    }

    .dv {
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
    .height {
        height: 5px;
    }
    .aheight {
        height: 25px;
    }
    .bheight {
        height: 30px;
    }
    .dheight {
        height: 100px;
    }
    .cheight {
        height: 50px;
    }
    .eheight {
        height: 270px;
    }
    .emargin {
        margin-left: -5%;
    }
    #footer {
        position: fixed;
        bottom: 0;
        width: auto;
        margin-left: -1.3%;
    }
    
</style>