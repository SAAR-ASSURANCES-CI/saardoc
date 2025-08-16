# Protection des Documents - Guide d'utilisation

## Vue d'ensemble

Ce système de protection empêche la copie, la sélection et la capture d'écran des documents publiés. Il utilise une combinaison de CSS et JavaScript pour une protection robuste.

## Composants disponibles

### 1. Composant de base : `document-protection`

Protection simple et efficace pour la plupart des cas d'usage.

```blade
<x-document-protection :enabled="true" />
```

**Fonctionnalités :**
- Désactive la sélection de texte
- Bloque le clic droit
- Désactive les raccourcis clavier (Ctrl+C, Ctrl+A, etc.)
- Empêche les captures d'écran
- Protection des iframes PDF

### 2. Composant avancé : `document-protection-advanced`

Protection configurable avec différents niveaux et options.

### 3. Composant intelligent : `document-protection-smart`

Protection qui permet le défilement tout en gardant une protection efficace.

```blade
<x-document-protection-smart 
    :enabled="true" 
    level="high" 
    :allowSelection="false" 
    :allowRightClick="false" 
    :allowKeyboardShortcuts="false" 
    :showWarnings="true" 
/>
```

**Fonctionnalités :**
- ✅ **Défilement autorisé** - Permet de naviguer dans le document
- ✅ **Protection contre la copie** - Bloque la sélection et la copie de texte
- ✅ **Protection contre les captures** - Détecte les tentatives de capture
- ✅ **Barres de défilement stylisées** - Interface utilisateur améliorée

### 4. Composant spécialisé PDF : `pdf-protection`

Protection optimisée pour les documents PDF avec défilement natif.

```blade
<x-pdf-protection :enabled="true" :showWarnings="true" />
```

**Fonctionnalités :**
- ✅ **Défilement PDF natif** - Utilise le défilement intégré du navigateur
- ✅ **Protection iframe** - Sécurise le contenu PDF embarqué
- ✅ **Détection de capture** - Identifie les tentatives de défilement rapide
- ✅ **Protection avancée** - Effets visuels subtils contre les captures

```blade
<x-document-protection-advanced 
    :enabled="true" 
    level="high" 
    :allowSelection="false" 
    :allowRightClick="false" 
    :allowKeyboardShortcuts="false" 
    :allowScreenshots="false" 
    :showWarnings="true" 
/>
```

## Paramètres du composant avancé

| Paramètre | Type | Défaut | Description |
|-----------|------|---------|-------------|
| `enabled` | bool | `true` | Active/désactive la protection |
| `level` | string | `'high'` | Niveau de protection (`'low'`, `'medium'`, `'high'`) |
| `allowSelection` | bool | `false` | Permet la sélection de texte |
| `allowRightClick` | bool | `false` | Permet le clic droit |
| `allowKeyboardShortcuts` | bool | `false` | Permet les raccourcis clavier |
| `allowScreenshots` | bool | `false` | Permet les captures d'écran |
| `showWarnings` | bool | `true` | Affiche les messages d'avertissement |

## Niveaux de protection

### Niveau `low`
- Protection de base contre la copie
- Permet la navigation normale

### Niveau `medium`
- Protection renforcée
- Bloque la plupart des tentatives de copie
- Messages d'avertissement

### Niveau `high` (recommandé)
- Protection maximale
- Désactive les outils de développement
- Effets visuels subtils pour décourager les captures
- Nettoyage automatique de la console

## Utilisation dans les vues

### Protection simple
```blade
<x-layouts.app>
    <x-document-protection />
    
    <div class="document-content">
        <!-- Contenu du document -->
    </div>
</x-layouts.app>
```

### Protection configurée
```blade
<x-layouts.app>
    <x-document-protection-advanced 
        level="high" 
        :showWarnings="false" 
    />
    
    <div class="doc-protection doc-protection-high">
        <!-- Contenu protégé -->
    </div>
</x-layouts.app>
```

## Classes CSS requises

Pour que la protection fonctionne, ajoutez les classes CSS appropriées :

```html
<!-- Protection de base -->
<div class="document-protected">
    <!-- Contenu protégé -->
</div>

<!-- Protection avancée -->
<div class="doc-protection doc-protection-high">
    <!-- Contenu protégé -->
</div>
```

## Fonctionnalités de protection

### Protection contre la copie
- Désactive Ctrl+C, Ctrl+A, Ctrl+X
- Bloque la sélection de texte
- Empêche le glisser-déposer
- Désactive le menu contextuel

### Protection contre les captures
- Détecte la touche Print Screen
- Bloque F11 (plein écran)
- Désactive les outils de développement
- Effets visuels subtils

### Protection des iframes
- Désactive les interactions dans les PDF
- Bloque le clic droit dans les iframes
- Empêche la sélection dans les documents embarqués

## Messages d'avertissement

Le système affiche des messages d'avertissement colorés :
- 🔴 **Rouge** : Actions bloquées (erreur)
- 🔵 **Bleu** : Informations sur la protection
- 🟡 **Jaune** : Avertissements

## Limitations et considérations

### Ce qui peut être contourné
- **Captures d'écran** : Les utilisateurs peuvent toujours utiliser des outils externes
- **Outils de développement** : Les développeurs expérimentés peuvent les réactiver
- **Sélection de texte** : Certains navigateurs peuvent ignorer les restrictions CSS

### Ce qui est efficace
- **Copie via raccourcis** : Bloquage fiable des raccourcis clavier
- **Sélection de texte** : Protection CSS robuste
- **Clic droit** : Blocage du menu contextuel
- **Glisser-déposer** : Prévention des actions de drag & drop

## Personnalisation

### Styles personnalisés
Vous pouvez personnaliser l'apparence des messages d'avertissement en modifiant les classes CSS :

```css
.doc-warning {
    /* Personnalisez l'apparence ici */
    background: rgba(59, 130, 246, 0.95);
    border-radius: 12px;
    font-size: 16px;
}
```

### Messages personnalisés
Modifiez les textes des avertissements dans le composant JavaScript.

## Support des navigateurs

- ✅ **Chrome/Edge** : Support complet
- ✅ **Firefox** : Support complet
- ✅ **Safari** : Support complet
- ⚠️ **Internet Explorer** : Support limité

## Dépannage

### La protection ne fonctionne pas
1. Vérifiez que le composant est bien inclus
2. Assurez-vous que les classes CSS sont appliquées
3. Vérifiez la console pour les erreurs JavaScript

### Problèmes de défilement
1. **Défilement bloqué** : Utilisez le composant `document-protection-smart` ou `pdf-protection`
2. **Classes CSS manquantes** : Assurez-vous d'utiliser `smart-protection smart-protection-high` ou `pdf-protection`
3. **Iframe PDF** : Utilisez le composant `pdf-protection` pour une protection optimale

### Problèmes avec les iframes
- Les restrictions CORS peuvent limiter la protection
- Utilisez des paramètres d'URL pour les PDF : `#toolbar=0&navpanes=0&scrollbar=0`
- Pour les PDF, utilisez le composant `pdf-protection` spécialisé

### Performance
- La protection n'affecte pas significativement les performances
- Les vérifications sont optimisées pour un impact minimal
- Le défilement est préservé pour une expérience utilisateur fluide

## Exemples d'utilisation

### Page de document simple
```blade
<x-layouts.app>
    <x-document-protection />
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="document-protected">
                <h1>{{ $document->titre }}</h1>
                <div class="content">
                    {{ $document->contenu }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
```

### Protection avec options personnalisées
```blade
<x-layouts.app>
    <x-document-protection-advanced 
        level="medium" 
        :allowSelection="false" 
        :showWarnings="true" 
    />
    
    <div class="doc-protection doc-protection-medium">
        <!-- Contenu avec protection moyenne -->
    </div>
</x-layouts.app>
```

## Sécurité

⚠️ **Important** : Cette protection est une mesure de dissuasion, pas une solution de sécurité absolue. Elle empêche la plupart des tentatives de copie accidentelles mais peut être contournée par des utilisateurs déterminés avec des outils spécialisés.

Pour une sécurité maximale, combinez cette protection avec :
- Authentification robuste
- Contrôle d'accès basé sur les rôles
- Chiffrement des fichiers
- Watermarking des documents
- Surveillance des accès
