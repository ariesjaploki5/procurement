<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DmdRemark;

class DmdRemarksController extends Controller
{
    public function index(){

    
    }

    public function store(Request $request){

        $remark = DmdRemark::create([
            'user_id' => $request->user_id,
            'dmd_id' => $request->dmd_id,
            'remarks' => $request->remarks,
        ]);

        return response()->json();
    }

    public function show($id){
    

    }

    public function update(Request $request, $id){
        
        $remark = DmdRemark::findOrFail($id);
        $remark->update([
            'viewed' => 1
        ]);

        return response()->json();
    }

    public function destroy($id){

        return response()->json();
    }
}
