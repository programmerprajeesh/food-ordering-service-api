<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;




class AuthController extends Controller
{
    public function register(Request $request)
    {
        // return response($request);
        // die();
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string|unique:users',
            'password' => 'required|string|confirmed',
                        

        ]);

        $user = User::create([
            'name'=> $fields['name'],
            'email'=> $fields['email'],
            'password'=> bcrypt($fields['password']),

        ]);
        // Role value must be passed from a dropdown field to avoid error
 
        
        if (isset($request->role)) {
           $user->assignRole($request->role);               

        } else {
            $user->assignRole('user');
             
        }       


        $token = $user->createToken('myAppToken')->plainTextToken;
        $response = [
            'user' => $user,
            'token'=> $token
        ];

        return response($response, 201);
        
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',            

        ]);

        // check email
        $user = User::where(['email'=> $fields['email']])->first();
        // check password
        if (!$user || !Hash::check($fields['password'],$user->password)) {
            return response('Wrong Credentials', 401);
        }
        $token = $user->createToken('myAppToken')->plainTextToken;
        $response = [
            'user' => $user,
            'token'=> $token
        ];

        return response($response, 201);
        
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}
