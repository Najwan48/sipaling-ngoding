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
});
