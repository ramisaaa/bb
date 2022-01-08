<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Functions\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

class AuthController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }


    public function register(UserRequest $request)
    {
        $email = $request->input('email');
        $userExists = User::where('email', $email)->exists();
        try {
            //check if user exists
            if ($userExists) {
                return Response::fail("شما قبلا ثبت نام کرده اید", 406);
            } else {
                $user = new User();
                $user->email = $email;
                $user->name = $request->input('password');
                $user->password = Hash::make($request->input('password'));
                $user->saveOrFail();
                return Response::ok([], 'true');
            }
        } catch (Throwable $e) {
            return Response::fail($e->getMessage());
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');


        if (! $token = Auth::attempt($credentials)) {
            return Response::fail('unauthorized', 401);
        }
        return $this->respondWithToken($token);

//        return Response::ok([], 'true');
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }


    public function me()
    {
        return response()->json(auth()->user());
    }


    public function logout()
    {
        auth()->logout();

        return Response::ok([], 'true');
    }



}
