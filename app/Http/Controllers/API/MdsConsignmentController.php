<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MdsConsignment;

class MdsConsignmentController extends Controller
{
    public function index(){
        $data = MdsConsignment::all();

        return response()->jsoN($data);
    }
}
