<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur - Signatures</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-900 flex items-center justify-center">
    <div class="text-center">
        <div class="text-red-500 text-6xl mb-4">⚠️</div>
        <h1 class="text-2xl font-bold text-white mb-2">Erreur d'authentification</h1>
        <p class="text-gray-400 mb-6"><?= htmlspecialchars($errorMessage ?? 'Une erreur est survenue') ?></p>
        <a href="/" class="text-purple-400 hover:text-purple-300">← Retour</a>
    </div>
</body>
</html>
