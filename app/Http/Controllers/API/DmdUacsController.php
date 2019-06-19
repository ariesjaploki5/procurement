<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DmdUacs;

class DmdUacsController extends Controller
{
    public function index(){

    }

    public function store(Request $request){
        
        $uacs = DmdUacs::firstOrCreate([
            'dmd_id' => $request->dmd_id,
            'code' => $request->code,
            'brand_id' => $request->brand_id,
        ]);

        return response()->json();
    }

    public function update(Request $request, $id){

        $uacs = DmdUacs::findOrFail($id);

        $uacs->update([
            'dmd_id' => $request->dmd_id,
            'code' => $request->code,
            'brand_id' => $request->brand_id,
        ]);

        return response()->json();
    }
}
