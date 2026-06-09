import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Lenis from '@studio-freight/lenis';

gsap.registerPlugin(ScrollTrigger);

// Initialize Lenis for buttery smooth scrolling
const lenis = new Lenis({
  duration: 1.5,
  easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
  direction: 'vertical',
  gestureDirection: 'vertical',
  smooth: true,
  mouseMultiplier: 1,
  smoothTouch: false,
  touchMultiplier: 2,
});

function raf(time) {
  lenis.raf(time);
  requestAnimationFrame(raf);
}
requestAnimationFrame(raf);

// Link GSAP to Lenis
lenis.on('scroll', ScrollTrigger.update);
gsap.ticker.add((time) => {
  lenis.raf(time * 1000);
});
gsap.ticker.lagSmoothing(0, 0);

// Animations on Load & Scroll
window.addEventListener("load", () => {
    
    // Capsul'in Style Vertical Parallax & Fade Effects
    
    // 1. Hero Video Parallax (Moves slightly slower than scroll to create depth)
    const heroVideo = document.querySelector('video');
    if (heroVideo) {
        gsap.to(heroVideo, {
            yPercent: 30,
            ease: "none",
            scrollTrigger: {
                trigger: "main > section:first-child",
                start: "top top",
                end: "bottom top",
                scrub: true
            }
        });
    }

    // 2. Hero Text Fade Out on Scroll
    const heroText = document.querySelector('.max-w-screen-2xl');
    if (heroText) {
        gsap.to(heroText, {
            opacity: 0,
            y: 50,
            ease: "power1.inOut",
            scrollTrigger: {
                trigger: "main > section:first-child",
                start: "top top",
                end: "bottom center",
                scrub: true
            }
        });
    }

    // Text Reveal (Lines masked with overflow hidden)
    const revealLines = gsap.utils.toArray('.reveal-text span');
    gsap.set(revealLines, { yPercent: 100 });
    
    ScrollTrigger.batch(revealLines, {
        onEnter: batch => gsap.to(batch, {
            yPercent: 0, 
            duration: 1.2, 
            stagger: 0.1, 
            ease: "power4.out"
        }),
        once: true
    });

    // Image Parallax / Scale reveal
    const images = gsap.utils.toArray('.reveal-image');
    images.forEach(img => {
        gsap.fromTo(img, 
            { clipPath: "polygon(0 100%, 100% 100%, 100% 100%, 0 100%)", scale: 1.1 },
            { 
                clipPath: "polygon(0 0, 100% 0, 100% 100%, 0 100%)", 
                scale: 1,
                duration: 1.5, 
                ease: "power3.inOut",
                scrollTrigger: {
                    trigger: img,
                    start: "top 85%",
                }
            }
        );
    });

    // Fade up general elements
    const fadeUps = gsap.utils.toArray('.fade-up');
    ScrollTrigger.batch(fadeUps, {
        onEnter: batch => gsap.fromTo(batch, 
            { opacity: 0, y: 30 },
            { opacity: 1, y: 0, duration: 1, stagger: 0.15, ease: "power3.out" }
        ),
        once: true
    });
    // --- Premium UI Additions ---
    
    // 1. Preloader (0-100%)
    lenis.stop(); // Prevent scrolling while loading
    const loaderCount = document.getElementById('loader-count');
    const preloader = document.getElementById('preloader');
    
    if (loaderCount && preloader) {
        let counter = { value: 0 };
        gsap.to(counter, {
            value: 100,
            duration: 2,
            ease: "power2.inOut",
            onUpdate: () => {
                loaderCount.textContent = Math.round(counter.value);
            },
            onComplete: () => {
                gsap.to(preloader, {
                    yPercent: -100,
                    duration: 1,
                    ease: "power4.inOut",
                    onComplete: () => lenis.start()
                });
            }
        });
    }

    // 2. Custom Cursor
    const cursor = document.querySelector('.custom-cursor');
    if (cursor) {
        let xTo = gsap.quickTo(cursor, "x", {duration: 0.1, ease: "power3"});
        let yTo = gsap.quickTo(cursor, "y", {duration: 0.1, ease: "power3"});

        window.addEventListener("mousemove", (e) => {
            xTo(e.clientX);
            yTo(e.clientY);
        });

        // Hover states for links
        const links = document.querySelectorAll('a, button');
        links.forEach(link => {
            link.addEventListener('mouseenter', () => cursor.classList.add('hovering'));
            link.addEventListener('mouseleave', () => cursor.classList.remove('hovering'));
        });
    }

    // 3. Magnetic Hover Effects
    const magnetics = document.querySelectorAll('.magnetic');
    magnetics.forEach(btn => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const h = rect.width / 2;
            const v = rect.height / 2;
            const x = e.clientX - rect.left - h;
            const y = e.clientY - rect.top - v;
            
            gsap.to(btn, {
                x: x * 0.4,
                y: y * 0.4,
                duration: 0.5,
                ease: "power3.out"
            });
        });
        
        btn.addEventListener('mouseleave', () => {
            gsap.to(btn, {
                x: 0,
                y: 0,
                duration: 0.5,
                ease: "elastic.out(1, 0.3)"
            });
        });
    });

    // 4. Audio Toggle Logic
    const bgAudio = document.getElementById('bg-audio');
    const audioToggle = document.getElementById('audio-toggle');
    let isPlaying = false;

    if (bgAudio && audioToggle) {
        bgAudio.volume = 0.6;
        audioToggle.addEventListener('click', () => {
            if (isPlaying) {
                bgAudio.pause();
                audioToggle.textContent = 'Sound: OFF';
            } else {
                bgAudio.play().catch(e => console.warn("Audio playback failed:", e));
                audioToggle.textContent = 'Sound: ON';
            }
            isPlaying = !isPlaying;
        });
    }

    // 5. Project Detail Modal GSAP Logic
    const projectTriggers = document.querySelectorAll('.project-trigger');
    const modal = document.getElementById('project-modal');
    const closeModalBtn = document.getElementById('close-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalDesc = document.getElementById('modal-desc');

    if (modal && projectTriggers.length > 0) {
        const openModal = (title, desc) => {
            lenis.stop(); // Pause smooth scrolling
            modalTitle.textContent = title;
            modalDesc.textContent = desc;
            
            gsap.to(modal, {
                yPercent: -100,
                duration: 0.8,
                ease: "power4.inOut",
                onStart: () => modal.classList.remove('pointer-events-none')
            });
        };

        const closeModal = () => {
            gsap.to(modal, {
                yPercent: 0,
                duration: 0.8,
                ease: "power4.inOut",
                onComplete: () => {
                    modal.classList.add('pointer-events-none');
                    lenis.start(); // Resume scrolling
                }
            });
        };

        projectTriggers.forEach(trigger => {
            trigger.addEventListener('click', () => {
                const title = trigger.getAttribute('data-title') || 'Project';
                const desc = trigger.getAttribute('data-desc') || 'Description...';
                openModal(title, desc);
            });
        });

        if (closeModalBtn) {
            closeModalBtn.addEventListener('click', closeModal);
        }
    }
});
