<?php

namespace App\Http\Services;

use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public static function login(array $credentials)
    {
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return ApiResponse::createUnauthorizedResponse(['Unauthorized']);
        }
        $user = Auth::user();
        if (!$user->hasVerifiedEmail()) {
            return ApiResponse::createUnauthorizedResponse(['Email not verified']);
        }
        $tokenResponse = self::generateToken($user, 'Personal Access Token');
        return ApiResponse::createSuccessResponse($tokenResponse);
    }

    private function generateToken($user, $tokenName = null)
    {
        return [
            'accessToken' => $user->createToken($tokenName)->plainTextToken,
            'tokenType' => 'Bearer',
        ];
    }
}