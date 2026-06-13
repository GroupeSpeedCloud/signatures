<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\AuthService;

class AuthController
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLogin(): void
    {
        $authUrl = $this->authService->getAuthUrl();
        include __DIR__ . '/../../views/login.php';
    }

    public function callback(): void
    {
        if (!isset($_GET['code'])) {
            header('Location: /');
            exit;
        }

        try {
            $_SESSION['user'] = $this->authService->authenticate($_GET['code']);
            header('Location: /');
            exit;
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            include __DIR__ . '/../../views/error.php';
            exit;
        }
    }

    public function logout(): void
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(), '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }

        session_destroy();
        header('Location: /');
        exit;
    }
}
