<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function register(UserRegisterRequest $request): UserResource
    {
        $data = $request->validated();

        if (User::where('email', $data['email'])->exists()) {
            throw new HttpResponseException(response([
                'errors' => [
                    'email' => [
                        'email already exists'
                    ]
                ]
            ], 400));
        }

        $user = new User($data);
        $user->password = Hash::make($data['password']);
        $user->save();

        return new UserResource($user);
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            throw new HttpResponseException(response([
                'errors' => [
                    'email' => [
                        'User not found'
                    ]
                ]
            ], 400));
        }

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new HttpResponseException(response([
                'errors' => [
                    'password' => [
                        'Incorrect password'
                    ]
                ]
            ], 400));
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token
        ]);
    }

    public function update(UserUpdateRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $user = User::find($id);
        if (!$user) {
            throw new HttpResponseException(response([
                "errors" => [
                    "message" => [
                        "user not found"
                    ]
                ]
            ], 404));
        }
        if (User::where('email', $data['email'])->exists()) {
            throw new HttpResponseException(response([
                'errors' => [
                    'email' => [
                        'Email already exists'
                    ]
                ]
            ], 400));
        }
        if (isset($request->password)) {
            $user->password = Hash::make($request->password);
        }
        if (isset($request->name)) {
            $user->name = $request->name;
        }
        if (isset($request->email)) {
            $user->email = $request->email;
        }
        $user->update();
        return response()->json([
            'message' => 'success update',
            'data' => new UserResource($user)
        ]);
    }

    public function getUser(Request $request): UserResource
    {
        return new UserResource($request->user());
    }


    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
