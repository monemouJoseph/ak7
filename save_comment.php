<?php
$servername = "localhost";
$username = "root"; // Votre nom d'utilisateur MySQL
$password = "";     // Votre mot de passe MySQL
$dbname = "ak7";    // Le nom de votre base de données

// Récupérer les données du POST
$chapter_id = $_POST['chapter_id'];
$work_id = $_POST['work_id'];
$posX = $_POST['posX'];
$posY = $_POST['posY'];
$comment = $_POST['comment'];

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Enregistrement du commentaire dans la base de données
$sql = "INSERT INTO comments (chapter_id, work_id, pos_x, pos_y, comment_text) 
        VALUES ($chapter_id, $work_id, $posX, $posY, '$comment')";

if ($conn->query($sql) === TRUE) {
    echo "Commentaire enregistré avec succès";
} else {
    echo "Erreur lors de l'enregistrement du commentaire: " . $conn->error;
}

$conn->close();
?>
