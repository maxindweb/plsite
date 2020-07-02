<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Tag;

use Validator;

class TagController extends Controller
{
    public function index()
    {
        return response()->json([
            ''
        ]);
    }

    public function show($tag)
    {
        return response()->json($tag->with('Article'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tag'   => 'required'
        ]);

        if($validator->fail()){
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

        $tags = Tag::create([
            'tag'   => $request->tag,
            'slug'  => str::slug($request->slug)
        ]);

        return response()->json([
            'status'    => (bool)$tags,
            'message'   => $tags ? 'success Created Tags' : 'Error Creating Tags'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tag' => 'required'
        ]);

        if($validator->fail()){
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

        $data = Tag::find($id);
        $data->tag      = $request['tag'];
        $data->slug     = str::slug($request->tag); 
        $data->update();

        return response()->json([
            'message' => $data ? 'Success Updated Tag' : 'Erorr Updating Tag'
        ]);
    }

    public function destoy()
    {
        $status = Tag::delete();

        return response()->json([
            'status'    => (bool)$status,
            'message'   => $status ? 'Success Deleted Tag': 'Erorr Deleting Tag'
        ]);
    }
}
