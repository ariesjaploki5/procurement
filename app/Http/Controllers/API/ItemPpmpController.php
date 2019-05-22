<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemPpmp;
use App\Models\Ppmp;

class ItemPpmpController extends Controller
{
    public function index(){


    }

    public function store(Request $request){
        $item_ppmp = ItemPpmp::create([
            'ppmp_id' => $request->ppmp_id,
            'item_id' => $request->item_id,
        ]);
        
        return response()->json($item_ppmp);
    }

    public function show($id){
        $item_ppmp = ItemPpmp::with([
            'item'
        ])->where('ppmp_id', $id)->get();

        return response()->json($item_ppmp);
    }
    

    public function update(Request $request, $id){

        
        $item = $request->items;

        $count = count($item);
        
        for($i = 0; $i < $count; $i++){
            $item_ppmp = ItemPpmp::findOrFail($item[$i]['item_ppmp_id']);
            
            $item_ppmp->update([
                'budget' => $item[$i]['budget'], 'mode_id' => $item[$i]['mode_id'],
                'jan' => $item[$i]['jan'], 'feb' => $item[$i]['feb'], 'mar' => $item[$i]['mar'],
                'apr' => $item[$i]['apr'], 'may' => $item[$i]['may'], 'june' => $item[$i]['june'],
                'july' => $item[$i]['july'], 'aug' => $item[$i]['aug'], 'sept' => $item[$i]['sept'],
                'oct' => $item[$i]['oct'], 'nov' => $item[$i]['nov'], 'dec' => $item[$i]['dec'],
            ]);
        }
        
        return response()->json();
    }

    public function destroy($id){


    }
}
