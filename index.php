<?php
$servername = "localhost";
$username = "root"; // Nom d'utilisateur
$password = "";     // Mot de passe (laissez la chaîne vide)
$dbname = "ak7";    // Nom de votre base de données

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les derniers chapitres
$sql = "SELECT works.id as work_id, works.work_name, chapters.id as chapter_id, chapters.chapter_number, chapters.chapter_title, images.image_link
        FROM works
        INNER JOIN chapters ON works.id = chapters.work_id
        INNER JOIN images ON chapters.id = images.chapter_id
        GROUP BY works.id, chapters.id
        ORDER BY chapters.id DESC
        LIMIT 5"; // Vous pouvez ajuster le nombre de chapitres affichés ici

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akira7ee</title>
</head>
<body>
    <h1>Derniers Chapitres</h1>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div>
            <h2>
                <a href="view_chapters.php?work_id=<?php echo $row['work_id']; ?>">
                    <?php echo $row['work_name']; ?>
                </a>
            </h2>
            <h3>Chapitre <?php echo $row['chapter_number']; ?>: <?php echo $row['chapter_title']; ?></h3>
            <a href="view_chapter.php?chapter_id=<?php echo $row['chapter_id']; ?>&work_id=<?php echo $row['work_id']; ?>">
                <img src="<?php echo $row['image_link']; ?>" alt="Vitrine Chapitre">
            </a>
        </div>
    <?php endwhile; ?>

    <?php $conn->close(); ?>
</body>
</html>
