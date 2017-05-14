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

        $token = JWTAuth::fromUser($user);

        $data = [
            'user' => $user->attributesToArray(),
        ];

        return response()
            ->json(['data' => $data], 201)
            ->header('Authorization', 'Bearer ' . $token);
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
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        $data = JWTAuth::authenticate($token);

        return response()
            ->json(['data' => $data], 200)
            ->header('Authorization', 'Bearer ' . $token);
    }
}
