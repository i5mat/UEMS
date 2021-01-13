<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $creds = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($creds))
        {
            return response()->json([
               'success' => false,
                'message' => 'invalid credentials...'
            ]);
        }
        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => Auth::user()
        ]);
    }

    public function register(Request $request)
    {
        $encryptedPass = Hash::make($request->password);

        $user = new User;

        try {
            $user->name = $request->name;
            $user->matric_no = $request->matric_no;
            $user->email = $user->matric_no.''.'@student.utem.edu.my';
            $user->password = $encryptedPass;
            $user->save();
            return $this->login($request);

        }catch (Exception $e) {
            return response()->json([
               'success' => false,
               'message' => ''.$e
            ]);
        }
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::parseToken($request->token));
            return response()->json([
               'success' => true,
               'message' => 'logout success'
            ]);
        }
        catch (Exception $e)
        {
            return response()->json([
               'success' => false,
               'message' => ''.$e
            ]);
        }
    }
}
