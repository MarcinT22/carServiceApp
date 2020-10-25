<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUser;
use App\Http\Requests\RegisterUser;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Calendar;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserApiController extends Controller
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

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

    public function list()
    {
        $users = $this->userRepository->getAll();
        return response()->json([
            'users'=>$users
        ]);

    }

    public function find($id)
    {
        $user = $this->userRepository->find($id);
        return response()->json([
            'user'=>$user
        ]);
    }

    public function destroy($id)
    {
        $this->userRepository->delete($id);
        return response()->json([
            'message'=>'success'
        ]);
    }

    public function update(Request $request, $id)
    {

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $this->userRepository->update($data, $id);
        return response()->json([
            'message'=>'success'
        ]);
    }
}
