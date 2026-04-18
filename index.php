<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

$config = require __DIR__ . '/config.php';

// Si déjà connecté, afficher le générateur
if (isset($_SESSION['user'])) {
    include __DIR__ . '/views/generator.php';
    exit;
}

// Créer le client Google
$client = new Google\Client();
$client->setClientId($config['google']['client_id']);
$client->setClientSecret($config['google']['client_secret']);
$client->setRedirectUri($config['google']['redirect_uri']);
$client->addScope('email');
$client->addScope('profile');
$client->setHostedDomain($config['google']['hosted_domain']);

$authUrl = $client->createAuthUrl();
?>
<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#141218">
    <title>Signatures - Groupe Speed Cloud</title>
    
    <!-- Material Design 3 -->
    <link rel="stylesheet" href="/assets/css/material-design.css">
    <link rel="icon" type="image/png" href="https://sign.groupe-speed.cloud/assets/images/cloudy.png">
    
    <!-- Google Fonts - Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Material Symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    
    <style>
        html, body {
            min-height: 100dvh;
        }
        
        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100dvh;
            padding: var(--md-sys-spacing-6);
        }
        
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: var(--md-sys-spacing-8);
            text-align: center;
            animation: cardEnter 0.5s var(--md-sys-motion-easing-emphasized-decelerate);
        }
        
        @keyframes cardEnter {
            from {
                opacity: 0;
                transform: translateY(24px) scale(0.96);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        .logo-container {
            position: relative;
            margin-bottom: var(--md-sys-spacing-6);
        }
        
        .logo {
            width: 96px;
            height: 96px;
            border-radius: var(--md-sys-shape-corner-extra-large);
            box-shadow: var(--md-sys-elevation-level3);
            animation: logoFloat 3s ease-in-out infinite;
        }
        
        @keyframes logoFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        
        .logo-glow {
            position: absolute;
            inset: -16px;
            border-radius: var(--md-sys-shape-corner-full);
            background: radial-gradient(circle, var(--md-sys-color-primary) 0%, transparent 70%);
            opacity: 0.2;
            filter: blur(20px);
            z-index: -1;
            animation: glowPulse 3s ease-in-out infinite;
        }
        
        @keyframes glowPulse {
            0%, 100% { opacity: 0.2; transform: scale(1); }
            50% { opacity: 0.3; transform: scale(1.1); }
        }
        
        .headline {
            color: var(--md-sys-color-on-surface);
            margin-bottom: var(--md-sys-spacing-2);
        }
        
        .supporting-text {
            color: var(--md-sys-color-on-surface-variant);
            margin-bottom: var(--md-sys-spacing-8);
        }
        
        .google-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: var(--md-sys-spacing-3);
            width: 100%;
            min-height: 56px;
            padding: 0 var(--md-sys-spacing-6);
            border: none;
            border-radius: var(--md-sys-shape-corner-full);
            background-color: var(--md-sys-color-surface-container-high);
            color: var(--md-sys-color-on-surface);
            font: var(--md-sys-typescale-label-large);
            text-decoration: none;
            cursor: pointer;
            transition: background-color var(--md-sys-motion-duration-short4) var(--md-sys-motion-easing-standard),
                        box-shadow var(--md-sys-motion-duration-short3) var(--md-sys-motion-easing-standard),
                        transform var(--md-sys-motion-duration-short2) var(--md-sys-motion-easing-emphasized);
            box-shadow: var(--md-sys-elevation-level1);
        }
        
        .google-button:hover {
            background-color: var(--md-sys-color-surface-container-highest);
            box-shadow: var(--md-sys-elevation-level2);
        }
        
        .google-button:active {
            transform: scale(0.98);
        }
        
        .google-button:focus-visible {
            outline: 2px solid var(--md-sys-color-primary);
            outline-offset: 2px;
        }
        
        .google-logo {
            width: 20px;
            height: 20px;
        }
        
        .footer-text {
            color: var(--md-sys-color-outline);
            margin-top: var(--md-sys-spacing-8);
        }
        
        /* Decorative elements */
        .decoration {
            position: fixed;
            pointer-events: none;
            z-index: -1;
        }
        
        .decoration-1 {
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            border-radius: var(--md-sys-shape-corner-full);
            background: radial-gradient(circle, var(--md-sys-color-primary-container) 0%, transparent 70%);
            opacity: 0.3;
            filter: blur(60px);
        }
        
        .decoration-2 {
            bottom: -150px;
            left: -150px;
            width: 500px;
            height: 500px;
            border-radius: var(--md-sys-shape-corner-full);
            background: radial-gradient(circle, var(--md-sys-color-tertiary-container) 0%, transparent 70%);
            opacity: 0.2;
            filter: blur(80px);
        }
    </style>
</head>
<body>
    <!-- Decorative backgrounds -->
    <div class="decoration decoration-1" aria-hidden="true"></div>
    <div class="decoration decoration-2" aria-hidden="true"></div>
    
    <main class="login-container">
        <div class="login-card md-card--elevated md-surface-container-low">
            <!-- Logo -->
            <div class="logo-container">
                <div class="logo-glow" aria-hidden="true"></div>
                <img src="/assets/images/cloudy.png" alt="" class="logo" aria-hidden="true">
            </div>
            
            <!-- Content -->
            <h1 class="headline headline-medium">Groupe Speed Cloud</h1>
            <p class="supporting-text body-medium">Générateur de signatures email professionnelles</p>
            
            <!-- Login Button -->
            <a href="<?= htmlspecialchars($authUrl) ?>" class="google-button" role="button">
                <svg class="google-logo" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                <span>Se connecter avec Google</span>
            </a>
            
            <!-- Footer -->
            <p class="footer-text label-medium">Réservé aux collaborateurs de l'association</p>
        </div>
    </main>
    
    <script>
        // Theme detection (auto switch based on system preference)
        const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
        const updateTheme = (e) => {
            document.documentElement.setAttribute('data-theme', e.matches ? 'dark' : 'light');
            document.querySelector('meta[name="theme-color"]').content = e.matches ? '#141218' : '#fffbff';
        };
        mediaQuery.addEventListener('change', updateTheme);
        // Default to dark for brand consistency
    </script>
</body>
</html>
