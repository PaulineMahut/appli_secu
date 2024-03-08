<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "appli_secu_bdd";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT password FROM user WHERE nom = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

// Si la requête a renvoyé des résultats
if ($stmt->num_rows > 0) {
    $stmt->bind_result($hashed_password);
    $stmt->fetch(); 

    // Vérifier si le mot de passe correspond
    if (password_verify($password, $hashed_password)) {
    } else {
        echo 'Mot de passe incorrect';
    }
} else {
    echo "Aucun utilisateur trouvé avec ce nom d'utilisateur, gérer l'erreur";
}

$stmt->close();
?>
