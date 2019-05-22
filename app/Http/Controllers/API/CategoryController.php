<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {

        $data = Category::orderBy('category_desc', 'asc')->get();

        return response()->json($data);
    }

    public function app($id){
        $data = Category::with([
            'apps' => function ($query) use ($id){
                $query->where('app_id', $id);
            }
        ])->orderBy('category_desc', 'asc')->get();

        return response()->json($data);
    }

    public function store(Request $request){

        $category = Category::create([
            'category_desc' => $request->country_desc,
        ]);

        return response()->json($category);

    }

    public function show($id){
        

    }

    public function update(Request $request, $id){
        $category = Category::findOrFail($id);

        $category->update([
            'category_desc' => $request->category_desc,
        ]);

        return response()->json($category);
    }


    public function destroy($id){
        $category = Category::where('category_id', $id)->first();
        $category->delete();

        return response()->json($category);
    }
}
