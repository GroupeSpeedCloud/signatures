<?php

declare(strict_types=1);

namespace App;

use App\Controllers\AuthController;
use App\Controllers\SignatureController;
use App\Controllers\ChibiController;
use App\Services\AuthService;
use App\Services\SignatureService;

class Router
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $key    = "{$method} {$uri}";

        match ($key) {
            'GET /'                  => $this->home(),
            'GET /auth'              => $this->auth()->showLogin(),
            'GET /callback'          => $this->auth()->callback(),
            'GET /callback.php'      => $this->auth()->callback(),
            'GET /logout'            => $this->auth()->logout(),
            'GET /signatures'        => $this->guard(fn() => $this->signature()->showGenerator()),
            'GET /signature'         => $this->guard(fn() => $this->signature()->render()),
            'POST /upload-signature' => $this->guard(fn() => $this->signature()->upload()),
            'GET /chibi'             => $this->guard(fn() => $this->chibi()->show()),
            default                  => $this->notFound(),
        };
    }

    private function home(): void
    {
        if (isset($_SESSION['user'])) {
            $this->signature()->showGenerator();
        } else {
            $this->auth()->showLogin();
        }
    }

    private function guard(callable $handler): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            exit;
        }
        $handler();
    }

    private function notFound(): void
    {
        http_response_code(404);
        $errorMessage = 'Page introuvable (404)';
        include __DIR__ . '/../views/error.php';
    }

    private function auth(): AuthController
    {
        return new AuthController(new AuthService($this->config['google']));
    }

    private function signature(): SignatureController
    {
        return new SignatureController(new SignatureService($this->config), $this->config);
    }

    private function chibi(): ChibiController
    {
        return new ChibiController($this->config);
    }
}
