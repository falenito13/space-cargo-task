<?php

namespace App\Http\Controllers\API\V1;

use App\DTOs\LoginCredentialsDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{

    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $loginCredentialsDTO = new LoginCredentialsDTO($request->email, $request->password);
            $authorizeUser = $this->authService->login($loginCredentialsDTO);
            if ($authorizeUser['success']) {
                return response()
                    ->json([
                        'success' => true,
                        'message' => $authorizeUser['message']
                    ], $authorizeUser['code'])
                    ->withCookie(cookie('auth_token', $authorizeUser['token'], 60));
            }
            return response()->json([
                'success' => false,
                'message' => $authorizeUser['message']
            ], $authorizeUser['code']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() . "Line:" . $e->getLine()
            ]);
        }
    }
}
