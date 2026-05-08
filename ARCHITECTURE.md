# Application de signatures email - Groupe Speed Cloud

## 🚀 Fonctionnalités

- Authentification via Google OAuth (réservé au domaine @groupe-speed.cloud)
- Générateur de signatures email avec plusieurs styles (Gmail, Outlook, Dolibarr)
- Signatures personnelles et de service
- Export en image PNG
- Copie rapide dans le presse-papier
- Générateur de Chibi (avatar personnalisé)

## 📁 Nouvelle Architecture

L'application a été refactorisée avec une architecture MVC propre :

```
signatures/
├── public/              # Point d'entrée (routing)
├── src/                 # Code source
│   ├── Controllers/     # Contrôleurs
│   ├── Services/        # Services métier
│   ├── Middleware/      # Middleware d'auth
│   └── Router.php       # Routeur
├── views/               # Vues HTML
├── templates/           # Templates de signatures
├── assets/              # Ressources statiques
└── uploads/             # Fichiers générés
```

## 🔧 Installation

```bash
# Installer les dépendances
composer install

# Configurer l'application
cp config.example.php config.php
# Éditer config.php avec vos identifiants Google OAuth

# Le serveur web doit pointer vers le dossier public/
```

## 🌐 Routes

- `GET /` - Login ou générateur
- `GET /signatures` - Générateur de signatures
- `GET /chibi` - Générateur de chibi
- `GET /logout` - Déconnexion

## 📝 Changements

- ✅ Architecture MVC avec séparation des préoccupations
- ✅ Routeur centralisé pour toutes les requêtes
- ✅ Services réutilisables (AuthService, SignatureService)
- ✅ Middleware d'authentification
- ✅ Code plus maintenable et testable
- ✅ Meilleure gestion des erreurs
- ✅ Interface utilisateur modernisée
