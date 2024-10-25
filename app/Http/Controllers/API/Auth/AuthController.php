<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        /**
        * Handle login request.
        */
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial pengguna
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Generate token untuk autentikasi
        $token = $user->createToken('authToken')->plainTextToken;

        // Berikan respons dengan token
        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 200);
    }

    public function register(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user = User::where('email', $request->email)->first();

        if($request->phone != null || $request->address != null){
            $user->update([
                'handphone' => $request->handphone,
                'address' => $request->address
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Registered successfully',
            'user' => $user,
        ]);
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        // Hapus token autentikasi
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }
}
