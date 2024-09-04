import { gsap } from 'gsap'
import { ScrollTrigger } from "gsap/ScrollTrigger"

function welcomeHeroAnimation() {
    const welcomeHeroAnimatedText = document.querySelector('#welcome-hero-animated-text')

    let tl = gsap.timeline({
        repeat: -1,
    })

    gsap.to('#welcome-hero', {
        y: 0,
        delay: 0.5,
        opacity: 1,
        duration: 1.4,
    })

    gsap.to('#welcome-hero-animated-text', {
        y: 0,
        duration: 1,
        delay: 0.8,
    })

    tl.to('.animation-item', {
        y: -130,
        delay: 2.8,
        duration: 1,
    })
    .to('.animation-item', {
        y: -260,
        delay: 1.5,
        duration: 1,
    })
    .to('.animation-item', {
        y: -390,
        delay: 1.5,
        duration: 1,
    })
    .to('.animation-item', {
        y: -520,
        delay: 1.5,
        duration: 1,
    })
    .to('.animation-item', {
        y: -390,
        delay: 1.5,
        duration: 1,
    })
    .to('.animation-item', {
        y: -260,
        delay: 1.5,
        duration: 1,
    })
    .to('.animation-item', {
        y: -130,
        delay: 1.5,
        duration: 1,
    })
    .to('.animation-item', {
        y: 0,
        delay: 1.5,
        duration: 1,
    })

    /*
    // floating images
    gsap.to('#welcome-hero-image-1', {
        top: 40,
        left: -80,
        width: 380,
        rotate: -15,
        duration: 1,
        delay: 1,
    })
    gsap.to('#welcome-hero-image-2', {
        top: 200,
        right: -80,
        width: 380,
        rotate: 8,
        duration: 1,
        delay: 2,
    })
    gsap.to('#welcome-hero-image-3', {
        top: 400,
        left: -80,
        rotate: -8,
        width: 380,
        duration: 1,
        delay: 2.2,
    })
    */
}

function headerAnimation() {
    gsap.to('#site-header', {
        y: 0,
        delay: 1.4,
        duration: 1,
    })
}

function section2Animation() {
    gsap.to('#section-2-image-1', {
        x: 0,
        duration: 1.4,
        scrollTrigger: {
            trigger: '#section-2',
            start: '40% bottom',
        }
    })

    gsap.to('#section-2-image-2', {
        x: 0,
        duration: 1.4,
        scrollTrigger: {
            trigger: '#section-2',
            start: '40% bottom',
        }
    })
}

function featuresAnimation() {
    gsap.to('#feature-1', {
        opacity: 1,
        duration: 1.4,
        scrollTrigger: {
            trigger: '#features',
            start: '40% bottom',
        }
    })
    gsap.to('#feature-2', {
        opacity: 1,
        delay: 0.5,
        duration: 1.4,
        scrollTrigger: {
            trigger: '#features',
            start: '40% bottom',
        }
    })
    gsap.to('#feature-3', {
        opacity: 1,
        duration: 1.4,
        scrollTrigger: {
            trigger: '#features',
            start: '60% bottom',
        }
    })
}

function init() {
    gsap.registerPlugin(ScrollTrigger)

    welcomeHeroAnimation()

    headerAnimation()

    section2Animation()

    featuresAnimation()
}

window.onload = init
