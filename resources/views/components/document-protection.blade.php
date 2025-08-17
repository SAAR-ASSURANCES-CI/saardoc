@props(['enabled' => true])

@if($enabled)
    <style>
        /* Protection contre la sélection de texte */
        .document-protected {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-touch-callout: none;
            -webkit-tap-highlight-color: transparent;
        }
        
        /* Protection contre le clic droit */
        .document-protected {
            -webkit-user-drag: none;
            -khtml-user-drag: none;
            -moz-user-drag: none;
            -o-user-drag: none;
            user-drag: none;
        }
        
        /* Désactiver la copie via le menu contextuel */
        .document-protected * {
            -webkit-user-select: none !important;
            -moz-user-select: none !important;
            -ms-user-select: none !important;
            user-select: none !important;
        }
        
        /* Protection pour les iframes PDF */
        .document-protected iframe {
            pointer-events: none;
        }
        
        /* Message d'avertissement */
        .protection-warning {
            position: fixed;
            top: 20px;
            right: 20px;
            background: rgba(239, 68, 68, 0.9);
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
        }
        
        .protection-warning.show {
            transform: translateX(0);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Protection contre le clic droit
            document.addEventListener('contextmenu', function(e) {
                e.preventDefault();
                showProtectionWarning('Clic droit désactivé pour protéger le document');
                return false;
            });
            
            // Protection contre les raccourcis clavier
            document.addEventListener('keydown', function(e) {
                // Ctrl+C, Ctrl+A, Ctrl+X, Ctrl+V, Ctrl+S, F12, Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U
                if (
                    (e.ctrlKey && (e.key === 'c' || e.key === 'a' || e.key === 'x' || e.key === 'v' || e.key === 's' || e.key === 'u')) ||
                    e.key === 'F12' ||
                    (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J'))
                ) {
                    e.preventDefault();
                    showProtectionWarning('Raccourci clavier désactivé pour protéger le document');
                    return false;
                }
            });
            
            // Protection contre la sélection de texte
            document.addEventListener('selectstart', function(e) {
                if (e.target.closest('.document-protected')) {
                    e.preventDefault();
                    return false;
                }
            });
            
            // Protection contre le glisser-déposer
            document.addEventListener('dragstart', function(e) {
                if (e.target.closest('.document-protected')) {
                    e.preventDefault();
                    return false;
                }
            });
            
            // Protection contre la copie via le menu Édition
            document.addEventListener('copy', function(e) {
                if (e.target.closest('.document-protected')) {
                    e.preventDefault();
                    showProtectionWarning('Copie désactivée pour protéger le document');
                    return false;
                }
            });
            
            // Protection contre les captures d'écran (détection de la touche Print Screen)
            document.addEventListener('keydown', function(e) {
                if (e.key === 'PrintScreen' || e.key === 'F11') {
                    e.preventDefault();
                    showProtectionWarning('Capture d\'écran désactivée pour protéger le document');
                    return false;
                }
            });
            
            // Désactiver la sélection dans les iframes
            const iframes = document.querySelectorAll('.document-protected iframe');
            iframes.forEach(iframe => {
                try {
                    iframe.addEventListener('load', function() {
                        try {
                            const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
                            iframeDoc.addEventListener('selectstart', function(e) {
                                e.preventDefault();
                                return false;
                            });
                            iframeDoc.addEventListener('contextmenu', function(e) {
                                e.preventDefault();
                                return false;
                            });
                        } catch (e) {
                            // Erreur CORS - on ne peut pas accéder au contenu de l'iframe
                        }
                    });
                } catch (e) {
                    // Erreur CORS - on ne peut pas accéder à l'iframe
                }
            });
            
            // Fonction pour afficher les avertissements
            function showProtectionWarning(message) {
                // Supprimer l'ancien avertissement s'il existe
                const existingWarning = document.querySelector('.protection-warning');
                if (existingWarning) {
                    existingWarning.remove();
                }
                
                // Créer le nouvel avertissement
                const warning = document.createElement('div');
                warning.className = 'protection-warning';
                warning.textContent = message;
                document.body.appendChild(warning);
                
                // Afficher l'avertissement
                setTimeout(() => warning.classList.add('show'), 100);
                
                // Masquer l'avertissement après 3 secondes
                setTimeout(() => {
                    warning.classList.remove('show');
                    setTimeout(() => warning.remove(), 300);
                }, 3000);
            }
            
            // Protection supplémentaire contre les outils de développement
            setInterval(function() {
                // Désactiver la console si elle est ouverte
                if (window.console && window.console.clear) {
                    try {
                        window.console.clear();
                    } catch (e) {}
                }
            }, 1000);
        });
    </script>
@endif
