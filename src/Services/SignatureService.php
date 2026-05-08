<?php

namespace App\Services;

/**
 * Service de gestion des signatures
 */
class SignatureService
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Génère les données pour une signature
     */
    public function generateSignatureData(array $params, array $user): array
    {
        $style = $params['style'] ?? 'gmail';
        $type = $params['type'] ?? 'personal';
        
        if ($type === 'service') {
            return $this->generateServiceSignature($params);
        }
        
        return $this->generatePersonalSignature($params, $user);
    }

    /**
     * Génère une signature de service
     */
    private function generateServiceSignature(array $params): array
    {
        $serviceKey = $params['service'] ?? '';
        $services = $this->config['services'] ?? [];
        
        if (!isset($services[$serviceKey]) || !is_array($services[$serviceKey])) {
            throw new \InvalidArgumentException('Service invalide');
        }
        
        $service = $services[$serviceKey];
        
        return [
            'name' => htmlspecialchars($service['name'] ?? ''),
            'email' => htmlspecialchars($service['email'] ?? ''),
            'job' => '',
            'phone' => htmlspecialchars($service['phone'] ?? ''),
            'type' => 'service',
        ];
    }

    /**
     * Génère une signature personnelle
     */
    private function generatePersonalSignature(array $params, array $user): array
    {
        return [
            'name' => htmlspecialchars($params['name'] ?? $user['name']),
            'job' => htmlspecialchars($params['job'] ?? ''),
            'email' => htmlspecialchars($params['email'] ?? $user['email']),
            'phone' => htmlspecialchars($params['phone'] ?? ''),
            'type' => 'personal',
        ];
    }

    /**
     * Valide le style de signature
     */
    public function validateStyle(string $style): string
    {
        $allowedStyles = ['gmail', 'outlook', 'dolibarr'];
        return in_array($style, $allowedStyles) ? $style : 'gmail';
    }

    /**
     * Sauvegarde une signature en tant qu'image
     */
    public function saveSignature(string $imageData, string $filename): array
    {
        // Décoder l'image base64
        $imageData = preg_replace('/^data:image\/\w+;base64,/', '', $imageData);
        $imageData = base64_decode($imageData);
        
        if (!$imageData) {
            throw new \InvalidArgumentException('Image invalide');
        }
        
        // Créer le dossier uploads s'il n'existe pas
        $uploadDir = __DIR__ . '/../../uploads/signatures/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        // Générer un nom unique
        $uniqueId = uniqid() . '_' . bin2hex(random_bytes(4));
        $safeFilename = preg_replace('/[^a-z0-9_-]/i', '_', $filename);
        $finalFilename = $safeFilename . '_' . $uniqueId . '.png';
        $filePath = $uploadDir . $finalFilename;
        
        // Sauvegarder l'image
        if (file_put_contents($filePath, $imageData) === false) {
            throw new \RuntimeException('Erreur lors de la sauvegarde');
        }
        
        // Générer l'URL publique
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $publicUrl = $protocol . '://' . $host . '/uploads/signatures/' . $finalFilename;
        
        return [
            'url' => $publicUrl,
            'filename' => $finalFilename,
        ];
    }
}
