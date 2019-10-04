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

        $attachment = $request->attachments;
        $count = count($attachment);
        $po_id = $request->po_id;

        for($i = 0; $i < $count; $i++){
            $attachment_id = $attachment[$i]['attachment_id'];
            $number_date_particulars = $attachment[$i]['number_date_particulars'];

            $dv_attachment = DvAttachment::create([  
                'attachment_id' => $attachment_id,
                'po_id' => $po_id,
                'number_date_particulars' => $number_date_particulars,
            ]);
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
