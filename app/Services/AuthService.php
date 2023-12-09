<?php

namespace App\Services;

use App\DTOs\LoginCredentialsDTO;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;

class AuthService
{

    public function login(LoginCredentialsDTO $loginCredentialsDTO): array
    {
        if (Auth::attempt(['email' => $loginCredentialsDTO->email, 'password' => $loginCredentialsDTO->password])) {
            $token = request()->user()->createToken('auth-token')->plainTextToken;
            request()->session()->regenerate();
            return [
                'success' => true,
                'code' => ResponseStatus::HTTP_OK,
                'message' => __('You are successfully logged in'),
                'token' => $token
            ];
        }
        return [
            'success' => false,
            'code' => ResponseStatus::HTTP_UNAUTHORIZED,
            'message' => __('Unauthorized')
        ];
    }

}
