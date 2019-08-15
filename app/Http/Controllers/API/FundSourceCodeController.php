<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FundSourceCode;

class FundSourceCodeController extends Controller
{
    
    public function index(){
        $data = FundSourceCode::orderBy('id', 'asc')
        ->select('id as fund_source_code_id', 'description', 'source', 'current_appropriations', 'continuing_appropraitons')
        ->get();

        return response()->json($data);
    }

}
