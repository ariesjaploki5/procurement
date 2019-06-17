<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Unit;

class UnitController extends Controller
{
    public function index(){
        $data = Unit::orderBy('unit_desc', 'asc')->get();

        return response()->json($data);
    }

    public function store(Request $request){
        $data = Unit::create([
            'budget' => $request->budget,
            'mode_id' => $request->mode_id,
            'quantity' => $request->quantity,
            'unit_id' => $request->unit_id,
        ]);

        return response()->json();
    }

    public function show($id){
        $data = Unit::findOrFaiL($id);

        return response()->json($data);
    }

    public function update(Request $request, $id){
        $data = Unit::findOrFail($id);
        $data->update([
            'budget' => $request->budget,
            'mode_id' => $request->mode_id,
            'quantity' => $request->quantity,
            'unit_id' => $request->unit_id,
        ]);

        return response()->json();
    }

    public function destroy($id){
        $data = Unit::where('unit_id', $id)->first()->delete();
        
        return response()->json();
    }
}
