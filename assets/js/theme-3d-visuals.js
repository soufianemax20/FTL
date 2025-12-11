/**
 * Tuning Mania - Premium 3D Visuals & Interaction Script
 * Handles Canvas animations and 3D Tilt effects.
 */

document.addEventListener('DOMContentLoaded', () => {
    initHeroCanvas();
    initTiltEffect();
});

/**
 * ------------------------------------------------------------------------
 * 1. HERO CANVAS ANIMATION (Interactive Particle Network)
 * ------------------------------------------------------------------------
 */
function initHeroCanvas() {
    const container = document.getElementById('hero-3d-container');
    if (!container) return;

    // Create Canvas
    const canvas = document.createElement('canvas');
    container.appendChild(canvas);

    const ctx = canvas.getContext('2d');
    let width, height;
    let particles = [];

    // Config
    const particleCount = window.innerWidth < 768 ? 40 : 100; // Less on mobile
    const connectionDistance = 150;
    const mouseDistance = 200;

    // Mouse State
    let mouse = { x: null, y: null };

    // Resize Handler
    const resize = () => {
        width = canvas.width = container.offsetWidth;
        height = canvas.height = container.offsetHeight;
    };
    window.addEventListener('resize', resize);
    resize();

    // Mouse Listeners
    container.addEventListener('mousemove', (e) => {
        const rect = canvas.getBoundingClientRect();
        mouse.x = e.clientX - rect.left;
        mouse.y = e.clientY - rect.top;
    });

    container.addEventListener('mouseleave', () => {
        mouse.x = null;
        mouse.y = null;
    });

    // Particle Class
    class Particle {
        constructor() {
            this.x = Math.random() * width;
            this.y = Math.random() * height;
            this.vx = (Math.random() - 0.5) * 0.5;
            this.vy = (Math.random() - 0.5) * 0.5;
            this.size = Math.random() * 2 + 1;
            this.color = Math.random() > 0.9 ? '#D7F207' : '#ffffff'; // Occasional neon particle
        }

        update() {
            this.x += this.vx;
            this.y += this.vy;

            // Bounce off edges
            if (this.x < 0 || this.x > width) this.vx *= -1;
            if (this.y < 0 || this.y > height) this.vy *= -1;

            // Mouse Interaction (Repel/Attract)
            if (mouse.x != null) {
                let dx = mouse.x - this.x;
                let dy = mouse.y - this.y;
                let distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < mouseDistance) {
                    const forceDirectionX = dx / distance;
                    const forceDirectionY = dy / distance;
                    const force = (mouseDistance - distance) / mouseDistance;
                    const directionMultiplier = (distance < mouseDistance / 2) ? 2 : -0.5; // Complex push/pull

                    this.vx -= forceDirectionX * force * 0.05 * directionMultiplier;
                    this.vy -= forceDirectionY * force * 0.05 * directionMultiplier;
                }
            }
        }

        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fillStyle = this.color;
            ctx.globalAlpha = 0.6;
            ctx.fill();
        }
    }

    // Init Particles
    for (let i = 0; i < particleCount; i++) {
        particles.push(new Particle());
    }

    // Animation Loop
    function animate() {
        ctx.clearRect(0, 0, width, height);

        // Update and Draw Particles
        particles.forEach(p => {
            p.update();
            p.draw();
        });

        // Connect Particles
        connectParticles();

        requestAnimationFrame(animate);
    }

    function connectParticles() {
        for (let a = 0; a < particles.length; a++) {
            for (let b = a; b < particles.length; b++) {
                let dx = particles[a].x - particles[b].x;
                let dy = particles[a].y - particles[b].y;
                let distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < connectionDistance) {
                    let opacityValue = 1 - (distance / connectionDistance);
                    ctx.strokeStyle = `rgba(255, 255, 255, ${opacityValue * 0.15})`;
                    ctx.beginPath();
                    ctx.lineWidth = 1;
                    ctx.moveTo(particles[a].x, particles[a].y);
                    ctx.lineTo(particles[b].x, particles[b].y);
                    ctx.stroke();
                }
            }
        }
    }

    animate();
}

/**
 * ------------------------------------------------------------------------
 * 2. 3D TILT EFFECT (Vanilla JS replacement for Tilt.js)
 * ------------------------------------------------------------------------
 * Applies to elements with class .card-3d
 */
function initTiltEffect() {
    const cards = document.querySelectorAll('.card-3d');

    cards.forEach(card => {
        card.addEventListener('mousemove', handleMouseMove);
        card.addEventListener('mouseleave', handleMouseLeave);
        card.addEventListener('mouseenter', handleMouseEnter);
    });

    function handleMouseMove(e) {
        const card = this;
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left; // x position within the element.
        const y = e.clientY - rect.top;  // y position within the element.

        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        const rotateX = ((y - centerY) / centerY) * -10; // Max rotation deg
        const rotateY = ((x - centerX) / centerX) * 10;

        // Add subtle glare effect if it exists
        const glare = card.querySelector('.card-glare');
        if (glare) {
            glare.style.transform = `translate(${x}px, ${y}px)`;
            glare.style.opacity = '1';
        }

        card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
    }

    function handleMouseLeave(e) {
        this.style.transform = `perspective(1000px) rotateX(0) rotateY(0) scale3d(1, 1, 1)`;

        const glare = this.querySelector('.card-glare');
        if (glare) {
            glare.style.opacity = '0';
        }
    }

    function handleMouseEnter(e) {
        // Transition settings for smooth entry
        this.style.transition = 'transform 0.1s ease-out';
    }
}
