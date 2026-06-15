const track = document.querySelector('.logo-marquee__track');

if(track){

    let x = 0;
    let speed = 0.4;

    const animate = () => {

        x -= speed;

        const firstGroup = track.children[0];

        if(Math.abs(x) >= firstGroup.offsetWidth){

            x += firstGroup.offsetWidth;

            track.appendChild(firstGroup);
        }

        track.style.transform = `translateX(${x}px)`;

        requestAnimationFrame(animate);
    };

    animate();
}