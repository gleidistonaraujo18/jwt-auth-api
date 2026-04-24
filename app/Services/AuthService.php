<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function register(array $data): User
    {
        return User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    public function login(string $email, string $password): array
    {
        $credentials = compact('email', 'password');
        $token = Auth::attempt($credentials);
        if (! $token) {
            throw ValidationException::withMessages([
                'email' => 'Credencias inválidas',
            ]);
        }

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
        ];
    }

    public function logoff(): array
    {
        Auth::guard('api')->logout();

        return [
            'message' => 'Logout realizado com sucesso.',
        ];
    }
}
