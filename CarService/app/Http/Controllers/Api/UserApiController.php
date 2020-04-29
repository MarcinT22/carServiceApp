<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUser;
use App\Http\Requests\RegisterUser;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Calendar;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserApiController extends Controller
{
    public function register(RegisterUser $request)
    {

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        Calendar::create([
            'user_id'=>$user['id']
        ]);


        return response()->json(['message' => 'User successfully created'], 201);
    }

    public function login(LoginUser $request)
    {

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorization user'
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('User Access Token');
        $token = $tokenResult->token;


        $token->save();
        return response()->json([
            'message' => 'User is logged',
            'access_token' => $tokenResult->accessToken,
            'user'=>$user,
            'calendar_id'=>$user->calendar->id,
        ]);


    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Logged out'
        ]);
    }


    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
