<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login_page()
    {
        return view('pages.auth.login');
    }

    public function login(LoginRequest $req)
    {
        return $this->authService->attempt($req->validated());
    }

    public function logout()
    {
        return $this->authService->logout();
    }
}
