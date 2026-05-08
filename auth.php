<?php
/**
 * Fichier de compatibilité - utilise le nouveau middleware
 * Ce fichier sera supprimé dans une future version
 */
require_once __DIR__ . '/src/Middleware/AuthMiddleware.php';

$middleware = new \App\Middleware\AuthMiddleware();
$middleware->handle();
