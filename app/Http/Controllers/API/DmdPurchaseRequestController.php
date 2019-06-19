<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DmdPurchaseRequest;
use App\Models\PurchaseRequest;
use App\Models\Cart;

class DmdPurchaseRequestController extends Controller
{
    public function index(){


    }

    public function store(Request $request){
        $dmd = $request->items;
        $count = count($dmd);
        $cart_id = $dmd[0]['cart_id'];

        $cart = Cart::findOrFail($cart_id);
        $cart->update([
            'status' => 1
        ]);  

        for($i = 0; $i < $count; $i++){

            $dmd_id = $dmd[$i]['dmd_id'];
            $quantity = $dmd[$i]['quantity'];
            $supplier_id = $dmd[$i]['dmd_price_schedule']['supplier_id'];

            $pr = PurchaseRequest::firstOrCreate([
                'mode_id' => $request->mode_id,
                'supplier_id' => $supplier_id,
                'category_id' => $request->category_id,
                'user_id' => $request->user_id, 
                'status' => 0,
                'purpose' => $request->purpose,
            ]);

            $pr->dmd_purchase_requests()->create([
                'dmd_id' => $dmd_id,
                'request_quantity' => $quantity,
            ]);
            
        }

        return response()->json();

    }

    public function shopping(Request $request){
        $dmd = $request->items;
        $count = count($dmd);
        $cart_id = $dmd[0]['cart_id'];

        $cart = Cart::findOrFail($cart_id);

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
