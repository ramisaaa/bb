<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Functions\Response;
use Illuminate\Support\Facades\Hash;
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

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return Response::fail('unauthorized', 401);
        }

        return Response::ok([], 'true');
    }


    public function logout()
    {
        auth()->logout();

        return Response::ok([], 'true');
    }



}
