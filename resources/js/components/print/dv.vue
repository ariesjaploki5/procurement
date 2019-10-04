<template>
<div>
    <button class="btn btn-primary d-print-none button ml-2 mb-2" onclick="print()">Print</button>
    <div class="row">
        <div class="col-12">
            <div class="row bottom">
                <div class="dv col-auto bottom right">
                    <img :src="'/img/bghmc.png'" class="img-thumbnail">
                </div>
                <div class="dv col bottom">
                    <div class="row">
                        <div class="col-12">
                            <div class="dv all text-center">Republic of the Philippines</div>
                            <div class="dv all text-center">Department of Health</div>
                            <div class="dv all text-center font-weight-bold">BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER
                            </div>
                            <div class="dv all text-center">Baguio City</div>
                        </div>
                    </div>
                    <div class="row dv left right bottom">
                        <div class="col mt-3">
                            <div class="text-center">
                                <h2>DISBURSEMENT VOUCHER</h2>
                            </div>
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
        <div class="col dv bottom top">
        </div>
        <div class="w-100"></div>
        <div class="col-7 dv text-center bottom font-weight-bold"><span>MODE OF PAYMENT</span>
            <div class="row">
                <div class="col-3 dv all"><input type="checkbox"> MDS Check</div>
                <div class="col-4 dv all"><input type="checkbox"> Commercial Check</div>
                <div class="col-2 dv all"><input type="checkbox"> ADA</div>
                <div class="col-3 dv all"><input type="checkbox"> Others</div>
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
        <div class="col-7 dv top right jheight"></div>
        <div class="col-2 dv top right jheight"></div>
        <div class="col dv top jheight"></div>
        <div class="w-100"></div>
        <div class="col-7 dv font-weight-bold top right">
            <span>PAYEE: </span>
            <div class="w-100"></div>
            <span>{{ dv_form.supplier_name }}</span>
        </div>
        <div class="col dv top right text-center">
            <span>TIN/Employee No.</span>
            <div class="w-100"></div>
            <span>{{ dv_form.tin }}</span>
        </div>
        <div class="col-3 text-center">
            <div class="row">
                <div class="col dv top bottom"><span>Obligation Request/BUR</span></div>
                <div class="w-100"></div>
                <div class=" dv top bottom right">No.:</div>
                <div class="col dv top left bottom">
                    <span><small><strong>{{ dv_form.obrs_no }}</strong></small></span>
                </div>
                <div class="w-100"></div>
                <div class="dv top bottom right">Date:</div>
                <div class="col dv left">
                    <span>{{ dv_form.obrs_date | myDate6 }}</span>
                </div>
                <div class="w-100"></div>
                <div class="col dv top jheight"></div>
            </div>
        </div>
        <div class="w-100"></div>
        <div class="col-7 dv top right bottom font-weight-bold">
            ADDRESS:
        </div>
        <div class="col-3 dv top right bottom text-center font-weight-bold">Responsibility Center</div>
        <div class="col-1 dv top right bottom text-center font-weight-bold"><small><span>RC CODE</span></small></div>
        <div class="col-1 dv top bottom text-center font-weight-bold">MFO/PAP</div>
        <div class="w-100"></div>

        <div class="col-7 dv top right bheight text-primary">
            <span>{{ dv_form.supplier_address }}</span>
        </div>
        <div class="col-3 dv top right text-center">Pharmacy Section (Main) </div>
        <div class="col dv top right text-center font-weight-bold"></div>
        <div class="col dv top text-center font-weight-bold">3</div>
        <div class="w-100"></div>

        <div class="col-10 dv text-center font-weight-bold top right">PARTICULARS</div>
        <div class="col dv text-center font-weight-bold top">AMOUNT</div>
        <div class="w-100"></div>

        <div class="col-2 dv top bottom right font-weight-bold cheight"><i>DESCRIPTION:</i></div>
        <div class="col-8 dv top bottom left">{{ dv_form.dmddesc }}</div>
        <div class="col dv-1 top bottom left text-center font-weight-bold">Php</div>
        <div class="col dv top bottom left text-right font-weight-bold">{{ dv_form.total_amount | currency }}</div>
        <div class="w-100"></div>

        <div class="col-10 dv top bottom eheight">
            <div class="row">
                <div class="col-6 dv all">
                    <div class="ml-1 row font-weight-bold">Attachments: (Mode: Mode of Procurement)</div>
                    <div class="row" v-for="(a, index) in attachments" :key="a.index">
                        <div class="col-md-12">
                            {{ index + 1 }}. {{ a.attachment }}
                        </div>
                    </div>
                </div>
                <div class="col-6 dv all">
                    <div class="row" v-if="dv_form.tax_id !== 3">
                        <div class="col-8 dv all font-weight-bold"><i>Tax Base:</i></div>
                        <div class="col-4 dv all text-right">
                            <span v-if="dv_form.tax_id == 1">{{ dv_form.total_amount / 1.12 | currency}}</span>
                            <span v-else>{{ dv_form.total_amount | currency }}</span>
                        </div>
                        <div class="w-100"></div>

                        <div class="col dv all font-weight-bold"><i>Withholding Taxes:</i></div>
                        <div class="w-100"></div>

                        <div class="col-8 dv all">EWT 1%</div>
                        <div class="col-4 dv all text-right">{{ dv_form.total_amount * .01 | currency }}</div>
                        <div class="w-100"></div>
                        <div class="col-8 dv all">
                            <span v-if="dv_form.tax_id == 1">Final Vat 5%</span>
                            <span v-if="dv_form.tax_id == 2">PT 3%</span>
                        </div>
                        <div class="col-4 dv all text-right">
                            <span v-if="dv_form.tax_id == 1">{{ dv_form.total_amount * .05 | currency }}</span>
                            <span v-if="dv_form.tax_id == 2">{{ dv_form.total_amount * .03 | currency }}</span>
                        </div>
                        <div class="w-100"></div>
                        <div class="col dv all font-weight-bold" v-if="liquidated_damages.length"><i>Liquidated Damages : () </i></div>
                        <div class="w-100"></div>
                        <div class="col-12" v-for="lq in liquidated_damages" :key="lq.iar_no_2">
                            <div class="row">
                                <div class="col-9 dv all"><small>{{ lq.iar_no }}</small></div>
                                <div class="col-3 dv all text-right">{{ lq.tax }}</div>
                            </div>
                            
                        </div>
                        <div class="w-100"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col dv top bottom left">
            <div class="row" v-if="dv_form.tax_id !== 3">
                <div class="col-12 dv all font-weight-bold"><i></i></div>
                    <div class="w-100"></div>
                <div class="col dv all font-weight-bold"><i></i></div>
                    <div class="w-100"></div>
                <div class="col-12 dv all"></div>
                    <div class="w-100"></div>
                <div class="col-12 dv all text-right">
                    <span>({{ dv_form.tax_vat_amount | currency }})</span>
                </div>
                    <div class="w-100"></div>
                <div class="col dv all font-weight-bold"><i></i></div>
                    <div class="w-100"></div>
                    <div class="row"></div>
                <div  v-if="liquidated_damages.length" class="col-12 text-right">
                    <span>({{ dv_form.total_lqd | currency}})</span>
                </div>
                <div class="w-100"></div>
            </div>
        </div>
        <div class="w-100"></div>

        <div class="col-10 dv top font-weight-bold text-right">AMOUNT DUE</div>
        <div class="col dv top left text-right font-weight-bold">{{ dv_form.last_amount | currency }}</div>
        <div class="w-100"></div>

        <div class="col-12">
            <div class="row">
                <div class="col-1 text-center font-weight-bold">
                    <div class="row">
                        <div class="col-auto dv top right"><span>A</span></div>
                        <div class="col dv top bottom right"></div>
                    </div>
                </div>
                <div class="col-auto dv all emargin"><span class="font-weight-bold font-italic">CERTIFIED:</span>
                    Expenses/Cash Advance necessary, lawful and incurred under my direct supervision.</div>
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
                <div class="col dv all"><span style='font-size:20px;'>&#9746;</span> Cash Available</div>
                <div class="w-100"></div>

                <div class="col-1 dv top right bottom"></div>
                <div class="col-3 dv all"></div>
                <div class="col dv all"><span style='font-size:20px;'>&#9634;</span> Subject to ADA (when applicable)</div>
                <div class="w-100"></div>

                <div class="col-1 dv top right bottom"></div>
                <div class="col-3 dv all"></div>
                <div class="col dv all"><span style='font-size:20px;'>&#9746;</span> Supporting document complete</div>
                <div class="w-100"></div>

                <div class="col-1 dv top bottom right  bheight"></div>
                <div class="col dv all bheight">Bank Account:</div>
                <div class="col-5 dv top left right font-weight-bold text-center"><h5>00-0-00318-510-5</h5></div>
                <div class="col-2 dv all"></div>
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
                <div class="col-8 dv top left right text-center font-weight-bold text-uppercase">
                    <small><span v-if="dv_form.amount">***{{ dv_form.last_amount | num_words }} PESOS <span v-if="dv_form.cent">AND {{ dv_form.cent | num_words }} CENTAVOS</span> ONLY ***</span>
                </small></div>
                <div class="col dv all"></div>
            </div>
        </div>
        <div class="col-6 dv top bottom right text-center text-bold" style="text-indent: 110px;">BGHMC - MEDICINE FUND</div>
        <div class="col-6 dv top bottom text-center cheight">Amount in Words</div>
        <div class="w-100"></div>
        <div class="col-6 dv top bottom right">
            <div class="row">
                <div class="col-2 dv all gheight"></div>
                <div class="col dv top left right"></div>
                <div class="col-2 dv all"></div>
            </div>
        </div>
        <div class="col-6 dv top bottom">
            <div class="row">
                <div class="col-2 dv all gheight"></div>
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
                <div class="col-1 dv all"></div>
                <div class="col-10 dv all text-center font-weight-bold">RICARDO B. RUNEZ JR.,MD,FPCS,MHA,CESE</div>
                <div class="col-1 dv all"></div>
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

                <div class="col dv top bottom right gheight"></div>
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
                <div class="col dv all gheight"></div>
                <div class="w-100"></div>

                <div class="col dv all height"></div>
            </div>
        </div>
        <div class="col-8 dv top bottom left">
            <div class="row">
                <div class="col-auto dv top bottom font-weight-bold gheight">E</div>
                <div class="col dv all font-weight-bold he"><span>ACCOUNTING ENTRY:</span></div>
            </div>
        </div>
        <div class="col-4 top bottom left">
            <div class="row">
                <div class="col-12 dv top bottom left gheight"></div>
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
        
            </div>
        </div>
        <div class="col-2 dv top right">
            <div class="row">
                <div class="col dv all text-center font-weight-bold"></div>
            </div>
        </div>
        <div class="col-2 dv top right">
            <div class="row">
                <div class="col dv all text-center font-weight-bold">DEBIT</div>
            </div>
        </div>
        <div class="col-2 dv top">
            <div class="row">
                <div class="col dv all text-center font-weight-bold">CREDIT</div>
            </div>
        </div>

        
        <div class="col-6 dv top">
            <div class="row">
                <div class="col dv gheight all">
                    <span v-if="dv_form.payment_term_id == 1">ACCOUNTS PAYABLE</span>
                </div>
                <div class="w-100"></div>
                <div class="col dv gheight left bottom right" style="text-indent: 50px;">
                    <span>CASH IN BANK, LCCA</span>
                </div>
                <div class="w-100"></div>
                <div class="col dv gheight left bottom right" style="text-indent: 50px;">
                    <span>DUE TO BIR</span>
                </div>
                <div class="w-100"></div>
                <div class="col dv gheight left bottom right">
                    <span v-if="liquidated_damages.length">MISCELLANEOUS INCOME</span>
                </div>
                <div class="w-100"></div>
                <div class="col dv gheight left bottom right"></div>
            </div>
        </div>
        <div class="col-2 dv top left text-center">
            <div class="row">
                <div class="col dv gheight top all">
                    <span>
                        (2010101000)
                    </span>
                </div>
                <div class="w-100"></div>
                <div class="col dv gheight left bottom right">
                    <span>
                        (1010202016)
                    </span>
                </div>
                <div class="w-100"></div>
                <div class="col dv gheight left bottom right">
                    <span>
                        (2020101000)
                    </span>
                </div>
                <div class="w-100"></div>
                <div class="col dv gheight left bottom right">
                    <span v-if="dv_form.total_lqd">
                        (4060999000)
                    </span>
                </div>
                <div class="w-100"></div>
                <div class="col dv gheight left bottom right">
                    <span ></span>
                </div>
            </div>
        </div>
        <div class="col-2 dv top left">
            <div class="row">
                <div class="col dv gheight all text-right">
                    <span v-if="dv_form.payment_term_id == 1">
                        {{ dv_form.total_amount | currency }}
                    </span>
                </div>
                <div class="w-100"></div>
                <div class="col dv gheight left bottom right"></div>
                <div class="w-100"></div>
                <div class="col dv gheight left bottom right"></div>
                <div class="w-100"></div>
                <div class="col dv gheight left bottom right">
                    
                </div>
                <div class="w-100"></div>
                <div class="col dv gheight left bottom right"></div>
            </div>
        </div>
        <div class="col-2 dv top left">
            <div class="row">
                <div class="col dv gheight all"></div>
                <div class="w-100"></div>
                <div class="col dv gheight left bottom right text-right">
                    <span>{{ dv_form.last_amount | currency }}</span>
                </div>
                <div class="w-100"></div>
                <div class="col dv gheight left bottom right text-right">
                    <span>{{ dv_form.tax_vat_amount | currency }}</span>
                </div>
                <div class="w-100"></div>
                <div class="col dv gheight left bottom right text-right">
                    <span v-if="dv_form.total_lqd">{{ dv_form.total_lqd | currency }}</span>
                </div>
                <div class="w-100"></div>
                <div class="col dv gheight left bottom right"></div>
            </div>
        </div>
   
        <div class="col-6 dv top">
            <div class="row">
                <div class="col-6 dv all font-weight-bold">PREPARED BY:</div>
                <div class="col-6 dv all font-weight-bold">CHECKED BY:</div>
                <div class="w-100"></div>
                <div class="col gheight text-center font-weight-bold"></div>
                <div class="col gheight text-center font-weight-bold"></div>
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

        <div class="col-12 all">
            <div class="col text-center text-primary">THIS DOCUMENT IS GENERATED AT THE MATERIALS MANAGEMENT OFFICE
                (MMO)</div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col dv all font-weight-bold">1. Latest Delivery For Inspection</div>
                <div class="col dv top left right"></div>

                <div class="w-100"></div>
                <div class="col dv all font-weight-bold">2. Date / Time DV PRINTED </div>
                <div class="col dv top left right"></div>

                <div class="w-100"></div>
                <div class="col dv all font-weight-bold">3. Date Received - End User </div>
                <div class="col dv top left right"></div>

                <div class="w-100"></div>
                <div class="col dv all font-weight-bold">4. Date Received - Division Chief </div>
                <div class="col dv top left right"></div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col dv all font-weight-bold">5. Date Received - Accounting Office</div>
                <div class="col dv top left right"></div>

                <div class="w-100"></div>
                <div class="col dv all font-weight-bold">6. Date Received - FMO </div>
                <div class="col dv top left right"></div>

                <div class="w-100"></div>
                <div class="col dv all font-weight-bold">7. Date Received - MCC </div>
                <div class="col dv top left right"></div>

                <div class="w-100"></div>
                <div class="col dv all font-weight-bold">8. Date Received - Cash Office </div>
                <div class="col dv top left right"></div>
            </div>
        </div>

    </div>
</div>  
</template>

<script>
export default {
    data(){
        return{
            dv_form: new Form({
                total_amount: '',
                dmddesc: '',
                purchase_order_id: '',
                supplier_name: '',
                supplier_address: '',
                tin: '',
                tax_registration: '',
                tax_id: '',
                obrs_no: '',
                obrs_date: '',
                dv_id: '',
                total_lqd: '',
                amount: '',
                cent: '',
                last_amount: '',
                payment_term_id: '',
                vat_amount: '',
                tax_amount: '',
                type_multiplier: '',
                tax_vat_amount: '',
            }),
            liquidated_damages: [],
            attachments: [],
        }
        
    },
    methods:{

        
        get_liquidated_damages(){
            axios.get('../../api/get_liquidated_damages/'+this.$route.params.id).then(({data}) => {
                this.dv_form.liquidated_damages = data;
            }).catch(() => {

            });

        },

        get_dv_item(){
            axios.get('../../api/get_dv_item/'+this.$route.params.id).then(({data}) => {
                this.dv_form.fill(data);
            }).catch(() => {

            });
        },

        get_attachments(){

            axios.get('../../api/get_attachments/'+this.$route.params.id).then(({data}) => {
                this.dv_form.attachments = data;
            }).catch(() => {

            });

        },
        get_all(){

            axios.get('../../api/get_dv_item/'+this.$route.params.id).then(({data}) => {
                this.dv_form.fill(data);
            }).catch(() => {

            });

            axios.get('../../api/get_attachments/'+this.$route.params.id).then(({data}) => {
                this.attachments = data;
            }).catch(() => {

            });
            
            axios.get('../../api/get_liquidated_damages/'+this.$route.params.id).then(({data}) => {
                this.liquidated_damages = data;
            }).catch(() => {

            });
        }
    },
    created(){
        this.get_all();

        // this.get_dv_item();
        // this.get_attachments();
        // this.get_liquidated_damages();
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
    .jheight {
        height: 5px;
    }
    .hheight {
        height: 20px;
    }
    .gheight {
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