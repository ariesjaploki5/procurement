<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchaseRequest;

class PurchaseRequestController extends Controller
{

    public function index(){
        $data = PurchaseRequest::with([
            'supplier', 'user'
        ])->get();

        return response()->json($data);
    }

    public function store(Request $request){
        $pr = PurchaseRequest::create([
            'user_id' => $request->user_id,
            'supplier_id' => $request->supplier_id,
        ]);
    }

    public function many($request){

    }

    public function show($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
