<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;

class AuthControlller extends Controller
{   
    public function sign_up(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        $token = $user->createToken('apiToken')->plainTextToken;

        $res = [
            'user' => $user,
            'token' => $token
        ];
        return response($res, 201);
    }

    public function index()
    {
        $users = User::all();

        return response()->json([
            'user' => $users
        ]); 
    }

    public function login(Request $request){
       $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
       ]);

       $user = User::where('email', $data['email'])->first();

       if (!$user || !Hash::check($data['password'], $user->password)){
            return response([
                'message' => 'Incorrect'
            ], 401);
       }

       $token = $user->createToken('apiToken')->plainTextToken;

       $res = [
            'user' => $user,
            'token' => $token
       ];

       return response($res, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Bye'
        ];
    }

    /**
     * Display a listing of the resource.
     *

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
