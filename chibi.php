<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

$config = require __DIR__ . '/config.php';

// Si pas connecté, rediriger vers la page de login
if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit;
}

// Afficher le générateur de chibi
include __DIR__ . '/views/chibi.php';
