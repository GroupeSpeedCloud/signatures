# Configuration Apache pour l'application Signatures

## 🎯 Architecture Requise

L'application utilise une architecture MVC avec un point d'entrée unique. **Le serveur web doit pointer vers le dossier `public/`**.

## 📁 Structure

```
signatures/
├── .htaccess              # Sécurité - protège les fichiers sensibles
├── public/
│   ├── index.php          # Point d'entrée unique
│   └── .htaccess          # Routage MVC
├── src/                   # Code source (protégé)
├── config.php             # Configuration (protégé)
└── vendor/                # Dépendances (protégé)
```

## ⚙️ Configuration Apache

### Option 1: VirtualHost (Recommandé)

```apache
<VirtualHost *:80>
    ServerName signatures.groupe-speed.cloud
    DocumentRoot /var/www/signatures/public
    
    <Directory /var/www/signatures/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    # Logs
    ErrorLog ${APACHE_LOG_DIR}/signatures_error.log
    CustomLog ${APACHE_LOG_DIR}/signatures_access.log combined
    
    # Sécurité
    Header always set X-Content-Type-Options "nosniff"
    Header always set X-Frame-Options "SAMEORIGIN"
</VirtualHost>
```

### Option 2: .htaccess (Développement)

Si vous ne pouvez pas modifier la configuration Apache, placez simplement les fichiers `.htaccess` dans les dossiers appropriés.

**Important** : Assurez-vous que `AllowOverride All` est activé dans la configuration Apache.

### Option 3: Redirection depuis la racine

Si votre hébergement impose que le DocumentRoot soit la racine du projet :

```apache
# Dans .htaccess racine
RewriteEngine On
RewriteCond %{REQUEST_URI} !^/public/
RewriteCond %{REQUEST_URI} !^/assets/
RewriteCond %{REQUEST_URI} !^/uploads/
RewriteRule ^(.*)$ public/$1 [L]
```

## 🔒 Sécurité des Fichiers

### Fichiers Protégés

Les fichiers suivants sont protégés par le `.htaccess` racine :

- ✅ `config.php` - Configuration (accès refusé)
- ✅ `composer.json` - Dépendances (accès refusé)
- ✅ `src/` - Code source (accès refusé)
- ✅ `vendor/` - Bibliothèques (accès refusé)
- ✅ `.git/` - Dépôt Git (accès refusé)

### En-têtes de Sécurité

Les `.htaccess` configurent automatiquement :

- `X-Content-Type-Options: nosniff`
- `X-Frame-Options: SAMEORIGIN`
- `X-XSS-Protection: 1; mode=block`
- `Referrer-Policy: strict-origin-when-cross-origin`
- `Content-Security-Policy` (configuré)

## 🚀 Modules Apache Requis

Activez ces modules Apache :

```bash
# Sur Ubuntu/Debian
sudo a2enmod rewrite
sudo a2enmod headers
sudo a2enmod expires
sudo a2enmod deflate
sudo a2enmod ssl

# Redémarrer Apache
sudo systemctl restart apache2
```

## 🔧 Vérification

### Tester la configuration

```bash
# Vérifier la syntaxe Apache
apachectl configtest

# Vérifier que mod_rewrite est activé
apache2ctl -M | grep rewrite
```

### Tester le routage

1. Accédez à `http://votre-domaine/`
2. Devrait afficher la page de login
3. Les URLs propres doivent fonctionner : `/signatures`, `/chibi`, `/logout`

## 🐛 Dépannage

### Erreur 404 sur toutes les pages

**Problème** : mod_rewrite n'est pas activé

**Solution** :
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

### Erreur 500 Internal Server Error

**Problème** : AllowOverride n'est pas activé

**Solution** :
```apache
<Directory /var/www/signatures/public>
    AllowOverride All
</Directory>
```

### Les assets ne chargent pas

**Problème** : Les chemins sont incorrects

**Solution** : Vérifiez que :
- `assets/` est accessible depuis la racine
- Les URLs dans le HTML commencent par `/assets/`

### Redirection HTTPS ne fonctionne pas

**Problème** : mod_ssl n'est pas activé

**Solution** :
```bash
sudo a2enmod ssl
sudo systemctl restart apache2
```

## 📝 Configuration SSL (Production)

```apache
<VirtualHost *:443>
    ServerName signatures.groupe-speed.cloud
    
    SSLEngine on
    SSLCertificateFile /path/to/certificate.crt
    SSLCertificateKeyFile /path/to/private.key
    SSLCertificateChainFile /path/to/chain.crt
    
    # HSTS (HTTP Strict Transport Security)
    Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains"
    
    # ... reste de la configuration
</VirtualHost>
```

## 🎯 Bonnes Pratiques

1. ✅ **Toujours pointer vers `public/`** - Jamais vers la racine
2. ✅ **Garder AllowOverride All** - Pour que .htaccess fonctionne
3. ✅ **Activer mod_rewrite** - Requis pour le routage MVC
4. ✅ **Utiliser HTTPS en production** - Redirection automatique configurée
5. ✅ **Logs activés** - Pour le débogage
6. ✅ **En-têtes de sécurité** - Déjà configurés dans .htaccess

## 🔍 Test de Sécurité

```bash
# Vérifier que config.php n'est pas accessible
curl http://votre-domaine/config.php
# Devrait retourner 403 Forbidden

# Vérifier que src/ n'est pas accessible
curl http://votre-domaine/src/Router.php
# Devrait retourner 403 Forbidden

# Vérifier que l'application fonctionne
curl http://votre-domaine/
# Devrait retourner le HTML de la page de login
```

## 📚 Ressources

- [Documentation Apache mod_rewrite](https://httpd.apache.org/docs/current/mod/mod_rewrite.html)
- [Documentation Apache mod_headers](https://httpd.apache.org/docs/current/mod/mod_headers.html)
- [Mozilla SSL Configuration Generator](https://ssl-config.mozilla.org/)
