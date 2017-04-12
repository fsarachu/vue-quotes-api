<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class UserController extends Controller
{
    public function signup(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        $user->save();

        $message = 'User successfully created';
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('message', 'token'), 201);
    }

    public function signin(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'password' => 'required|string'
        ]);

        $credentials = $request->only(['name', 'password']);

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'Could not create token'], 500);
        }

        return response()->json(compact('token'), 200);
    }
}
