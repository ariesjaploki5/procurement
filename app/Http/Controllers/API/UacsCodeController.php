<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UacsCode;

class UacsCodeController extends Controller
{
    public function index(){
        $data = UacsCode::orderBy('uacs_desc', 'asc')->get();

        return response()->json($data);
    }


}
