<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\DmdPurchaseRequest;

class DmdPurchaseOrderController extends Controller
{

    public function index(){


    }

    public function store(Request $request){
        $item = $request->items;
        $count = count($item);
        
        for($i = 0; $i < $count; $i++){
            $dpr_id = $item[$i][''];
            $po = PurchaseOrder::create([
                'supplier_id' => $request->supplier_id,
            ]);
    
            $dmd_pr = DmdPurchaseRequest::findOrFail($dpr_id);
        }
        return response()->json();
    }

    public function show($id){


    }

    public function update(Request $request, $id){
        
        $dmd_po = DmdPurchaseOrder::findOrFail($id);
        
        $dmd_po->update([
            'order_quantity' => $request->order_quantity,
        ]);

        return response()->json();
    }

    public function change_po($id){

        $dmd_po = DmdPurchaseOrder::findOrFail($id);
        $purchase_request_id = $dmd_po->purchase_order->purchase_request_id;
        $pr_id = $dmd_po->purchase_order->pr_id;
        
        $po = PurchaseOrder::count();

        $new_po = PurchaseOrder::create([
            'po_id' => $new_po
        ]);

        $dmd_po->update([
            'po_id' => $new_po->po_id,
            
        ]);

    }

    public function destroy($id){


    }



}
