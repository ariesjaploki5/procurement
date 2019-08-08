<?php

namespace App\Http\Controllers\APi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentTerm;

class PaymentTermController extends Controller
{
    public function index(){
        $data = PaymentTerm::all();

        return response()->json($data);
    }
}
