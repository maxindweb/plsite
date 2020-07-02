<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserRole;

class UserRoleController extends Controller
{
    public function index()
    {
        return response()->json(UserRole::all(), 200);
    }

    public function all()
    {
        return response()->json(UserRole::with('User')->get(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'role'  => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors
            ]);
        }

        $status = UserRole::create([
            'role'  => $request->role
        ]);

        return response()->json([
            'status'    => (bool) $status,
            'message'   => $status ? 'Success Created User Role' : 'Error Creating User Role'
        ]);
    }

    public function destroy()
    {
        $status = UserRole::delete();

        return response()->json([
            'status'  => $status,
            'message' => $status ? 'Success Deleted User Role':'Error Deleting User Role'
        ]);
    }
}
