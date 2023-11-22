<?php
$servername = "localhost";
$username = "root"; // Votre nom d'utilisateur MySQL
$password = "";     // Votre mot de passe MySQL
$dbname = "ak7";    // Le nom de votre base de données

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$chapter_id = $_GET['chapter_id'];
$work_id = $_GET['work_id'];

// Récupérer toutes les images du chapitre
$sql = "SELECT image_link FROM images WHERE chapter_id = $chapter_id ORDER BY id";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akira7ee - Chapitre</title>

    <style>
        #commentButton {
            position: fixed;
            top: 50%;
            left: 0;
            transform: translate(0, -50%);
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        #commentOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
        }

        #commentPositionBox {
            position: absolute;
        }

        #commentBox {
            position: absolute;
            background: #fff;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: none;
        }

        .dot {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: green;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <h1>Liste des Images du Chapitre</h1>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div>
            <img id="chapterImage" src="<?php echo $row['image_link']; ?>" alt="Image du Chapitre">
        </div>
    <?php endwhile; ?>

    <button id="commentButton">Ajouter un Commentaire</button>

    <div id="commentOverlay">
        <div id="commentPositionBox"></div>
        <div id="commentBox">
            <label for="commentInput">Ajouter un commentaire :</label>
            <textarea id="commentInput" rows="4"></textarea>
            <button id="saveComment">Valider</button>
        </div>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var commentButton = document.getElementById('commentButton');
        var commentOverlay = document.getElementById('commentOverlay');
        var commentPositionBox = document.getElementById('commentPositionBox');
        var commentBox = document.getElementById('commentBox');
        var saveCommentButton = document.getElementById('saveComment');

        var selectedPosX = 0;
        var selectedPosY = 0;
        var positionEnabled = false;

        commentButton.addEventListener('click', function () {
            selectedPosX = 0;
            selectedPosY = 0;
            positionEnabled = true;
            commentOverlay.style.display = 'block';
        });

        saveCommentButton.addEventListener('click', function () {
            commentPositionBox.innerHTML = '';
            positionEnabled = false;
            commentBox.style.display = 'block';
        });
    });
</script>





<script src="app.js"></script>
    <?php $conn->close(); ?>
</body>
</html>
