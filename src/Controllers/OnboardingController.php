<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\UserService;

class OnboardingController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function show(): void
    {
        $user = $_SESSION['user'];
        include __DIR__ . '/../../views/onboarding.php';
    }

    public function save(): void
    {
        $gender = $_POST['gender'] ?? '';

        if (!in_array($gender, ['m', 'f'], true)) {
            header('Location: /onboarding');
            exit;
        }

        $this->userService->saveGender($_SESSION['user']['email'], $gender);
        $_SESSION['user']['gender'] = $gender;

        header('Location: /signatures');
        exit;
    }
}
