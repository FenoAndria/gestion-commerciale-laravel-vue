<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'error' => $validator->errors(),
            ], 404);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json([
            'message' => 'Utilisateur enregistré',
            'user' => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            /** @var \App\Models\User $user  */
            $user = Auth::user();
            $authData['token'] = $user->createToken('LaravelSanctumAuth')->plainTextToken;
            $authData['name'] = $user->name;
            return response()->json([
                'message' => 'Utilisateur connecté',
                'user' => $authData,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Utilisateur non identifié',
            ], 403);
        }
    }

    public function logout(Request $request)
    {
        /** @var \App\Models\User $user  */
        $user = Auth::user();
        $user->tokens()->delete();
        return response()->json([
            'message' => 'Utilisateur déconnecté',
            'user' => $user,
        ]);
    }
}
