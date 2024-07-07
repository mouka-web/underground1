<?php
// Informations de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = ""; // Mettez votre mot de passe MySQL ici
$dbname = "underground";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Préparez la requête SQL pour récupérer les abonnements avec le champ `created_at` trié par date croissante
$sql = "SELECT id, cin, nom, prenom, telephone, abonnement, prix, created_at FROM abonnements ORDER BY created_at ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Sortie des données sous forme de texte
    while ($row = $result->fetch_assoc()) {
        echo "{$row['cin']},{$row['nom']},{$row['prenom']},{$row['telephone']},{$row['abonnement']},{$row['prix']},{$row['created_at']},{$row['id']}\n";
    }
} else {
    echo ""; // Aucune donnée disponible
}

$conn->close();
?>
