<?php

namespace App\Services;

class SignatureService
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function generateSignatureData(array $params, array $user): array
    {
        $type = $params['type'] ?? 'personal';

        if ($type === 'service') {
            return $this->generateServiceSignature($params);
        }

        return $this->generatePersonalSignature($params, $user);
    }

    private function generatePersonalSignature(array $params, array $user): array
    {
        return [
            'name'     => $this->sanitize($params['name']     ?? $user['name']),
            'job'      => $this->sanitize($params['job']      ?? ''),
            'email'    => $this->sanitize($params['email']    ?? $user['email']),
            'phone'    => $this->sanitize($params['phone']    ?? ''),
            'linkedin' => $this->sanitizeUrl($params['linkedin'] ?? ''),
            'type'     => 'personal',
        ];
    }

    private function generateServiceSignature(array $params): array
    {
        $serviceKey = $params['service'] ?? '';
        $services   = $this->config['services'] ?? [];

        if (!isset($services[$serviceKey]) || !is_array($services[$serviceKey])) {
            throw new \InvalidArgumentException('Service invalide');
        }

        $service = $services[$serviceKey];

        return [
            'name'     => $this->sanitize($service['name']  ?? ''),
            'job'      => '',
            'email'    => $this->sanitize($service['email'] ?? ''),
            'phone'    => $this->sanitize($service['phone'] ?? ''),
            'linkedin' => '',
            'type'     => 'service',
        ];
    }

    public function validateStyle(string $style): string
    {
        return in_array($style, ['gmail', 'outlook', 'dolibarr'], true) ? $style : 'gmail';
    }

    public function saveSignature(string $imageData, string $filename): array
    {
        $imageData = preg_replace('/^data:image\/\w+;base64,/', '', $imageData);
        $decoded   = base64_decode($imageData, true);

        if ($decoded === false) {
            throw new \InvalidArgumentException('Image invalide');
        }

        $uploadDir = __DIR__ . '/../../uploads/signatures/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $uniqueId      = uniqid() . '_' . bin2hex(random_bytes(4));
        $safeFilename  = preg_replace('/[^a-z0-9_-]/i', '_', $filename);
        $finalFilename = $safeFilename . '_' . $uniqueId . '.png';
        $filePath      = $uploadDir . $finalFilename;

        if (file_put_contents($filePath, $decoded) === false) {
            throw new \RuntimeException('Erreur lors de la sauvegarde');
        }

        $protocol  = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $publicUrl = $protocol . '://' . $_SERVER['HTTP_HOST'] . '/uploads/signatures/' . $finalFilename;

        return [
            'url'      => $publicUrl,
            'filename' => $finalFilename,
        ];
    }

    private function sanitize(string $value): string
    {
        return htmlspecialchars(trim($value), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    private function sanitizeUrl(string $url): string
    {
        $url = trim($url);
        if ($url === '') return '';
        $parsed = parse_url($url);
        if (!isset($parsed['scheme']) || !in_array($parsed['scheme'], ['http', 'https'], true)) return '';
        return htmlspecialchars($url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }
}
