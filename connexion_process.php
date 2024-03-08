<?php
require_once('connexion_bdd.php');

// Vérification si les données ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nomUtilisateur = $_POST['nom_utilisateur'];
    $motDePasse = $_POST['mot_de_passe'];

    // Requête pour récupérer le mot de passe hashé et le rôle depuis la base de données
    $sql = "SELECT password, role FROM user WHERE nom = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nomUtilisateur);
    $stmt->execute();
    $stmt->bind_result($motDePasseHash, $role);
    $stmt->fetch();
    $stmt->close();

    // Vérification si les identifiants sont valides
    if ($motDePasseHash && password_verify($motDePasse, $motDePasseHash)) {

        session_start();
        $_SESSION['user_id'] = $nomUtilisateur;
        // Fonction pour créer un jeton JWT
        function creerTokenJWT($donnees, $cleSecrete, $expiration) {
            // En-tête du jeton
            $en_tete = base64_encode(json_encode(['typ' => 'JWT', 'alg' => 'HS256']));

            // Contenu du jeton (données utilisateur)
            $contenu = base64_encode(json_encode($donnees));

            // Horodatage actuel
            $maintenant = time();

            // Date d'expiration du jeton
            $expiration_timestamp = $maintenant + $expiration;

            // Construction du jeton JWT
            $jwt = "$en_tete.$contenu";

            // Signature du jeton
            $signature = hash_hmac('sha256', $jwt, $cleSecrete);

            // Assemblage du jeton complet
            $jwt = "$jwt.$signature";

            return $jwt;
        }

        // Données à inclure dans le jeton
        $donneesToken = array(
            "id" => $id,
            "nom_utilisateur" => $nomUtilisateur
        );
        $cleSecrete = "ma_cle_secrete";
        $expiration = 3600; // 1 heure
        $jwtToken = creerTokenJWT($donneesToken, $cleSecrete, $expiration);

        // Stockage du token dans le localStorage
        echo '<script>';
        echo 'localStorage.setItem("token", "'. $jwtToken .'");';
        echo 'window.location.href = "'. ($role == 'ADMIN' ? 'accueil_admin.php' : 'accueil_user.php') .'";'; // Redirection vers la page appropriée
        echo '</script>';
        exit(); // Assurez-vous de terminer le script ici pour éviter toute sortie supplémentaire

    } else {
        // Identifiants invalides
        echo json_encode(['success' => false, 'message' => 'Identifiants invalides']);
    }
}
?>
