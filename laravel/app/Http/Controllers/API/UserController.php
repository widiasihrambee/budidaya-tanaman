<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;

class UserController extends Controller
{
    public function register(Request $request){
        try{
            $request->validate([
                 'name' => ['required', 'string', 'max:255'],
                 'email' => ['required', 'string','email', 'max:255', 'unique:users'],
                 'password' => ['required', 'string', new Password]
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            
            $user = User::where('email', $request->email)->first();

            // create token 
            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'User Registered');
        } catch(Exception $error){
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);

        }
    }

    public function login(Request $request){
        try{
            $request->validate([
                'email' => 'email|required',
                'password' => 'required',
            ]);

            $creadentials = request(['email', 'password']);

            if(!Auth::attempt($creadentials)){
                 return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                 ], 'Authentication Failed', 500);
            }

            $user = User::where('email', $request->email)->first();

            if(! Hash::check($request->password, $user->password, [])){
                 throw new \Exception('Invalid Credentilas');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Authenticated');
        } catch(Exception $error){
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500 );
        }
    }

    public function fetch(Request $request){
        return ResponseFormatter::success($request->user(), 'Data user berhasil diambail');
    }
    public function logout(Request $request){
        $token = $request->user()->currentAccessToken()->delete();
        return ResponseFormatter::success($token, 'Token Revoked');
    }
    
}
