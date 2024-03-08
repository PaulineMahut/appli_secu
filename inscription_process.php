<?php
require_once('connexion_bdd.php');

// Vérification si les données ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nomUtilisateur = $_POST['nom'];
    $motDePasse = $_POST['password'];
    $imageProfil = $_FILES['image_profil']['name'];

    // Validation des données
    if (empty($nomUtilisateur) || empty($motDePasse) || empty($imageProfil)) {
        $response = ['success' => false, 'message' => 'Veuillez remplir tous les champs!'];
        echo json_encode($response);
        exit;
    }

    // Validation du format du nom d'utilisateur
    if (!preg_match("/^[a-zA-Z0-9_]+$/", $nomUtilisateur)) {
        $response = ['success' => false, 'message' => 'Le nom d\'utilisateur ne doit contenir que des lettres, des chiffres et des soulignés (_).'];
        echo json_encode($response);
        exit;
    }

    // Validation du format du mot de passe (minimum 8 caractères, au moins une lettre majuscule, une lettre minuscule, et un chiffre)
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $motDePasse)) {
        $response = ['success' => false, 'message' => 'Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule et un chiffre.'];
        echo json_encode($response);
        exit;
    }

    // Validation de l'image de profil (exemple pour une image au format JPEG ou PNG)
    $extensionsAutorisees = array('jpg', 'jpeg', 'png');
    $extensionFichier = strtolower(pathinfo($imageProfil, PATHINFO_EXTENSION));
    if (!in_array($extensionFichier, $extensionsAutorisees)) {
        $response = ['success' => false, 'message' => 'Veuillez télécharger une image au format JPEG ou PNG'];
        echo json_encode($response);
        exit;
    }

    // Vérification si le fichier est une image réelle
    if (getimagesize($_FILES["image_profil"]["tmp_name"]) === false) {
        $response = ['success' => false, 'message' => 'Le fichier téléchargé n\'est pas une image valide.'];
        echo json_encode($response);
        exit;
    }

    // Hashage du mot de passe
    $motDePasseHash = password_hash($motDePasse, PASSWORD_DEFAULT);

    // Déplacer le fichier téléchargé vers le dossier de destination
    $targetDir = "uploads/";
    $targetFilePath = $targetDir . basename($imageProfil);
    move_uploaded_file($_FILES["image_profil"]["tmp_name"], $targetFilePath);

    // Insertion des données dans la base de données
    $sql = "INSERT INTO user (nom, password, image_profil) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nomUtilisateur, $motDePasseHash, $imageProfil);
    if ($stmt->execute()) {
        $response = ['success' => true, 'message' => 'Inscription réussie!'];
    } else {
        $response = ['success' => false, 'message' => 'Erreur lors de l\'inscription: ' . $stmt->error];
    }
    $stmt->close();

    // Retourner la réponse JSON
    echo json_encode($response);
}

// Fermeture de la connexion à la base de données après l'exécution des requêtes
$conn->close();
