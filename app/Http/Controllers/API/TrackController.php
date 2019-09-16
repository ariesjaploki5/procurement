<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class TrackController extends Controller
{
    
    public function index(){





    }

    public function store(Request $request){




    }

    public function show($id){

        $data = DB::table("dbo.fn_purchase_request_track($id)")
        ->orderBy('date_time', 'asc')
        ->get();


        return response()->json($data);
    }

    public function update(Request $request, $id){




    }

    public function destroy($id){




    }
}
