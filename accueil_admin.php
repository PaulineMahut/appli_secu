<?php
// Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'ADMIN') {
    // Rediriger l'utilisateur vers une page d'erreur ou une autre page appropriée
    header("Location: erreur.php");
    exit(); // Assurez-vous de terminer le script après la redirection
}

// Si l'utilisateur est autorisé, continuer avec le contenu de la page
?>
<!DOCTYPE html>
<html>
<head>
    <title>Page d'accueil Admin</title>
</head>
<body>
    <h1>Bienvenue sur la page d'accueil Admin</h1>
    <!-- Contenu de la page pour l'administrateur -->
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Bonjour ADMIN
</body>
</html>