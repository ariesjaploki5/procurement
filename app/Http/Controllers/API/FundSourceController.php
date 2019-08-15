<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FundSource;

class FundSourceController extends Controller
{
    public function index(){
        $data = FundSource::orderBy('id', 'asc')
        ->select('id as fund_source_id', 'description', 'acronym')
        ->get();

        return response()->json($data);
    }
}
