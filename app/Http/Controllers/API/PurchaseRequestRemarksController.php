<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchaseRequestRemark;
use App\Models\PurchaseRequest;

class PurchaseRequestRemarksController extends Controller
{
    public function index(){
        
    }

    public function store(Request $request){

        $pr_id = $request->purchase_request_id; 
        $user_id = $request->user_id; 
        $remarks = $request->remarks;
        
        $remark = PurchaseRequestRemark::create([
            'user_id' => $user_id,
            'purchase_request_id' => $pr_id,
            'remarks' => $remarks
        ]);

        $remark->purchase_request()->update([
            'status' => 2
        ]);

        return response()->json();
    }

    public function show($id){
    
    }

    public function update(Request $request, $id){
        
        $remark = PurchaseRequestRemark::findOrFail($id);
        $remark->update([
            'viewed' => 1
        ]);

        return response()->json();
    }

    public function destroy($id){

        return response()->json();
    }
}
