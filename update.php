<?php
// Informations de connexion à la base de données
$servername = "127.0.0.1";
$username = "root";
$password = ""; // Mettez votre mot de passe MySQL ici
$dbname = "underground";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $cin = $_POST['cin'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $abonnement = $_POST['abonnement'];
    $prix = $_POST['prix'];

    // Préparez la requête SQL pour mettre à jour l'abonnement
    $sql = "UPDATE abonnements SET cin='$cin', nom='$nom', prenom='$prenom', telephone='$telephone', abonnement='$abonnement', prix='$prix' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

$conn->close();
?>
