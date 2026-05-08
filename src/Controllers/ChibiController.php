<?php

namespace App\Controllers;

/**
 * Contrôleur pour le générateur de Chibi
 */
class ChibiController
{
    /**
     * Affiche le générateur de chibi
     */
    public function show(): void
    {
        session_start();
        
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            exit;
        }
        
        include __DIR__ . '/../../views/chibi.php';
    }
}
