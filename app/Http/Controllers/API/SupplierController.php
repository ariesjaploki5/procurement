<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supplier;

class SupplierController extends Controller
{

    public function index()
    {
        $data = Supplier::orderBy('supplier_name', 'asc')->get();

        return response()->json($data);
    }

    public function store(Request $request){
        $supplier = Supplier::firstOrCreate([
            'supplier_name' => $request->supplier_name,
            'supplier_address' => $request->supplier_address,
            'zip_code' => $request->zip_code,
            ''
        ]);
        
        return response()->json();
    }

    public function show($id){
        $data = Supplier::findOrFail($id);

        return response()->json($data);
    }

    public function update(Request $request, $id){
        $supplier = Supplier::findOrFail($id);
        $supplier->update([
            'supplier_name' => $request->supplier_name,
            'supllier_address' => $request->supplier_address,
        ]);

        return response()->json();
    }

    public function destroy($id){
        $supplier = Supplier::where('supplier_id', $id)->first();
        $supllier->delete();

        return response()->json();
    }
}
