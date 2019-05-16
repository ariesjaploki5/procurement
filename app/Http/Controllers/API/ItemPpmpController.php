<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemPpmp;

class ItemPpmpController extends Controller
{
    public function index(){


    }

    public function store(Request $request){
        $it_ppmp = ItemPpmp::create([
            'ppmp_id' => $request->ppmp_id,
            'item_id' => $request->item_id,
        ]);
        
        return response()->json($it_ppmp);
    }

    public function show($id){
        $item_ppmp = ItemPpmp::with([
            'item'
        ])->where('ppmp_id', $id)->get();

        return response()->json($item_ppmp);
    }
    

    public function update(Request $request, $id){


    }

    public function destroy($id){


    }
}
