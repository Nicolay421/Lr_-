<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'config.php';
    $dsn = "mysql:host=localhost;dbname=books";
    $username = "root";
    $password = "";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    try {
        $conn = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $e) {
        die("Помилка підключення: " . $e->getMessage());
    }

    $login = $_POST['login'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->execute([$login]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['login'] = $login;
        header("Location: list.php"); 
    } else {
        echo "Неправильний логін або пароль";
    }
}
?>
