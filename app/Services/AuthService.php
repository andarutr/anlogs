<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function attempt(array $data)
    {
        $email = $data['email'];
        $password = $data['password'];

        if(Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return response()->json([
                'status' => 'success', 
                'message' => 'Berhasil Login!'
            ]);
        }else{
            return response()->json([
                'status' => 'false', 
                'message' => 'Email dan password salah!'
            ]);
        }
    }
}