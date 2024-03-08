<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title>Inscription</title>
    <script src="validation.js" defer></script>
</head>
<body>
    <div class="formulaire-connexion">
    <h1>Inscription</h1>
    <!-- FORMULAIRE D'INSCRIPTION -->
    <form  id="inscriptionForm" action="inscription_process.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="nom" id="nom" placeholder="Nom d'utilisateur" required>

    <input type="password" name="password" id="password" placeholder="Mot de passe">
   
    <div class="custom-file-upload">
    <label class="label-fichier" for="image_profil">Image de profil:</label>
    <input type="file" id="image_profil" name="image_profil"><br>
    </div>

    <div class="button-container">
    <input class="button-inscrire1" type="submit" value="S'inscrire">
    <a href="connexion.php" class="button-inscrire">Se connecter</a>
    </div>
    </form>
    </div>


    <!-- MESSAGE D'ERREUR -->

    <div id="error-message" style="color: red;"></div>
    <div id="inscriptionMessage"></div>


</body>
</html>

