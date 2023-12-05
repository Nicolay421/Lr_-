<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

include "config.php";
include "Model.php";

try {
    $pdo = new PDO("mysql:host=localhost;dbname=photos", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Validate the user ID against the database, and redirect if invalid
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT * FROM photos WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);

    if (!$stmt->execute() || !$stmt->fetch(PDO::FETCH_ASSOC)) {
        header("Location: login.php");
        exit();
    }

    $photos = Model::all($pdo, 'photos');

    if (count($photos) > 0) {
        echo "<h1>Фотогалерея</h1>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Опис</th><th>Фото</th></tr>";

        foreach ($photos as $photo) {
            echo "<tr>";
            echo "<td>" . $photo->columns->id . "</td>";
            echo "<td>" . $photo->columns->description . "</td>";
            echo '<td><img src="' . $photo->columns->filename . '" width="300"></td>';
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "У базі даних немає фотографій.";
    }
} catch (PDOException $e) {
    echo "Помилка підключення до бази даних: " . $e->getMessage();
}
?>
