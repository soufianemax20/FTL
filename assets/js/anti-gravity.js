/**
 * Anti-Gravity Core JS
 * Handles 3D Parallax, Layer Depth, and Mouse Interactions.
 */

document.addEventListener('DOMContentLoaded', () => {
    initAntiGravity();
});

function initAntiGravity() {
    const cards = document.querySelectorAll('.card-3d, .ctr-main-content, .group');
    const heroSection = document.querySelector('.site-main section:first-of-type');

    // 1. Mouse Move Parallax for Hero Section
    if (heroSection) {
        heroSection.addEventListener('mousemove', (e) => {
            const { clientX, clientY } = e;
            const centerX = window.innerWidth / 2;
            const centerY = window.innerHeight / 2;

            // Calculate intensity
            const x = (clientX - centerX) / centerX;
            const y = (clientY - centerY) / centerY;

            // Move Background Layers (Deep)
            const deepLayers = heroSection.querySelectorAll('.absolute.inset-0');
            deepLayers.forEach(layer => {
                layer.style.transform = `translate(${x * -20}px, ${y * -20}px)`;
            });

            // Move Floating Elements (Top)
            const floatingElements = heroSection.querySelectorAll('.transform-gpu');
            floatingElements.forEach(el => {
                const speed = el.getAttribute('data-speed') || 20;
                el.style.transform = `translate(${x * speed}px, ${y * speed}px)`;
            });
        });
    }

    // 2. 3D Tilt Effect for Cards
    cards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            if (window.innerWidth < 768) return; // Disable on mobile

            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = ((y - centerY) / centerY) * -10; // Max 10deg rotation
            const rotateY = ((x - centerX) / centerX) * 10;

            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;

            // Adjust Glow/Reflection
            card.style.setProperty('--mouse-x', `${x}px`);
            card.style.setProperty('--mouse-y', `${y}px`);
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale3d(1, 1, 1)';
        });
    });
}
