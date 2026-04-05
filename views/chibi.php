<?php
$user = $_SESSION['user'];
$config = require __DIR__ . '/../config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer mon Chibi - Groupe Speed Cloud</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'speed-purple': '#8a4dfd',
                        'speed-purple-dark': '#7040d9',
                    }
                }
            }
        }
    </script>
    <link rel="icon" type="image/png" href="https://sign.groupe-speed.cloud/assets/images/cloudy.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900" style="font-family: 'Titillium Web', sans-serif;">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
            <div class="flex items-center gap-4">
                <a href="/" class="flex items-center gap-4 hover:opacity-80 transition">
                    <img src="/assets/images/cloudy.png" alt="Groupe Speed Cloud" class="w-12 h-12 rounded-xl">
                    <div>
                        <h1 class="text-xl font-bold text-white">Créer mon Chibi</h1>
                        <p class="text-gray-400 text-sm">Association Groupe Speed Cloud</p>
                    </div>
                </a>
            </div>
            <div class="flex items-center gap-4">
                <a href="/" class="text-gray-400 hover:text-white transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span class="hidden sm:inline">Retour aux signatures</span>
                </a>
                <div class="flex items-center gap-3">
                    <?php if (!empty($user['picture'])): ?>
                    <img src="<?= htmlspecialchars($user['picture']) ?>" alt="" class="w-10 h-10 rounded-full">
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-5xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-8">
                
                <!-- Customization Panel -->
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 shadow-2xl border border-white/20">
                    <h2 class="text-xl font-bold text-white mb-6">✨ Personnalise ton Chibi</h2>
                    
                    <form id="chibiForm" class="space-y-5">
                        <!-- Seed / Name -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-200 mb-2">Nom (génère un avatar unique)</label>
                            <input type="text" id="seed" value="<?= htmlspecialchars($user['name']) ?>" 
                                class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-speed-purple transition">
                        </div>

                        <!-- Style -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-200 mb-2">Style d'avatar</label>
                            <select id="style" class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-speed-purple transition cursor-pointer">
                                <option value="lorelei" class="bg-gray-800">Lorelei (Chibi mignon)</option>
                                <option value="adventurer" class="bg-gray-800">Adventurer (Cartoon)</option>
                                <option value="avataaars" class="bg-gray-800">Avataaars (Style Memoji)</option>
                                <option value="big-smile" class="bg-gray-800">Big Smile (Souriant)</option>
                                <option value="notionists" class="bg-gray-800">Notionists (Minimaliste)</option>
                                <option value="fun-emoji" class="bg-gray-800">Fun Emoji</option>
                                <option value="thumbs" class="bg-gray-800">Thumbs (Pouces)</option>
                            </select>
                        </div>

                        <!-- Background Color -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-200 mb-2">Couleur de fond</label>
                            <div class="grid grid-cols-6 gap-2">
                                <label class="cursor-pointer">
                                    <input type="radio" name="bgColor" value="transparent" class="peer hidden" checked>
                                    <div class="w-full aspect-square rounded-lg border-2 border-white/20 peer-checked:border-speed-purple transition bg-[url('data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%228%22%20height%3D%228%22%3E%3Crect%20width%3D%224%22%20height%3D%224%22%20fill%3D%22%23ccc%22%2F%3E%3Crect%20x%3D%224%22%20y%3D%224%22%20width%3D%224%22%20height%3D%224%22%20fill%3D%22%23ccc%22%2F%3E%3C%2Fsvg%3E')]"></div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="bgColor" value="8a4dfd" class="peer hidden">
                                    <div class="w-full aspect-square rounded-lg border-2 border-white/20 peer-checked:border-white transition" style="background: #8a4dfd;"></div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="bgColor" value="6366f1" class="peer hidden">
                                    <div class="w-full aspect-square rounded-lg border-2 border-white/20 peer-checked:border-white transition" style="background: #6366f1;"></div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="bgColor" value="ec4899" class="peer hidden">
                                    <div class="w-full aspect-square rounded-lg border-2 border-white/20 peer-checked:border-white transition" style="background: #ec4899;"></div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="bgColor" value="10b981" class="peer hidden">
                                    <div class="w-full aspect-square rounded-lg border-2 border-white/20 peer-checked:border-white transition" style="background: #10b981;"></div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="bgColor" value="f59e0b" class="peer hidden">
                                    <div class="w-full aspect-square rounded-lg border-2 border-white/20 peer-checked:border-white transition" style="background: #f59e0b;"></div>
                                </label>
                            </div>
                        </div>

                        <!-- Size -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-200 mb-2">Taille : <span id="sizeValue">200</span>px</label>
                            <input type="range" id="size" min="64" max="512" value="200" 
                                class="w-full h-2 bg-white/20 rounded-lg appearance-none cursor-pointer accent-speed-purple">
                        </div>

                        <!-- Flip -->
                        <div class="flex items-center gap-3">
                            <input type="checkbox" id="flip" class="w-5 h-5 rounded border-white/20 bg-white/10 text-speed-purple focus:ring-speed-purple cursor-pointer">
                            <label for="flip" class="text-sm text-gray-200 cursor-pointer">Retourner horizontalement</label>
                        </div>

                        <!-- Rotate -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-200 mb-2">Rotation : <span id="rotateValue">0</span>°</label>
                            <input type="range" id="rotate" min="0" max="360" value="0" step="15"
                                class="w-full h-2 bg-white/20 rounded-lg appearance-none cursor-pointer accent-speed-purple">
                        </div>

                        <!-- Random Button -->
                        <button type="button" id="randomBtn" class="w-full py-3 bg-white/10 border border-white/20 rounded-lg text-white font-medium hover:bg-white/20 transition flex items-center justify-center gap-2">
                            🎲 Générer aléatoirement
                        </button>
                    </form>
                </div>

                <!-- Preview Panel -->
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 shadow-2xl border border-white/20">
                    <h2 class="text-xl font-bold text-white mb-6">👀 Aperçu</h2>
                    
                    <!-- Avatar Preview -->
                    <div class="flex justify-center mb-6">
                        <div id="chibiPreview" class="bg-white/5 rounded-2xl p-4 border border-white/10">
                            <img id="chibiImage" src="" alt="Ton Chibi" class="mx-auto rounded-xl">
                        </div>
                    </div>

                    <!-- Download Buttons -->
                    <div class="space-y-3">
                        <button id="downloadPng" class="w-full py-3 bg-speed-purple text-white rounded-lg font-semibold hover:bg-speed-purple-dark transition flex items-center justify-center gap-2">
                            📥 Télécharger PNG
                        </button>
                        <button id="downloadSvg" class="w-full py-3 bg-white/10 border border-white/20 rounded-lg text-white font-medium hover:bg-white/20 transition flex items-center justify-center gap-2">
                            📄 Télécharger SVG
                        </button>
                        <button id="copyUrl" class="w-full py-3 bg-white/10 border border-white/20 rounded-lg text-white font-medium hover:bg-white/20 transition flex items-center justify-center gap-2">
                            🔗 Copier l'URL
                        </button>
                    </div>

                    <!-- Tips -->
                    <div class="mt-6 p-4 bg-speed-purple/20 rounded-lg border border-speed-purple/30">
                        <h3 class="text-white font-semibold mb-2">💡 Astuces</h3>
                        <ul class="text-gray-300 text-sm space-y-1 list-disc list-inside">
                            <li>Change ton nom pour un avatar différent</li>
                            <li>Le PNG est idéal pour les profils</li>
                            <li>Le SVG permet un redimensionnement parfait</li>
                            <li>Utilise l'URL dans ta signature email !</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-gray-400 text-sm">
            © <?= date('Y') ?> Association Groupe Speed Cloud - Tous droits réservés
        </div>
    </div>

    <script>
        const chibiImage = document.getElementById('chibiImage');
        const seedInput = document.getElementById('seed');
        const styleSelect = document.getElementById('style');
        const sizeInput = document.getElementById('size');
        const sizeValue = document.getElementById('sizeValue');
        const rotateInput = document.getElementById('rotate');
        const rotateValue = document.getElementById('rotateValue');
        const flipCheckbox = document.getElementById('flip');
        
        function generateAvatarUrl(format = 'svg') {
            const seed = encodeURIComponent(seedInput.value || 'default');
            const style = styleSelect.value;
            const size = sizeInput.value;
            const bgColor = document.querySelector('input[name="bgColor"]:checked').value;
            const flip = flipCheckbox.checked;
            const rotate = rotateInput.value;
            
            let url = `https://api.dicebear.com/7.x/${style}/${format}?seed=${seed}&size=${size}`;
            
            if (bgColor !== 'transparent') {
                url += `&backgroundColor=${bgColor}`;
            }
            if (flip) {
                url += '&flip=true';
            }
            if (rotate !== '0') {
                url += `&rotate=${rotate}`;
            }
            
            return url;
        }
        
        function updatePreview() {
            const url = generateAvatarUrl('svg');
            chibiImage.src = url;
            chibiImage.style.width = sizeInput.value + 'px';
            chibiImage.style.height = sizeInput.value + 'px';
        }
        
        // Event listeners
        seedInput.addEventListener('input', updatePreview);
        styleSelect.addEventListener('change', updatePreview);
        sizeInput.addEventListener('input', () => {
            sizeValue.textContent = sizeInput.value;
            updatePreview();
        });
        rotateInput.addEventListener('input', () => {
            rotateValue.textContent = rotateInput.value;
            updatePreview();
        });
        flipCheckbox.addEventListener('change', updatePreview);
        document.querySelectorAll('input[name="bgColor"]').forEach(input => {
            input.addEventListener('change', updatePreview);
        });
        
        // Random button
        document.getElementById('randomBtn').addEventListener('click', () => {
            const randomSeed = Math.random().toString(36).substring(2, 10);
            seedInput.value = randomSeed;
            
            const styles = ['lorelei', 'adventurer', 'avataaars', 'big-smile', 'notionists', 'fun-emoji', 'thumbs'];
            styleSelect.value = styles[Math.floor(Math.random() * styles.length)];
            
            const colors = document.querySelectorAll('input[name="bgColor"]');
            colors[Math.floor(Math.random() * colors.length)].checked = true;
            
            rotateInput.value = 0;
            rotateValue.textContent = '0';
            flipCheckbox.checked = Math.random() > 0.5;
            
            updatePreview();
        });
        
        // Download PNG
        document.getElementById('downloadPng').addEventListener('click', async () => {
            const url = generateAvatarUrl('png');
            const response = await fetch(url);
            const blob = await response.blob();
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = `chibi-${seedInput.value || 'avatar'}.png`;
            link.click();
        });
        
        // Download SVG
        document.getElementById('downloadSvg').addEventListener('click', async () => {
            const url = generateAvatarUrl('svg');
            const response = await fetch(url);
            const blob = await response.blob();
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = `chibi-${seedInput.value || 'avatar'}.svg`;
            link.click();
        });
        
        // Copy URL
        document.getElementById('copyUrl').addEventListener('click', async () => {
            const url = generateAvatarUrl('svg');
            await navigator.clipboard.writeText(url);
            const btn = document.getElementById('copyUrl');
            btn.innerHTML = '✓ URL copiée !';
            setTimeout(() => {
                btn.innerHTML = '🔗 Copier l\'URL';
            }, 2000);
        });
        
        // Init
        updatePreview();
    </script>
</body>
</html>
