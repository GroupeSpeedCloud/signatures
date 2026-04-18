<?php
$user = $_SESSION['user'];
$config = require __DIR__ . '/../config.php';
$services = $config['services'] ?? [];
$jobs = $config['jobs'] ?? [];
$currentPage = 'signatures';
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
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    
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
        
        /* Form card */
        .form-card {
            padding: var(--md-sys-spacing-6);
            margin-bottom: var(--md-sys-spacing-6);
            animation: slideUp 0.4s var(--md-sys-motion-easing-emphasized-decelerate);
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Form grid */
        .form-grid {
            display: grid;
            gap: var(--md-sys-spacing-4);
        }
        
        @media (min-width: 640px) {
            .form-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        /* Field container */
        .field-container {
            display: flex;
            flex-direction: column;
            gap: var(--md-sys-spacing-2);
        }
        
        .field-label {
            font: var(--md-sys-typescale-label-large);
            color: var(--md-sys-color-on-surface-variant);
        }
        
        /* Custom select styling */
        .md-select option {
            background-color: var(--md-sys-color-surface-container-high);
            color: var(--md-sys-color-on-surface);
            padding: var(--md-sys-spacing-2);
        }
        
        /* Preview card */
        .preview-card {
            background-color: var(--md-sys-color-surface-container-lowest);
            border-radius: var(--md-sys-shape-corner-extra-large);
            overflow: hidden;
            box-shadow: var(--md-sys-elevation-level2);
        }
        
        .preview-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: var(--md-sys-spacing-3) var(--md-sys-spacing-4);
            background-color: var(--md-sys-color-surface-container);
            border-bottom: 1px solid var(--md-sys-color-outline-variant);
            flex-wrap: wrap;
            gap: var(--md-sys-spacing-3);
        }
        
        .preview-header-left {
            display: flex;
            align-items: center;
            gap: var(--md-sys-spacing-2);
        }
        
        .preview-dots {
            display: none;
            gap: var(--md-sys-spacing-1);
        }
        
        @media (min-width: 640px) {
            .preview-dots {
                display: flex;
            }
        }
        
        .preview-dot {
            width: 12px;
            height: 12px;
            border-radius: var(--md-sys-shape-corner-full);
        }
        
        .preview-actions {
            display: flex;
            gap: var(--md-sys-spacing-2);
            flex-wrap: wrap;
        }
        
        .preview-content {
            padding: var(--md-sys-spacing-4);
            background-color: #ffffff;
            min-height: 120px;
            overflow-x: auto;
        }
        
        /* Link result section */
        .link-result {
            padding: var(--md-sys-spacing-4);
            background-color: var(--md-sys-color-success-container);
            border-top: 1px solid var(--md-sys-color-outline-variant);
            animation: slideDown 0.3s var(--md-sys-motion-easing-emphasized-decelerate);
        }
        
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .link-input-container {
            display: flex;
            gap: var(--md-sys-spacing-2);
            margin-top: var(--md-sys-spacing-2);
        }
        
        .link-input {
            flex: 1;
            padding: var(--md-sys-spacing-3);
            border: 1px solid var(--md-sys-color-outline);
            border-radius: var(--md-sys-shape-corner-small);
            background-color: var(--md-sys-color-surface);
            color: var(--md-sys-color-on-surface);
            font: var(--md-sys-typescale-body-small);
            font-family: monospace;
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
            margin-bottom: var(--md-sys-spacing-3);
        }
        
        .info-grid {
            display: grid;
            gap: var(--md-sys-spacing-3);
        }
        
        @media (min-width: 640px) {
            .info-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        .info-item {
            background-color: color-mix(in srgb, var(--md-sys-color-surface) 50%, transparent);
            border-radius: var(--md-sys-shape-corner-medium);
            padding: var(--md-sys-spacing-3);
        }
        
        .info-item-title {
            display: flex;
            align-items: center;
            gap: var(--md-sys-spacing-1);
            color: var(--md-sys-color-primary);
            margin-bottom: var(--md-sys-spacing-1);
        }
        
        .info-item-text {
            color: var(--md-sys-color-on-surface-variant);
            font: var(--md-sys-typescale-body-small);
        }
        
        /* User menu in nav rail */
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
        
        .md-input-dark:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .md-input-dark::placeholder {
            color: var(--md-sys-color-on-surface-variant);
        }
        
        /* Footer */
        .footer {
            text-align: center;
            padding: var(--md-sys-spacing-6);
            color: var(--md-sys-color-outline);
        }
        
        /* Snackbar positioning adjustment */
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
        
        <a href="/" class="md-navigation-rail__item <?= $currentPage === 'signatures' ? 'active' : '' ?>" aria-current="<?= $currentPage === 'signatures' ? 'page' : 'false' ?>">
            <span class="md-navigation-rail__icon">
                <span class="material-symbols-rounded">edit_note</span>
            </span>
            <span class="md-navigation-rail__label">Signature</span>
        </a>
        
        <a href="/chibi.php" class="md-navigation-rail__item <?= $currentPage === 'avatar' ? 'active' : '' ?>">
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
        <a href="/" class="md-navigation-bar__item <?= $currentPage === 'signatures' ? 'active' : '' ?>" aria-current="<?= $currentPage === 'signatures' ? 'page' : 'false' ?>">
            <span class="md-navigation-bar__icon">
                <span class="material-symbols-rounded">edit_note</span>
            </span>
            <span class="md-navigation-bar__label">Signature</span>
        </a>
        
        <a href="/chibi.php" class="md-navigation-bar__item <?= $currentPage === 'avatar' ? 'active' : '' ?>">
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
                <h1 class="headline-large" style="color: var(--md-sys-color-on-surface);">Créer ma signature</h1>
                <p class="body-medium" style="color: var(--md-sys-color-on-surface-variant); margin-top: var(--md-sys-spacing-1);">
                    Générez votre signature email professionnelle
                </p>
            </header>
            
            <!-- Tabs -->
            <div class="md-tabs mb-6" role="tablist">
                <button id="tabPersonal" class="md-tab active" role="tab" aria-selected="true" aria-controls="personalForm">
                    <span class="material-symbols-rounded">person</span>
                    Personnelle
                </button>
                <button id="tabService" class="md-tab" role="tab" aria-selected="false" aria-controls="serviceForm">
                    <span class="material-symbols-rounded">domain</span>
                    Service
                </button>
            </div>
            
            <!-- Form Card -->
            <div class="form-card md-card--elevated md-surface-container-low">
                <!-- Personal Signature Form -->
                <form id="personalForm" class="form-grid" role="tabpanel" aria-labelledby="tabPersonal">
                    <div class="field-container">
                        <label for="firstname" class="field-label">Prénom</label>
                        <input type="text" id="firstname" value="<?= htmlspecialchars($user['firstName']) ?>" 
                            class="md-input-dark" autocomplete="given-name">
                    </div>
                    <div class="field-container">
                        <label for="lastname" class="field-label">Nom</label>
                        <input type="text" id="lastname" value="<?= htmlspecialchars($user['lastName']) ?>" 
                            class="md-input-dark" autocomplete="family-name">
                    </div>
                    <div class="field-container">
                        <label for="job" class="field-label">Poste</label>
                        <select id="job" class="md-input-dark" style="cursor: pointer;">
                            <?php foreach ($jobs as $value => $label): ?>
                            <option value="<?= htmlspecialchars($value) ?>"><?= htmlspecialchars($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" id="customJob" placeholder="Votre poste personnalisé" 
                            class="md-input-dark hidden" style="margin-top: var(--md-sys-spacing-2);">
                    </div>
                    <div class="field-container">
                        <label for="email" class="field-label">Adresse e-mail</label>
                        <input type="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" readonly
                            class="md-input-dark" disabled autocomplete="email">
                    </div>
                    <input type="hidden" id="signatureType" value="personal">
                </form>
                
                <!-- Service Signature Form -->
                <form id="serviceForm" class="form-grid hidden" role="tabpanel" aria-labelledby="tabService" aria-hidden="true">
                    <div class="field-container" style="grid-column: 1 / -1;">
                        <label for="service" class="field-label">Service / Département</label>
                        <select id="service" class="md-input-dark" style="cursor: pointer;">
                            <?php foreach ($services as $key => $service): ?>
                                <?php if ($key === ''): ?>
                                <option value="">— Sélectionnez un service —</option>
                                <?php else: ?>
                                <option value="<?= htmlspecialchars($key) ?>"><?= htmlspecialchars($service['name']) ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" id="serviceSignatureType" value="service">
                </form>
                
                <input type="hidden" id="signatureStyle" name="style" value="gmail">
            </div>
            
            <!-- Preview Card -->
            <div class="preview-card">
                <div class="preview-header">
                    <div class="preview-header-left">
                        <div class="preview-dots">
                            <span class="preview-dot" style="background-color: #ff5f57;"></span>
                            <span class="preview-dot" style="background-color: #febc2e;"></span>
                            <span class="preview-dot" style="background-color: #28c840;"></span>
                        </div>
                        <span class="label-medium" style="color: var(--md-sys-color-on-surface-variant);">Aperçu de la signature</span>
                    </div>
                    <div class="preview-actions">
                        <button id="copyBtn" class="md-button--tonal md-button" title="Pour Dolibarr/BackOffice">
                            <span class="material-symbols-rounded" style="font-size: 18px;">content_copy</span>
                            <span class="sm:block hidden">Copier HTML</span>
                        </button>
                        <button id="generateLinkBtn" class="md-button--filled md-button" style="background-color: var(--md-sys-color-success); color: var(--md-sys-color-on-success);" title="Pour Gmail">
                            <span class="material-symbols-rounded" style="font-size: 18px;">link</span>
                            <span class="sm:block hidden">Lien image</span>
                        </button>
                    </div>
                </div>
                
                <div id="preview" class="preview-content">
                    <!-- Signature générée ici -->
                </div>
                
                <!-- Link Result -->
                <div id="linkResult" class="link-result hidden">
                    <label class="label-medium" style="color: var(--md-sys-color-on-success-container);">
                        <span class="material-symbols-rounded" style="font-size: 16px; vertical-align: middle;">link</span>
                        Lien de votre signature (à coller dans Gmail → Insérer image → Par URL) :
                    </label>
                    <div class="link-input-container">
                        <input type="text" id="linkInput" readonly class="link-input">
                        <button id="copyLinkBtn" class="md-button--filled md-button" style="background-color: var(--md-sys-color-success); color: var(--md-sys-color-on-success);">
                            <span class="material-symbols-rounded" style="font-size: 18px;">content_copy</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Info Card -->
            <div class="info-card">
                <h3 class="info-card-title title-small">
                    <span class="material-symbols-rounded">lightbulb</span>
                    Comment utiliser
                </h3>
                <div class="info-grid">
                    <div class="info-item">
                        <p class="info-item-title label-large">
                            <span class="material-symbols-rounded" style="font-size: 18px;">link</span>
                            Gmail / Outlook
                        </p>
                        <p class="info-item-text">« Lien image » → Copier l'URL → Paramètres signature → Insérer image par URL</p>
                    </div>
                    <div class="info-item">
                        <p class="info-item-title label-large">
                            <span class="material-symbols-rounded" style="font-size: 18px;">content_copy</span>
                            Dolibarr / BackOffice
                        </p>
                        <p class="info-item-text">« Copier HTML » → Coller dans les paramètres de signature</p>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <footer class="footer">
                <p class="body-small">© <?= date('Y') ?> Association Groupe Speed Cloud — Tous droits réservés</p>
            </footer>
        </div>
    </main>
    
    <!-- Snackbar (will be shown dynamically) -->
    <div id="snackbar" class="md-snackbar hidden" role="alert" aria-live="polite">
        <span class="md-snackbar__text" id="snackbarText"></span>
    </div>

    <!-- Services data for JS -->
    <script>
        const servicesData = <?= json_encode($services) ?>;
    </script>

    <script>
        // DOM Elements
        const personalForm = document.getElementById('personalForm');
        const serviceForm = document.getElementById('serviceForm');
        const tabPersonal = document.getElementById('tabPersonal');
        const tabService = document.getElementById('tabService');
        const preview = document.getElementById('preview');
        const copyBtn = document.getElementById('copyBtn');
        const snackbar = document.getElementById('snackbar');
        const snackbarText = document.getElementById('snackbarText');
        
        let currentTab = 'personal';
        
        // Snackbar utility
        function showSnackbar(message, duration = 3000) {
            snackbarText.textContent = message;
            snackbar.classList.remove('hidden');
            setTimeout(() => {
                snackbar.classList.add('hidden');
            }, duration);
        }
        
        // Tab switching with animations
        function switchTab(tab) {
            currentTab = tab;
            
            // Update tab states
            tabPersonal.classList.toggle('active', tab === 'personal');
            tabPersonal.setAttribute('aria-selected', tab === 'personal');
            tabService.classList.toggle('active', tab === 'service');
            tabService.setAttribute('aria-selected', tab === 'service');
            
            // Animate form transitions
            if (tab === 'personal') {
                serviceForm.classList.add('hidden');
                serviceForm.setAttribute('aria-hidden', 'true');
                personalForm.classList.remove('hidden');
                personalForm.setAttribute('aria-hidden', 'false');
                personalForm.style.animation = 'slideUp 0.3s var(--md-sys-motion-easing-emphasized-decelerate)';
            } else {
                personalForm.classList.add('hidden');
                personalForm.setAttribute('aria-hidden', 'true');
                serviceForm.classList.remove('hidden');
                serviceForm.setAttribute('aria-hidden', 'false');
                serviceForm.style.animation = 'slideUp 0.3s var(--md-sys-motion-easing-emphasized-decelerate)';
            }
            
            updatePreview();
        }
        
        tabPersonal.addEventListener('click', () => switchTab('personal'));
        tabService.addEventListener('click', () => switchTab('service'));
        
        async function updatePreview() {
            const style = document.getElementById('signatureStyle').value;
            let data;
            
            if (currentTab === 'personal') {
                const jobSelect = personalForm.job;
                const customJob = document.getElementById('customJob');
                const jobValue = jobSelect.value === '__autre__' ? customJob.value : jobSelect.value;
                data = new URLSearchParams({
                    style: style,
                    type: 'personal',
                    name: `${personalForm.firstname.value} ${personalForm.lastname.value}`.trim(),
                    job: jobValue,
                    email: personalForm.email.value
                });
            } else {
                const serviceKey = serviceForm.service.value;
                const serviceInfo = servicesData[serviceKey] || {};
                data = new URLSearchParams({
                    style: style,
                    type: 'service',
                    service: serviceKey,
                    name: serviceInfo.name || '',
                    email: serviceInfo.email || '',
                    job: ''
                });
            }
            
            try {
                const response = await fetch('/signature.php?' + data.toString());
                preview.innerHTML = await response.text();
            } catch (e) {
                console.error(e);
            }
        }
        
        // Events for personal form
        personalForm.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', updatePreview);
        });
        
        personalForm.job.addEventListener('change', function() {
            const customJobInput = document.getElementById('customJob');
            if (this.value === '__autre__') {
                customJobInput.classList.remove('hidden');
                customJobInput.focus();
            } else {
                customJobInput.classList.add('hidden');
                customJobInput.value = '';
            }
            updatePreview();
        });
        
        document.getElementById('customJob').addEventListener('input', updatePreview);
        
        // Events for service form
        serviceForm.service.addEventListener('change', updatePreview);
        
        // Copy HTML button
        copyBtn.addEventListener('click', async () => {
            try {
                const selection = window.getSelection();
                const range = document.createRange();
                range.selectNodeContents(preview);
                selection.removeAllRanges();
                selection.addRange(range);
                document.execCommand('copy');
                selection.removeAllRanges();
                
                showSnackbar('HTML copié dans le presse-papiers');
                
                // Button feedback
                const icon = copyBtn.querySelector('.material-symbols-rounded');
                icon.textContent = 'check';
                setTimeout(() => icon.textContent = 'content_copy', 2000);
            } catch (e) {
                console.error(e);
                showSnackbar('Erreur lors de la copie');
            }
        });
        
        // Generate link button (for Gmail)
        const generateLinkBtn = document.getElementById('generateLinkBtn');
        const linkResult = document.getElementById('linkResult');
        const linkInput = document.getElementById('linkInput');
        const copyLinkBtn = document.getElementById('copyLinkBtn');
        
        generateLinkBtn.addEventListener('click', async () => {
            try {
                const icon = generateLinkBtn.querySelector('.material-symbols-rounded');
                const textSpan = generateLinkBtn.querySelector('span:last-child');
                icon.textContent = 'hourglass_empty';
                if (textSpan) textSpan.textContent = 'Génération...';
                generateLinkBtn.disabled = true;
                
                // Wait for images to load
                const images = preview.querySelectorAll('img');
                await Promise.all(Array.from(images).map(img => {
                    if (img.complete) return Promise.resolve();
                    return new Promise((resolve) => {
                        img.onload = resolve;
                        img.onerror = resolve;
                    });
                }));
                
                // Generate canvas with html2canvas
                const canvas = await html2canvas(preview, {
                    backgroundColor: '#ffffff',
                    scale: 2,
                    useCORS: true,
                    allowTaint: true,
                    logging: false
                });
                
                // Prepare filename
                const style = document.getElementById('signatureStyle').value;
                const name = currentTab === 'personal' 
                    ? `${personalForm.firstname.value}_${personalForm.lastname.value}`.toLowerCase().replace(/\s+/g, '_')
                    : serviceForm.service.value;
                const filename = `signature_${name}_${style}`;
                
                // Upload to server
                const imageData = canvas.toDataURL('image/png');
                const response = await fetch('/upload-signature.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ image: imageData, filename: filename })
                });
                
                const result = await response.json();
                
                if (result.success && result.url) {
                    linkInput.value = result.url;
                    linkResult.classList.remove('hidden');
                    
                    showSnackbar('Lien généré avec succès');
                    
                    icon.textContent = 'check';
                    if (textSpan) textSpan.textContent = 'Créé !';
                    setTimeout(() => {
                        icon.textContent = 'link';
                        if (textSpan) textSpan.textContent = 'Lien image';
                        generateLinkBtn.disabled = false;
                    }, 2000);
                } else {
                    throw new Error(result.error || 'Erreur inconnue');
                }
            } catch (e) {
                console.error('Erreur upload:', e);
                showSnackbar('Erreur lors de la génération');
                
                const icon = generateLinkBtn.querySelector('.material-symbols-rounded');
                const textSpan = generateLinkBtn.querySelector('span:last-child');
                icon.textContent = 'error';
                if (textSpan) textSpan.textContent = 'Erreur';
                setTimeout(() => {
                    icon.textContent = 'link';
                    if (textSpan) textSpan.textContent = 'Lien image';
                    generateLinkBtn.disabled = false;
                }, 2000);
            }
        });
        
        // Copy link button
        copyLinkBtn.addEventListener('click', () => {
            linkInput.select();
            document.execCommand('copy');
            showSnackbar('Lien copié dans le presse-papiers');
            
            const icon = copyLinkBtn.querySelector('.material-symbols-rounded');
            icon.textContent = 'check';
            setTimeout(() => icon.textContent = 'content_copy', 1500);
        });
        
        // Initialize
        updatePreview();
        
        // Add keyboard navigation for tabs
        [tabPersonal, tabService].forEach(tab => {
            tab.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
                    e.preventDefault();
                    const nextTab = e.key === 'ArrowLeft' ? tabPersonal : tabService;
                    nextTab.click();
                    nextTab.focus();
                }
            });
        });
    </script>
</body>
</html>
