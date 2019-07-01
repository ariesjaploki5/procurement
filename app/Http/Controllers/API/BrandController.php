<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;

class BrandController extends Controller{

    public function index(){
        $data = Brand::orderBy('brand_desc', 'asc')->get();

        return response()->json($data);
    }

    public function store(Request $request){
        $brand = Brand::create([
            'brand_desc' => $request->brand_desc,
        ]);

        return response()->json($brand);
    }

    public function show($id){
        $brand = Brand::findOrFail($id);

        return response()->json($brand);
    }

    public function update(Request $request, $id){
        $brand = Brand::findOrFail($id);
        $brand->update([
            'brand_desc' => $request->brand_desc,
        ]);
        
        return response()->json($brand);
    }

    public function destroy($id){
        $brand = Brand::where('brand_id', $id)->first();
        $brand->delete();

        return response()->json($brand);
    }
}
