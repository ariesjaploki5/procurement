<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Events\ItemCreated;
use App\Events\ItemUpdated;
use DB;


class ItemController extends Controller
{

    public function index(){
        $data = Item::all();
        
        return response()->json($data);
    }

    public function store(Request $request){
        $item = Item::create([
            'item_desc' => $request->item_desc,
            'category_id' => $request->category_id,
            'beginning_balance' => $request->beginning_balance,
            'unit_id' => $request->unit_id,
        ]);

        return response()->json($item);
    }

    public function show($id){
        

    }

    public function update(Request $request, $id){
        $item = Item::findOrFail($id);

        $item->update([
            'item_desc' => $request->item_desc,
            'category_id' => $request->category_id,
            'beginning_balance' => $request->beginning_balance,
            'unit_id' => $request->unit_id,
            'standard_stock_level' => $request->standard_stock_level,
        ]);

        broadcast(new ItemUpdated($item));
        
        return response()->json($item);

    }

    public function destroy($id){
        

    }

    public function search(Request $request, $id){
        $word = $request->word;
        $items = Item::where('category_id', $id)->where('item_desc', 'like', $word.'%')->get();

        return response()->json($items);
    }

    public function search_item_ppmp(Request $request, $id){

        $word = $request->word;
        $items = DB::select("SELECT * FROM procurement.dbo.view_item_item_ppmp where item_id_2 is null and item_desc LIKE '$word%'");
        return response()->json($items);
    }

    public function purchase_request($category_id, $mode_id){
        $data = Item::with([
            'app_item' => function($query){
                $query->where('mode_id', $mode_id);
            }
        ])->get();
    }
}
