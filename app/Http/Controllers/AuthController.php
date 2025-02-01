<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request) {}

    public function login(LoginRequest $request)
    {
        return AuthService::login($request->all());
    }
}