<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NoticeOfAdjustment;
use DB;
use Carbon\Carbon;
use App\Models\PurchaseOrder;

class NoticeOfAdjustmentController extends Controller
{
    public function index(){

    }

    public function store(Request $request){

        if($request->adjust_ors_burs_no == false){
            $adjust_ors_burs_no = 0;
        } else {
            $adjust_ors_burs_no = 1;
        }

        if($request->ors == false) {
            $ors = 0;
        } else {
            $ors = 1;
        }

        if($request->burs == false) {
            $burs = 0;
        } else {
            $burs = 1;
        }

        if($request->amount_to_p == false) {
            $amount_to_p = 0;
        } else {
            $amount_to_p = 1;
        }

        $noa = NoticeOfAdjustment::create([
            'purchase_order_id' => $request->purchase_order_id,
            'ors' => $ors,
            'burs' => $burs,
            'amount_to_p' => $amount_to_p,

            'adjust_ors_burs_no' => $adjust_ors_burs_no,
            'resp_center_to' => $request->resp_center_to,
            
            'particulars_to' => $request->particulars_to,
            'mfo_pap_to' => $request->mfo_pap_to,
            'account_code_to' => $request->account_code_to,
            'adjust_raod' => $request->adjust_raod,
            'remarks' => $request->remarks
        ]);
        
        $po = PurchaseOrder::findOrFail($noa->purchase_order_id);

        $po->update([
            'updated_at' => Carbon::now(),
        ]);

        return response()->json();
    }

    public function show($id){
        $data = DB::table('fn_po_noa()')->where('purchase_order_id', $id)->first();

        return response()->json($data);
    }
}
