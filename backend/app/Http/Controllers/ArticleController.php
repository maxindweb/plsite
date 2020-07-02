<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\support\Carbon;
use App\Article;
use App\user;

use Auth;

class ArticleController extends Controller
{
    public function index()
    {
        return response()->json(Article::all()->get(), 200);
    }

    public function all()
    {
        return response()->json(Article::where('published', '=', true))->with('Tag');
    }

    public function allAdmin($user_id)
    {
        return response()->json(Article::where('user_id', $user_id)->get(), 200);
    }

    public function show($slug)
    {
        return response()->json($slug);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'         => 'required|unique:articles',
            'content'       => 'required',
            'category_id'   => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

        $article = Article::create([
            'title'         => $request->title,
            'slug'          => str::slug($request->title),
            'content'       => $request->content,
            'user_id'       => $request->user_id,
            'category_id'   => $request->category_id,
            'attachment'    => $request->attachment,
            'thumbnail'     => $request->thumbnail
        ]);

        $article->tag()->attach($request->tag);
        return response()->json([
            'status'    => (bool) $article,
            'message'   => $article ? 'Success Created article' : 'Error Creating article'
        ]);
    }

    public function published(Request $request)
    {
        $article = Article::updateOrCreate(
            ['title'        => $request->title],
            ['slug'         => str::slug($request->title) ],
            ['thumbnail'    => $request->thumbnail],
            ['content'      => $request->content],
            ['category_id'  => $request->tag_id],
            ['published'    => true],
            ['published_at' => Carbon::now()]
        );

        $article->tags()->attach($request->tags);

        return response()->json([
            'status' => (bool) $article ,
            'message' => $article ? 'Article Published' : 'Error Publishing Article'
        ]);
    }

    public function archive(Article $article)
    {
        $article->is_published = false;
        $status = $article->save();

        return response()->json([
            'status' => (bool) $status,
            'message'=> $status ? 'Artikel Berhasil di Arsipkan' : 'Artikel Gagal di Arsipkan'
        ]);
    }

    public function update(Request $request,Article $article)
    {
        $validator = Validator::make($request->all(),[
            'title'         => 'required|unique:articles',
            'content'       => 'required',
            'category_id'   => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

        $data = Article::find($article);
        $data->title        = $request['title'];
        $data->content      = $request['content'];
        $data->category_id  = $request['category_id'];
        $data->update();

        return response()->json([
            'status'        => $data,
            'message'       => $data ? 'Success Updated Article': 'Error Updating Article'
        ]);
    }

    public function destroy()
    {
        $status = Article::delete();

         return response()->json([
             'status' => $article,
         ]);
    }
}
