<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchaseRequest;

class PurchaseRequestController extends Controller
{

    public function index(){
        $data = PurchaseRequest::with([
            'supplier', 'user', 'mode'
        ])->get();

        return response()->json($data);
    }

    public function store(Request $request){
        $item = $request->items;

        $pr = PurchaseRequest::create([
            'user_id' => $request->user_id,
            'supplier_id' => $request->supplier_id,
        ]);
        
        $this->item_purchase_request($pr, $item);
    }

    public function item_purchase_request($pr, $item){
        $count = count($item);

        for($i = 0; $i < $count; $i++){
            $item_id = $item[$i]['item_id'];
            $request_quantity = $item[$i]['quantity'];
            $pr->items()->attach($item_id, ['request_quantity' => $request_quantity]);
        }

        return response()->json();
    }

    public function show($id){
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
