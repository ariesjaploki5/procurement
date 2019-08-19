<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StockRequest;

class StockRequestController extends Controller
{
    public function index(){

        $data = StockRequest::all();

        return response()->json($data);

    }

    public function store(Request $request){
        
        $sr = StockRequest::create([
            'requested_quantity' => $request->requested_quantity,
            'dmd_id' => $request->dmd_id,
            'user_id' => $request->user_id,
        ]);


        return response()->json();
    }

    public function update(Request $request, $id){
        $sr = StockRequest::findOrFail($id);
        $sr->update([
            'requested_quantity' => $request->requested_quantity,
            'dmd_id' => $request->dmd_id,
            'user_id' => $request->user_id,
        ]);

        return response()->json();
    }
    
    public function show($id){


    }

    public function destroy($id){
        $sr = StockRequest::findOrFail($id);
        $sr->delete();

        return response()->json();
        

    }
}
