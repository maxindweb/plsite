<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Image;

use Validator;

class ImageController extends Controller
{
    public function index()
    {
        //
    }

    public function show()
    {
        //
    }

    /**
     * @param Request $request
     * @param null $name
     * return
     */
    public function uploadImmage(Request $request, $name = null)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|',
            'image'     => 'required|mimes:jpg,jpeg,WebP,png,svg',
            'alt'       => 'reuired|max:255',
            'caption'   => 'required|max:255'
        ]);

        if($validator->fail()){
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        if($request->hasFile('image')){
            foreach ($request->file('images') as $image) {
                //
            }
        }

        
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'      => 'required',
            'alt'       => 'required|max:255',
            'caption'   => 'required|max:255'
        ]);

        if($validator->fail()){
            return response()->json([
                'error' => $validator->errors()
            ]);
        }
    }

    public function destroy()
    {
        //
    }
}
