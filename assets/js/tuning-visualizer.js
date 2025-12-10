
/**
 * TuningVisualizer V2.0 - Cyberpunk Automotive Simulator
 * Features: 3D Engine, Holographic Dyno, Shockwaves, Physics Particles
 */
class TuningVisualizer {
    constructor(containerId) {
        this.container = document.getElementById(containerId);
        if (!this.container) return;

        // State
        this.currentStage = 0;
        this.modifiers = { pops: false, vmax: false, launch: false };
        this.time = 0;

        // Configuration
        this.configs = [
            { name: 'Stock', color: 0x00aaff, speed: 1.0, vibration: 0.001, curve: 1.0 },
            { name: 'Stage 1', color: 0xD7F207, speed: 2.5, vibration: 0.003, curve: 1.4 },
            { name: 'Stage 2', color: 0xFFAA00, speed: 4.0, vibration: 0.006, curve: 1.8 },
            { name: 'Stage 3', color: 0xFF0055, speed: 6.0, vibration: 0.015, curve: 2.4 }
        ];

        // Three.js Components
        this.scene = null;
        this.camera = null;
        this.renderer = null;

        // Groups
        this.mainGroup = new THREE.Group();
        this.engineGroup = new THREE.Group();
        this.hologramGroup = new THREE.Group();

        // Elements
        this.dynoLine = null;
        this.shockwaves = [];

        this.init();
        this.setupUI();
        this.animate();
    }

    init() {
        // 1. Scene & Camera
        this.scene = new THREE.Scene();
        // Fog for depth fading
        this.scene.fog = new THREE.FogExp2(0x050505, 0.02);

        this.camera = new THREE.PerspectiveCamera(45, this.container.clientWidth / this.container.clientHeight, 0.1, 100);
        this.camera.position.set(8, 4, 8);
        this.camera.lookAt(0, 1, 0);

        // 2. Renderer (High Quality)
        this.renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
        this.renderer.setSize(this.container.clientWidth, this.container.clientHeight);
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        this.renderer.toneMapping = THREE.ACESFilmicToneMapping;
        this.container.appendChild(this.renderer.domElement);

        // 3. Lighting
        const ambientLight = new THREE.AmbientLight(0x222222, 5);
        this.scene.add(ambientLight);

        this.pointLight = new THREE.PointLight(this.configs[0].color, 5, 20);
        this.pointLight.position.set(0, 5, 0);
        this.scene.add(this.pointLight);

        const blueRim = new THREE.SpotLight(0x00aaff, 5);
        blueRim.position.set(-10, 0, -5);
        this.scene.add(blueRim);

        // 4. Build Components
        this.scene.add(this.mainGroup);
        this.mainGroup.add(this.engineGroup);
        this.mainGroup.add(this.hologramGroup);

        this.buildCyberEngine();
        this.buildHolographicDyno();
        this.buildParticles();

        // 5. Events
        window.addEventListener('resize', () => this.onResize());

        // Mouse Parallax
        this.mouseX = 0; this.mouseY = 0;
        document.addEventListener('mousemove', (e) => {
            this.mouseX = (e.clientX - window.innerWidth / 2) * 0.0005;
            this.mouseY = (e.clientY - window.innerHeight / 2) * 0.0005;
        });
    }

    // --- 3D BUILDING BLOCKS ---

    buildCyberEngine() {
        // Core Block (Turbine Style)
        const geo = new THREE.CylinderGeometry(1, 1, 3, 8, 1, true);
        const mat = new THREE.MeshStandardMaterial({
            color: 0x111111,
            metalness: 0.9,
            roughness: 0.2,
            side: THREE.DoubleSide
        });
        const core = new THREE.Mesh(geo, mat);
        core.rotation.z = Math.PI / 2;
        this.engineGroup.add(core);

        // Glowing Rings (Stator)
        for(let i=0; i<5; i++) {
            const ring = new THREE.Mesh(
                new THREE.TorusGeometry(1.2, 0.05, 16, 32),
                new THREE.MeshBasicMaterial({ color: 0x333333 })
            );
            ring.position.x = -1.5 + (i * 0.75);
            ring.rotation.y = Math.PI / 2;
            this.engineGroup.add(ring);
        }

        // Inner Energy Rotor (Spinning part)
        const rotorGeo = new THREE.IcosahedronGeometry(0.8, 1);
        this.rotorMat = new THREE.MeshBasicMaterial({
            color: this.configs[0].color,
            wireframe: true,
            transparent: true,
            opacity: 0.5
        });
        this.rotor = new THREE.Mesh(rotorGeo, this.rotorMat);
        this.engineGroup.add(this.rotor);

        // Manifolds (Floating Tech)
        const pipeGeo = new THREE.TorusGeometry(1.5, 0.1, 8, 64, Math.PI);
        this.manifoldMat = new THREE.MeshStandardMaterial({ color: 0x222222, emissive: 0x000000 });

        // Top Pipes
        const pipesTop = new THREE.Mesh(pipeGeo, this.manifoldMat);
        pipesTop.rotation.x = Math.PI; // Arch over
        this.engineGroup.add(pipesTop);

        // Bottom Pipes
        const pipesBot = new THREE.Mesh(pipeGeo, this.manifoldMat);
        this.engineGroup.add(pipesBot);
    }

    buildHolographicDyno() {
        // Grid Backdrop
        const grid = new THREE.GridHelper(10, 10, 0x333333, 0x111111);
        grid.rotation.x = Math.PI / 2;
        grid.position.z = -3;
        this.hologramGroup.add(grid);

        // The Power Curve Line
        const points = [];
        for (let i = 0; i <= 50; i++) points.push(new THREE.Vector3(i/5 - 5, 0, 0));

        const geometry = new THREE.BufferGeometry().setFromPoints(points);
        this.lineMat = new THREE.LineBasicMaterial({
            color: this.configs[0].color,
            linewidth: 3,
            transparent: true,
            opacity: 0.8
        });

        this.dynoLine = new THREE.Line(geometry, this.lineMat);
        this.dynoLine.position.z = -3;
        this.hologramGroup.add(this.dynoLine);
    }

    buildParticles() {
        // Intake Stream (Airflow)
        const count = 800;
        const pos = new Float32Array(count * 3);
        const speed = new Float32Array(count);

        for(let i=0; i<count; i++) {
            pos[i*3] = -6 + Math.random() * 4; // Start left
            pos[i*3+1] = (Math.random() - 0.5) * 2;
            pos[i*3+2] = (Math.random() - 0.5) * 2;
            speed[i] = Math.random() * 0.1 + 0.05;
        }

        const geo = new THREE.BufferGeometry();
        geo.setAttribute('position', new THREE.BufferAttribute(pos, 3));

        this.particleMat = new THREE.PointsMaterial({
            color: this.configs[0].color,
            size: 0.08,
            transparent: true,
            opacity: 0.6,
            blending: THREE.AdditiveBlending
        });

        this.particles = new THREE.Points(geo, this.particleMat);
        this.particles.userData = { speed: speed };
        this.engineGroup.add(this.particles);

        // Exhaust Fire (Pops)
        const exCount = 100;
        const exPos = new Float32Array(exCount * 3);
        // Hide initially
        for(let i=0; i<exCount; i++) exPos[i*3] = 999;

        const exGeo = new THREE.BufferGeometry();
        exGeo.setAttribute('position', new THREE.BufferAttribute(exPos, 3));

        this.fireMat = new THREE.PointsMaterial({
            color: 0xFFaa00,
            size: 0.4,
            transparent: true,
            opacity: 0,
            blending: THREE.AdditiveBlending
        });

        this.exhaust = new THREE.Points(exGeo, this.fireMat);
        this.exhaust.userData = { life: new Float32Array(exCount).fill(0) };
        this.engineGroup.add(this.exhaust);
    }

    // --- ANIMATION & LOGIC ---

    animate() {
        requestAnimationFrame(() => this.animate());
        this.time += 0.01;
        const config = this.configs[this.currentStage];

        // 1. Engine Spin & Vibrate
        this.rotor.rotation.x -= 0.05 * config.speed;
        this.engineGroup.position.y = Math.sin(this.time * 20) * config.vibration;

        // Mouse Look
        this.mainGroup.rotation.y += (this.mouseX - this.mainGroup.rotation.y) * 0.05;
        this.mainGroup.rotation.x += (this.mouseY - this.mainGroup.rotation.x) * 0.05;

        // 2. Particle Flow
        const positions = this.particles.geometry.attributes.position.array;
        const speeds = this.particles.userData.speed;
        const flowRate = config.speed;

        for(let i=0; i < positions.length / 3; i++) {
            // Move Right (X axis)
            positions[i*3] += speeds[i] * flowRate;

            // Funnel effect towards center (engine intake)
            if(positions[i*3] < 0) {
                positions[i*3+1] *= 0.98; // Converge Y
                positions[i*3+2] *= 0.98; // Converge Z
            } else {
                // Exhaust side - expand
                positions[i*3+1] += (Math.random()-0.5) * 0.05;
                positions[i*3+2] += (Math.random()-0.5) * 0.05;
            }

            // Reset
            if(positions[i*3] > 6) {
                positions[i*3] = -6;
                positions[i*3+1] = (Math.random() - 0.5) * 3;
                positions[i*3+2] = (Math.random() - 0.5) * 3;
            }
        }
        this.particles.geometry.attributes.position.needsUpdate = true;

        // 3. Holographic Dyno Curve
        const curvePoints = this.dynoLine.geometry.attributes.position.array;
        const curveFactor = config.curve;

        for(let i=0; i <= 50; i++) {
            // x is i*3, y is i*3+1
            const x = (i/50); // 0 to 1

            // Curve formula: Soft ease-in-out based on RPM (x)
            // Lerp towards target curve
            const targetY = Math.pow(x, 0.8) * 4 * curveFactor;
            // Add noise/jitter for "live reading" feel
            const noise = Math.sin(this.time * 10 + i) * 0.05;

            // Smooth Lerp
            const currentY = curvePoints[i*3+1];
            curvePoints[i*3+1] += (targetY + noise - currentY) * 0.1;
        }
        this.dynoLine.geometry.attributes.position.needsUpdate = true;

        // 4. Shockwaves
        this.shockwaves.forEach((wave, index) => {
            wave.scale.addScalar(0.1);
            wave.material.opacity -= 0.02;
            if(wave.material.opacity <= 0) {
                this.scene.remove(wave);
                this.shockwaves.splice(index, 1);
            }
        });

        // 5. Exhaust Pops
        if(this.modifiers.pops || this.currentStage >= 2) {
            if(Math.random() > 0.95) this.triggerPop();
            this.updateExhaust();
        }

        // 6. Manifold Heat
        if(this.currentStage > 1) {
            const heatColor = new THREE.Color(0xff0000);
            this.manifoldMat.emissive.lerp(heatColor, 0.01);
            this.manifoldMat.emissiveIntensity = 0.5 + Math.sin(this.time * 5) * 0.2;
        } else {
            this.manifoldMat.emissive.lerp(new THREE.Color(0x000000), 0.05);
        }

        this.renderer.render(this.scene, this.camera);
    }

    // --- INTERACTION ---

    triggerShockwave() {
        const geo = new THREE.RingGeometry(0.5, 0.8, 32);
        const mat = new THREE.MeshBasicMaterial({
            color: this.configs[this.currentStage].color,
            transparent: true,
            opacity: 1,
            side: THREE.DoubleSide
        });
        const wave = new THREE.Mesh(geo, mat);
        wave.rotation.y = Math.PI / 2;
        wave.position.x = 0;
        this.scene.add(wave);
        this.shockwaves.push(wave);
    }

    triggerPop() {
        const pos = this.exhaust.geometry.attributes.position.array;
        const life = this.exhaust.userData.life;

        // Spawn particles at end of engine
        let spawned = 0;
        for(let i=0; i<life.length && spawned < 5; i++) {
            if(life[i] <= 0) {
                pos[i*3] = 2.5; // End of turbine
                pos[i*3+1] = (Math.random() - 0.5) * 0.2;
                pos[i*3+2] = (Math.random() - 0.5) * 0.2;
                life[i] = 1.0;
                spawned++;
            }
        }
        this.exhaust.geometry.attributes.position.needsUpdate = true;
        this.fireMat.opacity = 1;
    }

    updateExhaust() {
        const pos = this.exhaust.geometry.attributes.position.array;
        const life = this.exhaust.userData.life;

        for(let i=0; i<life.length; i++) {
            if(life[i] > 0) {
                life[i] -= 0.05;
                pos[i*3] += 0.2; // Move right fast
                pos[i*3+1] += (Math.random() - 0.5) * 0.1; // Spread
                pos[i*3+2] += (Math.random() - 0.5) * 0.1;

                if(life[i] <= 0) pos[i*3] = 999; // Hide
            }
        }
        this.exhaust.geometry.attributes.position.needsUpdate = true;
    }

    setStage(index) {
        this.currentStage = index;
        const config = this.configs[index];
        const color = new THREE.Color(config.color);

        // Update Materials
        this.rotorMat.color.set(color);
        this.particleMat.color.set(color);
        this.lineMat.color.set(color);
        this.pointLight.color.set(color);

        // FX
        this.triggerShockwave();
    }

    toggleModifier(key, isActive) {
        this.modifiers[key] = isActive;
        if(key === 'launch' && isActive) {
            // Rev engine
            this.engineGroup.rotation.x = -0.2; // Dip nose
            setTimeout(() => { this.engineGroup.rotation.x = 0; }, 200);
        }
    }

    setupUI() {
        const slider = document.getElementById('tuning-stage-slider');
        const label = document.getElementById('tuning-stage-label');
        const bars = {
            power: document.getElementById('sim-power-bar'),
            torque: document.getElementById('sim-torque-bar'),
            response: document.getElementById('sim-response-bar')
        };

        if(slider) {
            slider.addEventListener('input', (e) => {
                const val = parseInt(e.target.value);
                this.setStage(val);
                if(label) label.innerText = this.configs[val].name;

                // UI Updates
                if(bars.power) bars.power.style.width = `${60 + (val * 13)}%`;
                if(bars.torque) bars.torque.style.width = `${55 + (val * 15)}%`;
                if(bars.response) bars.response.style.width = `${50 + (val * 16)}%`;

                const hex = '#' + new THREE.Color(this.configs[val].color).getHexString();
                Object.values(bars).forEach(bar => {
                    if(bar) {
                        bar.style.backgroundColor = hex;
                        bar.style.boxShadow = `0 0 15px ${hex}`;
                    }
                });
            });
        }

        document.querySelectorAll('.tuning-modifier-toggle').forEach(t => {
            t.addEventListener('change', (e) => this.toggleModifier(e.target.dataset.mod, e.target.checked));
        });
    }

    onResize() {
        this.camera.aspect = this.container.clientWidth / this.container.clientHeight;
        this.camera.updateProjectionMatrix();
        this.renderer.setSize(this.container.clientWidth, this.container.clientHeight);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new TuningVisualizer('tuning-visualizer-canvas');
});
