<?php
include "Model.php";
session_start();

try {
    $pdo = new PDO("mysql:host=localhost;dbname=photos", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_SESSION['user_id'])) {


        $users = Model::all($pdo, 'photos');

        if (count($users) > 0) {
            echo "<h1>Список користувачів</h1>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Ім'я користувача</th><th>Email</th></tr>";

            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user->columns->id . "</td>";
                echo "<td>" . $user->columns->username . "</td>";
                echo "<td>" . $user->columns->email . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "У базі даних немає користувачів.";
        }

        echo "<h1>Фотогалерея</h1>";
        echo "<div class='gallery'>";

        $photoPath = "photo/photo.jpg";
        if (is_file($photoPath) && in_array(pathinfo($photoPath, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
            echo "<div class='photo'>";
            echo "<img src='" . $photoPath . "' alt='" . pathinfo($photoPath, PATHINFO_FILENAME) . "'>";
            echo "<p>" . pathinfo($photoPath, PATHINFO_FILENAME) . "</p>";
            echo "</div>";
        } else {
            echo "Фото не знайдено";
        }

        echo "</div>";
    } else {

        include "login.php";
    }
} catch (PDOException $e) {
    echo "Помилка підключення до бази даних: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post" action="login.php"> 
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
    <div class='photo'>
        <img src='photo/photo.jpg' alt=''>
    </div>
</body>
</html>
