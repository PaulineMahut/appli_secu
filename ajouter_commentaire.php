<?php
require_once('connexion_bdd.php');

session_start();
var_dump($_SESSION);


if(isset($_SESSION['user_id'])) {
    // Récupérer l'identifiant de l'utilisateur connecté
    $user_id = $_SESSION['user_id'];
    
    // Récupérer le commentaire depuis le formulaire
    $commentaire = $_POST['commentaire'];
    
    // Ajouter le commentaire dans la base de données avec l'identifiant de l'utilisateur
    $sql_ajout_commentaire = "INSERT INTO comments (user_id, comment_text) VALUES (?, ?)";
    $stmt_ajout_commentaire = $conn->prepare($sql_ajout_commentaire);
    $stmt_ajout_commentaire->bind_param("is", $user_id, $commentaire);
    $stmt_ajout_commentaire->execute();
    $stmt_ajout_commentaire->close();
    
    // Redirection vers une page de succès ou toute autre page appropriée
    header("Location: commentaire_ajoute.php");
    exit();
} else {
    // Redirection vers une page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit();
}
?>
