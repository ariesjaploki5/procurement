<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Packaging;

class PackagingController extends Controller
{

    public function index(){
        $data = Packaging::orderBy('packaging_desc', 'asc')->get();

        return response()->json($data);
    }

    public function store(Request $request){
        $packaging = Packaging::create([
            'packaging_desc' => $request->packaging_desc,
        ]);

        return response()->json($packaging);
    }

    public function show($id){
        

    }

    public function update(Request $request, $id){
        $packaging = Packaging::findOrFail($id);
        $packaging->update([
            'packaging_desc' => $request->packaging_desc,
        ]);
        
        return response()->json($packaging);
    }

    public function destroy($id){
        $packaging = Packaging::where('packaging_id', $id)->first();
        $packaging->delete();

        return response()->json($packaging);
    }
}
