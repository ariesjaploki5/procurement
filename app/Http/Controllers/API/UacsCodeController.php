<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UacsCode;

class UacsCodeController extends Controller
{
    public function index(){
        $data = UacsCode::orderBy('uacs_desc', 'asc')
        ->select('id as uacs_code_id', 'uacs_desc')
        ->get();

        return response()->json($data);
    }


}
