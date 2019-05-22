<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Views\HomisDrugsAndMedicines;
use App\Models\ItemHomisDrug;

class LinkController extends Controller
{
    public function index(){
        $data = Item::with([
            'item_homis_link'
        ])->get();

        return response()->json($data);
    }

    public function homis_drugs_and_medicines(){
        $data = HomisDrugsAndMedicines::orderBy('gendesc', 'asc')->get();
        return response()->json($data);
    }

    public function item_homis_link(Request $request, $id){
        $item_homis_drug = ItemHomisDrug::where('item_id', $id)->first();
        $item_homis_drug->update([
            'dmdctr' => $request->item_homis_link->dmdctr,
            'dmdcomb' => $request->item_homis_link->dmdcomb,
        ]);

        return response()->json($item_homis_drug);
    }
}
