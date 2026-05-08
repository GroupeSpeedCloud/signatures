<?php
/**
 * Vue du générateur de signatures
 * Variables attendues: $user, $services, $jobs
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signatures — Groupe Speed Cloud</title>
    <link rel="icon" type="image/png" href="https://sign.groupe-speed.cloud/assets/images/cloudy.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script>tailwind.config={theme:{extend:{fontFamily:{sans:['Inter','sans-serif']}}}}</script>
    <style>
        body{font-family:'Inter',sans-serif;}
        select option{background:#18181b;color:#fff;}
        ::-webkit-scrollbar{width:5px;height:5px;}
        ::-webkit-scrollbar-track{background:transparent;}
        ::-webkit-scrollbar-thumb{background:#3f3f46;border-radius:9999px;}
    </style>
</head>
<body class="bg-zinc-950 text-white h-screen flex overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-80 bg-zinc-900 border-r border-zinc-800 flex flex-col">
        <!-- Header -->
        <div class="p-4 border-b border-zinc-800">
            <div class="flex items-center gap-3">
                <img src="/assets/images/cloudy.png" alt="" class="w-10 h-10 rounded-lg">
                <div>
                    <h1 class="font-semibold text-white">Groupe Speed Cloud</h1>
                    <p class="text-xs text-zinc-500">Générateur de signatures</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 p-4 space-y-2">
            <a href="/signatures" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-purple-600/10 text-purple-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
                Signatures
            </a>
            <a href="/chibi" class="flex items-center gap-3 px-3 py-2 rounded-lg text-zinc-400 hover:bg-zinc-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Chibi
            </a>
        </nav>

        <!-- User -->
        <div class="p-4 border-t border-zinc-800">
            <div class="flex items-center gap-3 mb-3">
                <img src="<?= htmlspecialchars($user['picture'] ?? '') ?>" alt="" class="w-8 h-8 rounded-full">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium truncate"><?= htmlspecialchars($user['name']) ?></p>
                    <p class="text-xs text-zinc-500 truncate"><?= htmlspecialchars($user['email']) ?></p>
                </div>
            </div>
            <a href="/logout" class="text-xs text-zinc-500 hover:text-red-400">Se déconnecter</a>
        </div>
    </aside>

    <!-- Main content -->
    <main class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="h-14 border-b border-zinc-800 flex items-center px-6">
            <h2 class="text-lg font-semibold">Ma signature</h2>
        </header>

        <!-- Content -->
        <div class="flex-1 overflow-y-auto p-6">
            <div class="max-w-4xl mx-auto space-y-6">
                <!-- Type selector -->
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-4">
                    <label class="text-sm font-medium text-zinc-300 mb-3 block">Type de signature</label>
                    <div class="flex gap-3">
                        <button onclick="setSignatureType('personal')" id="btn-personal" class="flex-1 py-2 px-4 rounded-lg bg-purple-600 text-white font-medium">
                            Personnelle
                        </button>
                        <button onclick="setSignatureType('service')" id="btn-service" class="flex-1 py-2 px-4 rounded-lg bg-zinc-800 text-zinc-400 font-medium">
                            Service
                        </button>
                    </div>
                </div>

                <!-- Personal form -->
                <div id="personal-form" class="bg-zinc-900 border border-zinc-800 rounded-xl p-4 space-y-4">
                    <div>
                        <label class="text-sm font-medium text-zinc-300 mb-2 block">Nom complet</label>
                        <input type="text" id="name" value="<?= htmlspecialchars($user['name']) ?>" 
                               class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-zinc-300 mb-2 block">Poste</label>
                        <select id="job" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                            <?php foreach ($jobs as $key => $label): ?>
                                <option value="<?= htmlspecialchars($key) ?>"><?= htmlspecialchars($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-zinc-300 mb-2 block">Email</label>
                        <input type="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" 
                               class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    </div>
                </div>

                <!-- Service form -->
                <div id="service-form" class="hidden bg-zinc-900 border border-zinc-800 rounded-xl p-4">
                    <label class="text-sm font-medium text-zinc-300 mb-2 block">Service</label>
                    <select id="service" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                        <?php foreach ($services as $key => $service): ?>
                            <?php if (is_array($service)): ?>
                                <option value="<?= htmlspecialchars($key) ?>"><?= htmlspecialchars($service['name']) ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Style selector -->
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-4">
                    <label class="text-sm font-medium text-zinc-300 mb-3 block">Style</label>
                    <div class="grid grid-cols-3 gap-3">
                        <button onclick="setStyle('gmail')" id="style-gmail" class="style-btn py-3 px-4 rounded-lg bg-purple-600 text-white font-medium">
                            Gmail
                        </button>
                        <button onclick="setStyle('outlook')" id="style-outlook" class="style-btn py-3 px-4 rounded-lg bg-zinc-800 text-zinc-400 font-medium">
                            Outlook
                        </button>
                        <button onclick="setStyle('dolibarr')" id="style-dolibarr" class="style-btn py-3 px-4 rounded-lg bg-zinc-800 text-zinc-400 font-medium">
                            Dolibarr
                        </button>
                    </div>
                </div>

                <!-- Preview -->
                <div class="bg-white rounded-xl p-6">
                    <h3 class="text-sm font-medium text-zinc-600 mb-4">Aperçu</h3>
                    <div id="signature-preview"></div>
                </div>

                <!-- Actions -->
                <div class="flex gap-3">
                    <button onclick="copyToClipboard()" class="flex-1 py-3 px-4 bg-purple-600 hover:bg-purple-700 rounded-lg font-medium transition-colors">
                        Copier la signature
                    </button>
                    <button onclick="downloadAsImage()" class="flex-1 py-3 px-4 bg-zinc-800 hover:bg-zinc-700 rounded-lg font-medium transition-colors">
                        Télécharger en image
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script>
        let currentType = 'personal';
        let currentStyle = 'gmail';

        function setSignatureType(type) {
            currentType = type;
            document.getElementById('btn-personal').className = type === 'personal' 
                ? 'flex-1 py-2 px-4 rounded-lg bg-purple-600 text-white font-medium'
                : 'flex-1 py-2 px-4 rounded-lg bg-zinc-800 text-zinc-400 font-medium';
            document.getElementById('btn-service').className = type === 'service' 
                ? 'flex-1 py-2 px-4 rounded-lg bg-purple-600 text-white font-medium'
                : 'flex-1 py-2 px-4 rounded-lg bg-zinc-800 text-zinc-400 font-medium';
            document.getElementById('personal-form').classList.toggle('hidden', type !== 'personal');
            document.getElementById('service-form').classList.toggle('hidden', type !== 'service');
            updatePreview();
        }

        function setStyle(style) {
            currentStyle = style;
            document.querySelectorAll('.style-btn').forEach(btn => {
                btn.className = 'style-btn py-3 px-4 rounded-lg bg-zinc-800 text-zinc-400 font-medium';
            });
            document.getElementById('style-' + style).className = 'style-btn py-3 px-4 rounded-lg bg-purple-600 text-white font-medium';
            updatePreview();
        }

        function updatePreview() {
            const params = new URLSearchParams({
                style: currentStyle,
                type: currentType,
                name: document.getElementById('name')?.value || '',
                job: document.getElementById('job')?.value || '',
                email: document.getElementById('email')?.value || '',
                service: document.getElementById('service')?.value || ''
            });
            fetch('/signature?' + params)
                .then(r => r.text())
                .then(html => {
                    document.getElementById('signature-preview').innerHTML = html;
                });
        }

        function copyToClipboard() {
            const preview = document.getElementById('signature-preview');
            const range = document.createRange();
            range.selectNode(preview);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand('copy');
            window.getSelection().removeAllRanges();
            alert('Signature copiée !');
        }

        function downloadAsImage() {
            const preview = document.getElementById('signature-preview');
            html2canvas(preview, { backgroundColor: '#ffffff' }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'signature.png';
                link.href = canvas.toDataURL();
                link.click();
            });
        }

        // Initialize
        document.getElementById('name')?.addEventListener('input', updatePreview);
        document.getElementById('job')?.addEventListener('change', updatePreview);
        document.getElementById('email')?.addEventListener('input', updatePreview);
        document.getElementById('service')?.addEventListener('change', updatePreview);
        updatePreview();
    </script>
</body>
</html>
