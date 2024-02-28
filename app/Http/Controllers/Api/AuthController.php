<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use ApiResponser;
    //login Api with sunctum
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' =>'required|email|exists:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation Error.', $validator->errors());
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $success['token'] = $user->createToken('girexpos_auth')->plainTextToken;
            $success['user'] = $user;

            return $this->successResponse($success, 'User login successfully.');
        } else {
            return $this->errorResponse('Unauthorised.', ['error' => 'Unauthorised.']);
        }
    }

    // logout Api with sunctum
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->successResponse([], 'User logout successfully.');
    }   
}