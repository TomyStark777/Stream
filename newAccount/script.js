submitButton = document.getElementById('create');
let continueButton = document.getElementById('continuer');
let div = document.getElementsByClassName("formDiv")
let i = 0;

continueButton.addEventListener('click', ()=>{
    
    if (document.getElementById("nom").value == "" || document.getElementById("prenom").value == "" || document.getElementById("email").value ==""){
        champVide.style.display = "block";
    } else {
        champVide.style.display = "none";
        div[i].style.display = 'none';
        i++;
        div[i].style.display = "flex";
        if (i==1) { 
            continueButton.style.display = "none";
            submitButton.style.display = "block";
        }
    }
})


