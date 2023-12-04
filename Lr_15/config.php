<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "photos";

try {
    $pdo = new PDO("mysql:host=localhost;dbname=photos", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $users = Model::all($pdo, 'photos');
} catch (PDOException $e) {
    echo "Помилка підключення до бази даних: " . $e->getMessage();
    die();
}

$photoFolder = "C:/xampp/htdocs/photo/photo.jpg"; 
?>
