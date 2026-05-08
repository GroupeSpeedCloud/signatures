<?php

namespace App\Controllers;

use App\Services\SignatureService;

/**
 * Contrôleur de signatures
 */
class SignatureController
{
    private SignatureService $signatureService;
    private array $config;

    public function __construct(SignatureService $signatureService, array $config)
    {
        $this->signatureService = $signatureService;
        $this->config = $config;
    }

    /**
     * Affiche le générateur de signatures
     */
    public function showGenerator(): void
    {
        $user = $_SESSION['user'];
        $services = $this->config['services'] ?? [];
        $jobs = $this->config['jobs'] ?? [];
        
        include __DIR__ . '/../../views/generator.php';
    }

    /**
     * Génère et affiche une signature
     */
    public function render(): void
    {
        session_start();
        
        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            exit('Non autorisé');
        }

        $params = array_merge($_GET, $_POST);
        $signatureData = $this->signatureService->generateSignatureData($params, $_SESSION['user']);
        
        $style = $this->signatureService->validateStyle($params['style'] ?? 'gmail');
        $company = $this->config['company'];
        
        // Charger le template
        $templateFile = __DIR__ . "/../../templates/{$style}.php";
        if (!file_exists($templateFile)) {
            $templateFile = __DIR__ . '/../../templates/gmail.php';
        }
        
        include $templateFile;
    }

    /**
     * Sauvegarde une signature (API)
     */
    public function upload(): void
    {
        session_start();
        
        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Non autorisé']);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Méthode non autorisée']);
            exit;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $imageData = $input['image'] ?? null;
        $filename = $input['filename'] ?? 'signature';

        if (!$imageData) {
            http_response_code(400);
            echo json_encode(['error' => 'Aucune image fournie']);
            exit;
        }

        try {
            $result = $this->signatureService->saveSignature($imageData, $filename);
            
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'url' => $result['url'],
                'filename' => $result['filename']
            ]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
