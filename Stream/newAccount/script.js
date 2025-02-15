submitButton = document.getElementById('submit');
form = document.getElementById('form');

submitButton.addEventListener('click', ()=>{

    form.innerHTML = `<input type="password" name="keyword" id="keyword" placeholder="Mot de Passe" required>
                    <input type="number" name="tel" id="tel" placeholder="Numéro de téléphone" required>
                    
                    <p><a href="help.php">Besoin d'aide ?</a></p>
                    <button type="submit">Continuer</button>`


})