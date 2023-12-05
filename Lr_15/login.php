<?php
include "Model.php";

session_start();
try {
    $pdo = new PDO("mysql:host=localhost;dbname=photos", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = Model::authenticateUser($pdo, $username, $password);

        if ($user) {
            $_SESSION['user_id'] = $user->columns->id;
            header("Location: index.php");
            exit();
        } else {
            echo "Невірні дані входу!";
        }
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
</body>
</html>
