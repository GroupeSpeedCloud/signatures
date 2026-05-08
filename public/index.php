<?php
/**
 * Point d'entrée unique de l'application
 * 
 * Toutes les requêtes passent par ce fichier
 */

// Activer les erreurs en développement
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Démarrer la session
session_start();

// Charger l'autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Charger la configuration
$config = require __DIR__ . '/../config.php';

// Initialiser le routeur
$router = new \App\Router($config);

// Dispatcher la requête
$router->dispatch();

// Initialiser le routeur
$router = new \App\Router($config);

// Dispatcher la requête
$router->dispatch();
