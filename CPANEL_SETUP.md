# 📦 Installation sur cPanel - Guide Complet

## 🎯 Structure cPanel Typique

Sur cPanel, votre arborescence ressemble généralement à :

```
/home/username/
└── public_html/          # Dossier racine du site principal
    ├── .htaccess         # .htaccess principal
    ├── index.php         # Site principal
    └── signatures/       # Votre application (sous-dossier)
        ├── .htaccess     # .htaccess racine de l'app
        ├── public/       # Point d'entrée
        │   ├── index.php
        │   └── .htaccess
        ├── src/
        ├── config.php
        └── ...
```

## 🚀 3 Scénarios d'Installation

### Scénario 1 : Sous-domaine (RECOMMANDÉ)

**Exemple** : `signatures.groupe-speed.cloud`

1. **Créer le sous-domaine dans cPanel**
   - Allez dans "Domaines" → "Sous-domaines"
   - Créez `signatures`
   - cPanel crée automatiquement `/home/username/signatures/` ou `/home/username/public_html/signatures/`

2. **Uploader les fichiers**
   ```
   /home/username/signatures/
   ├── .htaccess (fichier racine)
   ├── public/
   │   ├── index.php
   │   └── .htaccess
   ├── src/
   ├── config.php
   └── ...
   ```

3. **Modifier `.htaccess` racine**
   ```apache
   RewriteEngine On
   RewriteBase /
   
   RewriteCond %{REQUEST_URI} !^/public/
   RewriteCond %{REQUEST_URI} !^/assets/
   RewriteCond %{REQUEST_URI} !^/uploads/
   RewriteRule ^(.*)$ public/$1 [L]
   ```

4. **Modifier `public/.htaccess`**
   ```apache
   RewriteEngine On
   RewriteBase /
   
   RewriteCond %{REQUEST_FILENAME} !-f
   RewriteCond %{REQUEST_FILENAME} !-d
   RewriteRule ^(.*)$ index.php [QSA,L]
   ```

✅ **Avantage** : URL propre (`signatures.domain.com`), isolation complète

---

### Scénario 2 : Sous-dossier

**Exemple** : `groupe-speed.cloud/signatures`

1. **Créer le dossier**
   - Dans `public_html/`, créez `signatures/`

2. **Uploader les fichiers**
   ```
   /home/username/public_html/signatures/
   ├── .htaccess (fichier racine)
   ├── public/
   │   ├── index.php
   │   └── .htaccess
   └── ...
   ```

3. **Modifier `.htaccess` racine**
   ```apache
   RewriteEngine On
   RewriteBase /signatures/
   
   # Ne pas rediriger si déjà dans public/
   RewriteCond %{REQUEST_URI} !^/signatures/public/
   RewriteCond %{REQUEST_URI} !^/signatures/assets/
   RewriteCond %{REQUEST_URI} !^/signatures/uploads/
   
   # Rediriger vers public/
   RewriteRule ^(.*)$ public/$1 [L]
   ```

4. **Modifier `public/.htaccess`**
   ```apache
   RewriteEngine On
   RewriteBase /signatures/public/
   
   RewriteCond %{REQUEST_FILENAME} !-f
   RewriteCond %{REQUEST_FILENAME} !-d
   RewriteRule ^(.*)$ index.php [QSA,L]
   ```

✅ **Avantage** : Simple à mettre en place
❌ **Inconvénient** : URL moins propre

---

### Scénario 3 : Domaine principal (déconseillé)

**Exemple** : `groupe-speed.cloud` (remplace le site existant)

1. **Sauvegarder l'ancien site**
2. **Uploader dans `public_html/`**
   ```
   /home/username/public_html/
   ├── .htaccess (fichier racine)
   ├── public/
   │   ├── index.php
   │   └── .htaccess
   └── ...
   ```

3. **Modifier `.htaccess` racine**
   ```apache
   RewriteEngine On
   RewriteBase /
   
   RewriteCond %{REQUEST_URI} !^/public/
   RewriteCond %{REQUEST_URI} !^/assets/
   RewriteCond %{REQUEST_URI} !^/uploads/
   RewriteRule ^(.*)$ public/$1 [L]
   ```

⚠️ **Attention** : Remplace votre site existant !

---

## 📝 Étapes Détaillées (Sous-domaine)

### Étape 1 : Créer le sous-domaine

1. Connectez-vous à cPanel
2. Allez dans **"Domaines"** → **"Sous-domaines"**
3. Remplissez :
   - **Sous-domaine** : `signatures`
   - **Domaine** : Choisissez votre domaine
   - **Dossier racine** : `signatures` (ou `public_html/signatures`)
4. Cliquez sur **"Créer"**

### Étape 2 : Configurer PHP

1. Allez dans **"Logiciel"** → **"Select PHP Version"**
2. Choisissez **PHP 8.0** ou supérieur
3. Activez les extensions :
   - ✅ `curl`
   - ✅ `json`
   - ✅ `mbstring`
   - ✅ `openssl`
   - ✅ `session`
   - ✅ `zip`

### Étape 3 : Uploader les fichiers

**Via File Manager** :
1. Allez dans **"Fichiers"** → **"File Manager"**
2. Naviguez vers `/home/username/signatures/`
3. Uploadez TOUS les fichiers de l'application

**Via FTP** :
```bash
# Utilisez FileZilla ou WinSCP
Hôte: ftp.votre-domaine.com
Utilisateur: votre-ftp-user
Mot de passe: votre-mot-de-passe
Port: 21
```

### Étape 4 : Configurer l'application

1. **Copier `config.example.php` vers `config.php`**
   ```bash
   cp config.example.php config.php
   ```

2. **Éditer `config.php`**
   - Mettez vos identifiants Google OAuth
   - Ajustez l'URL de redirection

3. **Installer les dépendances** (si Composer disponible)
   ```bash
   cd signatures
   php composer.phar install --no-dev
   ```
   
   **OU** uploadez le dossier `vendor/` depuis votre ordinateur

### Étape 5 : Permissions des fichiers

Dans **"File Manager"** :

```
Dossiers (755) :
- signatures/
- signatures/public/
- signatures/uploads/
- signatures/assets/

Fichiers (644) :
- signatures/.htaccess
- signatures/public/.htaccess
- signatures/public/index.php
- signatures/config.php
```

### Étape 6 : Créer le dossier uploads

```bash
cd /home/username/signatures/
mkdir -p uploads/signatures
chmod 755 uploads
chmod 755 uploads/signatures
```

### Étape 7 : Tester

1. Accédez à `https://signatures.votre-domaine.com`
2. Devrait afficher la page de login Google
3. Testez la connexion

---

## 🔧 Fichiers .htaccess pour cPanel

### `.htaccess` Racine (dans signatures/)

```apache
# ===========================================
# .htaccess RACINE - cPanel
# ===========================================

RewriteEngine On
RewriteBase /

# Rediriger tout vers public/
RewriteCond %{REQUEST_URI} !^/public/
RewriteCond %{REQUEST_URI} !^/assets/
RewriteCond %{REQUEST_URI} !^/uploads/
RewriteCond %{REQUEST_URI} !^/\.well-known/
RewriteRule ^(.*)$ public/$1 [L]

# Protéger config.php
<Files "config.php">
    Require all denied
</Files>

# Protéger les dossiers sensibles
<IfModule mod_rewrite.c>
    RewriteRule ^src/ - [F,L]
    RewriteRule ^vendor/ - [F,L]
</IfModule>

# Sécurité de base
Options -Indexes
```

### `public/.htaccess` (dans signatures/public/)

```apache
# ===========================================
# .htaccess PUBLIC - cPanel
# ===========================================

RewriteEngine On
RewriteBase /

# Routage MVC
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]

# PHP Settings
<IfModule php7_module>
    php_value upload_max_filesize 10M
    php_value post_max_size 10M
    php_value max_execution_time 300
</IfModule>

# Sécurité
Options -Indexes
```

---

## 🐛 Dépannage cPanel

### Erreur 500 Internal Server Error

**Cause** : `.htaccess` incompatible ou PHP incorrect

**Solutions** :
1. Vérifiez la version PHP (doit être 8.0+)
2. Renommez temporairement `.htaccess` pour tester
3. Consultez les logs d'erreur dans cPanel → "Erreurs"

### Page blanche

**Cause** : Erreur PHP non affichée

**Solutions** :
1. Allez dans "Select PHP Version" → "Options"
2. Activez `display_errors` temporairement
3. Consultez les logs : `/home/username/tmp/error_logs`

### Erreur 404

**Cause** : mod_rewrite non activé ou RewriteBase incorrect

**Solutions** :
1. Vérifiez que `RewriteBase` correspond à votre dossier
2. Contactez l'hébergeur pour activer mod_rewrite
3. Testez avec un fichier `test.php` dans `public/`

### Uploads ne fonctionnent pas

**Cause** : Permissions incorrectes

**Solutions** :
```bash
chmod 755 uploads/
chmod 755 uploads/signatures/
chown username:username uploads/
```

### "Config.php not found"

**Cause** : Chemin incorrect

**Solutions** :
1. Vérifiez que `config.php` existe dans la racine de l'app
2. Vérifiez les permissions (644)
3. Renommez `config.example.php` en `config.php`

---

## ✅ Checklist d'Installation

- [ ] Sous-domaine ou sous-dossier créé
- [ ] PHP 8.0+ sélectionné
- [ ] Extensions PHP activées
- [ ] Fichiers uploadés
- [ ] `config.php` créé et configuré
- [ ] `vendor/` présent (via Composer ou upload)
- [ ] Dossier `uploads/` créé avec permissions 755
- [ ] `.htaccess` configurés correctement
- [ ] HTTPS activé (SSL cPanel)
- [ ] Test de connexion effectué

---

## 🔒 Sécurité cPanel

### Protection supplémentaire

Ajoutez dans `.htaccess` racine :

```apache
# Bloquer l'accès aux fichiers sensibles
<FilesMatch "^(config\.php|composer\.(json|lock)|\.env)$">
    Require all denied
</FilesMatch>

# Bloquer l'exécution PHP dans uploads/
<Directory uploads>
    <FilesMatch "\.php$">
        Require all denied
    </FilesMatch>
</Directory>
```

### Hotlink Protection (optionnel)

```apache
RewriteEngine On
RewriteCond %{HTTP_REFERER} !^$
RewriteCond %{HTTP_REFERER} !^https?://(www\.)?votre-domaine\.com [NC]
RewriteRule \.(jpg|jpeg|png|gif)$ - [F,NC,L]
```

---

## 📞 Support cPanel

Si vous rencontrez des problèmes :

1. **Logs d'erreur** : cPanel → "Erreurs"
2. **Version PHP** : cPanel → "Select PHP Version"
3. **Logs Apache** : `/usr/local/apache/logs/error_log` (nécessite SSH)
4. **Contactez votre hébergeur** pour :
   - Activer mod_rewrite
   - Vérifier la configuration Apache
   - Accéder aux logs système

---

## 🎯 URLs après installation

### Sous-domaine
- Accueil : `https://signatures.domaine.com/`
- Signatures : `https://signatures.domaine.com/signatures`
- Chibi : `https://signatures.domaine.com/chibi`
- Logout : `https://signatures.domaine.com/logout`

### Sous-dossier
- Accueil : `https://domaine.com/signatures/`
- Signatures : `https://domaine.com/signatures/signatures`
- Chibi : `https://domaine.com/signatures/chibi`
- Logout : `https://domaine.com/signatures/logout`

---

## 📚 Ressources

- [Documentation cPanel](https://documentation.cpanel.net/)
- [Select PHP Version](https://docs.cpanel.net/knowledge-base/web-services/select-php-version/)
- [File Manager](https://docs.cpanel.net/knowledge-base/web-services/file-manager/)
