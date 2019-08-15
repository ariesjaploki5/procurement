<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FundCluster;

class FundClusterController extends Controller
{
    
    public function index(){
        $data = FundCluster::orderBy('fund_cluster_desc', 'asc')
        ->select('id as fund_cluster_id', 'fund_cluster_desc', 'fund_cluster_code')
        ->get();

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
