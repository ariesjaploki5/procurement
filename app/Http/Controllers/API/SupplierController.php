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

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
