<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attachment;
use DB;

class AttachmentController extends Controller
{
    
    public function index(){
        $data = Attachment::orderBy('attachment_desc', 'asc')->get();

        return response()->json($data);
    }

    public function approving_officer(){
        $data = DB::Table("dv_officers")->get();

        return response()->json($data);
    }

    public function store(Request $request){


    }

    public function update(Request $request, $id){


    }

    public function show($id){


    }

    public function destroy($id){


    }

}
