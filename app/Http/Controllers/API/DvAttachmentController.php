<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DvAttachment;

class DvAttachmentController extends Controller
{
    public function index(){

    }

    public function store(Request $request){

        $dv_attachment = DvAttachment::firstOrCreate([  
            'attachment_id' => $request->attachment_id,
            'po_id' => $request->po_id,
            'purchase_order_id' => $request->purchase_order_id,
            'number_date_particulars' => $request->number_date_particulars
        ]);

        return response()->json();
    }

    public function show($id){


    }

    public function update(Request $request, $id){


    }

    public function destroy($id){


    }
}
