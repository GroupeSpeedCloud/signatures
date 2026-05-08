<?php

namespace App\Middleware;

/**
 * Middleware d'authentification
 */
class AuthMiddleware
{
    /**
     * Vérifie si l'utilisateur est authentifié
     */
    public function handle(): void
    {
        session_start();
        
        if (!isset($_SESSION['user'])) {
            // Si on est sur la page de login, laisser passer
            if ($this->isLoginPage()) {
                return;
            }
            
            // Rediriger vers la page de login
            header('Location: /');
            exit;
        }
    }

    /**
     * Vérifie si on est sur la page de login
     */
    private function isLoginPage(): bool
    {
        $scriptName = basename($_SERVER['PHP_SELF'] ?? '');
        $requestUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        
        return $scriptName === 'index.php' || $requestUri === '/' || $requestUri === '/index.php';
    }

    /**
     * Force l'authentification (pour les API)
     */
    public function requireAuth(): void
    {
        session_start();
        
        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            
            // Si c'est une requête AJAX/API, retourner du JSON
            if ($this->isApiRequest()) {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Non autorisé']);
                exit;
            }
            
            header('Location: /');
            exit;
        }
    }

    /**
     * Vérifie si c'est une requête API
     */
    private function isApiRequest(): bool
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
            || str_contains($_SERVER['REQUEST_URI'] ?? '', '.api')
            || str_ends_with($_SERVER['SCRIPT_NAME'] ?? '', '.php');
    }
}
