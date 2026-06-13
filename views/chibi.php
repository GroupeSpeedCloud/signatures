<?php
// $user et $jobs sont injectés par ChibiController
$currentPage = 'avatar';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badge — Groupe Speed Cloud</title>
    <link rel="icon" type="image/png" href="/assets/images/cloudy.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>tailwind.config={theme:{extend:{fontFamily:{sans:['Inter','sans-serif']}}}}</script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        select option { background: #18181b; color: #fff; }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #3f3f46; border-radius: 9999px; }
        input[type=range] {
            -webkit-appearance: none; appearance: none;
            width: 100%; height: 4px;
            background: #3f3f46; border-radius: 9999px; outline: none;
        }
        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none; appearance: none;
            width: 16px; height: 16px; border-radius: 50%;
            background: #8a4dfd; cursor: pointer;
        }
        #toast { transition: opacity 0.3s ease, transform 0.3s ease; }
        #toast.show { opacity: 1 !important; transform: translateY(0) !important; }
    </style>
</head>
<body class="bg-zinc-950 text-white h-screen flex overflow-hidden">

    <!-- Toast -->
    <div id="toast" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 opacity-0 translate-y-4 pointer-events-none">
        <div id="toast-inner" class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium shadow-lg bg-zinc-800 border border-zinc-700 text-white"></div>
    </div>

    <!-- Sidebar -->
    <aside class="w-72 bg-zinc-900 border-r border-zinc-800 flex flex-col shrink-0">
        <div class="p-4 border-b border-zinc-800">
            <div class="flex items-center gap-3">
                <img src="/assets/images/cloudy.png" alt="" class="w-10 h-10 rounded-lg">
                <div>
                    <h1 class="font-semibold text-white">Groupe Speed Cloud</h1>
                    <p class="text-xs text-zinc-500">Générateur de badges</p>
                </div>
            </div>
        </div>
        <nav class="flex-1 p-3 space-y-1">
            <a href="/signatures" class="flex items-center gap-3 px-3 py-2 rounded-lg text-zinc-400 hover:bg-zinc-800 text-sm font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
                Signatures email
            </a>
            <a href="/chibi" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-purple-600/10 text-purple-400 text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Badge profil
            </a>
        </nav>
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

    <!-- Main -->
    <main class="flex-1 flex overflow-hidden">

        <!-- Form panel -->
        <div class="w-80 shrink-0 border-r border-zinc-800 overflow-y-auto flex flex-col">
            <div class="p-4 border-b border-zinc-800">
                <h2 class="text-sm font-semibold text-zinc-300">Personnalisation</h2>
            </div>
            <div class="p-4 space-y-5 flex-1">

                <!-- Nom -->
                <div>
                    <label class="text-xs font-medium text-zinc-400 mb-1.5 block">Nom complet</label>
                    <input type="text" id="badgeName" value="<?= htmlspecialchars($user['name']) ?>"
                        class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-purple-500 transition-colors">
                </div>

                <!-- Poste -->
                <div>
                    <label class="text-xs font-medium text-zinc-400 mb-1.5 block">Poste</label>
                    <select id="badgeJob" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-purple-500 transition-colors">
                        <option value="">Sans poste</option>
                        <?php foreach ($jobs as $key => $label): ?>
                            <?php if ($key && $key !== '__autre__'): ?>
                            <option value="<?= htmlspecialchars($label) ?>"><?= htmlspecialchars($label) ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <option value="__custom__">Autre...</option>
                    </select>
                    <input type="text" id="badgeJobCustom" placeholder="Poste personnalisé..."
                        class="hidden mt-2 w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-purple-500 transition-colors">
                </div>

                <!-- Style -->
                <div>
                    <label class="text-xs font-semibold text-zinc-400 uppercase tracking-wider mb-2 block">Style</label>
                    <div class="grid grid-cols-3 gap-2">
                        <?php foreach (['modern' => 'Moderne', 'gradient' => 'Dégradé', 'neon' => 'Néon'] as $val => $lbl): ?>
                        <button onclick="setStyle('<?= $val ?>')" id="style-<?= $val ?>"
                            class="style-btn py-2 rounded-lg border text-xs font-medium transition-colors
                            <?= $val === 'modern' ? 'border-purple-500 bg-purple-600/10 text-white' : 'border-zinc-700 bg-zinc-800/50 text-zinc-400' ?>">
                            <?= $lbl ?>
                        </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Fond -->
                <div>
                    <label class="text-xs font-semibold text-zinc-400 uppercase tracking-wider mb-2 block">Fond</label>
                    <div class="grid grid-cols-6 gap-2">
                        <?php
                        $colors = [
                            'transparent' => null,
                            'ffffff'      => '#ffffff',
                            '8a4dfd'      => '#8a4dfd',
                            '1a1a2e'      => '#1a1a2e',
                            '0f172a'      => '#0f172a',
                            'f8fafc'      => '#f8fafc',
                        ];
                        foreach ($colors as $val => $hex): ?>
                        <label class="block cursor-pointer">
                            <input type="radio" name="bgColor" value="<?= $val ?>" <?= $val === 'transparent' ? 'checked' : '' ?> class="sr-only">
                            <div class="color-swatch aspect-square rounded-lg border-2 border-zinc-700 transition-all hover:scale-110
                                <?= $val === 'transparent' ? 'bg-[url(\'data:image/svg+xml,<svg xmlns=\\\'http://www.w3.org/2000/svg\\\' width=\\\'8\\\' height=\\\'8\\\'><rect width=\\\'4\\\' height=\\\'4\\\' fill=\\\'%236b7280\\\'/><rect x=\\\'4\\\' y=\\\'4\\\' width=\\\'4\\\' height=\\\'4\\\' fill=\\\'%236b7280\\\'/></svg>\')] bg-repeat' : '' ?>"
                                <?= $hex ? "style=\"background:$hex\"" : '' ?>>
                            </div>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Taille -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="text-xs font-medium text-zinc-400">Taille</label>
                        <span id="sizeLabel" class="text-xs text-purple-400 font-medium bg-purple-600/10 px-2 py-0.5 rounded">256 px</span>
                    </div>
                    <input type="range" id="badgeSize" min="128" max="512" value="256">
                </div>

                <!-- Anneau -->
                <label class="flex items-center gap-3 cursor-pointer">
                    <div class="relative">
                        <input type="checkbox" id="showRing" class="sr-only peer" checked>
                        <div class="w-9 h-5 bg-zinc-700 rounded-full peer peer-checked:bg-purple-600 transition-colors"></div>
                        <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-4"></div>
                    </div>
                    <span class="text-sm text-zinc-300">Anneau Groupe Speed Cloud</span>
                </label>

            </div>
        </div>

        <!-- Preview panel -->
        <div class="flex-1 flex flex-col overflow-hidden bg-zinc-950">
            <div class="h-12 border-b border-zinc-800 flex items-center justify-between px-6 shrink-0">
                <h2 class="text-sm font-semibold text-zinc-300">Aperçu</h2>
                <button onclick="downloadBadge()"
                    class="flex items-center gap-2 px-3 py-1.5 bg-purple-600 hover:bg-purple-700 rounded-lg text-sm font-medium transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Télécharger PNG
                </button>
            </div>

            <div class="flex-1 overflow-y-auto flex flex-col items-center justify-center p-8 gap-6">
                <!-- Canvas -->
                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 flex items-center justify-center">
                    <canvas id="badgeCanvas" class="rounded-xl block"></canvas>
                </div>

                <!-- Usages -->
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-4 max-w-xs w-full">
                    <p class="text-xs font-semibold text-zinc-400 uppercase tracking-wider mb-2">Utilisations</p>
                    <ul class="text-sm text-zinc-400 space-y-1">
                        <li class="flex items-center gap-2">
                            <div class="w-1 h-1 rounded-full bg-purple-500"></div>Photo de profil Gmail / Slack
                        </li>
                        <li class="flex items-center gap-2">
                            <div class="w-1 h-1 rounded-full bg-purple-500"></div>Avatar pour les outils internes
                        </li>
                        <li class="flex items-center gap-2">
                            <div class="w-1 h-1 rounded-full bg-purple-500"></div>Badge d'identification
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <script>
        const canvas = document.getElementById('badgeCanvas');
        const ctx    = canvas.getContext('2d');

        const cloudyImg = new Image();
        cloudyImg.crossOrigin = 'anonymous';
        cloudyImg.src = '/assets/images/cloudy.png';
        cloudyImg.onload = draw;

        let currentStyle = 'modern';

        function getJobValue() {
            const sel = document.getElementById('badgeJob');
            if (sel.value === '__custom__') return document.getElementById('badgeJobCustom').value;
            return sel.value;
        }

        function stringToColor(str) {
            let hash = 0;
            for (let i = 0; i < str.length; i++) hash = str.charCodeAt(i) + ((hash << 5) - hash);
            const palette = ['#8a4dfd','#6366f1','#ec4899','#10b981','#f59e0b','#ef4444','#06b6d4'];
            return palette[Math.abs(hash) % palette.length];
        }

        function adjustColor(hex, amt) {
            const n = parseInt(hex.replace('#',''), 16);
            const r = Math.min(255, Math.max(0, (n >> 16) + amt));
            const g = Math.min(255, Math.max(0, ((n >> 8) & 0xff) + amt));
            const b = Math.min(255, Math.max(0, (n & 0xff) + amt));
            return '#' + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
        }

        function draw() {
            const size      = parseInt(document.getElementById('badgeSize').value);
            const name      = document.getElementById('badgeName').value || 'Membre';
            const job       = getJobValue();
            const showRing  = document.getElementById('showRing').checked;
            const bgColor   = document.querySelector('input[name="bgColor"]:checked').value;
            const initials  = name.split(' ').map(w => w[0]).join('').toUpperCase().slice(0, 2);
            const color     = stringToColor(name);

            canvas.width  = size;
            canvas.height = size;

            // Fond
            if (bgColor === 'transparent') {
                ctx.clearRect(0, 0, size, size);
            } else {
                ctx.fillStyle = '#' + bgColor;
                ctx.fillRect(0, 0, size, size);
            }

            const cx = size / 2;
            const cy = size / 2;
            const r  = size * 0.36;
            const ringR = r + size * 0.06;
            const ringW = size * 0.045;

            // Anneau violet
            if (showRing) {
                ctx.save();
                ctx.shadowColor = 'rgba(138,77,253,0.5)';
                ctx.shadowBlur  = size * 0.05;
                const rg = ctx.createLinearGradient(cx - ringR, cy - ringR, cx + ringR, cy + ringR);
                rg.addColorStop(0,   '#a855f7');
                rg.addColorStop(0.5, '#8a4dfd');
                rg.addColorStop(1,   '#6d28d9');
                ctx.beginPath();
                ctx.arc(cx, cy, ringR + ringW / 2, 0, Math.PI * 2);
                ctx.arc(cx, cy, ringR - ringW / 2, 0, Math.PI * 2, true);
                ctx.fillStyle = rg;
                ctx.fill();
                // Reflet
                const hl = ctx.createLinearGradient(0, cy - ringR, 0, cy);
                hl.addColorStop(0, 'rgba(255,255,255,0.4)');
                hl.addColorStop(1, 'rgba(255,255,255,0)');
                ctx.beginPath();
                ctx.arc(cx, cy, ringR + ringW / 2 - 1, 0, Math.PI * 2);
                ctx.arc(cx, cy, ringR - ringW / 2 + 1, 0, Math.PI * 2, true);
                ctx.fillStyle = hl;
                ctx.fill();
                ctx.restore();
            }

            // Ombre cercle principal
            ctx.save();
            ctx.shadowColor  = 'rgba(0,0,0,0.3)';
            ctx.shadowBlur   = size * 0.04;
            ctx.shadowOffsetY= size * 0.015;
            ctx.beginPath();
            ctx.arc(cx, cy, r, 0, Math.PI * 2);
            ctx.fillStyle = 'rgba(0,0,0,0.01)';
            ctx.fill();
            ctx.restore();

            // Cercle — style
            ctx.beginPath();
            ctx.arc(cx, cy, r, 0, Math.PI * 2);

            if (currentStyle === 'modern') {
                const g = ctx.createRadialGradient(cx - r * 0.3, cy - r * 0.3, 0, cx, cy, r * 1.2);
                g.addColorStop(0, adjustColor(color, 40));
                g.addColorStop(0.7, color);
                g.addColorStop(1, adjustColor(color, -30));
                ctx.fillStyle = g;
                ctx.fill();
                // Reflet
                ctx.beginPath();
                ctx.arc(cx, cy, r, 0, Math.PI * 2);
                const hl = ctx.createRadialGradient(cx - r * 0.25, cy - r * 0.35, 0, cx, cy, r);
                hl.addColorStop(0, 'rgba(255,255,255,0.35)');
                hl.addColorStop(0.5, 'rgba(255,255,255,0.08)');
                hl.addColorStop(1, 'rgba(255,255,255,0)');
                ctx.fillStyle = hl;
                ctx.fill();

            } else if (currentStyle === 'gradient') {
                const g = ctx.createLinearGradient(cx - r, cy - r, cx + r, cy + r);
                g.addColorStop(0, adjustColor(color, 20));
                g.addColorStop(0.5, '#8a4dfd');
                g.addColorStop(1, '#6d28d9');
                ctx.fillStyle = g;
                ctx.fill();
                const hl = ctx.createRadialGradient(cx - r * 0.3, cy - r * 0.3, 0, cx, cy, r);
                hl.addColorStop(0, 'rgba(255,255,255,0.25)');
                hl.addColorStop(1, 'rgba(255,255,255,0)');
                ctx.beginPath();
                ctx.arc(cx, cy, r, 0, Math.PI * 2);
                ctx.fillStyle = hl;
                ctx.fill();

            } else { // neon
                ctx.save();
                ctx.shadowColor = color;
                ctx.shadowBlur  = size * 0.12;
                ctx.strokeStyle = color;
                ctx.lineWidth   = size * 0.025;
                ctx.stroke();
                ctx.restore();
                const g = ctx.createRadialGradient(cx, cy, 0, cx, cy, r);
                g.addColorStop(0, 'rgba(138,77,253,0.18)');
                g.addColorStop(1, 'rgba(138,77,253,0.04)');
                ctx.beginPath();
                ctx.arc(cx, cy, r - size * 0.015, 0, Math.PI * 2);
                ctx.fillStyle = g;
                ctx.fill();
            }

            // Initiales
            const textColor = currentStyle === 'neon' ? color : '#ffffff';
            const yOffset   = job ? -size * 0.06 : 0;
            ctx.fillStyle    = textColor;
            ctx.font         = `700 ${size * 0.28}px 'Inter', Arial, sans-serif`;
            ctx.textAlign    = 'center';
            ctx.textBaseline = 'middle';
            if (currentStyle === 'neon') {
                ctx.save();
                ctx.shadowColor = color;
                ctx.shadowBlur  = size * 0.04;
                ctx.fillText(initials, cx, cy + yOffset);
                ctx.restore();
            } else {
                ctx.fillText(initials, cx, cy + yOffset);
            }

            // Poste
            if (job) {
                ctx.fillStyle    = currentStyle === 'neon' ? '#ffffff' : 'rgba(255,255,255,0.88)';
                let fs           = size * 0.08;
                ctx.font         = `500 ${fs}px 'Inter', Arial, sans-serif`;
                const maxW       = r * 1.6;
                while (ctx.measureText(job).width > maxW && fs > size * 0.038) {
                    fs -= 1;
                    ctx.font = `500 ${fs}px 'Inter', Arial, sans-serif`;
                }
                ctx.fillText(job, cx, cy + size * 0.14);
            }

            // Logo Cloudy sur l'anneau
            if (showRing && cloudyImg.complete && cloudyImg.naturalWidth > 0) {
                ctx.save();
                const angle    = Math.PI * 0.75;
                const logoR    = size * 0.08;
                const logoCx   = cx + Math.cos(angle) * ringR;
                const logoCy   = cy + Math.sin(angle) * ringR;
                const bgR      = logoR + size * 0.018;

                ctx.shadowColor  = 'rgba(0,0,0,0.4)';
                ctx.shadowBlur   = size * 0.025;
                ctx.beginPath();
                ctx.arc(logoCx, logoCy, bgR, 0, Math.PI * 2);
                ctx.fillStyle = '#ffffff';
                ctx.fill();

                ctx.shadowBlur = 0;
                ctx.shadowColor = 'transparent';
                const border = ctx.createLinearGradient(logoCx - bgR, logoCy - bgR, logoCx + bgR, logoCy + bgR);
                border.addColorStop(0, '#a855f7');
                border.addColorStop(1, '#7c3aed');
                ctx.strokeStyle = border;
                ctx.lineWidth   = size * 0.012;
                ctx.stroke();

                ctx.beginPath();
                ctx.arc(logoCx, logoCy, logoR, 0, Math.PI * 2);
                ctx.clip();
                ctx.drawImage(cloudyImg, logoCx - logoR, logoCy - logoR, logoR * 2, logoR * 2);
                ctx.restore();
            }
        }

        function setStyle(s) {
            currentStyle = s;
            document.querySelectorAll('.style-btn').forEach(b => {
                b.className = b.className
                    .replace('border-purple-500 bg-purple-600/10 text-white', 'border-zinc-700 bg-zinc-800/50 text-zinc-400');
            });
            const active = document.getElementById('style-' + s);
            active.className = active.className
                .replace('border-zinc-700 bg-zinc-800/50 text-zinc-400', 'border-purple-500 bg-purple-600/10 text-white');
            draw();
        }

        function downloadBadge() {
            const name = document.getElementById('badgeName').value.replace(/\s+/g, '_').toLowerCase() || 'badge';
            const link = document.createElement('a');
            link.download = `badge_${name}.png`;
            link.href = canvas.toDataURL('image/png');
            link.click();
            showToast('Badge téléchargé.');
        }

        function showToast(msg) {
            const t = document.getElementById('toast');
            document.getElementById('toast-inner').textContent = msg;
            t.classList.add('show');
            setTimeout(() => t.classList.remove('show'), 3000);
        }

        // Listeners
        document.getElementById('badgeName').addEventListener('input', draw);
        document.getElementById('badgeJob').addEventListener('change', () => {
            const isCustom = document.getElementById('badgeJob').value === '__custom__';
            document.getElementById('badgeJobCustom').classList.toggle('hidden', !isCustom);
            draw();
        });
        document.getElementById('badgeJobCustom').addEventListener('input', draw);
        document.getElementById('badgeSize').addEventListener('input', () => {
            document.getElementById('sizeLabel').textContent = document.getElementById('badgeSize').value + ' px';
            draw();
        });
        document.getElementById('showRing').addEventListener('change', draw);
        document.querySelectorAll('input[name="bgColor"]').forEach(el => {
            el.addEventListener('change', () => {
                document.querySelectorAll('.color-swatch').forEach(s => s.classList.remove('ring-2', 'ring-purple-500', 'ring-offset-1', 'ring-offset-zinc-900'));
                el.closest('label').querySelector('.color-swatch').classList.add('ring-2', 'ring-purple-500', 'ring-offset-1', 'ring-offset-zinc-900');
                draw();
            });
        });

        // Init — marquer le premier swatch comme actif
        document.querySelector('input[name="bgColor"]:checked').closest('label').querySelector('.color-swatch').classList.add('ring-2', 'ring-purple-500', 'ring-offset-1', 'ring-offset-zinc-900');
        draw();
    </script>
</body>
</html>
