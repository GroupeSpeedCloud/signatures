<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue — Groupe Speed Cloud</title>
    <link rel="icon" type="image/png" href="/assets/images/cloudy.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>tailwind.config={theme:{extend:{fontFamily:{sans:['Inter','sans-serif']}}}}</script>
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-zinc-950 text-white min-h-screen flex items-center justify-center px-4">

    <div class="fixed top-0 right-0 w-96 h-96 rounded-full pointer-events-none"
         style="background: radial-gradient(circle, rgba(138,77,253,0.12) 0%, transparent 70%); filter: blur(60px);"></div>

    <main class="w-full max-w-md relative">

        <!-- Logo -->
        <div class="text-center mb-10">
            <div class="relative inline-block mb-5">
                <div class="absolute inset-0 rounded-2xl"
                     style="background: rgba(138,77,253,0.3); filter: blur(20px); transform: scale(1.3);"></div>
                <img src="/assets/images/cloudy.png" alt="" class="relative w-16 h-16 rounded-2xl shadow-lg">
            </div>
            <h1 class="text-2xl font-bold">Bienvenue, <?= htmlspecialchars(explode(' ', $user['name'])[0]) ?> !</h1>
            <p class="text-zinc-400 text-sm mt-2">Une dernière étape avant de créer ta signature.</p>
        </div>

        <!-- Carte -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8">
            <p class="text-base font-semibold text-white text-center mb-2">Tu es...</p>
            <p class="text-sm text-zinc-400 text-center mb-8">
                Cela permet d'afficher les intitulés de postes dans la bonne forme grammaticale.
            </p>

            <form method="POST" action="/onboarding" class="space-y-3">
                <!-- Masculin -->
                <button type="submit" name="gender" value="m"
                    class="w-full flex items-center gap-4 px-5 py-4 bg-zinc-800 hover:bg-zinc-700 border border-zinc-700 hover:border-purple-500 rounded-xl transition-all text-left group">
                    <div class="w-10 h-10 rounded-full bg-blue-500/10 border border-blue-500/30 flex items-center justify-center shrink-0 text-lg">
                        ♂
                    </div>
                    <div>
                        <p class="font-semibold text-white group-hover:text-purple-300 transition-colors">Masculin</p>
                        <p class="text-xs text-zinc-500 mt-0.5">Ex : Président, Développeur, Stagiaire</p>
                    </div>
                </button>

                <!-- Féminin -->
                <button type="submit" name="gender" value="f"
                    class="w-full flex items-center gap-4 px-5 py-4 bg-zinc-800 hover:bg-zinc-700 border border-zinc-700 hover:border-purple-500 rounded-xl transition-all text-left group">
                    <div class="w-10 h-10 rounded-full bg-pink-500/10 border border-pink-500/30 flex items-center justify-center shrink-0 text-lg">
                        ♀
                    </div>
                    <div>
                        <p class="font-semibold text-white group-hover:text-purple-300 transition-colors">Féminin</p>
                        <p class="text-xs text-zinc-500 mt-0.5">Ex : Présidente, Développeuse, Stagiaire</p>
                    </div>
                </button>
            </form>

            <p class="text-center text-xs text-zinc-600 mt-6">
                Tu pourras modifier ce choix depuis ton profil.
            </p>
        </div>
    </main>
</body>
</html>
