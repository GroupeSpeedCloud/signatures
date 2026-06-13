<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur — Groupe Speed Cloud</title>
    <link rel="icon" type="image/png" href="/assets/images/cloudy.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>tailwind.config={theme:{extend:{fontFamily:{sans:['Inter','sans-serif']}}}}</script>
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-zinc-950 text-white min-h-screen flex items-center justify-center px-4">
    <div class="fixed top-0 right-0 w-96 h-96 rounded-full pointer-events-none"
         style="background: radial-gradient(circle, rgba(239,68,68,0.08) 0%, transparent 70%); filter: blur(60px);"></div>

    <main class="w-full max-w-sm text-center">
        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-red-500/10 border border-red-500/20 mb-6">
            <svg class="w-7 h-7 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
            </svg>
        </div>

        <h1 class="text-xl font-semibold text-white mb-2">Une erreur est survenue</h1>
        <p class="text-sm text-zinc-400 mb-8"><?= htmlspecialchars($errorMessage ?? 'Erreur inconnue') ?></p>

        <a href="/" class="inline-flex items-center gap-2 text-sm text-zinc-400 hover:text-white transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Retour à l'accueil
        </a>
    </main>
</body>
</html>
