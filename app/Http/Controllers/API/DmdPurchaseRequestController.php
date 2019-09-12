<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DmdPurchaseRequest;
use App\Models\PurchaseRequest;
use App\Models\Cart;
use Carbon\Carbon;

class DmdPurchaseRequestController extends Controller
{
    public function index(){


    }

    public function terminate($id){

        $dmd = DmdPurchaseRequest::findOrFail($id);
        $dmd->update([
            'terminated' => 1,
        ]);

        return response()->json($id);
    }

    public function receive(Request $request, $id){

        $dmd = DmdPurchaseRequest::findOrFail($id);
        $dmd->update([
            'received_quantity' => $request->received_quantity,
            'terminated' => 2,
        ]);

        return response()->json($id);
    }

    public function store(Request $request){

        // $month = Carbon::now()->format('YmdH')->month;
        // $year = Carbon::now()->format('YmdH')->year;

        $year_month = Carbon::now()->format('Y-m');

        $dmd = $request->items;
        $count = count($dmd);

        $cart = Cart::where('status', 0)->where('mode_id', 1)->first();
        

        for($i = 0; $i < $count; $i++){

            $dmd_id = $dmd[$i]['dmd_id'];
            $quantity = $dmd[$i]['item_needed'];
            $supplier_id = $dmd[$i]['supplier_id'];
            $ep = $dmd[$i]['ep'];

            $cost = $dmd[$i]['cost'];

            $pr = PurchaseRequest::firstOrCreate([
                'mode_id' => $request->mode_id,
                'supplier_id' => $supplier_id,
                'category_id' => $request->category_id,
                'user_id' => $request->user_id,
                'status' => 0,
                'purpose' => $request->purpose,
                'cart_id' => $cart->id,
                'ep' =>  $ep,
            ]);

            
            if(!$pr->pr_id){
                $zero_id = sprintf("%04d", $pr->purchase_request_id);
                
                $pr->pr_id = $year_month.'-'.$zero_id;
                $pr->save();
            }

            $pr->dmd_purchase_requests()->create([
                'dmd_id' => $dmd_id,
                'request_quantity' => $quantity,
                'cost_price' => $cost,
            ]);

            $pr->purchase_request_statuses()->create([
                'current_status_id' => 1
            ]);
        }

        $cart->update([
            'status' => 1
        ]);  

        return response()->json();
    }

    public function shopping(Request $request){

        $year_month = Carbon::now()->format('Y-m');

        $dmd = $request->items;
        $count = count($dmd);

        $cart = Cart::where('status', 0)->where('mode_id', 4)->first();

        for($i = 0; $i < $count; $i++){

            $ep = $dmd[$i]['ep'];

            $pr = PurchaseRequest::create([
                'mode_id' => $request->mode_id,
                'category_id' => $request->category_id,
                'user_id' => $request->user_id, 
                'status' => 0,
                'purpose' => $request->purpose,
                'cart_id' => $cart->id,
                'ep' => $ep
            ]);
    
            if(!$pr->pr_id){
                $zero_id = sprintf("%04d", $pr->purchase_request_id);
                $pr->pr_id = $year_month.'-'.$zero_id;
                $pr->save();
            }

            $dmd_id = $dmd[$i]['dmd_id'];
            $quantity = $dmd[$i]['item_needed'];
            $cost = $dmd[$i]['cost'];
            
            $pr->dmd_purchase_requests()->create([
                'dmd_id' => $dmd_id,
                'request_quantity' => $quantity,
                'cost_price' => $cost,
            ]);

            $pr->purchase_request_statuses()->create([
                'current_status_id' => 1
            ]);
        }

        $cart->update([
            'status' => 1
        ]);  

        return response()->json();
    }

    public function rfq(Request $request){
        
        $dmd = $request->items;
        $count = count($dmd);
        $cart_id = $dmd[0]['cart_id'];

        $cart = Cart::findOrFail($cart_id);

        $rfq = RequestForQuotation::create([
            'category_id' => $request->category_id,
            'user_id' => $request->user_id, 
        ]);

        $pr = PurchaseRequest::create([
            'mode_id' => $request->mode_id,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id, 
            'status' => 0,
            'purpose' => $request->purpose,
        ]);

        for($i = 0; $i < $count; $i++){

            $dmd_id = $dmd[$i]['dmd_id'];
            $quantity = $dmd[$i]['quantity'];

            $pr->dmd_purchase_requests()->create([
                'dmd_id' => $dmd_id,
                'request_quantity' => $quantity,
            ]);
        }

        $cart->update([
            'status' => 1
        ]);  

        return response()->json();
    }

    public function show($id){
        $data = DmdPurchaseRequest::where('purchase_request_id', $id)->get();

        return response()->json($data);
    }

    public function update(Request $request, $id){


    }

    public function destroy($id){
        $dmd = DmdPurchaseRequest::where('id', $id)->first();
        $dmd->delete();
        return response()->json();
    }


}
