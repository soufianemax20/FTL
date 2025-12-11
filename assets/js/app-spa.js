document.addEventListener('DOMContentLoaded', () => {

    // Check if Barba is loaded
    if (typeof barba !== 'undefined') {

        barba.init({
            debug: true,
            transitions: [{
                name: 'opacity-transition',
                leave(data) {
                    return gsap.to(data.current.container, {
                        opacity: 0,
                        duration: 0.5
                    });
                },
                enter(data) {
                    return gsap.from(data.next.container, {
                        opacity: 0,
                        duration: 0.5
                    });
                },
                after(data) {
                    // Re-initialize 3D Tilt Effects
                    if (typeof VanillaTilt !== 'undefined') {
                        VanillaTilt.init(document.querySelectorAll(".card-3d"), {
                            max: 15,
                            speed: 400,
                            glare: true,
                            "max-glare": 0.2,
                        });
                    }

                    // Re-initialize Alpine.js if needed (Alpine usually handles DOM mutations, but sometimes needs a nudge)
                    // In a full SPA, we might need to manually restart Alpine on the new container.
                    // For now, we rely on Alpine's MutationObserver.

                    // RE-INIT PLUGIN SCRIPTS
                    // This is a hack to force the car selector to work after AJAX navigation.
                    // We look for scripts with 'ctr' in the src and reload them.
                    document.querySelectorAll('script').forEach(script => {
                        if (script.src && script.src.includes('ctr')) {
                            const newScript = document.createElement('script');
                            newScript.src = script.src;
                            newScript.async = false;
                            document.body.appendChild(newScript);
                        }
                    });

                    // Scroll to top
                    window.scrollTo(0, 0);
                }
            }]
        });
    }

    // PWA Install Prompt Logic
    let deferredPrompt;
    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;
        // Show install button if we had one (we can add one to the footer later)
        console.log('App can be installed');
    });

});
