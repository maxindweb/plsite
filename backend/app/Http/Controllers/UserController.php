<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\user;

use Validator;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    public function all()
    {
        //
    }

    public function login(Request $request)
    {
        $status = 401;
        $response = ['error' => 'Unauthorized'];

        if(Auth::attempt($request->only(['email', 'password']))){
            $status = 200;
            $response = [
                'user' => Auth::user(),
                'token'=> Auth::user()->createToken('plsite')->accessToken
            ];
        }

        return response()->json($response, $status);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|unique:users',
            'email'         => 'required|unique:users|email',
            'password'      => 'required|min:6',
            'c_password'    => 'required|same:password'
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }

        $data = $request->only(['name', 'email', 'password', 'role_id']);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        return response()->json([
            'user'  => $user,
        ]);
    }

    public function updatePassword(Request $request)
    {
        //
    }

    public function forgotPassword()
    {
        //
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:users',
            'email' => 'required|unique:users|email',
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors
            ]);
        }

        $data = User::find($id);
        $data->name     = $request['name'];
        $data->email    = $request['email'];
        $data->uppdate();

        return response()->json([
            'status'       => $data,
            'message'      => $data ? 'Success Updated User' : 'Error updating User'
        ]);
    }

    public function show($user)
    {
        return response()->json($user, 200);
    }

    public function destroy()
    {
        $status = User::delete();

        return response()->json([
            'status'    => $status,
            'message'   => $status ? 'user Deleted' : 'Error Deleting user'
        ]);
    }
}
