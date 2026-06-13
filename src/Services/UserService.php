<?php

declare(strict_types=1);

namespace App\Services;

class UserService
{
    private string $dataDir;

    public function __construct()
    {
        $this->dataDir = __DIR__ . '/../../data/users/';
    }

    public function getGender(string $email): ?string
    {
        $data = $this->load($email);
        $gender = $data['gender'] ?? null;
        return in_array($gender, ['m', 'f'], true) ? $gender : null;
    }

    public function saveGender(string $email, string $gender): void
    {
        if (!in_array($gender, ['m', 'f'], true)) return;

        $data           = $this->load($email);
        $data['gender'] = $gender;
        $this->save($email, $data);
    }

    private function load(string $email): array
    {
        $file = $this->filePath($email);
        if (!file_exists($file)) return [];
        $json = file_get_contents($file);
        return json_decode($json ?: '{}', true) ?? [];
    }

    private function save(string $email, array $data): void
    {
        if (!is_dir($this->dataDir)) {
            mkdir($this->dataDir, 0755, true);
        }
        file_put_contents($this->filePath($email), json_encode($data, JSON_PRETTY_PRINT));
    }

    private function filePath(string $email): string
    {
        return $this->dataDir . hash('sha256', strtolower(trim($email))) . '.json';
    }
}
