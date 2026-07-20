import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

let animationContext;

function prefersReducedMotion() {
    return window.matchMedia(
        '(prefers-reduced-motion: reduce)',
    ).matches;
}

function destroyAnimations() {
    animationContext?.revert();
    animationContext = undefined;
}

function addTweenIfTargetsExist(
    timeline,
    targets,
    vars,
    position,
) {
    if (targets.length === 0) {
        return;
    }

    timeline.from(targets, vars, position);
}

function initializeHeroAnimation() {
    const hero = document.querySelector('[data-hero]');

    if (! hero) {
        return;
    }

    const select = gsap.utils.selector(hero);

    const image = select('[data-hero-image]');
    const eyebrow = select('[data-hero-eyebrow]');
    const title = select('[data-hero-title]');
    const content = select(
        '[data-hero-copy], [data-hero-action]',
    );

    const timeline = gsap.timeline({
        defaults: {
            ease: 'power3.out',
        },
    });

    addTweenIfTargetsExist(
        timeline,
        image,
        {
            scale: 1.06,
            duration: 1.4,
        },
        0,
    );

    addTweenIfTargetsExist(
        timeline,
        eyebrow,
        {
            opacity: 0,
            y: 20,
            duration: 0.6,
        },
        0.2,
    );

    addTweenIfTargetsExist(
        timeline,
        title,
        {
            opacity: 0,
            y: 40,
            duration: 0.9,
        },
        0.3,
    );

    addTweenIfTargetsExist(
        timeline,
        content,
        {
            opacity: 0,
            y: 24,
            duration: 0.7,
            stagger: 0.12,
        },
        0.55,
    );
}

function initializeScrollReveals() {
    const revealElements = gsap.utils.toArray(
        '[data-reveal]',
    );

    revealElements.forEach((element) => {
        gsap.from(element, {
            opacity: 0,
            y: 36,
            duration: 0.8,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: element,
                start: 'top 86%',
                once: true,
            },
        });
    });
}

function refreshScrollTriggers() {
    window.requestAnimationFrame(() => {
        ScrollTrigger.refresh();
    });
}

function initializeAnimations() {
    destroyAnimations();

    if (prefersReducedMotion()) {
        return;
    }

    animationContext = gsap.context(() => {
        initializeHeroAnimation();
        initializeScrollReveals();
    }, document.body);

    refreshScrollTriggers();
}

document.addEventListener(
    'livewire:navigating',
    destroyAnimations,
);

document.addEventListener(
    'livewire:navigated',
    initializeAnimations,
);