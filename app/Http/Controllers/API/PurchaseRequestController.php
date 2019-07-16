<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchaseRequest;
use App\Models\DmdPurchaseRequest;
use App\Models\PurchaseOrder;
use Carbon\Carbon;
use App\Models\DmdPurchaseOrder;


class PurchaseRequestController extends Controller
{

    public function index(){
        $data = PurchaseRequest::with([
            'supplier', 'user', 'mode', 'rfq', 'purchase_request_remarks',
            'view_dmd_purchase_requests' => function($query){
                $query->with([
                    'dmd_price_schedule' => function($query){
                        $query->first();
                    },
                ]);
            },
        ])->orderBy('created_at', 'desc')->get();

        return response()->json($data);
    }

    public function for_pharmacy(){

    }

    public function for_pmo(){
        $data = PurchaseRequest::with([
            'supplier', 'user', 'mode', 'rfq', 'purchase_request_remarks',
            'view_dmd_purchase_requests' => function($query){
                $query->with([
                    'dmd_price_schedule' => function($query){
                        $query->first();
                    },
                ]);
            },
        ])
        ->whereNotNull('div_head_rcv')
        ->whereNotNull('div_head_rls')
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json($data);
    }

    public function new_for_pmo(){
        $data = PurchaseRequest::with([
            'supplier', 'user', 'mode', 'rfq', 'purchase_request_remarks',
            'view_dmd_purchase_requests' => function($query){
                $query->with([
                    'dmd_price_schedule' => function($query){
                        $query->first();
                    },
                ]);
            },
        ])
        ->where('created_at', '>=', Carbon::today())
        ->whereNotNull('div_head_rcv')
        ->whereNotNull('div_head_rls')
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json($data);
    }

    public function new(){

        $data = PurchaseRequest::with([
            'supplier', 'user', 'mode', 'rfq',
            'view_dmd_purchase_requests' => function($query){
                $query->with([
                    'dmd_price_schedule' => function($query){
                        $query->first();
                    },
                ]);
            },
        ])->where('created_at', '>=', Carbon::today())->orderBy('created_at', 'desc')->get();

        return response()->json($data);
    }

    public function public_bidding(){
        $data = PurchaseRequest::with([
            'supplier', 'user', 'mode', 
            'view_dmd_purchase_requests' => function($query){
                $query->with([
                    'dmd_price_schedule' => function($query){
                        $query->first();
                    },
                ]);
            },
        ])->where('mode_id', 1)->get();

        return response()->json($data);
    }

    public function shopping(){
        $data = PurchaseRequest::with([
            'supplier', 'user', 'mode', 
            'view_dmd_purchase_requests' => function($query){
                $query->with([
                    'dmd_price_schedule' => function($query){
                        $query->first();
                    },
                ]);
            },
        ])->where('mode_id', 4)->get();

        return response()->json($data);
    }

    public function store(Request $request){
        $item = $request->items;
        $count = count($item);

        for($i = 0; $i < $count; $i++){
            $dmd_id = $item[$i]['dmd_id'];
            $request_quantity = $item[$i]['quantity'];
            $supplier_id = $item[$i]['dmd_price_schedule']['supplier_id'];

            $pr = PurchaseRequest::firstOrCreate([
                'user_id' => $request->user_id,
                'supplier_id' => $supplier_id,
            ]);
            
            $pr->dmds()->attach($dmd_id, ['request_quantity' => $request_quantity]);
        }

        return response()->json();
    }

    public function store_public_bidding(Request $request){
        $item = $request->items;
        $count = count($item);

        for($i = 0; $i < $count; $i++){
            $dmd_id = $item[$i]['dmd_id'];
            $request_quantity = $item[$i]['quantity'];
            $supplier_id = $item[$i]['dmd_price_schedule']['supplier_id'];

            $pr = PurchaseRequest::firstOrCreate([
                'user_id' => $request->user_id,
                'supplier_id' => $supplier_id,
            ]);
            
            $pr->dmds()->attach($dmd_id, ['request_quantity' => $request_quantity]);
        }

        return response()->json();
    }

    public function store_shopping(Request $request){
        $item = $request->items;
        $count = count($item);

        for($i = 0; $i < $count; $i++){
            $dmd_id = $item[$i]['dmd_id'];
            $request_quantity = $item[$i]['quantity'];
            $supplier_id = $item[$i]['dmd_price_schedule']['supplier_id'];

            $pr = PurchaseRequest::firstOrCreate([
                'user_id' => $request->user_id,
                'supplier_id' => $supplier_id,
            ]);
            
            $pr->dmds()->attach($dmd_id, ['request_quantity' => $request_quantity]);
        }

        return response()->json();
    }

    public function item_purchase_request($pr, $item){
        
    }

    public function show($id){
        $data = PurchaseRequest::with([
            'supplier', 'user.employee', 'mode', 'rfq', 'purchase_request_remarks',
            'view_dmd_purchase_requests'=> function($query){
                $query->with([
                    'dmd_price_schedule', 'app_dmd'
                ]);
            },
        ])->where('purchase_request_id', $id)->first();

        return response()->json($data);
    }

    public function remove_dmd($id){
        
    }
    
    public function update(Request $request, $id){
        
        $dmd = $request->view_dmd_purchase_requests;
        $count = count($dmd);
        $pr = PurchaseRequest::findOrFail($id);
        $po = PurchaseOrder::create([
            'created_at' => $this->date_now()
        ]);
        $pr->update([
            'purchase_order_id' => $po->purchase_order_id,
        ]);
        for($i = 0; $i < $count; $i++){
            $dmd_pr = DmdPurchaseRequest::findOrFail($dmd[$i]['id']);
            $dmd_pr->update([
                'order_quantity' => $dmd[$i]['request_quantity'],
            ]);
        }
        return response()->json();
    }

    public function pr_to_po(Request $request, $id){
        
        $item = $request->view_dmd_purchase_requests;
        $count = count($item);
        $purchase_request_id = $request->purchase_request_id;
        
        $supplier_id = $item[0]['dmd_price_schedule']['supplier_id'];
        
        $po = PurchaseOrder::create([
            'supplier_id' => $supplier_id,
            'purchase_request_id' => $purchase_request_id,
        ]); 

        for($i = 0; $i < $count; $i++){
            $dmd_id = $item[$i]['dmd_id'];
            $quantity = $item[$i]['request_quantity'];
            
            $po->dmd_purchase_order()->create([
                'dmd_id' => $dmd_id,
                'quantity' => $quantity,
                'purchase_order_id' => $po->purchase_order_id,
            ]);
        }

        return response()->json();
    }

    public function aoq_to_po(){
        $item = $request->view_dmd_purchase_requests;
        $count = count($item);
        $purchase_request_id = $request->purchase_request_id;
        
        for($i = 0; $i < $count; $i++){
            $dmd_id = $item[$i]['dmd_id'];
            $quantity = $item[$i]['request_quantity'];
            $supplier_id = $item[$i]['dmd_price_schedule']['supplier_id'];

            $po = PurchaseOrder::create([
                'supplier_id' => $supplier_id,
            ]); 
            
            $po->dmd_purchase_order()->create([
                'dmd_id' => $dmd_id,
                'quantity' => $quantity,
                'purchase_order_id' => $po->purchase_order_id,
            ]);
        }

        return response()->json();
    }

    public function destroy($id){
        
        
    }

    public function approved($id){

        $pr = PurchaseRequest::findOrFail($id);

        $pr->update([
            'status' => 1
        ]);

        return response()->json();
    }

    public function date_now(){
        return Carbon::now();
    }

    public function send_to_cmps($id){

        $pr = PurchaseRequest::findOrFail($id);

        $pr->update([
            'send' => $this->date_now(),
            'current_status' => 'Send To CMPS',
        ]);

        return response()->json();
    }

    public function div_head_rcv($id){

        $pr = PurchaseRequest::findOrFail($id);

        $pr->update([
            'div_head_rcv' => $this->date_now(),
            'current_status' => 'Received From End User',
        ]);

        return response()->json();
    }

    public function div_head_rls($id){

        $pr = PurchaseRequest::findOrFail($id);

        $pr->update([
            'div_head_rls' => $this->date_now(),
            'current_status' => 'Release to PMO',
        ]);

        return response()->json();
    }

    public function pmo_rcv($id){

        $pr = PurchaseRequest::findOrFail($id);

        $pr->update([
            'pmo_rcv' => $this->date_now(),
            'current_status' => 'Received From CMPS'
        ]);

        return response()->json();
    }

    public function pmo_rls($id){

        $pr = PurchaseRequest::findOrFail($id);

        $pr->update([
            'pmo_rls' => $this->date_now(),
            'current_status' => 'Release To CMPS'
        ]);

        return response()->json();
    }

}
