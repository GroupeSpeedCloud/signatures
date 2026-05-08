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
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'] } } }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-zinc-950 text-white min-h-screen flex items-center justify-center px-4">
    <!-- Glow décoratif -->
    <div class="fixed top-0 right-0 w-96 h-96 rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(138,77,253,0.15) 0%, transparent 70%); filter: blur(60px);"></div>
    <div class="fixed bottom-0 left-0 w-96 h-96 rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(109,40,217,0.1) 0%, transparent 70%); filter: blur(80px);"></div>

    <main class="w-full max-w-sm relative">
        <!-- Logo + titre -->
        <div class="text-center mb-8">
            <div class="relative inline-block mb-5">
                <div class="absolute inset-0 rounded-2xl" style="background: rgba(138,77,253,0.3); filter: blur(20px); transform: scale(1.3);"></div>
                <img src="/assets/images/cloudy.png" alt="" class="relative w-16 h-16 rounded-2xl shadow-lg">
            </div>
            <h1 class="text-xl font-bold text-white">Groupe Speed Cloud</h1>
            <p class="text-zinc-500 text-sm mt-1">Générateur de signatures email</p>
        </div>

        <!-- Carte de connexion -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-7">
            <p class="text-sm font-medium text-zinc-300 mb-5 text-center">Connectez-vous pour continuer</p>

            <a href="<?= htmlspecialchars($authUrl) ?>"
               class="flex items-center justify-center gap-3 w-full py-3 px-5 bg-white hover:bg-zinc-100 rounded-xl text-zinc-900 text-sm font-semibold transition-colors shadow-sm">
                <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Se connecter avec Google
            </a>

            <p class="text-center text-xs text-zinc-600 mt-5">Réservé aux membres <span class="text-zinc-500">@groupe-speed.cloud</span></p>
        </div>
    </main>
</body>
</html>
