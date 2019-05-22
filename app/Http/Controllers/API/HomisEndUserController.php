<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Views\HomisEndUser;

class HomisEndUserController extends Controller
{
    public function index(){
        $data = HomisEndUser::orderBy('chrgdesc', 'asc')->get();

        return response()->json($data);
    }
}
