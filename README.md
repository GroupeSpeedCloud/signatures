# Documentation de l'application

## Structure du projet

```
signatures/
├── public/                 # Point d'entrée public
│   └── index.php          # Routeur principal
├── src/                   # Code source PHP
│   ├── Controllers/       # Contrôleurs MVC
│   │   ├── AuthController.php
│   │   ├── SignatureController.php
│   │   └── ChibiController.php
│   ├── Services/          # Services métier
│   │   ├── AuthService.php
│   │   └── SignatureService.php
│   ├── Middleware/        # Middleware
│   │   └── AuthMiddleware.php
│   └── Router.php         # Système de routage
├── views/                 # Vues/templates HTML
│   ├── login.php
│   ├── generator.php
│   ├── error.php
│   └── chibi.php
├── templates/             # Templates de signatures email
│   ├── gmail.php
│   ├── outlook.php
│   └── dolibarr.php
├── assets/                # Ressources statiques
│   ├── css/
│   └── images/
├── uploads/               # Fichiers uploadés
│   └── signatures/
├── config.php             # Configuration
└── composer.json          # Dépendances
```

## Architecture

L'application suit le pattern **MVC (Modèle-Vue-Contrôleur)** :

1. **Router** : Centralise toutes les requêtes et les dispatch vers les bons contrôleurs
2. **Controllers** : Gèrent la logique métier et préparent les données pour les vues
3. **Services** : Contiennent la logique métier réutilisable (authentification, signatures)
4. **Views** : Affichent les données fournies par les contrôleurs

## Routes disponibles

- `GET /` : Page de login ou générateur (selon authentification)
- `GET /auth` : Authentification Google OAuth
- `GET /callback` : Callback OAuth
- `GET /logout` : Déconnexion
- `GET /signatures` : Générateur de signatures
- `GET /signature` : Rendu d'une signature (paramètres en query string)
- `POST /upload-signature` : Upload d'une signature en tant qu'image
- `GET /chibi` : Générateur de chibi

## Installation

1. Cloner le repository
2. Installer les dépendances : `composer install`
3. Copier `config.example.php` vers `config.php`
4. Configurer les identifiants Google OAuth dans `config.php`
5. Configurer le serveur web pour pointer vers le dossier `public/`

## Configuration Google OAuth

1. Aller sur https://console.cloud.google.com/
2. Créer un projet ou en sélectionner un existant
3. APIs & Services > Credentials > Create Credentials > OAuth 2.0 Client IDs
4. Type : Web application
5. Authorized redirect URI : `https://signatures.groupe-speed.cloud/callback.php`

## Bonnes pratiques

- Toutes les requêtes passent par le routeur
- La logique métier est dans les Services, pas dans les Contrôleurs
- Les vues ne contiennent que de l'affichage (pas de logique complexe)
- Validation des données dans les Services
- Gestion centralisée des erreurs
