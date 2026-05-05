/* =====================================================================
 *  Krystal Ingredients — front-end runtime
 *
 *  TIER 1 (always on, vanilla):
 *    - Pre-loader hide
 *    - Glassmorphism nav (scroll-state + mobile drawer)
 *    - Scroll-progress bar
 *    - GSAP / IntersectionObserver reveals
 *    - Custom cursor (desktop pointer:fine only)
 *    - Magnetic CTAs
 *    - Tilt cards
 *    - Stat counters
 *    - Split-text headline
 *    - Marquee hover-reverse (CSS-only, here just a no-op marker)
 *    - Smooth in-page anchor scroll
 *    - Hotspot map + product rail prev/next
 *    - Inquiry form AJAX
 *
 *  TIER 2 (when libs are present):
 *    - Lenis smooth scroll
 *    - Pinned horizontal product rail (GSAP ScrollTrigger pin + scrub)
 *    - Scroll-scrubbed hero molecule rotation
 *    - Diagonal mask-reveal on industry tiles
 *
 *  TIER 3 (when Three.js is present + viewport >= 1024 + prefers-motion):
 *    - WebGL 3D molecule mounted into #kipl-three-mount
 *    - Liquid gradient orb canvas (lightweight 2D fallback if WebGL fails)
 * ===================================================================== */

(function () {
    'use strict';

    const D = document;
    const W = window;
    const REDUCED_MOTION = W.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const COARSE_POINTER = W.matchMedia('(hover: none), (pointer: coarse)').matches;
    const VW             = () => W.innerWidth;
    const isDesktop      = () => VW() >= 1024;

    /* ---------- Toast helper ---------- */
    function toast(message, kind) {
        const el = D.createElement('div');
        el.className = 'kipl-toast' + (kind === 'success' ? ' kipl-toast--success' : kind === 'error' ? ' kipl-toast--error' : '');
        el.setAttribute('role', 'status');
        el.textContent = message;
        D.body.appendChild(el);
        requestAnimationFrame(() => el.classList.add('is-visible'));
        setTimeout(() => {
            el.classList.remove('is-visible');
            setTimeout(() => el.remove(), 300);
        }, 5000);
    }

    function onReady(fn) {
        if (D.readyState !== 'loading') fn();
        else D.addEventListener('DOMContentLoaded', fn);
    }

    onReady(function () {
        D.documentElement.classList.add('kipl-loaded');

        wirePreloader();
        wireSmoothScroll();      // Lenis (T2)
        wireNav();
        wireScrollProgress();
        wireRevealAnimations();  // GSAP-driven scroll reveals
        wireSplitText();         // T1
        wireCounters();          // T1
        wireMagneticCTAs();      // T1
        wireTiltCards();         // T1
        wireCursor();            // T1
        wireHero();
        wireProductRail();
        wirePinnedProducts();    // T2
        wireMaskReveal();        // T2
        wireHotspotMap();
        wireThreeJsScene();      // T3
        wireLiquidOrb();         // T3
        wireInquiryForm();
    });

    /* ------------------------------------------------------------------
     *  Pre-loader
     * ------------------------------------------------------------------ */
    function wirePreloader() {
        W.addEventListener('load', () => {
            const el = D.getElementById('kipl-pre-loader');
            if (el) setTimeout(() => el.classList.add('is-hidden'), 200);
        });
    }

    /* ------------------------------------------------------------------
     *  TIER 2 — Lenis smooth scroll
     * ------------------------------------------------------------------ */
    let lenis = null;
    function wireSmoothScroll() {
        if (REDUCED_MOTION || typeof W.Lenis === 'undefined') return;
        try {
            lenis = new W.Lenis({
                lerp: 0.085,
                smoothWheel: true,
                smoothTouch: false,
                wheelMultiplier: 1,
            });
            D.documentElement.classList.add('has-lenis');
            const raf = (time) => { lenis.raf(time); W.requestAnimationFrame(raf); };
            W.requestAnimationFrame(raf);

            // Make GSAP ScrollTrigger aware of Lenis-driven scroll
            if (W.gsap && W.ScrollTrigger) {
                lenis.on('scroll', W.ScrollTrigger.update);
                W.gsap.ticker.add((t) => lenis.raf(t * 1000));
                W.gsap.ticker.lagSmoothing(0);
            }
        } catch (_) { /* ignore — fallback to native scroll */ }
    }

    /* ------------------------------------------------------------------
     *  Sticky glassmorphism nav + mobile drawer
     * ------------------------------------------------------------------ */
    function wireNav() {
        const nav = D.getElementById('kipl-nav');
        if (!nav) return;
        const toggle = D.getElementById('kipl-nav-toggle');
        const panel  = D.getElementById('kipl-nav-mobile');

        const setState = () => { nav.dataset.state = (W.scrollY > 8) ? 'scrolled' : 'top'; };
        setState();
        W.addEventListener('scroll', setState, { passive: true });

        if (toggle && panel) {
            toggle.addEventListener('click', () => {
                const open = panel.classList.toggle('is-open');
                toggle.setAttribute('aria-expanded', String(open));
                toggle.querySelector('.kipl-nav-toggle__open').classList.toggle('hidden', open);
                toggle.querySelector('.kipl-nav-toggle__close').classList.toggle('hidden', !open);
            });
            panel.querySelectorAll('a').forEach((a) => {
                a.addEventListener('click', () => {
                    panel.classList.remove('is-open');
                    toggle.setAttribute('aria-expanded', 'false');
                    toggle.querySelector('.kipl-nav-toggle__open').classList.remove('hidden');
                    toggle.querySelector('.kipl-nav-toggle__close').classList.add('hidden');
                });
            });
        }
    }

    /* ------------------------------------------------------------------
     *  Scroll progress bar
     * ------------------------------------------------------------------ */
    function wireScrollProgress() {
        const bar = D.getElementById('kipl-scroll-progress');
        if (!bar) return;
        let raf = 0;
        const update = () => {
            const max = D.documentElement.scrollHeight - W.innerHeight;
            const p = max > 0 ? W.scrollY / max : 0;
            bar.style.transform = 'scaleX(' + p + ')';
            raf = 0;
        };
        const onScroll = () => { if (!raf) raf = W.requestAnimationFrame(update); };
        update();
        W.addEventListener('scroll', onScroll, { passive: true });
        W.addEventListener('resize', update);
    }

    /* ------------------------------------------------------------------
     *  Reveal animations (GSAP if present, IO fallback)
     * ------------------------------------------------------------------ */
    function wireRevealAnimations() {
        const hasGSAP = typeof W.gsap !== 'undefined' && typeof W.ScrollTrigger !== 'undefined';

        if (hasGSAP && !REDUCED_MOTION) {
            W.gsap.registerPlugin(W.ScrollTrigger);

            D.querySelectorAll('.kipl-reveal').forEach((el) => {
                W.gsap.fromTo(el,
                    { autoAlpha: 0, y: 24 },
                    {
                        autoAlpha: 1, y: 0, duration: 0.9, ease: 'power3.out',
                        scrollTrigger: { trigger: el, start: 'top 88%', once: true },
                        onComplete: () => el.classList.add('is-visible'),
                    }
                );
            });

            D.querySelectorAll('[data-kipl-stagger]').forEach((group) => {
                const items = group.querySelectorAll('.kipl-fadeup');
                if (!items.length) return;
                W.gsap.fromTo(items,
                    { autoAlpha: 0, y: 24 },
                    {
                        autoAlpha: 1, y: 0, duration: 0.7, ease: 'power3.out', stagger: 0.08,
                        scrollTrigger: { trigger: group, start: 'top 82%', once: true },
                        onComplete: () => items.forEach((el) => el.classList.add('is-visible')),
                    }
                );
            });
        } else {
            const io = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        io.unobserve(entry.target);
                    }
                });
            }, { rootMargin: '0px 0px -10% 0px', threshold: 0.1 });

            D.querySelectorAll('.kipl-reveal, .kipl-fadeup').forEach((el) => io.observe(el));
        }
    }

    /* ------------------------------------------------------------------
     *  TIER 1 — Split-text hero
     * ------------------------------------------------------------------ */
    function wireSplitText() {
        if (REDUCED_MOTION) {
            D.querySelectorAll('[data-kipl-split-text]').forEach((root) => {
                root.querySelectorAll('.kipl-split-line').forEach((line) => line.style.opacity = 1);
            });
            return;
        }

        D.querySelectorAll('[data-kipl-split-text]').forEach((root) => {
            const lines = root.querySelectorAll('.kipl-split-line');
            const allChars = [];
            lines.forEach((line) => {
                const text = line.textContent;
                line.textContent = '';
                [...text].forEach((ch) => {
                    const span = D.createElement('span');
                    span.className = 'kipl-split-char';
                    span.textContent = ch === ' ' ? ' ' : ch;
                    line.appendChild(span);
                    allChars.push(span);
                });
            });

            // Reveal on next frames with small stagger
            requestAnimationFrame(() => {
                allChars.forEach((c, i) => {
                    setTimeout(() => c.classList.add('is-visible'), 80 + i * 24);
                });
            });
        });
    }

    /* ------------------------------------------------------------------
     *  TIER 1 — Stat counters
     * ------------------------------------------------------------------ */
    function wireCounters() {
        const counters = D.querySelectorAll('.kipl-counter');
        if (!counters.length) return;

        const parseTarget = (raw) => {
            // Pull digits + decimal out of strings like "₹230Cr", "99.5", "42"
            const match = String(raw || '').match(/-?\d+(\.\d+)?/);
            if (!match) return null;
            return { num: parseFloat(match[0]), original: raw, isFloat: match[0].includes('.') };
        };

        const animate = (el) => {
            const target = parseTarget(el.dataset.target || el.textContent);
            if (!target) return;
            if (REDUCED_MOTION) {
                el.textContent = target.original;
                return;
            }

            const duration = 1600;
            const t0 = performance.now();
            const ease = (t) => 1 - Math.pow(1 - t, 3);

            const tick = (now) => {
                const t = Math.min(1, (now - t0) / duration);
                const value = ease(t) * target.num;
                el.textContent = target.isFloat ? value.toFixed(1) : Math.round(value);
                if (t < 1) {
                    requestAnimationFrame(tick);
                } else {
                    // Final pass uses the original (so suffixes / currency formats survive)
                    el.textContent = target.original;
                }
            };
            requestAnimationFrame(tick);
        };

        const io = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    animate(entry.target);
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach((c) => io.observe(c));
    }

    /* ------------------------------------------------------------------
     *  TIER 1 — Magnetic CTAs
     * ------------------------------------------------------------------ */
    function wireMagneticCTAs() {
        if (COARSE_POINTER || REDUCED_MOTION) return;
        D.querySelectorAll('[data-kipl-magnetic]').forEach((btn) => {
            const inner = btn.querySelector('[data-kipl-magnetic-inner]') || btn;
            const radius = 26; // px max travel
            btn.addEventListener('pointermove', (e) => {
                const rect = btn.getBoundingClientRect();
                const dx = (e.clientX - rect.left - rect.width / 2)  / (rect.width  / 2);
                const dy = (e.clientY - rect.top  - rect.height / 2) / (rect.height / 2);
                inner.style.transform = `translate3d(${dx * radius}px, ${dy * radius * 0.6}px, 0)`;
            });
            btn.addEventListener('pointerleave', () => {
                inner.style.transform = '';
            });
        });
    }

    /* ------------------------------------------------------------------
     *  TIER 1 — Tilt cards
     * ------------------------------------------------------------------ */
    function wireTiltCards() {
        if (COARSE_POINTER || REDUCED_MOTION) return;
        const max = 7; // degrees
        D.querySelectorAll('.kipl-tilt').forEach((card) => {
            card.addEventListener('pointermove', (e) => {
                const rect = card.getBoundingClientRect();
                const dx = (e.clientX - rect.left) / rect.width  - 0.5;
                const dy = (e.clientY - rect.top)  / rect.height - 0.5;
                const rx = (-dy * max).toFixed(2);
                const ry = ( dx * max).toFixed(2);
                card.style.transform = `perspective(900px) rotateX(${rx}deg) rotateY(${ry}deg) translateY(-4px)`;
            });
            card.addEventListener('pointerleave', () => { card.style.transform = ''; });
        });
    }

    /* ------------------------------------------------------------------
     *  TIER 1 — Custom cursor
     * ------------------------------------------------------------------ */
    function wireCursor() {
        if (COARSE_POINTER || REDUCED_MOTION) return;
        const ring = D.createElement('div');
        ring.className = 'kipl-cursor';
        const dot = D.createElement('div');
        dot.className = 'kipl-cursor-dot';
        D.body.appendChild(ring);
        D.body.appendChild(dot);
        D.documentElement.classList.add('kipl-has-cursor');

        let tx = 0, ty = 0, x = 0, y = 0;
        D.addEventListener('pointermove', (e) => { tx = e.clientX; ty = e.clientY; });

        const tick = () => {
            x += (tx - x) * 0.18;
            y += (ty - y) * 0.18;
            ring.style.transform = `translate3d(${x}px, ${y}px, 0) translate(-50%, -50%)`;
            dot.style.transform  = `translate3d(${tx}px, ${ty}px, 0) translate(-50%, -50%)`;
            requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);

        // Hover affordances
        const linkSel = 'a, button, [role="button"], [data-kipl-magnetic], .kipl-tilt';
        const textSel = 'input, textarea, select';
        D.querySelectorAll(linkSel).forEach((el) => {
            el.addEventListener('pointerenter', () => ring.classList.add('is-link'));
            el.addEventListener('pointerleave', () => ring.classList.remove('is-link'));
        });
        D.querySelectorAll(textSel).forEach((el) => {
            el.addEventListener('pointerenter', () => ring.classList.add('is-text'));
            el.addEventListener('pointerleave', () => ring.classList.remove('is-text'));
        });

        // Hide cursor when leaving the document
        D.addEventListener('pointerleave', () => {
            ring.style.opacity = 0; dot.style.opacity = 0;
        });
        D.addEventListener('pointerenter', () => {
            ring.style.opacity = 1; dot.style.opacity = 1;
        });
    }

    /* ------------------------------------------------------------------
     *  Hero — SVG molecules (CSS-driven) + parallax + scroll-scrub (T2)
     * ------------------------------------------------------------------ */
    function wireHero() {
        if (REDUCED_MOTION) return;
        const hasGSAP = typeof W.gsap !== 'undefined';
        const lattice = D.getElementById('kipl-mol-spin');
        const molA    = D.getElementById('kipl-mol-a');
        const molB    = D.getElementById('kipl-mol-b');
        const hero    = D.getElementById('kipl-hero');
        if (!hero) return;

        if (hasGSAP && lattice) {
            W.gsap.to(lattice, { rotation: 360, duration: 80, ease: 'none', repeat: -1, transformOrigin: '600px 400px' });
        }
        if (hasGSAP && molA) {
            W.gsap.to(molA, { x: 18, y: -14, duration: 6, ease: 'sine.inOut', repeat: -1, yoyo: true });
        }
        if (hasGSAP && molB) {
            W.gsap.to(molB, { x: -22, y: 16, duration: 8, ease: 'sine.inOut', repeat: -1, yoyo: true });
        }

        // T2 — scroll-scrubbed extra rotation on the lattice as the hero exits
        if (hasGSAP && W.ScrollTrigger && lattice) {
            W.gsap.to(lattice, {
                rotation: '+=180',
                ease: 'none',
                scrollTrigger: {
                    trigger: hero,
                    start: 'top top',
                    end:   'bottom top',
                    scrub: true,
                },
            });
        }

        // Mouse parallax fallback (works without GSAP too)
        let raf = 0; let mx = 0; let my = 0;
        hero.addEventListener('mousemove', (e) => {
            const rect = hero.getBoundingClientRect();
            mx = (e.clientX - rect.left - rect.width / 2)  / rect.width;
            my = (e.clientY - rect.top  - rect.height / 2) / rect.height;
            if (!raf) {
                raf = W.requestAnimationFrame(() => {
                    if (hasGSAP) {
                        if (molA) W.gsap.to(molA, { x: 18 + mx * 18, y: -14 + my * 18, duration: 1.2, overwrite: 'auto' });
                        if (molB) W.gsap.to(molB, { x: -22 - mx * 22, y: 16 - my * 22, duration: 1.2, overwrite: 'auto' });
                    }
                    raf = 0;
                });
            }
        });

        // Smooth in-page anchor scroll (Lenis-aware)
        D.querySelectorAll('a[href^="#"]').forEach((link) => {
            link.addEventListener('click', (e) => {
                const href = link.getAttribute('href');
                if (!href || href === '#') return;
                const target = D.querySelector(href);
                if (!target) return;
                e.preventDefault();
                const top = target.getBoundingClientRect().top + W.scrollY - 80;
                if (lenis) lenis.scrollTo(top, { duration: 1.4 });
                else W.scrollTo({ top, behavior: 'smooth' });
            });
        });
    }

    /* ------------------------------------------------------------------
     *  Product rail prev / next
     * ------------------------------------------------------------------ */
    function wireProductRail() {
        const rail = D.getElementById('kipl-product-rail');
        if (!rail) return;
        const prev = D.querySelector('.kipl-product-rail-prev');
        const next = D.querySelector('.kipl-product-rail-next');
        const step = () => Math.max(280, rail.firstElementChild ? rail.firstElementChild.getBoundingClientRect().width + 24 : 320);
        if (prev) prev.addEventListener('click', () => rail.scrollBy({ left: -step(), behavior: 'smooth' }));
        if (next) next.addEventListener('click', () => rail.scrollBy({ left:  step(), behavior: 'smooth' }));
    }

    /* ------------------------------------------------------------------
     *  TIER 2 — Pinned horizontal product scroll
     *  (desktop only; falls back to native horizontal-scroll rail on mobile)
     * ------------------------------------------------------------------ */
    function wirePinnedProducts() {
        if (REDUCED_MOTION || !isDesktop()) return;
        if (typeof W.gsap === 'undefined' || typeof W.ScrollTrigger === 'undefined') return;

        const section = D.querySelector('[data-kipl-pin-products]');
        const track   = D.querySelector('[data-kipl-pin-track]');
        if (!section || !track) return;

        // Wait one frame so layout is final
        requestAnimationFrame(() => {
            const distance = track.scrollWidth - track.clientWidth;
            if (distance <= 60) return;

            section.classList.add('is-pinning');

            W.gsap.to(track, {
                x: -distance,
                ease: 'none',
                scrollTrigger: {
                    trigger: section,
                    start:   'top 12%',
                    end:     '+=' + distance,
                    pin:     true,
                    scrub:   0.8,
                    invalidateOnRefresh: true,
                    anticipatePin: 0.5,
                },
            });

            // Hide the prev/next buttons in pin mode (scroll itself drives the rail)
            const prev = D.querySelector('.kipl-product-rail-prev');
            const next = D.querySelector('.kipl-product-rail-next');
            if (prev) prev.style.display = 'none';
            if (next) next.style.display = 'none';
        });
    }

    /* ------------------------------------------------------------------
     *  TIER 2 — Diagonal mask-reveal on industry tiles
     * ------------------------------------------------------------------ */
    function wireMaskReveal() {
        if (REDUCED_MOTION) return;
        const io = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                }
            });
        }, { rootMargin: '0px 0px -8% 0px', threshold: 0.1 });

        D.querySelectorAll('.kipl-mask-reveal').forEach((el) => io.observe(el));
    }

    /* ------------------------------------------------------------------
     *  Manufacturing hotspot map
     * ------------------------------------------------------------------ */
    function wireHotspotMap() {
        const map = D.getElementById('kipl-hotspot-map');
        if (!map) return;
        const buttons = map.querySelectorAll('.kipl-hotspot');
        const labelEl  = map.querySelector('[data-hotspot-active-label]');
        const detailEl = map.querySelector('[data-hotspot-active-detail]');
        const indexEl  = map.querySelector('[data-hotspot-active-index]');
        const total    = buttons.length;

        const setActive = (btn, index) => {
            buttons.forEach((b) => b.dataset.active = 'false');
            btn.dataset.active = 'true';
            map.dataset.active = btn.dataset.hotspot;
            if (labelEl)  labelEl.textContent  = btn.dataset.label;
            if (detailEl) detailEl.textContent = btn.dataset.detail;
            if (indexEl)  indexEl.textContent  = (index + 1) + ' / ' + total;
        };

        buttons.forEach((btn, i) => {
            if (i === 0) setActive(btn, 0);
            btn.addEventListener('click', () => setActive(btn, i));
            btn.addEventListener('mouseenter', () => setActive(btn, i));
        });
    }

    /* ------------------------------------------------------------------
     *  TIER 3 — Three.js 3D molecule
     *  Boots only on desktop, when WebGL is available, and motion isn't reduced.
     *  Renders a real 3D "molecule" — central node + bonded outer atoms +
     *  electron-orbital ring lines, lit, slowly rotating, mouse-parallax.
     * ------------------------------------------------------------------ */
    function wireThreeJsScene() {
        if (REDUCED_MOTION || !isDesktop() || COARSE_POINTER) return;
        if (typeof W.THREE === 'undefined') return;
        const mount = D.getElementById('kipl-three-mount');
        if (!mount) return;

        const T = W.THREE;
        let renderer, scene, camera, root, frame = 0, mx = 0, my = 0;

        try {
            renderer = new T.WebGLRenderer({ alpha: true, antialias: true, powerPreference: 'low-power' });
            renderer.setPixelRatio(Math.min(W.devicePixelRatio || 1, 2));
            const setSize = () => renderer.setSize(mount.clientWidth, mount.clientHeight, false);
            setSize();
            mount.appendChild(renderer.domElement);

            scene = new T.Scene();
            camera = new T.PerspectiveCamera(45, mount.clientWidth / mount.clientHeight, 0.1, 100);
            camera.position.set(0, 0, 9);

            // Lighting
            const key  = new T.PointLight(0x10B981, 1.4, 100);
            key.position.set(4, 4, 6);
            const fill = new T.PointLight(0x38BDF8, 0.6, 100);
            fill.position.set(-5, -3, 4);
            const amb  = new T.AmbientLight(0xffffff, 0.18);
            scene.add(key, fill, amb);

            root = new T.Group();
            scene.add(root);

            // Central glow node
            const center = new T.Mesh(
                new T.SphereGeometry(0.55, 48, 48),
                new T.MeshStandardMaterial({ color: 0x10B981, emissive: 0x10B981, emissiveIntensity: 0.55, roughness: 0.25, metalness: 0.2 })
            );
            root.add(center);

            // Bonded outer atoms (octahedral arrangement)
            const positions = [
                new T.Vector3( 2.4,  0,    0),
                new T.Vector3(-2.4,  0,    0),
                new T.Vector3( 0,    2.4,  0),
                new T.Vector3( 0,   -2.4,  0),
                new T.Vector3( 0,    0,    2.4),
                new T.Vector3( 0,    0,   -2.4),
            ];
            const atomGeom = new T.SphereGeometry(0.32, 32, 32);
            const atomMat  = new T.MeshStandardMaterial({ color: 0xE2E8F0, roughness: 0.4, metalness: 0.4 });
            const bondMat  = new T.MeshStandardMaterial({ color: 0x10B981, emissive: 0x064E3B, emissiveIntensity: 0.4, transparent: true, opacity: 0.65 });

            positions.forEach((pos) => {
                const atom = new T.Mesh(atomGeom, atomMat);
                atom.position.copy(pos);
                root.add(atom);

                // Bond cylinder from origin → pos
                const dir   = pos.clone();
                const length = dir.length();
                const bondGeom = new T.CylinderGeometry(0.06, 0.06, length, 18);
                const bond = new T.Mesh(bondGeom, bondMat);
                bond.position.copy(dir.clone().multiplyScalar(0.5));
                bond.lookAt(pos);
                bond.rotateX(Math.PI / 2);
                root.add(bond);
            });

            // Electron-orbital rings
            const ringMat = new T.LineBasicMaterial({ color: 0x10B981, transparent: true, opacity: 0.35 });
            for (let i = 0; i < 3; i++) {
                const points = [];
                const radius = 3.0 + i * 0.18;
                for (let t = 0; t <= 64; t++) {
                    const a = (t / 64) * Math.PI * 2;
                    points.push(new T.Vector3(Math.cos(a) * radius, Math.sin(a) * radius, 0));
                }
                const geo  = new T.BufferGeometry().setFromPoints(points);
                const ring = new T.LineLoop(geo, ringMat);
                ring.rotation.x = (Math.PI / 3) * (i + 1);
                ring.rotation.y = (Math.PI / 5) * i;
                root.add(ring);
            }

            const onMove = (e) => {
                const rect = mount.getBoundingClientRect();
                mx = (e.clientX - rect.left - rect.width / 2)  / rect.width;
                my = (e.clientY - rect.top  - rect.height / 2) / rect.height;
            };
            mount.addEventListener('pointermove', onMove);

            const onResize = () => {
                if (!mount.clientWidth) return;
                camera.aspect = mount.clientWidth / mount.clientHeight;
                camera.updateProjectionMatrix();
                setSize();
            };
            W.addEventListener('resize', onResize);

            const tick = () => {
                frame++;
                root.rotation.y += 0.0035;
                root.rotation.x = my * -0.4 + Math.sin(frame * 0.003) * 0.05;
                root.rotation.z = mx *  0.25;
                renderer.render(scene, camera);
                W.requestAnimationFrame(tick);
            };
            W.requestAnimationFrame(tick);

            D.documentElement.classList.add('kipl-three-on');
        } catch (err) {
            // WebGL failed — leave the SVG fallback visible
            mount.remove();
        }
    }

    /* ------------------------------------------------------------------
     *  TIER 3 — Liquid gradient orb (canvas 2D — minimal cost, always-on
     *  on desktop because it's <2ms / frame and adds atmosphere)
     * ------------------------------------------------------------------ */
    function wireLiquidOrb() {
        if (REDUCED_MOTION) return;
        const canvas = D.getElementById('kipl-liquid-orb');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        if (!ctx) return;

        let dpr = Math.min(W.devicePixelRatio || 1, 2);
        let blobs = [];

        const resize = () => {
            dpr = Math.min(W.devicePixelRatio || 1, 2);
            const { clientWidth: w, clientHeight: h } = canvas;
            canvas.width  = w * dpr;
            canvas.height = h * dpr;
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

            blobs = [
                { x: w * 0.25, y: h * 0.30, r: Math.max(180, w * 0.25), c: 'rgba(16,185,129,0.55)',  vx: 0.28, vy: 0.18 },
                { x: w * 0.75, y: h * 0.65, r: Math.max(220, w * 0.30), c: 'rgba(56,189,248,0.35)',  vx: -0.22, vy: -0.16 },
                { x: w * 0.55, y: h * 0.20, r: Math.max(160, w * 0.22), c: 'rgba(34,197,94,0.30)',   vx: 0.16, vy: 0.22 },
            ];
        };
        resize();
        W.addEventListener('resize', resize);

        const draw = () => {
            const w = canvas.clientWidth, h = canvas.clientHeight;
            ctx.clearRect(0, 0, w, h);
            ctx.globalCompositeOperation = 'lighter';
            ctx.filter = 'blur(80px)';

            blobs.forEach((b) => {
                b.x += b.vx; b.y += b.vy;
                if (b.x < b.r * 0.2 || b.x > w - b.r * 0.2) b.vx *= -1;
                if (b.y < b.r * 0.2 || b.y > h - b.r * 0.2) b.vy *= -1;
                ctx.beginPath();
                ctx.fillStyle = b.c;
                ctx.arc(b.x, b.y, b.r, 0, Math.PI * 2);
                ctx.fill();
            });
            W.requestAnimationFrame(draw);
        };
        W.requestAnimationFrame(draw);

        D.documentElement.classList.add('kipl-orb-on');
    }

    /* ------------------------------------------------------------------
     *  Inquiry form — REST submission
     * ------------------------------------------------------------------ */
    function wireInquiryForm() {
        const form = D.getElementById('kipl-inquiry-form');
        if (!form) return;
        const pane     = form.querySelector('[data-kipl-form-pane]');
        const success  = form.querySelector('[data-kipl-form-success]');
        const refEl    = form.querySelector('[data-kipl-form-reference]');
        const resetBtn = form.querySelector('[data-kipl-form-reset]');
        const submit   = form.querySelector('button[type="submit"]');
        const labelDef = form.querySelector('[data-kipl-submit-default]');
        const labelLd  = form.querySelector('[data-kipl-submit-loading]');

        const showSuccess = (reference) => {
            pane.classList.add('hidden');
            success.classList.remove('hidden');
            success.classList.add('flex');
            if (refEl) {
                refEl.textContent = 'Reference · ' + reference;
                refEl.classList.toggle('hidden', !reference);
            }
        };

        const reset = () => {
            form.reset();
            pane.classList.remove('hidden');
            success.classList.add('hidden');
            success.classList.remove('flex');
        };

        if (resetBtn) resetBtn.addEventListener('click', reset);

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            if (!submit) return;
            if (!form.reportValidity()) return;

            const data = Object.fromEntries(new FormData(form));
            const cfg  = W.KIPL_DATA || {};

            submit.disabled = true;
            if (labelDef) labelDef.classList.add('hidden');
            if (labelLd)  labelLd.classList.remove('hidden');

            try {
                const response = await fetch(cfg.restUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-WP-Nonce': cfg.restNonce || '',
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify(data),
                });
                const json = await response.json().catch(() => ({}));
                if (!response.ok || json.ok === false) {
                    throw new Error(json.error || 'Submission failed.');
                }
                showSuccess(json.reference || '');
                toast('Inquiry received. Our team will respond within one business day.', 'success');
            } catch (err) {
                toast(err.message || 'Could not submit. Please try again.', 'error');
            } finally {
                submit.disabled = false;
                if (labelDef) labelDef.classList.remove('hidden');
                if (labelLd)  labelLd.classList.add('hidden');
            }
        });
    }
})();
