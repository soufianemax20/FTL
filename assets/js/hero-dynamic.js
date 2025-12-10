/**
 * TUNER FILES LAB - Dynamic Hero Controller
 * Handles loading screen, tuning slider, and counter animations.
 * No Three.js - Pure CSS animations for background.
 */

document.addEventListener('DOMContentLoaded', function () {
    console.log("Hero Dynamic: Init");

    // === LOADING SCREEN ===
    const loader = document.getElementById('hero-loader');
    if (loader) {
        setTimeout(() => {
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 1000);
        }, 600);
    }

    // === TUNING SLIDER LOGIC ===
    const slider = document.getElementById('tuning-slider');
    const hpStat = document.getElementById('hp-stat');
    const nmStat = document.getElementById('nm-stat');

    // Base Stats (Typical 2.0 TDI)
    const stockHP = 180;
    const targetHP = 265;
    const stockNM = 320;
    const targetNM = 440;

    function updateStats(val) {
        const fraction = val / 100;

        // Calculate current values
        const currentHP = Math.floor(stockHP + (targetHP - stockHP) * fraction);
        const currentNM = Math.floor(stockNM + (targetNM - stockNM) * fraction);

        // Update DOM
        if (hpStat) {
            hpStat.innerHTML = `${currentHP}<span class="text-lg text-gray-500 ml-1">hp</span>`;
        }
        if (nmStat) {
            nmStat.innerHTML = `${currentNM}<span class="text-lg text-gray-500 ml-1">Nm</span>`;
        }
    }

    if (slider) {
        slider.addEventListener('input', (e) => {
            updateStats(parseInt(e.target.value));
        });

        // Initial state
        updateStats(0);

        // Auto demo animation on load
        setTimeout(() => {
            gsap.to(slider, {
                value: 60,
                duration: 2,
                ease: "power2.inOut",
                yoyo: true,
                repeat: 1,
                onUpdate: () => {
                    updateStats(slider.value);
                }
            });
        }, 1500);
    }

    // === COUNTER ANIMATION (For Stats HUD) ===
    const counters = document.querySelectorAll('.counter');

    const animateCounter = (counter) => {
        const target = parseInt(counter.getAttribute('data-target')) || 0;
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        const update = () => {
            current += step;
            if (current < target) {
                counter.textContent = Math.floor(current).toLocaleString();
                requestAnimationFrame(update);
            } else {
                counter.textContent = target.toLocaleString();
            }
        };

        update();
    };

    // Intersection Observer for counters
    if (counters.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => observer.observe(counter));
    }

    // === PARALLAX ON FLOATING ELEMENTS (Optional Enhancement) ===
    document.addEventListener('mousemove', (e) => {
        const chips = document.querySelectorAll('.float-chip');
        const mouseX = (e.clientX / window.innerWidth - 0.5) * 20;
        const mouseY = (e.clientY / window.innerHeight - 0.5) * 20;

        chips.forEach((chip, index) => {
            const depth = (index + 1) * 0.5;
            chip.style.transform = `translate(${mouseX * depth}px, ${mouseY * depth}px)`;
        });
    });

    console.log("Hero Dynamic: Ready");
});
