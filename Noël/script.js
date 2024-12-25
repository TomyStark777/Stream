let container = document.querySelector(".container");
let body = document.querySelector("body");
let ok = document.querySelector("#ok");
let start = document.getElementById("start");
let form = document.getElementById("getName");
let nom = document.getElementById("name");
let afficher = document.getElementById("afficher");
let count = 3; 
let url = ["gdg.png","annie.jpg","billy.jpg","club.jpg","joanna.jpg"];
ok.addEventListener('click', () => { 
    
    afficher.style.display = "none"
    form.style.display = "none";
    start.style.display = "flex";
    
});


start.addEventListener('click', () => {
    const interval1 = setInterval(() => { 
        start.style.fontFamily = "Times New Roman"; 
        start.style.fontSize = "1.5em"; 
        if (count > 0) { 
            start.innerHTML = `<h2>${count}</h2>`; 
            count--; 
        } else if (count == 0) { 
            start.style.fontFamily = "Christmas"; 
            start.innerHTML = `<h2>C'est Noël !</h2>`; 
            launchConfetti(); 
            count--; 
        } else { 
            clearInterval(interval1); 
            start.style.display = "none"; 
            body.style.color = "skyblue"; 
            body.style.fontSize = "2em"; 
            body.innerHTML = `<h1><strong>${nom.value}</strong><br>Joyeux Noël !</h1>`; 
            body.style.textShadow = "2px 2px 4px #000000;"; 
            launchConfetti(); 
        } 
        }, 800);
    },
)

// Changement de couleur du fond aléatoirement toutes les 5 secondes
setInterval(() => {
    body.style.backgroundImage = "url(" + url[Math.floor(Math.random() * url.length)] + ")";	
},5000);
    


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






