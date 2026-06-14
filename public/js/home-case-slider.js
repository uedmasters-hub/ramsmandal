import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

const section = document.querySelector(".case-slider");
const track = document.querySelector(".case-slider__track");

if (section && track) {

    const distance =
        track.scrollWidth - window.innerWidth;

    gsap.to(track, {

        x: -distance,

        ease: "none",

        scrollTrigger: {
            trigger: section,
            start: "top top",
            end: () => `+=${distance}`,
            scrub: true,
            pin: true,
            invalidateOnRefresh: true
        }
    });
}