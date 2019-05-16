<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ppmp;
use App\Models\Item;
use App\Events\PpmpCreated;
use App\Events\PpmpUpdated;

class PpmpController extends Controller
{

    public function index(){

        $data = Ppmp::orderBy('ppmp_year', 'asc')->get();

        return response()->json($data);
    }

    public function ppmp_get($id){

        $data = Ppmp::with([
            'category', 
        ])->where('ppmp_id', $id)->first();
            
        return response()->json($data);
    }

    public function get_ppmp($id){

        $data = Ppmp::with([
            'category'
        ])->where('user_id', $id)->orderBy('ppmp_year', 'desc')->get();

        return response()->json($data);
    }

    public function store(Request $request){

        $ppmp = Ppmp::create([
            'ppmp_year' => $request->ppmp_year,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
        ]);
            
        broadcast(new PpmpCreated($ppmp));

        return response()->json($ppmp);
    }

    public function show($id){
        $ppmp = Ppmp::where('ppmp_id', $id)->first();
        $category_id = $ppmp->category_id;
        
        $ppmps = Item::with(['item_ppmps' => function ($query) use ($id) {
                    $query->where('ppmp_id', $id)->first();
                }])->where('category_id', $category_id)->get();

        return response()->json($ppmps);
    }

    public function show2($ppmp_id, $category_id){
        $data = Item::with(['item_ppmps' => function ($query) use ($ppmp_id) {
                $query->where('ppmp_id', $ppmp_id);
            }])->where('category_id', $category_id)->get();
        
        return response()->json($data);
    }

    public function update(Request $request, $id){
        $ppmp = Ppmp::findOrFail($id);

        $ppmp->update([
            'ppmp_year' => $request->ppmp_year,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
        ]);

        broadcast(new PpmpUpdated($ppmp));

        return response()->json($ppmp);
    }

    public function destroy($id){
        $ppmp = Ppmp::where('ppmp_id', $id)->first();
        $ppmp->delete();

        return response()->json($ppmp);
    
    }
}
