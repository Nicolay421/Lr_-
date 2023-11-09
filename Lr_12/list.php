<?php
session_start();
require_once 'config.php'; 

if (!isset($_SESSION['login'])) {
    header("Location: login.php"); 
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $published_year = $_POST['published_year'];

    $sql = "INSERT INTO books (title, author, published_year) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$title, $author, $published_year]);

    echo "Книга успішно додана";
}
?>
