<?php

declare(strict_types=1);

namespace App;

use App\Controllers\AuthController;
use App\Controllers\OnboardingController;
use App\Controllers\SignatureController;
use App\Controllers\ChibiController;
use App\Services\AuthService;
use App\Services\SignatureService;
use App\Services\UserService;

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
            'GET /onboarding'        => $this->guard(fn() => $this->onboarding()->show(), bypass: true),
            'POST /onboarding'       => $this->guard(fn() => $this->onboarding()->save(), bypass: true),
            'GET /signatures'        => $this->guard(fn() => $this->signature()->showGenerator()),
            'GET /signature'         => $this->guard(fn() => $this->signature()->render()),
            'POST /upload-signature' => $this->guard(fn() => $this->signature()->upload()),
            'GET /chibi'             => $this->guard(fn() => $this->chibi()->show()),
            default                  => $this->notFound(),
        };
    }

    private function home(): void
    {
        if (!isset($_SESSION['user'])) {
            $this->auth()->showLogin();
            return;
        }
        if (!isset($_SESSION['user']['gender'])) {
            header('Location: /onboarding');
            exit;
        }
        $this->signature()->showGenerator();
    }

    /**
     * @param bool $bypass Autoriser l'accès même sans genre défini (page onboarding elle-même).
     */
    private function guard(callable $handler, bool $bypass = false): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            exit;
        }
        if (!$bypass && !isset($_SESSION['user']['gender'])) {
            header('Location: /onboarding');
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
        return new AuthController(new AuthService($this->config['google']), new UserService());
    }

    private function onboarding(): OnboardingController
    {
        return new OnboardingController(new UserService());
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
