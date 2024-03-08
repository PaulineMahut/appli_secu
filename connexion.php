<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="validation.js" defer></script>
</head>
<body>
    <div class="formulaire-connexion">
    <h1>Connexion</h1>
    <form id="connexionForm" action="connexion_process.php" method="POST" enctype="multipart/form-data">
       <input type="text" id="nom_utilisateur" name="nom_utilisateur" placeholder="Nom d'utilisateur" required><br>
        
        <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Mot de passe" required><br>
        
        <div class="button-container">
        <button class="button-login" type="submit">Se connecter</button>
        <a href="inscription.php" class="button-inscrire">S'inscrire</a>
</div>
    </form>
    <div id="message"></div>
    </div>
</body>
</html>

