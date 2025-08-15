# SAARDOC - Système de Gestion Documentaire

Un système moderne de gestion documentaire développé avec Laravel et Livewire, offrant une interface utilisateur élégante et des fonctionnalités avancées de gestion des documents.

## 🚀 Fonctionnalités

### 📊 Tableau de bord
- **Vue d'ensemble des documents** par type avec statistiques
- **Barre de recherche élégante** pour trouver rapidement les documents
- **Filtrage par type** de document
- **Pagination** pour une navigation fluide
- **Statistiques visuelles** par catégorie de document

### 📚 Gestion des documents
- **8 types de documents** supportés :
  - Notes de service
  - Guides
  - Manuels de procédures
  - Textes réglementaires et législatifs
  - Tarifs
  - Supports de formation
  - Organigrammes et répertoire interne
  - Politiques et chartes internes
- **Publication de documents** avec upload de fichiers
- **Consultation en ligne** sans téléchargement
- **Notifications automatiques** par email aux employés
- **Gestion complète** (création, modification, suppression)

### 👥 Gestion des utilisateurs
- **3 niveaux de rôles** :
  - **Employé** : Consultation des documents publics
  - **RH** : Gestion des documents et consultation des utilisateurs
  - **Administrateur** : Accès complet à toutes les fonctionnalités
- **Gestion des comptes** (création, modification, suppression)
- **Contrôle des accès** (blocage/déblocage)
- **Gestion des mots de passe**

### 🔒 Sécurité
- **Authentification** Laravel Breeze
- **Autorisations** basées sur les rôles
- **Politiques d'accès** personnalisées
- **Protection contre le téléchargement** non autorisé

## 🛠️ Technologies utilisées

- **Backend** : Laravel 11
- **Frontend** : Livewire 3, Tailwind CSS
- **Base de données** : MySQL/PostgreSQL
- **Authentification** : Laravel Breeze
- **Notifications** : Système de notifications Laravel
- **Stockage** : Système de fichiers Laravel

## 📋 Prérequis

- PHP 8.2+
- Composer
- MySQL/PostgreSQL
- Node.js et NPM

## 🚀 Installation

1. **Cloner le projet**
   ```bash
   git clone [url-du-projet]
   cd saardoc
   ```

2. **Installer les dépendances**
   ```bash
   composer install
   npm install
   ```

3. **Configuration de l'environnement**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configuration de la base de données**
   ```bash
   # Modifier .env avec vos informations de base de données
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=saardoc
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Exécuter les migrations et seeders**
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Créer le lien symbolique de stockage**
   ```bash
   php artisan storage:link
   ```

7. **Compiler les assets**
   ```bash
   npm run build
   ```

8. **Démarrer le serveur**
   ```bash
   php artisan serve
   ```

## 👤 Comptes par défaut

Après l'installation, les comptes suivants sont créés automatiquement :

- **Administrateur** : `admin@saardoc.com` / `password`
- **RH** : `rh@saardoc.com` / `password`
- **Employé** : `employe@saardoc.com` / `password`

## 📁 Structure du projet

```
saardoc/
├── app/
│   ├── Http/Controllers/     # Contrôleurs
│   ├── Livewire/            # Composants Livewire
│   ├── Models/              # Modèles Eloquent
│   ├── Notifications/       # Notifications
│   └── Policies/            # Politiques d'autorisation
├── database/
│   ├── migrations/          # Migrations de base de données
│   └── seeders/            # Seeders
├── resources/
│   └── views/              # Vues Blade et Livewire
└── routes/                 # Définition des routes
```

## 🔧 Configuration

### Types de documents supportés
Le système supporte les formats suivants :
- **PDF** : Aperçu en ligne
- **TXT** : Affichage du contenu
- **DOC/DOCX, XLS/XLSX, PPT/PPTX** : Informations de base

### Limites de fichiers
- **Taille maximale** : 10 MB
- **Types autorisés** : PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT

## 📧 Notifications

Le système envoie automatiquement des notifications par email :
- **Nouveaux documents** : Notification à tous les employés
- **Format personnalisé** avec détails du document
- **Queue support** pour les performances

## 🎨 Interface utilisateur

- **Design responsive** adapté à tous les écrans
- **Mode sombre** intégré
- **Navigation intuitive** avec sidebar
- **Composants interactifs** Livewire
- **Feedback utilisateur** avec messages de succès/erreur

## 🔐 Sécurité et autorisations

### Rôles et permissions
- **Employé** : Lecture seule des documents publics
- **RH** : Gestion des documents + consultation des utilisateurs
- **Administrateur** : Accès complet + gestion des utilisateurs

### Politiques d'accès
- **DocumentPolicy** : Contrôle l'accès aux documents
- **UserPolicy** : Contrôle la gestion des utilisateurs
- **Middleware** : Vérification des rôles

## 🚀 Déploiement

### Production
1. **Optimiser l'application**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

2. **Configurer la queue**
   ```bash
   # Pour les notifications en arrière-plan
   php artisan queue:work
   ```

3. **Sécuriser l'application**
   - HTTPS obligatoire
   - Variables d'environnement sécurisées
   - Logs d'erreurs configurés

## 🤝 Contribution

1. Fork le projet
2. Créer une branche feature (`git checkout -b feature/AmazingFeature`)
3. Commit les changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 📞 Support

Pour toute question ou problème :
- Créer une issue sur GitHub
- Contacter l'équipe de développement

---

**SAARDOC** - Simplifiez la gestion de vos documents d'entreprise ! 📚✨
