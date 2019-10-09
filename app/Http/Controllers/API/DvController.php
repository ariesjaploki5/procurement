<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dv;
use Carbon\Carbon;
use DB;

class DvController extends Controller
{
    
    public function index(){
        
        $data = DB::table("fn_get_all_dv()")->get();

        return response()->json($data);
        
    }

    public function store(Request $request){
    
        $year = Carbon::now()->year;

        $count_3 = Dv::where('created_at', $year)->count();

        $attachment = $request->attachments;
        $liquidated_damage = $request->liquidated_damages;

        $count = count($attachment);
        $count_2 = count($liquidated_damage);
        $dv = Dv::create([
            'po_id' => $request->po_id,
            'dv_officer_id' => $request->approving_officer_id,
        ]);
        
        $dv_id = sprintf("%04d", $dv->id);
        $dv->dv_id = $year .'-'. $dv_id;
        $dv->save();

        $dv_id = $dv->dv_id;

        for($i = 0; $i < $count; $i++){
            
            $dv->attachments()->create([
                'dv_id' => $dv_id,
                'attachment' => $attachment[$i]['attachment'],
            ]);
        }

        return response()->json();
    }

    public function update(Request $request, $id){



    }

    public function show($id){



    }

    public function destroy($id){



    }

}
