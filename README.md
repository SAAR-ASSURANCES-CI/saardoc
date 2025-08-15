# 📚 SAAR DOC - Plateforme de Documentation

**SAAR ASSURANCES CI** - Plateforme web de consultation de documents internes

## 🎯 Description du Projet

SAAR DOC est une plateforme web sécurisée permettant aux employés de **SAAR ASSURANCES CI** de consulter des documents internes sans possibilité de téléchargement, capture d'écran ou prise de photo.

## 🛡️ Fonctionnalités de Sécurité

- ✅ **Consultation uniquement** - Pas de téléchargement
- ✅ **Protection contre les captures** - Désactivation des raccourcis clavier
- ✅ **Authentification obligatoire** - Système de connexion sécurisé
- ✅ **Gestion des permissions** - Accès basé sur les rôles
- ✅ **Audit des consultations** - Traçabilité des accès

## 🚀 Technologies Utilisées

- **Backend**: Laravel 12 (PHP 8.2)
- **Frontend**: Livewire, Alpine.js, Tailwind CSS
- **Base de données**: MySQL 8.0
- **Cache**: Redis
- **Serveur web**: Nginx/Apache

## 📋 Prérequis

- PHP 8.2 ou supérieur
- Composer
- Node.js 18+ et npm
- MySQL 8.0
- Redis
- Nginx ou Apache
- Git

## 🚀 Installation Locale

### 1. Cloner le projet

```bash
git clone <repository-url>
cd saardoc
```

### 2. Installation des dépendances

```bash
# Installation des dépendances PHP
composer install

# Installation des dépendances Node.js
npm install
```

### 3. Configuration de l'environnement

```bash
# Copier le fichier de configuration
cp .env.example .env

# Générer la clé d'application
php artisan key:generate

### 5. Exécution des migrations et seeders

```bash
# Exécuter les migrations
php artisan migrate

### 6. Compilation des assets

```bash
# Compiler les assets pour la production
npm run build

# Ou pour le développement avec recompilation automatique
npm run dev
```

### 7. Démarrer le serveur de développement

```bash
# Démarrer le serveur Laravel
php artisan serve

# ou
composer run dev

# L'application sera accessible sur http://localhost:8000
```

## 🚀 Commandes Utiles

### Laravel
```bash
# Exécuter les migrations
php artisan migrate

# Exécuter les seeders
php artisan db:seed

# Vider le cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 🔒 Sécurité

### Protection des Documents

- Les documents sont stockés dans `storage/app/documents/`
- Accès contrôlé via middleware d'authentification
- Headers de sécurité pour empêcher le téléchargement
- Désactivation des raccourcis clavier de capture

### Authentification

- Système de connexion sécurisé
- Gestion des sessions avec Redis
- Protection CSRF
- Validation des permissions par rôle

## 🧪 Tests

```bash
# Exécuter les tests
php artisan test

# Tests avec couverture
php artisan test --coverage
```

### Workflow Git

```bash
# Créer une nouvelle branche
git checkout -b feature/nouvelle-fonctionnalite

# Commiter les changements
git add .
git commit -m "feat: ajout de la nouvelle fonctionnalité"

# Pousser vers le serveur
git push origin feature/nouvelle-fonctionnalite
```

## 📄 Licence

Ce projet est propriétaire de **SAAR ASSURANCES CI**. Tous droits réservés.

---

**Développé avec ❤️ par l'équipe SAAR ASSURANCES CI**
