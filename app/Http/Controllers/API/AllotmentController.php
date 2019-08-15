<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Allotment;

class AllotmentController extends Controller
{

    public function index(){
        $data = Allotment::orderBy('allotment_id', 'asc')->get();

        return response()->json($data);
    }
    
}
