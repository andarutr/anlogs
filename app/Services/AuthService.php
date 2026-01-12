<?php

namespace App\Services;

use App\Traits\TrackActivity;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    use TrackActivity;

    public function attempt(array $data)
    {
        $email = $data['email'];
        $password = $data['password'];

        if(Auth::attempt(['email' => $email, 'password' => $password]))
        {
            // Track Activity
            $this->trackUserActivity($action = 'login', $ip_address = request()->ip(), $page = 'login');

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

    public function logout()
    {
        // Track Activity
        $this->trackUserActivity($action = 'logout', $ip_address = request()->ip(), $page = 'logout');

        Auth::logout();

        return redirect('/login');
    }
}