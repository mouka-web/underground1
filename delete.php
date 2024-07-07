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
    $id = $_GET['id'];

    // Préparez la requête SQL pour supprimer l'abonnement
    $sql = "DELETE FROM abonnements WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

$conn->close();
?>
