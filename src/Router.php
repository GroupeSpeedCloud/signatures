<?php

namespace App;

use App\Controllers\AuthController;
use App\Controllers\SignatureController;
use App\Controllers\ChibiController;
use App\Services\AuthService;
use App\Services\SignatureService;

/**
 * Routeur de l'application
 */
class Router
{
    private array $config;
    private array $routes = [];

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->defineRoutes();
    }

    /**
     * Définit toutes les routes de l'application
     */
    private function defineRoutes(): void
    {
        // Routes publiques
        $this->routes['GET /'] = function() {
            if (isset($_SESSION['user'])) {
                $this->dispatch('signature.generator');
            } else {
                $this->dispatch('auth.login');
            }
        };

        // Routes d'authentification
        $this->routes['GET /auth'] = 'auth.login';
        $this->routes['GET /callback'] = 'auth.callback';
        $this->routes['GET /logout'] = 'auth.logout';

        // Routes de signatures
        $this->routes['GET /signatures'] = 'signature.generator';
        $this->routes['GET /signature'] = 'signature.render';
        $this->routes['POST /upload-signature'] = 'signature.upload';

        // Routes Chibi
        $this->routes['GET /chibi'] = 'chibi.show';
    }

    /**
     * Dispatch la requête vers le bon contrôleur
     */
    public function dispatch(?string $routeKey = null): void
    {
        if ($routeKey === null) {
            $method = $_SERVER['REQUEST_METHOD'];
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $routeKey = "{$method} {$uri}";
        }

        if (!isset($this->routes[$routeKey])) {
            http_response_code(404);
            echo "Page non trouvée";
            return;
        }

        $handler = $this->routes[$routeKey];

        if (is_callable($handler)) {
            $handler();
            return;
        }

        // Appeler le contrôleur
        [$controllerName, $action] = explode('.', $handler);
        $controller = $this->getController($controllerName);
        
        if (method_exists($controller, $action)) {
            $controller->$action();
        }
    }

    /**
     * Instancie un contrôleur
     */
    private function getController(string $name): object
    {
        return match($name) {
            'auth' => new AuthController(
                new AuthService($this->config['google'])
            ),
            'signature' => new SignatureController(
                new SignatureService($this->config),
                $this->config
            ),
            'chibi' => new ChibiController(),
            default => throw new \Exception("Contrôleur inconnu: {$name}")
        };
    }
}
