<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ak7";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cette partie est dédiée à la gestion des commentaires ajoutés depuis le client.
    // Assurez-vous de mettre en œuvre la gestion de session utilisateur appropriée pour récupérer l'ID de l'utilisateur.
    session_start();

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if ($user_id && isset($_POST['image_link'], $_POST['x'], $_POST['y'], $_POST['comment_text'])) {
        $image_link = $_POST['image_link'];
        $x = $_POST['x'];
        $y = $_POST['y'];
        $comment_text = $_POST['comment_text'];

        // Ajouter le commentaire à la base de données
        $stmt = $conn->prepare("INSERT INTO comments (image_id, x_coordinate, y_coordinate, comment_text, user_id)
                                SELECT id, ?, ?, ?, ? FROM images WHERE image_link = ?");
        $stmt->bind_param("iiiss", $x, $y, $comment_text, $user_id, $image_link);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add comment']);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid parameters']);
    }

    exit;
}

// Le reste du code pour récupérer les images et les commentaires reste inchangé

?>
