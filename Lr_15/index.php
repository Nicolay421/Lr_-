<?php
include "login.php"; // Включаємо код авторизації
include "Model.php";

if (!isset($_SESSION["user_id"])) {
    
    header("Location: login.php");
    exit();
}
try {
    $pdo = new PDO("mysql:host=localhost;dbname=photos", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $photos = Model::all($pdo, 'photos');

    if (count($photos) > 0) {
        echo "<h1>Фотогалерея</h1>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Опис</th><th>Фото</th></tr>";

        foreach ($photos as $photo) {
            echo "<tr>";
            echo "<td>" . $photo->columns->id . "</td>";
            echo "<td>" . $photo->columns->description . "</td>";
            echo '<td><img src="' . $photo->columns->filename . '"width="300"></td>"';
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "У базі даних немає користувачів.";
    }
} catch (PDOException $e) {
    echo "Помилка підключення до бази даних: " . $e->getMessage();
}
?>
