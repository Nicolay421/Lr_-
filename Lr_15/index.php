<?php
include "Model.php";
include "config.php";

session_start();

if (isset($_SESSION['user_id'])) {
    echo "<h1>Фотогалерея</h1>";
    echo "<div class='gallery'>";

    $absolutePath = realpath($photoFolder);
    if ($absolutePath && is_file($absolutePath) && in_array(pathinfo($absolutePath, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "<div class='photo'>";
        echo "<img src='" . $absolutePath . "' alt='" . pathinfo($absolutePath, PATHINFO_FILENAME) . "'>";
        echo "<p>" . pathinfo($absolutePath, PATHINFO_FILENAME) . "</p>";
        echo "</div>";
    } else {
        echo "Фото не знайдено";
    }

    echo "</div>";
} else {
  
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $enteredUsername = $_POST['username'];
        $enteredPassword = $_POST['password'];

    

        if ($enteredUsername === "Nick" && $enteredPassword === "gen76") {
            $_SESSION['user_id'] = 1; 
            header("Location: index.php");
            exit();
        } else {
            echo "Невірні дані входу!";
        }
    } 
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
        <form method="post" action="index.php">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <br>
            <button type="submit">Login</button>
</form>
        <div class='photo'>
            <img src='photo.jpg' alt='Placeholder Image'>
            <p>Placeholder Image</p>
        </div>
    </body>
    </html>
    <?php

?>
