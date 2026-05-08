# Test de configuration Apache

Ce script vérifie que votre configuration Apache est correcte.

## ✅ Checklist

### 1. Modules Apache activés

```bash
# Vérifier mod_rewrite
apache2ctl -M | grep rewrite
# Doit afficher : rewrite_module (shared)

# Vérifier mod_headers
apache2ctl -M | grep headers
# Doit afficher : headers_module (shared)

# Vérifier mod_ssl (pour HTTPS)
apache2ctl -M | grep ssl
# Doit afficher : ssl_module (shared)
```

### 2. Permissions des fichiers

```bash
# Les fichiers doivent être lisibles
chmod 644 public/index.php
chmod 644 .htaccess
chmod 644 public/.htaccess

# Le dossier public doit être exécutable
chmod 755 public/
```

### 3. Configuration VirtualHost

Vérifiez que votre VirtualHost pointe vers `public/` :

```apache
DocumentRoot /chemin/vers/signatures/public
<Directory /chemin/vers/signatures/public>
    AllowOverride All
    Require all granted
</Directory>
```

### 4. Tests de sécurité

```bash
# Test 1 : config.php doit être inaccessible
curl -I http://votre-domaine/config.php
# Résultat attendu : 403 Forbidden

# Test 2 : src/ doit être inaccessible
curl -I http://votre-domaine/src/Router.php
# Résultat attendu : 403 Forbidden

# Test 3 : vendor/ doit être inaccessible
curl -I http://votre-domaine/vendor/autoload.php
# Résultat attendu : 403 Forbidden

# Test 4 : .git doit être inaccessible
curl -I http://votre-domaine/.git/config
# Résultat attendu : 403 Forbidden

# Test 5 : La page d'accueil doit fonctionner
curl http://votre-domaine/
# Résultat attendu : HTML de la page de login (200 OK)

# Test 6 : Le routage doit fonctionner
curl http://votre-domaine/signatures
# Résultat attendu : HTML du générateur (200 OK) ou 302 vers login
```

### 5. En-têtes de sécurité

```bash
# Vérifier les en-têtes
curl -I http://votre-domaine/

# Doit inclure :
# X-Content-Type-Options: nosniff
# X-Frame-Options: SAMEORIGIN
# X-XSS-Protection: 1; mode=block
```

## 🔧 Commandes de vérification rapide

```bash
# 1. Tester la syntaxe Apache
apachectl configtest

# 2. Redémarrer Apache
sudo systemctl restart apache2

# 3. Voir les logs d'erreur
tail -f /var/log/apache2/signatures_error.log

# 4. Vérifier les logs d'accès
tail -f /var/log/apache2/signatures_access.log
```

## ❌ Erreurs courantes

### Erreur 500 Internal Server Error

**Cause** : `.htaccess` mal formé ou `AllowOverride` non activé

**Solution** :
```bash
# Vérifier les logs
tail /var/log/apache2/error.log

# Activer AllowOverride dans Apache
sudo nano /etc/apache2/apache2.conf
# Ajouter : AllowOverride All dans le Directory

# Redémarrer Apache
sudo systemctl restart apache2
```

### Erreur 404 Not Found

**Cause** : mod_rewrite non activé ou DocumentRoot incorrect

**Solution** :
```bash
# Activer mod_rewrite
sudo a2enmod rewrite
sudo systemctl restart apache2

# Vérifier DocumentRoot
grep -r "DocumentRoot" /etc/apache2/sites-enabled/
# Doit pointer vers .../signatures/public
```

### Page blanche

**Cause** : Erreur PHP non affichée

**Solution** :
```bash
# Vérifier les logs PHP
tail /var/log/apache2/signatures_error.log

# Ou activer display_errors temporairement
# Dans public/.htaccess, décommenter :
# php_flag display_errors On
```

### Boucle de redirection

**Cause** : Règles .htaccess conflictuelles

**Solution** :
```bash
# Vérifier les logs Apache
tail /var/log/apache2/error.log

# Tester en désactivant temporairement .htaccess
mv .htaccess .htaccess.bak
mv public/.htaccess public/.htaccess.bak
```

## 📝 Fichier de test rapide

Créez `public/test.php` :

```php
<?php
phpinfo();
```

Accédez à `http://votre-domaine/test.php`

- Si ça marche : Apache + PHP fonctionnent
- Si 404 : Problème de routage
- Si 403 : Problème de permissions

**Supprimez le fichier après le test !**

```bash
rm public/test.php
```

## 🎯 Configuration minimale requise

- Apache 2.4+
- PHP 8.0+
- mod_rewrite activé
- mod_headers activé
- AllowOverride All

## ✅ Tests automatisés

```bash
#!/bin/bash
# save-test.sh

DOMAIN="votre-domaine.com"

echo "Test de configuration Apache"
echo "=============================="

# Test 1 : Page d'accueil
echo -n "Page d'accueil... "
curl -s -o /dev/null -w "%{http_code}" http://$DOMAIN/ | grep -q "200" && echo "✅" || echo "❌"

# Test 2 : config.php protégé
echo -n "config.php protégé... "
curl -s -o /dev/null -w "%{http_code}" http://$DOMAIN/config.php | grep -q "403" && echo "✅" || echo "❌"

# Test 3 : src/ protégé
echo -n "src/ protégé... "
curl -s -o /dev/null -w "%{http_code}" http://$DOMAIN/src/Router.php | grep -q "403" && echo "✅" || echo "❌"

# Test 4 : Routage
echo -n "Routage /signatures... "
curl -s -o /dev/null -w "%{http_code}" http://$DOMAIN/signatures | grep -qE "200|302" && echo "✅" || echo "❌"

echo "=============================="
echo "Tests terminés"
```
