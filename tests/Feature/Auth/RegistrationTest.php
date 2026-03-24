<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RegistrationTest extends TestCase
{
    use RefreshDatabase; // Réinitialise la base de données après chaque test

    /**
     * Teste si un utilisateur peut s'inscrire avec succès.
     *
     * @return void
     */
    public function test_a_user_can_register()
    {
        // 1. Préparation : Définir les données du nouvel utilisateur
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post(route('register'), $userData);

        // vérif
        $this->assertAuthenticated();
        $response->assertRedirect('/');

        // Vérifie que l'utilisateur existe bien dans la base de données
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
