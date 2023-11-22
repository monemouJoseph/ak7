<?php
$servername = "localhost";
$username = "root"; // Nom d'utilisateur
$password = "";     // Mot de passe (laissez la chaîne vide)
$dbname = "ak7";    // Nom de votre base de données

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$work_id = $_GET['work_id'];

// Récupérer tous les chapitres de l'œuvre
$sql = "SELECT id, chapter_number, chapter_title FROM chapters WHERE work_id = $work_id ORDER BY chapter_number";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akira7ee - Chapitres de l'Oeuvre</title>
</head>
<body>
    <h1>Chapitres de l'Oeuvre</h1>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div>
            <h3>
                <a href="view_chapter.php?chapter_id=<?php echo $row['id']; ?>&work_id=<?php echo $work_id; ?>">
                    Chapitre <?php echo $row['chapter_number']; ?>: <?php echo $row['chapter_title']; ?>
                </a>
            </h3>
        </div>
    <?php endwhile; ?>

    <?php $conn->close(); ?>
</body>
</html>
