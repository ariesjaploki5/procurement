<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ppmp;

class PpmpController extends Controller
{

    public function index(){

        $data = Ppmp::orderBy('ppmp_year', 'asc')->get();

        return response()->json($data);
    }

    public function store(Request $request){
        $ppmp = Ppmp::create([
            'ppmp_year' => $request->ppmp_year,
            'category_id' => $request->category_id,
        ]);
        
    }

    public function show($id){
        

    }

    public function update(Request $request, $id){
        

    }

    public function destroy($id){

        
    }
}
