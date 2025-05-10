window.onload = function() {
    let countdown = document.getElementById('countdown');
    let timer = document.getElementById('timer');
    let message = document.getElementById('message');

    // Date cible : 1er Janvier à 00 : 00
    let targetDate = new Date('December 31, 2024 00:58:00').getTime();
    


    const updateCountdown = () => {
        let now = new Date().getTime();

        let distance = targetDate - now;

        if (distance > 0) {
            let days = Math.floor(distance / (1000 * 60 * 60 * 24));
            let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            timer.innerHTML = `${days}j ${hours}h ${minutes}m ${seconds}s`;
        } else {
            clearInterval(interval);
            countdown.style.display = 'none';
            launchConfetti();
            launchConfetti();
            message.style.display = 'block';
        }
    };

    const interval = setInterval(updateCountdown, 1000);
    updateCountdown();  // Afficher immédiatement le décompte
};

function launchConfetti() {
    confetti({
        particleCount: 100,
        angle: 60,
        spread: 70,
        startVelocity: 70,
        origin: { x: 0, y: 1 },
        colors: ['#ff0', '#f00', '#0f0', '#00f', '#f0f', '#0ff']
    });
    confetti({
        particleCount: 100,
        angle: 120,
        spread: 70,
        startVelocity: 70,
        origin: { x: 1, y: 1 },
        colors: ['#ff0', '#f00', '#0f0', '#00f', '#f0f', '#0ff']
    });
}
