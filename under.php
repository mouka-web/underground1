<?php
// Informations de connexion à la base de données
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "underground";

try {
    // Connexion à la base de données MySQL via PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Définir le mode d'erreur PDO à exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les données du formulaire
    $cin = $_POST['cin'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $abonnement = $_POST['abonnement'];
    $prix = $_POST['prix'];

    // Vérifier si le CIN existe déjà
    $check_query = "SELECT * FROM abonnements WHERE cin = :cin";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bindParam(':cin', $cin);
    $check_stmt->execute();

    if ($check_stmt->rowCount() > 0) {
        // Si un abonnement avec ce CIN existe déjà
        echo "Erreur: Un abonnement avec ce numéro de CIN existe déjà.";
    } else {
        // Préparer la requête d'insertion SQL avec des paramètres nommés
        $insert_query = "INSERT INTO abonnements (cin, nom, prenom, telephone, abonnement, prix) 
                         VALUES (:cin, :nom, :prenom, :telephone, :abonnement, :prix)";
        
        // Préparer et exécuter la requête d'insertion
        $stmt = $conn->prepare($insert_query);
        $stmt->bindParam(':cin', $cin);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':abonnement', $abonnement);
        $stmt->bindParam(':prix', $prix);

        if ($stmt->execute()) {
            // Message de succès
            echo "Nouvel enregistrement créé avec succès";
        } else {
            // Message d'erreur
            echo "Erreur lors de l'insertion des données";
        }
    }

} catch(PDOException $e) {
    // En cas d'erreur, afficher l'erreur
    echo "Erreur : " . $e->getMessage();
}

// Fermer la connexion à la base de données
$conn = null;
?>
