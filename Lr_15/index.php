<?php
include "Model.php";
include "config.php";

session_start();

// Check if the user is authenticated
if (isset($_SESSION['user_id'])) {
    try {
        $photos = Model::allPhotos($pdo);

        if (count($photos) > 0) {
            echo "<h1>Фотогалерея</h1>";
            echo "<div class='gallery'>";

            foreach ($photos as $photo) {
                echo "<div class='photo'>";
                echo "<img src='photo.jpg/" . $photo->columns->filename . "' alt='" . $photo->columns->description . "'>";
                echo "<p>" . $photo->columns->description . "</p>";
                echo "</div>";
            }

            echo "</div>";
        } else {
            echo "Фотогалерея порожня.";
        }
    } catch (PDOException $e) {
        echo "Помилка підключення до бази даних: " . $e->getMessage();
    }
} else {
    // User not authenticated, show login form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $enteredUsername = $_POST['username'];
        $enteredPassword = $_POST['password'];

        // Authenticate the user
        if ($enteredUsername === "Nick" && $enteredPassword === "gen76") {
            $_SESSION['user_id'] = 1; 
            header("Location: index.php");
            exit();
        } else {
            echo "Невірні дані входу!";
        }
    }

    // Login form
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
}
?>
