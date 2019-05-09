<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mode;

class ModeController extends Controller
{

    public function index(){
        $data = Mode::orderBy('mode_desc', 'asc')->get();

        return response()->json($data);
    }

    public function store(Request $request){
        

    }

    public function show($id){
        

    }

    public function update(Request $request, $id){

        
    }

    public function destroy($id){
        

    }
}
