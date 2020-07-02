<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Category;

use Validator;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::with('Article')->get(), 200);
    }

    public function all()
    {
        return response()->json();
    }

    //show category with articles where published
    public function showPublished()
    {
        return response()->json(Category::where('slug', '=', $slug)->with('Article')
        ->whereHas('Article', function($q){
            $q->where('published', true);
        })->get(), 200);
    }

    public function show($slug)
    {
        return response()->json(Category::where('slug', '=', $slug)->with('Article')->get(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

        $category = Category::create([
            'category'      => $request->category,
            'slug'          => str::slug($request->category)
        ]);

        return response()->json([
            'status'    => (bool) $category,
            'message'   => $category ? 'Success Category Created' : 'Erorr Cretaing Crated'
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category'   => 'required'
        ]);

        if($validator->fail()){
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

        $category = Category::update([
            'category'  => $request->category
        ]);

        return response()->json([
            'status' => (bool) $category,
            'message'=> $category ? 'Success Created category' : 'Error Creating Category'
        ]);
    }

    public function destroy()
    {
        $status = Category::delete();

        return response()->json([
            'status'    => $status,
            'message'   => $status ? 'Success Deleted Category':'Error Deleting Category'
        ]);
    }
}
