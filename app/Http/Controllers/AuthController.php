<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService) {}

    public function register(RegisterRequest $request): JsonResponse
    {

        $user = $this->authService->register($request->validated());

        return response()->json([
            'message' => 'Usuário criado com sucesso.',
            'user' => $user->only('id', 'name', 'email'),
        ], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        /* Request validado pelo LoginRequest */
        $request->validated();
        $tokenData = $this->authService->login($request['email'], $request['password']);

        return response()->json($tokenData);
    }

    public function me(): JsonResponse
    {
        return response()->json(
            Auth::guard('api')->user()
        );
    }

    public function logoff()
    {
        return response()->json($this->authService->logoff());
    }
}
