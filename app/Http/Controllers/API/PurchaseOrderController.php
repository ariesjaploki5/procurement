<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\PurchaseRequest;
use App\Models\DmdPurchaseRequest;
use DB;

use Carbon\Carbon;

class PurchaseOrderController extends Controller
{

    public function index(){
        $data = PurchaseOrder::with([
            'allotment', 'fund_source', 'uacs',
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

    public function received_dmd(Request $request){
        $dmd = $request->items;
        
        $count = count($dmd);
        

        for($i = 0; $i < $count; $i++){

            $received_quantity = $dmd[$i]['received_quantity'];
            $dmdcomb = $dmd[$i]['dmdcomb'];
            $dmdctr = $dmd[$i]['dmdctr'];
            $id = $dmd[$i]['id'];

            $dmd_pr = DmdPurchaseRequest::findOrFail($id);
            $dmd_pr->update([
                'received_quantity' => $received_quantity,
            ]);


            $check = DB::SELECT("SELECT * FROM hospital.dbo.hdmhdrsub WHERE dmhdrsub = 'DRUM4' AND dmdcomb = $dmdcomb AND dmdctr = $dmdctr");
            $count_check = count($check);

            if($count_check > 0){
                DB::table('hospital.dbo.hdmhdrsub')->where('dmdcomb', $dmdcomb)
                ->where('dmdctr', $dmdctr)->where('dmhdrsub', 'DRUM4')
                ->update(['stockbal' + $received_quantity]);
                
            } else{
                DB::table('hospital.dbo.hdmhdrsub')->insert([
                    'dmdcomb' => $dmdcomb, 
                    'dmdctr' => $dmdctr, 
                    'dmhdrsub' => 'DRUM4', 
                    'statusMed' => 'A',
                    'stockbal' => $received_quantity]);
            }
        
        }

        return response()->json();
    }

    public function store_date_of_delivery(Request $request){
        $po = PurchaseOrder::findOrFail($request->purchase_order_id);
        $po->update([
            'date_of_delivery' => $request->date_of_delivery,
        ]);

        return response()->json();
    }

    public function store_update_obrs(Request $request){
        $date = Carbon::now();

        $po = PurchaseOrder::findOrFail($request->purchase_order_id);
        $po->update([
            'allotment_id' => $request->allotment_id,
            'uacs_id' => $request->uacs_id,
            'fund_source_id' => $request->fund_source_id,
            'amount' => $request->amount,
            'obrs_date' => $date,
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
            'allotment', 'fund_source', 'uacs',
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
            'pmo_rcv_2' => $this->date_now(),
            'current_status' => 'Received by PMO'
        ]);
        return response()->json();
    }
    public function pmo_rls_2($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'pmo_rls_2' => $this->date_now(),
            'current_status' => 'Release by PMO'
        ]);


        return response()->json();
    }

    public function budget_rcv($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'budget_rcv' => $this->date_now(),
            'current_status' => 'Received by Budget'
        ]);
        return response()->json();
    }
    public function budget_rls($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'budget_rls' => $this->date_now(),
            'current_status' => 'Release by Budget'
        ]);
        return response()->json();
    }
    public function accounting_rcv($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'accounting_rcv' => $this->date_now(),
            'current_status' => 'Received by Accounting'
        ]);
        return response()->json();
    }
    public function accounting_rls($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'accounting_rls' => $this->date_now(),
            'current_status' => 'Release by Accounting'
        ]);
        return response()->json();
    }
    public function mcc_rcv($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'mcc_rcv' => $this->date_now(),
            'current_status' => 'Received by MCC'
        ]);
        return response()->json();
    }
    public function mcc_rls($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'mcc_rls' => $this->date_now(),
            'current_status' => 'Release by MCC'
        ]);
        return response()->json();
    }

    public function fmo_rcv($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'fmo_rcv' => $this->date_now(),
            'current_status' => 'Received by FMO'
        ]);
        return response()->json();
    }
    public function fmo_rls($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'fmo_rls' => $this->date_now(),
            'current_status' => 'Release by FMO'
        ]);
        return response()->json();
    }
    public function pmo_rcv_3($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'pmo_rcv_3' => $this->date_now(),
            'current_status' => 'Received by PMO'
        ]);
        return response()->json();
    }
    public function pmo_rls_3($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'pmo_rls_3' => $this->date_now(),
            'current_status' => 'Release by PMO'
        ]);
        return response()->json();
    }

    public function mmo_rcv($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'mmo_rcv' => $this->date_now(),
            'current_status' => 'Received by MMO'
        ]);
        return response()->json();
    }
    public function mmo_rls($id){
        $pr = PurchaseRequest::findOrFail($id);
        $pr->update([
            'mmo_rls' => $this->date_now(),
            'current_status' => 'Release by MMO'
        ]);
        return response()->json();
    }
}
