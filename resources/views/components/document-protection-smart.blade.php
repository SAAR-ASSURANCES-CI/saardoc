@props([
    'enabled' => true,
    'level' => 'high',
    'allowSelection' => false,
    'allowRightClick' => false,
    'allowKeyboardShortcuts' => false,
    'showWarnings' => true
])

@if($enabled)
    <style>
        /* Protection intelligente qui permet le défilement */
        .smart-protection {
            position: relative;
        }
        
        .smart-protection-{{ $level }} {
            /* Protection contre la sélection de texte */
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-touch-callout: none;
            -webkit-tap-highlight-color: transparent;
            
            /* Permettre le défilement */
            overflow: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(156, 163, 175, 0.5) transparent;
        }
        
        /* Protection contre la sélection du contenu */
        .smart-protection-{{ $level }} * {
            -webkit-user-select: none !important;
            -moz-user-select: none !important;
            -ms-user-select: none !important;
            user-select: none !important;
        }
        
        /* Permettre la sélection des éléments de défilement */
        .smart-protection-{{ $level }}::-webkit-scrollbar,
        .smart-protection-{{ $level }}::-webkit-scrollbar-track,
        .smart-protection-{{ $level }}::-webkit-scrollbar-thumb {
            -webkit-user-select: auto !important;
            -moz-user-select: auto !important;
            -ms-user-select: auto !important;
            user-select: auto !important;
        }
        
        /* Styles des barres de défilement */
        .smart-protection-{{ $level }}::-webkit-scrollbar {
            width: 8px;
        }
        
        .smart-protection-{{ $level }}::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .smart-protection-{{ $level }}::-webkit-scrollbar-thumb {
            background: rgba(156, 163, 175, 0.5);
            border-radius: 4px;
        }
        
        .smart-protection-{{ $level }}::-webkit-scrollbar-thumb:hover {
            background: rgba(156, 163, 175, 0.7);
        }
        
        /* Protection contre le glisser-déposer */
        .smart-protection-{{ $level }} {
            -webkit-user-drag: none;
            -khtml-user-drag: none;
            -moz-user-drag: none;
            -o-user-drag: none;
            user-drag: none;
        }
        
        /* Protection pour les iframes */
        .smart-protection-{{ $level }} iframe {
            pointer-events: {{ $allowRightClick ? 'auto' : 'none' }};
        }
        
        /* Messages d'avertissement */
        @if($showWarnings)
        .smart-warning {
            position: fixed;
            top: 20px;
            right: 20px;
            background: rgba(239, 68, 68, 0.95);
            color: white;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            z-index: 9999;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateX(400px);
            transition: transform 0.3s ease;
            max-width: 300px;
            word-wrap: break-word;
        }
        
        .smart-warning.show {
            transform: translateX(0);
        }
        
        .smart-warning.info {
            background: rgba(59, 130, 246, 0.95);
        }
        
        .smart-warning.warning {
            background: rgba(245, 158, 11, 0.95);
        }
        @endif
        
        /* Protection contre les outils de développement (niveau élevé) */
        @if($level === 'high')
        .smart-protection-high {
            -webkit-filter: contrast(1.02) brightness(1.01);
            filter: contrast(1.02) brightness(1.01);
        }
        @endif
        
        /* Protection contre les captures d'écran avancées */
        .smart-protection-{{ $level }} {
            /* Décourager les captures d'écran avec des effets subtils */
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            -webkit-transform: translateZ(0);
            transform: translateZ(0);
        }
        
        /* Effet de protection visuelle */
        .smart-protection-{{ $level }}::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: -1;
            background: linear-gradient(
                45deg,
                transparent 0%,
                rgba(255, 255, 255, 0.001) 50%,
                transparent 100%
            );
            animation: protection-shimmer 10s infinite linear;
        }
        
        @keyframes protection-shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const protectionLevel = '{{ $level }}';
            const showWarnings = {{ $showWarnings ? 'true' : 'false' }};
            
            // Fonction pour afficher les avertissements
            function showWarning(message, type = 'error') {
                if (!showWarnings) return;
                
                const existingWarning = document.querySelector('.smart-warning');
                if (existingWarning) {
                    existingWarning.remove();
                }
                
                const warning = document.createElement('div');
                warning.className = `smart-warning ${type}`;
                warning.textContent = message;
                document.body.appendChild(warning);
                
                setTimeout(() => warning.classList.add('show'), 100);
                
                setTimeout(() => {
                    warning.classList.remove('show');
                    setTimeout(() => warning.remove(), 300);
                }, 4000);
            }
            
            // Protection contre le clic droit
            @if(!$allowRightClick)
            document.addEventListener('contextmenu', function(e) {
                if (e.target.closest('.smart-protection-' + protectionLevel)) {
                    e.preventDefault();
                    showWarning('Clic droit désactivé pour protéger le document');
                    return false;
                }
            });
            @endif
            
            // Protection contre les raccourcis clavier
            @if(!$allowKeyboardShortcuts)
            document.addEventListener('keydown', function(e) {
                if (e.target.closest('.smart-protection-' + protectionLevel)) {
                    const shortcuts = [
                        { ctrl: true, key: 'c', desc: 'Copier' },
                        { ctrl: true, key: 'a', desc: 'Tout sélectionner' },
                        { ctrl: true, key: 'x', desc: 'Couper' },
                        { ctrl: true, key: 'v', desc: 'Coller' },
                        { ctrl: true, key: 's', desc: 'Enregistrer' },
                        { ctrl: true, key: 'u', desc: 'Code source' },
                        { key: 'F12', desc: 'Outils de développement' },
                        { ctrl: true, shift: true, key: 'I', desc: 'Inspecter' },
                        { ctrl: true, shift: true, key: 'J', desc: 'Console' },
                        { ctrl: true, shift: true, key: 'C', desc: 'Inspecter l\'élément' }
                    ];
                    
                    for (const shortcut of shortcuts) {
                        if (
                            (shortcut.ctrl ? e.ctrlKey : true) &&
                            (shortcut.shift ? e.shiftKey : true) &&
                            e.key.toLowerCase() === shortcut.key.toLowerCase()
                        ) {
                            e.preventDefault();
                            showWarning(`Raccourci ${shortcut.desc} désactivé pour protéger le document`);
                            return false;
                        }
                    }
                }
            });
            @endif
            
            // Protection intelligente contre la sélection (permet le défilement)
            @if(!$allowSelection)
            document.addEventListener('selectstart', function(e) {
                if (e.target.closest('.smart-protection-' + protectionLevel)) {
                    // Permettre la sélection des éléments de défilement
                    if (e.target.tagName === 'SCROLLBAR' || 
                        e.target.classList.contains('scrollbar') ||
                        e.target.closest('.scrollbar') ||
                        e.target.closest('::-webkit-scrollbar') ||
                        e.target.closest('.smart-protection-' + protectionLevel + '::-webkit-scrollbar')) {
                        return true;
                    }
                    
                    // Permettre la sélection pour le défilement
                    if (e.target.closest('.smart-protection-' + protectionLevel + '::-webkit-scrollbar-thumb') ||
                        e.target.closest('.smart-protection-' + protectionLevel + '::-webkit-scrollbar-track')) {
                        return true;
                    }
                    
                    e.preventDefault();
                    return false;
                }
            });
            @endif
            
            // Protection contre le glisser-déposer
            document.addEventListener('dragstart', function(e) {
                if (e.target.closest('.smart-protection-' + protectionLevel)) {
                    e.preventDefault();
                    return false;
                }
            });
            
            // Protection contre la copie
            @if(!$allowSelection)
            document.addEventListener('copy', function(e) {
                if (e.target.closest('.smart-protection-' + protectionLevel)) {
                    e.preventDefault();
                    showWarning('Copie désactivée pour protéger le document');
                    return false;
                }
            });
            @endif
            
            // Protection contre les captures d'écran
            document.addEventListener('keydown', function(e) {
                if (e.key === 'PrintScreen' || e.key === 'F11') {
                    e.preventDefault();
                    showWarning('Capture d\'écran désactivée pour protéger le document');
                    return false;
                }
            });
            
            // Protection des iframes
            const iframes = document.querySelectorAll('.smart-protection-' + protectionLevel + ' iframe');
            iframes.forEach(iframe => {
                try {
                    iframe.addEventListener('load', function() {
                        try {
                            const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
                            
                            @if(!$allowSelection)
                            iframeDoc.addEventListener('selectstart', function(e) {
                                e.preventDefault();
                                return false;
                            });
                            @endif
                            
                            @if(!$allowRightClick)
                            iframeDoc.addEventListener('contextmenu', function(e) {
                                e.preventDefault();
                                return false;
                            });
                            @endif
                        } catch (e) {
                            // Erreur CORS - on ne peut pas accéder au contenu de l'iframe
                        }
                    });
                } catch (e) {
                    // Erreur CORS - on ne peut pas accéder à l'iframe
                }
            });
            
            // Protection supplémentaire pour le niveau élevé
            @if($level === 'high')
            setInterval(function() {
                // Désactiver la console
                if (window.console && window.console.clear) {
                    try {
                        window.console.clear();
                    } catch (e) {}
                }
                
                // Désactiver les outils de développement
                if (window.console && window.console.log) {
                    try {
                        window.console.log = function() {};
                        window.console.warn = function() {};
                        window.console.error = function() {};
                    } catch (e) {}
                }
            }, 500);
            @endif
            
            // Message d'information sur la protection
            @if($showWarnings)
            setTimeout(() => {
                showWarning('Document protégé - Défilement autorisé, copie interdite', 'info');
            }, 2000);
            @endif
            
            // Protection contre les tentatives de capture d'écran avancées
            let lastScrollTop = 0;
            let scrollAttempts = 0;
            
            document.addEventListener('scroll', function(e) {
                if (e.target.closest('.smart-protection-' + protectionLevel)) {
                    const currentScrollTop = e.target.scrollTop || window.pageYOffset;
                    
                    // Détecter les tentatives de défilement rapide (possible capture)
                    if (Math.abs(currentScrollTop - lastScrollTop) > 1000) {
                        scrollAttempts++;
                        if (scrollAttempts > 3) {
                            showWarning('Défilement trop rapide détecté - possible tentative de capture', 'warning');
                            scrollAttempts = 0;
                        }
                    }
                    
                    lastScrollTop = currentScrollTop;
                }
            });
        });
    </script>
@endif
