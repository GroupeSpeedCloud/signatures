<?php
$user = $_SESSION['user'];
$config = require __DIR__ . '/../config.php';
$currentPage = 'avatar';
$jobs = $config['jobs'] ?? [];
?>
<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#141218">
    <title>Badge Professionnel - Groupe Speed Cloud</title>
    
    <!-- Material Design 3 -->
    <link rel="stylesheet" href="/assets/css/material-design.css">
    <link rel="icon" type="image/png" href="https://sign.groupe-speed.cloud/assets/images/cloudy.png">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    
    <style>
        .material-symbols-rounded {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        
        /* Navigation Rail Logo */
        .nav-logo {
            width: 48px;
            height: 48px;
            border-radius: var(--md-sys-shape-corner-large);
            margin-bottom: var(--md-sys-spacing-4);
        }
        
        /* Main content area */
        .main-content {
            padding: var(--md-sys-spacing-4);
            padding-bottom: 96px;
        }
        
        @media (min-width: 640px) {
            .main-content {
                margin-left: 80px;
                padding: var(--md-sys-spacing-6);
                padding-bottom: var(--md-sys-spacing-6);
            }
        }
        
        /* Page header */
        .page-header {
            margin-bottom: var(--md-sys-spacing-6);
        }
        
        /* Two column layout */
        .badge-layout {
            display: grid;
            gap: var(--md-sys-spacing-6);
        }
        
        @media (min-width: 1024px) {
            .badge-layout {
                grid-template-columns: 1fr 1fr;
            }
        }
        
        /* Options card */
        .options-card {
            padding: var(--md-sys-spacing-6);
            animation: slideUp 0.4s var(--md-sys-motion-easing-emphasized-decelerate);
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .options-title {
            display: flex;
            align-items: center;
            gap: var(--md-sys-spacing-2);
            color: var(--md-sys-color-on-surface);
            margin-bottom: var(--md-sys-spacing-6);
        }
        
        /* Form fields */
        .form-fields {
            display: flex;
            flex-direction: column;
            gap: var(--md-sys-spacing-5);
        }
        
        .field-container {
            display: flex;
            flex-direction: column;
            gap: var(--md-sys-spacing-2);
        }
        
        .field-label {
            font: var(--md-sys-typescale-label-large);
            color: var(--md-sys-color-on-surface-variant);
        }
        
        /* Style selection */
        .style-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: var(--md-sys-spacing-2);
        }
        
        .style-option {
            cursor: pointer;
        }
        
        .style-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }
        
        .style-option-content {
            padding: var(--md-sys-spacing-3);
            background-color: var(--md-sys-color-surface-container);
            border: 2px solid var(--md-sys-color-outline-variant);
            border-radius: var(--md-sys-shape-corner-medium);
            text-align: center;
            transition: all var(--md-sys-motion-duration-short3) var(--md-sys-motion-easing-standard);
        }
        
        .style-option input:checked + .style-option-content {
            border-color: var(--md-sys-color-primary);
            background-color: var(--md-sys-color-primary-container);
        }
        
        .style-option:hover .style-option-content {
            background-color: var(--md-sys-color-surface-container-high);
        }
        
        .style-option input:checked + .style-option-content:hover {
            background-color: var(--md-sys-color-primary-container);
        }
        
        .style-option-text {
            font: var(--md-sys-typescale-label-medium);
            color: var(--md-sys-color-on-surface);
        }
        
        /* Color selection */
        .color-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: var(--md-sys-spacing-2);
        }
        
        .color-option {
            cursor: pointer;
        }
        
        .color-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }
        
        .color-swatch {
            width: 100%;
            aspect-ratio: 1;
            border-radius: var(--md-sys-shape-corner-medium);
            border: 2px solid var(--md-sys-color-outline-variant);
            transition: all var(--md-sys-motion-duration-short3) var(--md-sys-motion-easing-standard);
        }
        
        .color-option input:checked + .color-swatch {
            border-color: var(--md-sys-color-primary);
            box-shadow: 0 0 0 2px var(--md-sys-color-surface), 0 0 0 4px var(--md-sys-color-primary);
        }
        
        .color-swatch--transparent {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Crect width='4' height='4' fill='%23ccc'/%3E%3Crect x='4' y='4' width='4' height='4' fill='%23ccc'/%3E%3C/svg%3E");
        }
        
        /* Slider field */
        .slider-container {
            display: flex;
            flex-direction: column;
            gap: var(--md-sys-spacing-2);
        }
        
        .slider-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .slider-value {
            font: var(--md-sys-typescale-label-medium);
            color: var(--md-sys-color-primary);
            background-color: var(--md-sys-color-primary-container);
            padding: var(--md-sys-spacing-1) var(--md-sys-spacing-2);
            border-radius: var(--md-sys-shape-corner-small);
        }
        
        /* Switch field */
        .switch-field {
            display: flex;
            align-items: center;
            gap: var(--md-sys-spacing-3);
        }
        
        /* Preview card */
        .preview-card {
            padding: var(--md-sys-spacing-6);
            animation: slideUp 0.5s var(--md-sys-motion-easing-emphasized-decelerate);
            animation-delay: 0.1s;
            animation-fill-mode: backwards;
        }
        
        .preview-title {
            display: flex;
            align-items: center;
            gap: var(--md-sys-spacing-2);
            color: var(--md-sys-color-on-surface);
            margin-bottom: var(--md-sys-spacing-6);
        }
        
        .canvas-container {
            display: flex;
            justify-content: center;
            margin-bottom: var(--md-sys-spacing-6);
        }
        
        .canvas-wrapper {
            background-color: var(--md-sys-color-surface-container);
            border-radius: var(--md-sys-shape-corner-extra-large);
            padding: var(--md-sys-spacing-4);
            border: 1px solid var(--md-sys-color-outline-variant);
        }
        
        #badgeCanvas {
            border-radius: var(--md-sys-shape-corner-large);
            display: block;
        }
        
        /* Info card */
        .info-card {
            background-color: var(--md-sys-color-primary-container);
            border-radius: var(--md-sys-shape-corner-large);
            padding: var(--md-sys-spacing-4);
            margin-top: var(--md-sys-spacing-6);
        }
        
        .info-card-title {
            display: flex;
            align-items: center;
            gap: var(--md-sys-spacing-2);
            color: var(--md-sys-color-on-primary-container);
            margin-bottom: var(--md-sys-spacing-2);
        }
        
        .info-list {
            color: var(--md-sys-color-on-primary-container);
            padding-left: var(--md-sys-spacing-5);
        }
        
        .info-list li {
            margin-bottom: var(--md-sys-spacing-1);
        }
        
        /* Custom input for dark theme */
        .md-input-dark {
            width: 100%;
            height: 56px;
            padding: var(--md-sys-spacing-4);
            border: 1px solid var(--md-sys-color-outline);
            border-radius: var(--md-sys-shape-corner-small);
            background-color: var(--md-sys-color-surface-container);
            color: var(--md-sys-color-on-surface);
            font: var(--md-sys-typescale-body-large);
            transition: border-color var(--md-sys-motion-duration-short3) var(--md-sys-motion-easing-standard),
                        background-color var(--md-sys-motion-duration-short3) var(--md-sys-motion-easing-standard);
        }
        
        .md-input-dark:hover {
            border-color: var(--md-sys-color-on-surface);
        }
        
        .md-input-dark:focus {
            outline: none;
            border-color: var(--md-sys-color-primary);
            border-width: 2px;
        }
        
        .md-input-dark::placeholder {
            color: var(--md-sys-color-on-surface-variant);
        }
        
        /* User section */
        .user-section {
            margin-top: auto;
            padding: var(--md-sys-spacing-3);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: var(--md-sys-spacing-2);
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: var(--md-sys-shape-corner-full);
            border: 2px solid var(--md-sys-color-outline-variant);
        }
        
        /* Mobile top bar */
        .mobile-top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: var(--md-sys-spacing-3) var(--md-sys-spacing-4);
            background-color: var(--md-sys-color-surface);
            position: sticky;
            top: 0;
            z-index: 50;
        }
        
        @media (min-width: 640px) {
            .mobile-top-bar {
                display: none;
            }
        }
        
        .mobile-logo {
            display: flex;
            align-items: center;
            gap: var(--md-sys-spacing-3);
            text-decoration: none;
            color: var(--md-sys-color-on-surface);
        }
        
        .mobile-logo img {
            width: 36px;
            height: 36px;
            border-radius: var(--md-sys-shape-corner-medium);
        }
        
        /* Footer */
        .footer {
            text-align: center;
            padding: var(--md-sys-spacing-6);
            color: var(--md-sys-color-outline);
        }
        
        /* Snackbar */
        @media (max-width: 639px) {
            .md-snackbar {
                bottom: 96px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Rail (Desktop) -->
    <nav class="md-navigation-rail" aria-label="Navigation principale">
        <a href="/" aria-label="Accueil">
            <img src="/assets/images/cloudy.png" alt="" class="nav-logo">
        </a>
        
        <a href="/" class="md-navigation-rail__item <?= $currentPage === 'signatures' ? 'active' : '' ?>">
            <span class="md-navigation-rail__icon">
                <span class="material-symbols-rounded">edit_note</span>
            </span>
            <span class="md-navigation-rail__label">Signature</span>
        </a>
        
        <a href="/chibi.php" class="md-navigation-rail__item <?= $currentPage === 'avatar' ? 'active' : '' ?>" aria-current="<?= $currentPage === 'avatar' ? 'page' : 'false' ?>">
            <span class="md-navigation-rail__icon">
                <span class="material-symbols-rounded">badge</span>
            </span>
            <span class="md-navigation-rail__label">Badge</span>
        </a>
        
        <div class="user-section">
            <?php if (!empty($user['picture'])): ?>
            <img src="<?= htmlspecialchars($user['picture']) ?>" alt="" class="user-avatar">
            <?php endif; ?>
            <a href="/logout.php" class="md-icon-button" title="Déconnexion" aria-label="Déconnexion">
                <span class="material-symbols-rounded">logout</span>
            </a>
        </div>
    </nav>
    
    <!-- Navigation Bar (Mobile) -->
    <nav class="md-navigation-bar" aria-label="Navigation principale">
        <a href="/" class="md-navigation-bar__item <?= $currentPage === 'signatures' ? 'active' : '' ?>">
            <span class="md-navigation-bar__icon">
                <span class="material-symbols-rounded">edit_note</span>
            </span>
            <span class="md-navigation-bar__label">Signature</span>
        </a>
        
        <a href="/chibi.php" class="md-navigation-bar__item <?= $currentPage === 'avatar' ? 'active' : '' ?>" aria-current="<?= $currentPage === 'avatar' ? 'page' : 'false' ?>">
            <span class="md-navigation-bar__icon">
                <span class="material-symbols-rounded">badge</span>
            </span>
            <span class="md-navigation-bar__label">Badge</span>
        </a>
    </nav>
    
    <!-- Mobile Top Bar -->
    <header class="mobile-top-bar">
        <a href="/" class="mobile-logo">
            <img src="/assets/images/cloudy.png" alt="">
            <span class="title-medium">Speed Cloud</span>
        </a>
        <div class="flex items-center gap-2">
            <?php if (!empty($user['picture'])): ?>
            <img src="<?= htmlspecialchars($user['picture']) ?>" alt="" class="user-avatar" style="width: 32px; height: 32px;">
            <?php endif; ?>
            <a href="/logout.php" class="md-icon-button" title="Déconnexion" aria-label="Déconnexion">
                <span class="material-symbols-rounded">logout</span>
            </a>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="main-content">
        <div class="md-container max-w-4xl">
            <!-- Page Header -->
            <header class="page-header">
                <h1 class="headline-large" style="color: var(--md-sys-color-on-surface);">Badge Professionnel</h1>
                <p class="body-medium" style="color: var(--md-sys-color-on-surface-variant); margin-top: var(--md-sys-spacing-1);">
                    Créez votre badge d'identification pour l'association
                </p>
            </header>
            
            <!-- Two Column Layout -->
            <div class="badge-layout">
                
                <!-- Options Card -->
                <div class="options-card md-card--elevated md-surface-container-low">
                    <h2 class="options-title title-large">
                        <span class="material-symbols-rounded">tune</span>
                        Personnalisation
                    </h2>
                    
                    <form id="badgeForm" class="form-fields">
                        <!-- Name -->
                        <div class="field-container">
                            <label for="name" class="field-label">Nom complet</label>
                            <input type="text" id="name" value="<?= htmlspecialchars($user['name']) ?>" 
                                class="md-input-dark" autocomplete="name">
                        </div>
                        
                        <!-- Job -->
                        <div class="field-container">
                            <label for="badgeJob" class="field-label">Poste</label>
                            <select id="badgeJob" class="md-input-dark" style="cursor: pointer;">
                                <option value="">Sans poste</option>
                                <?php foreach ($jobs as $key => $label): 
                                    if ($key && $key !== '__autre__'):
                                ?>
                                <option value="<?= htmlspecialchars($label) ?>"><?= htmlspecialchars($label) ?></option>
                                <?php endif; endforeach; ?>
                            </select>
                        </div>
                        
                        <!-- Style -->
                        <div class="field-container">
                            <span class="field-label">Style</span>
                            <div class="style-grid">
                                <label class="style-option">
                                    <input type="radio" name="badgeStyle" value="modern" checked>
                                    <div class="style-option-content">
                                        <span class="style-option-text">Moderne</span>
                                    </div>
                                </label>
                                <label class="style-option">
                                    <input type="radio" name="badgeStyle" value="gradient">
                                    <div class="style-option-content">
                                        <span class="style-option-text">Dégradé</span>
                                    </div>
                                </label>
                                <label class="style-option">
                                    <input type="radio" name="badgeStyle" value="neon">
                                    <div class="style-option-content">
                                        <span class="style-option-text">Néon</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Background Color -->
                        <div class="field-container">
                            <span class="field-label">Fond</span>
                            <div class="color-grid">
                                <label class="color-option">
                                    <input type="radio" name="bgColor" value="transparent" checked>
                                    <div class="color-swatch color-swatch--transparent"></div>
                                </label>
                                <label class="color-option">
                                    <input type="radio" name="bgColor" value="ffffff">
                                    <div class="color-swatch" style="background: #ffffff;"></div>
                                </label>
                                <label class="color-option">
                                    <input type="radio" name="bgColor" value="8a4dfd">
                                    <div class="color-swatch" style="background: #8a4dfd;"></div>
                                </label>
                                <label class="color-option">
                                    <input type="radio" name="bgColor" value="1a1a2e">
                                    <div class="color-swatch" style="background: #1a1a2e;"></div>
                                </label>
                                <label class="color-option">
                                    <input type="radio" name="bgColor" value="0f172a">
                                    <div class="color-swatch" style="background: #0f172a;"></div>
                                </label>
                                <label class="color-option">
                                    <input type="radio" name="bgColor" value="f8fafc">
                                    <div class="color-swatch" style="background: #f8fafc;"></div>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Size Slider -->
                        <div class="field-container">
                            <div class="slider-header">
                                <span class="field-label">Taille</span>
                                <span id="sizeValue" class="slider-value">256px</span>
                            </div>
                            <input type="range" id="size" min="128" max="512" value="256" class="md-slider">
                        </div>
                        
                        <!-- Show Cloudy Switch -->
                        <div class="switch-field">
                            <label class="md-switch">
                                <input type="checkbox" id="showCloudy" class="md-switch__input" checked>
                                <span class="md-switch__track"></span>
                                <span class="md-switch__thumb"></span>
                            </label>
                            <label for="showCloudy" class="field-label" style="cursor: pointer;">Afficher l'anneau Speed Cloud</label>
                        </div>
                    </form>
                </div>
                
                <!-- Preview Card -->
                <div class="preview-card md-card--elevated md-surface-container-low">
                    <h2 class="preview-title title-large">
                        <span class="material-symbols-rounded">visibility</span>
                        Aperçu
                    </h2>
                    
                    <div class="canvas-container">
                        <div class="canvas-wrapper">
                            <canvas id="badgeCanvas"></canvas>
                        </div>
                    </div>
                    
                    <button id="downloadPng" class="md-button--filled md-button w-full" style="min-height: 48px;">
                        <span class="material-symbols-rounded">download</span>
                        Télécharger PNG
                    </button>
                    
                    <!-- Info Card -->
                    <div class="info-card">
                        <h3 class="info-card-title title-small">
                            <span class="material-symbols-rounded">lightbulb</span>
                            Utilisation
                        </h3>
                        <ul class="info-list body-small">
                            <li>Photo de profil Gmail / Slack</li>
                            <li>Avatar pour les outils internes</li>
                            <li>Badge d'identification</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <footer class="footer">
                <p class="body-small">© <?= date('Y') ?> Association Groupe Speed Cloud — Tous droits réservés</p>
            </footer>
        </div>
    </main>
    
    <!-- Snackbar -->
    <div id="snackbar" class="md-snackbar hidden" role="alert" aria-live="polite">
        <span class="md-snackbar__text" id="snackbarText"></span>
    </div>

    <script>
        const badgeCanvas = document.getElementById('badgeCanvas');
        const nameInput = document.getElementById('name');
        const sizeInput = document.getElementById('size');
        const sizeValue = document.getElementById('sizeValue');
        const snackbar = document.getElementById('snackbar');
        const snackbarText = document.getElementById('snackbarText');
        
        const cloudyLogo = new Image();
        cloudyLogo.crossOrigin = 'anonymous';
        cloudyLogo.src = 'https://sign.groupe-speed.cloud/assets/images/cloudy.png';
        cloudyLogo.onload = () => drawBadge();
        
        // Snackbar utility
        function showSnackbar(message, duration = 3000) {
            snackbarText.textContent = message;
            snackbar.classList.remove('hidden');
            setTimeout(() => {
                snackbar.classList.add('hidden');
            }, duration);
        }
        
        function getInitials(name) {
            return name.split(' ').map(word => word[0]).join('').toUpperCase().substring(0, 2);
        }
        
        function stringToColor(str) {
            let hash = 0;
            for (let i = 0; i < str.length; i++) {
                hash = str.charCodeAt(i) + ((hash << 5) - hash);
            }
            const colors = ['#8a4dfd', '#6366f1', '#ec4899', '#10b981', '#f59e0b', '#ef4444', '#06b6d4'];
            return colors[Math.abs(hash) % colors.length];
        }
        
        function lightenColor(hex, percent) {
            const num = parseInt(hex.replace('#', ''), 16);
            const amt = Math.round(2.55 * percent);
            const R = Math.min(255, (num >> 16) + amt);
            const G = Math.min(255, ((num >> 8) & 0x00FF) + amt);
            const B = Math.min(255, (num & 0x0000FF) + amt);
            return '#' + (0x1000000 + R * 0x10000 + G * 0x100 + B).toString(16).slice(1);
        }
        
        function darkenColor(hex, percent) {
            const num = parseInt(hex.replace('#', ''), 16);
            const amt = Math.round(2.55 * percent);
            const R = Math.max(0, (num >> 16) - amt);
            const G = Math.max(0, ((num >> 8) & 0x00FF) - amt);
            const B = Math.max(0, (num & 0x0000FF) - amt);
            return '#' + (0x1000000 + R * 0x10000 + G * 0x100 + B).toString(16).slice(1);
        }
        
        function drawBadge() {
            const size = parseInt(sizeInput.value);
            const name = nameInput.value || 'Membre';
            const initials = getInitials(name);
            const badgeStyle = document.querySelector('input[name="badgeStyle"]:checked')?.value || 'modern';
            const job = document.getElementById('badgeJob')?.value || '';
            const showCloudy = document.getElementById('showCloudy')?.checked ?? true;
            const bgColor = document.querySelector('input[name="bgColor"]:checked').value;
            
            badgeCanvas.width = size;
            badgeCanvas.height = size;
            const ctx = badgeCanvas.getContext('2d');
            
            // Background
            if (bgColor === 'transparent') {
                ctx.clearRect(0, 0, size, size);
            } else {
                ctx.fillStyle = '#' + bgColor;
                ctx.fillRect(0, 0, size, size);
            }
            
            const primaryColor = stringToColor(name);
            const centerX = size / 2;
            const centerY = size / 2;
            const radius = size * 0.36;
            
            // Ring config
            const ringWidth = size * 0.045;
            const ringRadius = radius + ringWidth / 2 + size * 0.015;
            
            // Global shadow
            if (showCloudy) {
                ctx.save();
                ctx.shadowColor = 'rgba(138, 77, 253, 0.4)';
                ctx.shadowBlur = size * 0.06;
                ctx.shadowOffsetY = size * 0.015;
                ctx.beginPath();
                ctx.arc(centerX, centerY, ringRadius + ringWidth / 2, 0, Math.PI * 2);
                ctx.fillStyle = 'rgba(138, 77, 253, 0.01)';
                ctx.fill();
                ctx.restore();
            }
            
            // Premium ring
            if (showCloudy && cloudyLogo.complete) {
                ctx.save();
                
                const ringGradient = ctx.createLinearGradient(
                    centerX - ringRadius, centerY - ringRadius,
                    centerX + ringRadius, centerY + ringRadius
                );
                ringGradient.addColorStop(0, '#a855f7');
                ringGradient.addColorStop(0.3, '#8a4dfd');
                ringGradient.addColorStop(0.5, '#7c3aed');
                ringGradient.addColorStop(0.7, '#8a4dfd');
                ringGradient.addColorStop(1, '#6d28d9');
                
                ctx.beginPath();
                ctx.arc(centerX, centerY, ringRadius + ringWidth / 2, 0, Math.PI * 2);
                ctx.arc(centerX, centerY, ringRadius - ringWidth / 2, 0, Math.PI * 2, true);
                ctx.fillStyle = ringGradient;
                ctx.fill();
                
                // Highlight
                ctx.beginPath();
                ctx.arc(centerX, centerY, ringRadius + ringWidth / 2 - 1, 0, Math.PI * 2);
                ctx.arc(centerX, centerY, ringRadius - ringWidth / 2 + 1, 0, Math.PI * 2, true);
                const highlightGradient = ctx.createLinearGradient(0, centerY - ringRadius, 0, centerY);
                highlightGradient.addColorStop(0, 'rgba(255, 255, 255, 0.5)');
                highlightGradient.addColorStop(0.5, 'rgba(255, 255, 255, 0.1)');
                highlightGradient.addColorStop(1, 'rgba(255, 255, 255, 0)');
                ctx.fillStyle = highlightGradient;
                ctx.fill();
                
                ctx.restore();
            }
            
            // Main circle shadow
            ctx.save();
            ctx.shadowColor = 'rgba(0, 0, 0, 0.2)';
            ctx.shadowBlur = size * 0.03;
            ctx.shadowOffsetY = size * 0.01;
            ctx.beginPath();
            ctx.arc(centerX, centerY, radius, 0, Math.PI * 2);
            ctx.fillStyle = 'rgba(0,0,0,0.01)';
            ctx.fill();
            ctx.restore();
            
            // Style-specific rendering
            if (badgeStyle === 'modern') {
                const bgGradient = ctx.createRadialGradient(
                    centerX - radius * 0.3, centerY - radius * 0.3, 0,
                    centerX, centerY, radius * 1.2
                );
                bgGradient.addColorStop(0, lightenColor(primaryColor, 15));
                bgGradient.addColorStop(0.7, primaryColor);
                bgGradient.addColorStop(1, darkenColor(primaryColor, 15));
                
                ctx.beginPath();
                ctx.arc(centerX, centerY, radius, 0, Math.PI * 2);
                ctx.fillStyle = bgGradient;
                ctx.fill();
                
                ctx.beginPath();
                ctx.arc(centerX, centerY, radius, 0, Math.PI * 2);
                const highlight = ctx.createRadialGradient(
                    centerX - radius * 0.25, centerY - radius * 0.35, 0,
                    centerX, centerY, radius
                );
                highlight.addColorStop(0, 'rgba(255,255,255,0.35)');
                highlight.addColorStop(0.4, 'rgba(255,255,255,0.1)');
                highlight.addColorStop(1, 'rgba(255,255,255,0)');
                ctx.fillStyle = highlight;
                ctx.fill();
                
            } else if (badgeStyle === 'gradient') {
                const gradient = ctx.createLinearGradient(
                    centerX - radius, centerY - radius,
                    centerX + radius, centerY + radius
                );
                gradient.addColorStop(0, lightenColor(primaryColor, 10));
                gradient.addColorStop(0.5, '#8a4dfd');
                gradient.addColorStop(1, '#6d28d9');
                
                ctx.beginPath();
                ctx.arc(centerX, centerY, radius, 0, Math.PI * 2);
                ctx.fillStyle = gradient;
                ctx.fill();
                
                ctx.beginPath();
                ctx.arc(centerX, centerY, radius, 0, Math.PI * 2);
                const highlight = ctx.createRadialGradient(
                    centerX - radius * 0.3, centerY - radius * 0.3, 0,
                    centerX, centerY, radius
                );
                highlight.addColorStop(0, 'rgba(255,255,255,0.25)');
                highlight.addColorStop(0.5, 'rgba(255,255,255,0.05)');
                highlight.addColorStop(1, 'rgba(255,255,255,0)');
                ctx.fillStyle = highlight;
                ctx.fill();
                
            } else if (badgeStyle === 'neon') {
                ctx.save();
                ctx.shadowColor = primaryColor;
                ctx.shadowBlur = size * 0.1;
                ctx.beginPath();
                ctx.arc(centerX, centerY, radius * 0.95, 0, Math.PI * 2);
                ctx.strokeStyle = primaryColor;
                ctx.lineWidth = size * 0.025;
                ctx.stroke();
                ctx.restore();
                
                ctx.save();
                ctx.shadowColor = '#8a4dfd';
                ctx.shadowBlur = size * 0.05;
                ctx.beginPath();
                ctx.arc(centerX, centerY, radius * 0.88, 0, Math.PI * 2);
                ctx.strokeStyle = 'rgba(138, 77, 253, 0.5)';
                ctx.lineWidth = size * 0.01;
                ctx.stroke();
                ctx.restore();
                
                const innerGradient = ctx.createRadialGradient(centerX, centerY, 0, centerX, centerY, radius * 0.85);
                innerGradient.addColorStop(0, 'rgba(138, 77, 253, 0.15)');
                innerGradient.addColorStop(1, 'rgba(138, 77, 253, 0.05)');
                ctx.beginPath();
                ctx.arc(centerX, centerY, radius * 0.85, 0, Math.PI * 2);
                ctx.fillStyle = innerGradient;
                ctx.fill();
            }
            
            // Initials
            ctx.fillStyle = badgeStyle === 'neon' ? primaryColor : '#ffffff';
            ctx.font = `bold ${size * 0.28}px 'Roboto', Arial, sans-serif`;
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText(initials, centerX, job ? centerY - size * 0.06 : centerY);
            
            // Job title
            if (job) {
                ctx.fillStyle = badgeStyle === 'neon' ? '#ffffff' : 'rgba(255,255,255,0.9)';
                ctx.font = `500 ${size * 0.08}px 'Roboto', Arial, sans-serif`;
                const maxWidth = radius * 1.6;
                let fontSize = size * 0.08;
                ctx.font = `500 ${fontSize}px 'Roboto', Arial, sans-serif`;
                while (ctx.measureText(job).width > maxWidth && fontSize > size * 0.04) {
                    fontSize -= 1;
                    ctx.font = `500 ${fontSize}px 'Roboto', Arial, sans-serif`;
                }
                ctx.fillText(job, centerX, centerY + size * 0.14);
            }
            
            // Cloudy logo on ring
            if (showCloudy && cloudyLogo.complete) {
                ctx.save();
                
                const logoSize = size * 0.16;
                const logoAngle = Math.PI / 4 + Math.PI / 2;
                const logoCenterX = centerX + Math.cos(logoAngle) * ringRadius;
                const logoCenterY = centerY + Math.sin(logoAngle) * ringRadius;
                const logoBgRadius = logoSize / 2 + size * 0.018;
                
                ctx.shadowColor = 'rgba(0, 0, 0, 0.35)';
                ctx.shadowBlur = size * 0.025;
                ctx.shadowOffsetX = size * 0.005;
                ctx.shadowOffsetY = size * 0.008;
                
                ctx.beginPath();
                ctx.arc(logoCenterX, logoCenterY, logoBgRadius, 0, Math.PI * 2);
                ctx.fillStyle = '#ffffff';
                ctx.fill();
                
                ctx.shadowColor = 'transparent';
                ctx.shadowBlur = 0;
                ctx.shadowOffsetX = 0;
                ctx.shadowOffsetY = 0;
                
                const borderGradient = ctx.createLinearGradient(
                    logoCenterX - logoBgRadius, logoCenterY - logoBgRadius,
                    logoCenterX + logoBgRadius, logoCenterY + logoBgRadius
                );
                borderGradient.addColorStop(0, '#a855f7');
                borderGradient.addColorStop(0.5, '#8a4dfd');
                borderGradient.addColorStop(1, '#7c3aed');
                ctx.strokeStyle = borderGradient;
                ctx.lineWidth = size * 0.012;
                ctx.stroke();
                
                ctx.beginPath();
                ctx.arc(logoCenterX, logoCenterY, logoSize / 2, 0, Math.PI * 2);
                ctx.clip();
                ctx.drawImage(
                    cloudyLogo, 
                    logoCenterX - logoSize / 2, 
                    logoCenterY - logoSize / 2, 
                    logoSize, 
                    logoSize
                );
                
                ctx.restore();
            }
        }
        
        // Event listeners
        nameInput.addEventListener('input', drawBadge);
        sizeInput.addEventListener('input', () => {
            sizeValue.textContent = sizeInput.value + 'px';
            drawBadge();
        });
        document.querySelectorAll('input[name="bgColor"]').forEach(input => {
            input.addEventListener('change', drawBadge);
        });
        document.querySelectorAll('input[name="badgeStyle"]').forEach(input => {
            input.addEventListener('change', drawBadge);
        });
        document.getElementById('badgeJob')?.addEventListener('change', drawBadge);
        document.getElementById('showCloudy')?.addEventListener('change', drawBadge);
        
        // Download PNG
        document.getElementById('downloadPng').addEventListener('click', () => {
            const link = document.createElement('a');
            const name = nameInput.value.replace(/\s+/g, '_').toLowerCase() || 'badge';
            link.download = `badge_${name}.png`;
            link.href = badgeCanvas.toDataURL('image/png');
            link.click();
            
            showSnackbar('Téléchargement du badge en cours...');
        });
        
        // Initialize
        drawBadge();
    </script>
</body>
</html>
