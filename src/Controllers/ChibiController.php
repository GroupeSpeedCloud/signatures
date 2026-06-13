<?php

declare(strict_types=1);

namespace App\Controllers;

class ChibiController
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function show(): void
    {
        $user = $_SESSION['user'];
        $jobs = $this->config['jobs'] ?? [];

        include __DIR__ . '/../../views/chibi.php';
    }
}
