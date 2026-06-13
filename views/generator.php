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
    <link rel="icon" type="image/png" href="/assets/images/cloudy.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script>tailwind.config={theme:{extend:{fontFamily:{sans:['Inter','sans-serif']}}}}</script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        select option { background: #18181b; color: #fff; }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #3f3f46; border-radius: 9999px; }

        #toast {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        #toast.show {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
    </style>
</head>
<body class="bg-zinc-950 text-white h-screen flex overflow-hidden">

    <!-- Toast notification -->
    <div id="toast" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 opacity-0 translate-y-4 pointer-events-none">
        <div id="toast-inner" class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium shadow-lg">
        </div>
    </div>

    <!-- Sidebar -->
    <aside class="w-72 bg-zinc-900 border-r border-zinc-800 flex flex-col shrink-0">
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
        <nav class="flex-1 p-3 space-y-1">
            <a href="/signatures" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-purple-600/10 text-purple-400 text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
                Signatures email
            </a>
            <a href="/chibi" class="flex items-center gap-3 px-3 py-2 rounded-lg text-zinc-400 hover:bg-zinc-800 text-sm font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Avatar Chibi
            </a>
        </nav>

        <!-- User -->
        <div class="p-4 border-t border-zinc-800">
            <div class="flex items-center gap-3 mb-3">
                <?php if (!empty($user['picture'])): ?>
                <img src="<?= htmlspecialchars($user['picture']) ?>" alt="" class="w-8 h-8 rounded-full">
                <?php else: ?>
                <div class="w-8 h-8 rounded-full bg-purple-600 flex items-center justify-center text-sm font-semibold">
                    <?= strtoupper(substr($user['name'], 0, 1)) ?>
                </div>
                <?php endif; ?>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium truncate"><?= htmlspecialchars($user['name']) ?></p>
                    <p class="text-xs text-zinc-500 truncate"><?= htmlspecialchars($user['email']) ?></p>
                </div>
            </div>
            <a href="/logout" class="text-xs text-zinc-500 hover:text-red-400 transition-colors">Se déconnecter</a>
        </div>
    </aside>

    <!-- Main content -->
    <main class="flex-1 flex overflow-hidden">

        <!-- Form panel -->
        <div class="w-80 shrink-0 border-r border-zinc-800 overflow-y-auto flex flex-col">
            <div class="p-4 border-b border-zinc-800">
                <h2 class="text-sm font-semibold text-zinc-300">Paramètres</h2>
            </div>

            <div class="p-4 space-y-5 flex-1">

                <!-- Type de signature -->
                <div>
                    <label class="text-xs font-semibold text-zinc-400 uppercase tracking-wider mb-2 block">Type</label>
                    <div class="flex rounded-lg overflow-hidden border border-zinc-700">
                        <button onclick="setType('personal')" id="btn-personal"
                            class="flex-1 py-2 text-sm font-medium transition-colors bg-purple-600 text-white">
                            Personnelle
                        </button>
                        <button onclick="setType('service')" id="btn-service"
                            class="flex-1 py-2 text-sm font-medium transition-colors bg-zinc-800 text-zinc-400">
                            Service
                        </button>
                    </div>
                </div>

                <!-- Formulaire personnel -->
                <div id="personal-form" class="space-y-3">
                    <div>
                        <label class="text-xs font-medium text-zinc-400 mb-1.5 block">Nom complet</label>
                        <input type="text" id="name"
                            value="<?= htmlspecialchars($user['name']) ?>"
                            placeholder="Prénom Nom"
                            class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-purple-500 transition-colors">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-zinc-400 mb-1.5 block">Poste</label>
                        <select id="job"
                            class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-purple-500 transition-colors">
                            <?php foreach ($jobs as $key => $label): ?>
                                <option value="<?= htmlspecialchars($key) ?>"><?= htmlspecialchars($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" id="job-custom" placeholder="Saisir un poste personnalisé..."
                            class="hidden mt-2 w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-purple-500 transition-colors">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-zinc-400 mb-1.5 block">Adresse email</label>
                        <input type="email" id="email"
                            value="<?= htmlspecialchars($user['email']) ?>"
                            placeholder="prenom.nom@groupe-speed.cloud"
                            class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-purple-500 transition-colors">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-zinc-400 mb-1.5 block">Téléphone <span class="text-zinc-600">(optionnel)</span></label>
                        <input type="tel" id="phone"
                            value=""
                            placeholder="+33 3 24 00 00 00"
                            class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-purple-500 transition-colors">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-zinc-400 mb-1.5 block">LinkedIn <span class="text-zinc-600">(optionnel)</span></label>
                        <input type="url" id="linkedin"
                            value=""
                            placeholder="https://linkedin.com/in/prenom-nom"
                            class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-purple-500 transition-colors">
                    </div>
                </div>

                <!-- Formulaire service -->
                <div id="service-form" class="hidden space-y-3">
                    <div>
                        <label class="text-xs font-medium text-zinc-400 mb-1.5 block">Département / Service</label>
                        <select id="service"
                            class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-purple-500 transition-colors">
                            <?php foreach ($services as $key => $service): ?>
                                <?php if (is_array($service)): ?>
                                    <option value="<?= htmlspecialchars($key) ?>"><?= htmlspecialchars($service['name']) ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Client email -->
                <div>
                    <label class="text-xs font-semibold text-zinc-400 uppercase tracking-wider mb-2 block">Client email</label>
                    <div class="space-y-1.5">
                        <?php
                        $clients = [
                            'gmail'   => ['label' => 'Gmail',    'desc' => 'Google Workspace'],
                            'outlook' => ['label' => 'Outlook',  'desc' => 'Microsoft 365'],
                            'dolibarr'=> ['label' => 'Dolibarr', 'desc' => 'ERP / CRM'],
                        ];
                        foreach ($clients as $key => $c):
                        ?>
                        <button onclick="setStyle('<?= $key ?>')" id="style-<?= $key ?>"
                            class="style-btn w-full flex items-center gap-3 px-3 py-2.5 rounded-lg border text-sm font-medium transition-colors text-left
                            <?= $key === 'gmail' ? 'border-purple-500 bg-purple-600/10 text-white' : 'border-zinc-700 bg-zinc-800/50 text-zinc-400' ?>">
                            <span class="flex-1"><?= $c['label'] ?></span>
                            <span class="text-xs opacity-60"><?= $c['desc'] ?></span>
                        </button>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>

        <!-- Preview panel -->
        <div class="flex-1 flex flex-col overflow-hidden bg-zinc-950">
            <div class="h-12 border-b border-zinc-800 flex items-center justify-between px-6 shrink-0">
                <h2 class="text-sm font-semibold text-zinc-300">Aperçu</h2>
                <div class="flex items-center gap-2">
                    <button onclick="copyHtml()"
                        class="flex items-center gap-2 px-3 py-1.5 bg-purple-600 hover:bg-purple-700 rounded-lg text-sm font-medium transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        Copier la signature
                    </button>
                    <button onclick="downloadPng()"
                        class="flex items-center gap-2 px-3 py-1.5 bg-zinc-800 hover:bg-zinc-700 rounded-lg text-sm font-medium transition-colors text-zinc-300">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        PNG
                    </button>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto flex items-start justify-center p-8">
                <div class="w-full max-w-2xl">
                    <!-- Email mock -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-xl">
                        <div class="bg-zinc-100 border-b border-zinc-200 px-4 py-2.5 flex items-center gap-2">
                            <div class="flex gap-1.5">
                                <div class="w-3 h-3 rounded-full bg-zinc-300"></div>
                                <div class="w-3 h-3 rounded-full bg-zinc-300"></div>
                                <div class="w-3 h-3 rounded-full bg-zinc-300"></div>
                            </div>
                            <span class="text-xs text-zinc-500 ml-2" id="client-label">Gmail</span>
                        </div>
                        <div class="p-6">
                            <!-- Fake email body -->
                            <div class="mb-4 space-y-1.5">
                                <div class="h-2.5 bg-zinc-100 rounded w-3/4"></div>
                                <div class="h-2.5 bg-zinc-100 rounded w-1/2"></div>
                                <div class="h-2.5 bg-zinc-100 rounded w-2/3"></div>
                            </div>
                            <div class="h-px bg-zinc-100 my-4"></div>
                            <!-- Signature -->
                            <div id="signature-preview"></div>
                        </div>
                    </div>

                    <!-- Instructions par client -->
                    <div id="instructions" class="mt-4 bg-zinc-900 border border-zinc-800 rounded-xl p-4 text-sm text-zinc-400 space-y-2">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        let currentType  = 'personal';
        let currentStyle = 'gmail';
        let debounceTimer = null;

        const clientLabels = {
            gmail:    'Gmail — Google Workspace',
            outlook:  'Outlook — Microsoft 365',
            dolibarr: 'Dolibarr — ERP / CRM',
        };

        const clientInstructions = {
            gmail: [
                '<strong>Paramètres Gmail</strong> → <em>Voir tous les paramètres</em> → onglet <em>Général</em>',
                'Section <em>Signature</em> → créer ou modifier une signature',
                'Coller la signature dans l\'éditeur (Ctrl+V ou Cmd+V)',
                'Enregistrer les modifications en bas de page',
            ],
            outlook: [
                '<strong>Fichier</strong> → <em>Options</em> → <em>Courrier</em> → <em>Signatures</em>',
                'Créer une nouvelle signature ou sélectionner une existante',
                'Coller dans l\'éditeur de signature (Ctrl+V)',
                'Sauvegarder et définir par défaut si souhaité',
            ],
            dolibarr: [
                'Dans Dolibarr : <strong>Configuration</strong> → <em>Email</em> → <em>Signature</em>',
                'Basculer l\'éditeur en mode HTML (source)',
                'Coller le HTML de la signature',
                'Enregistrer la configuration',
            ],
        };

        function setType(type) {
            currentType = type;
            const isPersonal = type === 'personal';

            document.getElementById('btn-personal').className =
                'flex-1 py-2 text-sm font-medium transition-colors ' +
                (isPersonal ? 'bg-purple-600 text-white' : 'bg-zinc-800 text-zinc-400');
            document.getElementById('btn-service').className =
                'flex-1 py-2 text-sm font-medium transition-colors ' +
                (!isPersonal ? 'bg-purple-600 text-white' : 'bg-zinc-800 text-zinc-400');

            document.getElementById('personal-form').classList.toggle('hidden', !isPersonal);
            document.getElementById('service-form').classList.toggle('hidden', isPersonal);
            scheduleUpdate();
        }

        function setStyle(style) {
            currentStyle = style;
            document.querySelectorAll('.style-btn').forEach(btn => {
                btn.className = btn.className
                    .replace('border-purple-500 bg-purple-600/10 text-white', 'border-zinc-700 bg-zinc-800/50 text-zinc-400');
            });
            const active = document.getElementById('style-' + style);
            active.className = active.className
                .replace('border-zinc-700 bg-zinc-800/50 text-zinc-400', 'border-purple-500 bg-purple-600/10 text-white');

            document.getElementById('client-label').textContent = clientLabels[style];
            updateInstructions();
            scheduleUpdate();
        }

        function updateInstructions() {
            const el = document.getElementById('instructions');
            const steps = clientInstructions[currentStyle] || [];
            el.innerHTML = '<p class="font-medium text-zinc-300 mb-2">Comment coller la signature :</p><ol class="space-y-1 list-decimal list-inside">'
                + steps.map(s => `<li>${s}</li>`).join('')
                + '</ol>';
        }

        function getJobValue() {
            const select = document.getElementById('job');
            if (select.value === '__autre__') {
                return document.getElementById('job-custom').value;
            }
            return select.value;
        }

        function scheduleUpdate() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(updatePreview, 120);
        }

        function updatePreview() {
            const params = new URLSearchParams({
                style:   currentStyle,
                type:    currentType,
                name:     document.getElementById('name')?.value     || '',
                job:      getJobValue(),
                email:    document.getElementById('email')?.value    || '',
                phone:    document.getElementById('phone')?.value    || '',
                linkedin: document.getElementById('linkedin')?.value || '',
                service:  document.getElementById('service')?.value  || '',
            });

            fetch('/signature?' + params)
                .then(r => r.text())
                .then(html => {
                    document.getElementById('signature-preview').innerHTML = html;
                })
                .catch(() => {});
        }

        async function copyHtml() {
            const preview = document.getElementById('signature-preview');
            const html = preview.innerHTML;

            try {
                // Modern clipboard API : copier en tant que text/html
                const blob = new Blob([html], { type: 'text/html' });
                const item = new ClipboardItem({ 'text/html': blob });
                await navigator.clipboard.write([item]);
                showToast('Signature copiée ! Colle-la directement dans ton client email.', 'success');
            } catch (err) {
                // Fallback : sélection DOM
                try {
                    const range = document.createRange();
                    range.selectNode(preview);
                    window.getSelection().removeAllRanges();
                    window.getSelection().addRange(range);
                    document.execCommand('copy');
                    window.getSelection().removeAllRanges();
                    showToast('Signature copiée (mode compatible).', 'success');
                } catch (e) {
                    showToast('Impossible de copier automatiquement. Sélectionne manuellement la signature.', 'error');
                }
            }
        }

        function downloadPng() {
            const preview = document.getElementById('signature-preview');
            html2canvas(preview, {
                backgroundColor: '#ffffff',
                scale: 2,
                useCORS: true,
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'signature-groupe-speed-cloud.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
                showToast('Image téléchargée.', 'success');
            }).catch(() => {
                showToast('Erreur lors de la génération de l\'image.', 'error');
            });
        }

        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const inner = document.getElementById('toast-inner');

            const colors = {
                success: 'bg-zinc-800 border border-zinc-700 text-white',
                error:   'bg-red-950 border border-red-800 text-red-200',
            };

            inner.className = `flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium shadow-lg ${colors[type] || colors.success}`;
            inner.textContent = message;

            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 3500);
        }

        // Listeners
        ['name', 'email', 'phone', 'linkedin'].forEach(id => {
            document.getElementById(id)?.addEventListener('input', scheduleUpdate);
        });
        document.getElementById('job')?.addEventListener('change', () => {
            const isCustom = document.getElementById('job').value === '__autre__';
            document.getElementById('job-custom').classList.toggle('hidden', !isCustom);
            scheduleUpdate();
        });
        document.getElementById('job-custom')?.addEventListener('input', scheduleUpdate);
        document.getElementById('service')?.addEventListener('change', scheduleUpdate);

        // Init
        updateInstructions();
        updatePreview();
    </script>
</body>
</html>
