<?php

namespace App\Controllers;

use App\Services\AuthService;

/**
 * Contrôleur d'authentification
 */
class AuthController
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Affiche la page de login
     */
    public function showLogin(): void
    {
        $authUrl = $this->authService->getAuthUrl();
        include __DIR__ . '/../../views/login.php';
    }

    /**
     * Traite le callback Google OAuth
     */
    public function callback(): void
    {
        if (!isset($_GET['code'])) {
            header('Location: /');
            exit;
        }

        try {
            $userData = $this->authService->authenticate($_GET['code']);
            
            // Stocker en session
            $_SESSION['user'] = $userData;
            
            header('Location: /');
            exit;
            
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            include __DIR__ . '/../../views/error.php';
            exit;
        }
    }

    /**
     * Déconnecte l'utilisateur
     */
    public function logout(): void
    {
        session_start();
        session_destroy();
        header('Location: /');
        exit;
    }
}
