// INSCRIPTION //

document.getElementById('inscriptionForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêche l'envoi du formulaire par défaut

    var formData = new FormData(this); // Récupère les données du formulaire

    var xhr = new XMLHttpRequest(); // Crée une nouvelle requête AJAX
    xhr.open('POST', 'inscription_process.php', true); // Configure la requête POST pour le script PHP
    xhr.onreadystatechange = function() { // Fonction de rappel pour gérer la réponse
        if (xhr.readyState === XMLHttpRequest.DONE) { // Vérifie si la requête est terminée
            if (xhr.status === 200) { // Vérifie si la requête s'est terminée avec succès
                var response = JSON.parse(xhr.responseText); // Analyse la réponse JSON du serveur
                if (!response.success) { // Vérifie si la réponse indique une erreur
                    document.getElementById('error-message').innerText = response.message; // Affiche le message d'erreur sur la page
                } else {
                    document.getElementById('inscriptionMessage').innerText = response.message; // Affiche le message d'inscription réussie sur la page
                }
            } else {
                console.error('Une erreur est survenue lors de la requête.'); // Affiche un message d'erreur dans la console en cas d'erreur de requête
            }
        }
    };
    xhr.send(formData); // Envoie la requête avec les données du formulaire
});





// CONNEXION //

document.getElementById('connexionForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var nomUtilisateur = document.getElementById('nom_utilisateur_connexion').value;
    var motDePasse = document.getElementById('mot_de_passe_connexion').value;

    // Envoyer les données de connexion au serveur
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'connexion_process.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Redirection vers une page sécurisée ou affichage d'un message de succès
                    window.location.href = 'page_secu.php';
                } else {
                    document.getElementById('message').innerText = response.message;
                }
            } else {
                console.error('Une erreur est survenue lors de la requête.');
            }
        }
    };
    var data = {
        nom_utilisateur: nomUtilisateur,
        mot_de_passe: motDePasse
    };
    xhr.send(JSON.stringify(data));
});


//COMMENTAIRE //