<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DvCurrentStatus;
use App\Models\PurchaseOrder;

class DvCurrentStatusController extends Controller
{
    
    public function end_user_rcv($id){
        $po = PurchaseOrder::findOrFail($id);
        $po_id = $po->po_id;

        $dv_current_status = DvCurrentStatus::create([
            'po_id' => $po_id,
            'purchase_order_id' => $id,
            'current_status_id' => 27
        ]);

        return response()->json();
    }

    public function end_user_rls($id){
        $po = PurchaseOrder::findOrFail($id);
        $po_id = $po->po_id;

        $dv_current_status = DvCurrentStatus::create([
            'po_id' => $po_id,
            'purchase_order_id' => $id,
            'current_status_id' => 28
        ]);

        return response()->json();
    }

    public function div_chief_rcv($id){

        $po = PurchaseOrder::findOrFail($id);
        $po_id = $po->po_id;

        $dv_current_status = DvCurrentStatus::create([
            'po_id' => $po_id,
            'purchase_order_id' => $id,
            'current_status_id' => 29
        ]);

        return response()->json();

    }

    public function div_chief_rls($id){

        $po = PurchaseOrder::findOrFail($id);
        $po_id = $po->po_id;

        $dv_current_status = DvCurrentStatus::create([
            'po_id' => $po_id,
            'purchase_order_id' => $id,
            'current_status_id' => 30
        ]);

        return response()->json();

    }

    public function accounting_rcv($id){

        $po = PurchaseOrder::findOrFail($id);
        $po_id = $po->po_id;

        $dv_current_status = DvCurrentStatus::create([
            'po_id' => $po_id,
            'purchase_order_id' => $id,
            'current_status_id' => 31
        ]);

        return response()->json();

    }

    public function accounting_rls($id){

        $po = PurchaseOrder::findOrFail($id);
        $po_id = $po->po_id;

        $dv_current_status = DvCurrentStatus::create([
            'po_id' => $po_id,
            'purchase_order_id' => $id,
            'current_status_id' => 32
        ]);

        return response()->json();

    }

    public function fmo_rcv($id){

        $po = PurchaseOrder::findOrFail($id);
        $po_id = $po->po_id;

        $dv_current_status = DvCurrentStatus::create([
            'po_id' => $po_id,
            'purchase_order_id' => $id,
            'current_status_id' => 33
        ]);

        return response()->json();

    }

    public function fmo_rls($id){

        $po = PurchaseOrder::findOrFail($id);
        $po_id = $po->po_id;

        $dv_current_status = DvCurrentStatus::create([
            'po_id' => $po_id,
            'purchase_order_id' => $id,
            'current_status_id' => 34
        ]);

        return response()->json();

    }

    public function mcc_rcv($id){

        $po = PurchaseOrder::findOrFail($id);
        $po_id = $po->po_id;

        $dv_current_status = DvCurrentStatus::create([
            'po_id' => $po_id,
            'purchase_order_id' => $id,
            'current_status_id' => 35
        ]);

        return response()->json();

    }

    public function mcc_rls($id){

        $po = PurchaseOrder::findOrFail($id);
        $po_id = $po->po_id;

        $dv_current_status = DvCurrentStatus::create([
            'po_id' => $po_id,
            'purchase_order_id' => $id,
            'current_status_id' => 36
        ]);

        return response()->json();

    }

    public function cash_office_rcv($id){

        $po = PurchaseOrder::findOrFail($id);
        $po_id = $po->po_id;

        $dv_current_status = DvCurrentStatus::create([
            'po_id' => $po_id,
            'purchase_order_id' => $id,
            'current_status_id' => 37
        ]);

    }

    public function cash_office_rls($id){

        $po = PurchaseOrder::findOrFail($id);
        $po_id = $po->po_id;

        $dv_current_status = DvCurrentStatus::create([
            'po_id' => $po_id,
            'purchase_order_id' => $id,
            'current_status_id' => 38
        ]);

    }

    public function index(){
        

    }

    public function store(Request $request){



    }

    public function update(Request $request, $id){



    }

    public function show($id){



    }

    public function destroy($id){



    }

}
