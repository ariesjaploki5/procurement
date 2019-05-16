<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;

class InventoryController extends Controller
{

    public function index($id){
        $data = Item::with([
            'item_homis_link' => function ($query){
                $query->with([
                    'end_users', 'balance_on_hand',
                ]);
            }
        ])->where('category_id', $id)->orderBy('item_desc', 'asc')->get();

        return response()->json($data);
    }

    public function store(Request $request){
        

    }

    public function show($id){
        

    }

    public function update(Request $request, $id){
        $item = Item::findOrFail($id);
        $item->update([
            'standard_stock_level' => $request->standard_stock_level,
        ]);

        return response()->json($item);
    }

    public function destroy($id){
        
        
    }

}
