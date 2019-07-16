<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\DmdPurchaseRequest;

class DmdPurchaseOrderController extends Controller
{

    public function index(){


    }

    public function store(Request $request){
        $item = $request->items;
        $count = count($item);
        
        for($i = 0; $i < $count; $i++){
            $dpr_id = $item[$i][''];
            $po = PurchaseOrder::create([
                'supplier_id' => $request->supplier_id,
            ]);
    
            $dmd_pr = DmdPurchaseRequest::findOrFail($dpr_id);
        }
        return response()->json();
    }

    public function show($id){


    }

    public function update(Request $request, $id){


    }

    public function destroy($id){


    }

}
