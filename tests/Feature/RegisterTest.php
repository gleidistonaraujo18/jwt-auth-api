<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('não deve registrar com senha curta', function () {
    $response = $this->postJson('/api/auth/register', [
        'name' => 'Gleidiston',
        'email' => 'gleidiston@email.com',
        'password' => '123',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['password']);
});

test('deve ter e-mail válido', function () {
    $response = $this->postJson('/api/auth/register', [
        'name' => 'Gleidiston',
        'email' => 'gleidistonemail.com',
        'password' => '12345678',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
});

test('não deve registrar com e-mail duplicado', function () {
    User::factory()->create([
        'email' => 'gleidiston@email.com',
    ]);

    // Act
    $response = $this->postJson('/api/auth/register', [
        'name' => 'Gleidiston',
        'email' => 'gleidiston@email.com',
        'password' => '12345678',
    ]);

    // Assert
    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
});

test('deve retornar json quando a validacao falhar sem accept application json', function () {
    $response = $this->post('/api/auth/register', [
        'name' => 'Gleidiston',
        'email' => 'gleidiston@email.com',
    ]);

    $response->assertStatus(422)
        ->assertHeader('content-type', 'application/json')
        ->assertJsonValidationErrors(['password']);
});
