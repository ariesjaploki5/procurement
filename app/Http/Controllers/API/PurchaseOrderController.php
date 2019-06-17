<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\PurchaseRequest;

class PurchaseOrderController extends Controller
{

    public function index(){
        $data = PurchaseOrder::with([
            'purchase_request' => function ($query){
                $query->with([
                    'view_dmd_purchase_requests.dmd_price_schedule', 
                    'supplier', 
                    'mode'
                    ]);
            }
        ])->get();

        return response()->json($data);
    }

    public function receive_order(Request $request, $id){
        $pr = PurchaseRequest::where('purchase_order_id', $id)->first();
        $pr->update([
            'received_quantity' => $received_quantity,
        ]);

        return response()->json($pr);
    }

    public function store_update_obrs(Request $request){
        $po = PurchaseOrder::findOrFail($request->purchase_order_id);
        $po->update([
            'allotment_id' => $request->allotment_id,
            'uacs_id' => $request->uacs_id,
            'fund_source_id' => $request->fund_source_id,
            'amount' => $request->amount,
        ]);

        return response()->json($po);
    }

    public function for_pmo(){
        $data = PurchaseOrder::with([
            'purchase_request' => function ($query){
                $query->with(['view_dmd_purchase_requests']);
            }
        ])->get();

        return response()->json($data);
    }

    public function for_div_heads(){
        $data = PurchaseOrder::with([
            'purchase_request' => function ($query){
                $query->with(['view_dmd_purchase_requests']);
            }
        ])->get();

        return response()->json($data);
    }

    public function for_budget(){
        $data = PurchaseOrder::with([
            'purchase_request' => function ($query){
                $query->with(['view_dmd_purchase_requests']);
            }
        ])->get();

        return response()->json($data);
    }

    public function for_accounting(){
        $data = PurchaseOrder::with([
            'purchase_request' => function ($query){
                $query->with(['view_dmd_purchase_requests']);
            }
        ])->get();

        return response()->json($data);
    }

    public function for_fmo(){
        $data = PurchaseOrder::with([
            'purchase_request' => function ($query){
                $query->with(['view_dmd_purchase_requests']);
            }
        ])->get();

        return response()->json($data);
    }

    public function for_mmo(){
        $data = PurchaseOrder::with([
            'purchase_request' => function ($query){
                $query->with(['view_dmd_purchase_requests']);
            }
        ])->get();

        return response()->json($data);
    }

    public function store(Request $request){
        

    }

    public function show($id){
        $data = PurchaseOrder::with([
            'purchase_request' => function ($query){
                $query->with([
                    'view_dmd_purchase_requests.dmd_price_schedule', 
                    'supplier', 
                    'mode'
                    ]);
            }
        ])->where('purchase_order_id', $id)->first();

        return response()->json($data);
    }

    public function update(Request $request, $id){
        

    }

    public function destroy($id){
        

    }

    public function pmo_rcv_2($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'pmo_rcv_2' => $this->date_now()
        ]);
        return response()->json();
    }
    public function pmo_rls_2($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'pmo_rls_2' => $this->date_now()
        ]);
        return response()->json();
    }

    public function budget_rcv($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'budget_rcv' => $this->date_now()
        ]);
        return response()->json();
    }
    public function budget_rls($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'budget_rls' => $this->date_now()
        ]);
        return response()->json();
    }
    public function accounting_rcv($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'accounting_rcv' => $this->date_now()
        ]);
        return response()->json();
    }
    public function accounting_rls($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'accounting_rls' => $this->date_now()
        ]);
        return response()->json();
    }
    public function mcc_rcv($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'mcc_rcv' => $this->date_now()
        ]);
        return response()->json();
    }
    public function mcc_rls($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'mcc_rls' => $this->date_now()
        ]);
        return response()->json();
    }

    public function fmo_rcv($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'fmo_rcv' => $this->date_now()
        ]);
        return response()->json();
    }
    public function fmo_rls($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'fmo_rls' => $this->date_now()
        ]);
        return response()->json();
    }
    public function pmo_rcv_3($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'pmo_rcv_3' => $this->date_now()
        ]);
        return response()->json();
    }
    public function pmo_rls_3($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'pmo_rls_3' => $this->date_now()
        ]);
        return response()->json();
    }

    public function mmo_rcv($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'mmo_rcv' => $this->date_now()
        ]);
        return response()->json();
    }
    public function mmo_rls($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'mmo_rls' => $this->date_now()
        ]);
        return response()->json();
    }
}
