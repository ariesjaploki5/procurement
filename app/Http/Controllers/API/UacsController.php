<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Uacs;

class UacsController extends Controller
{
    public function index(){
        $data = Uacs::orderBy('id', 'asc')->get();

        return response()->json($data);
    }
}
