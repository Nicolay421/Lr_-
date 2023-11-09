<?php
require_once 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST"){
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

    if(isset($_POST['title'], $_POST['author'], $_POST['published_year'])){
        $title = $_POST['title'];
        $author = $_POST['author'];
        $published_year = $_POST['published_year'];

        $sql = "INSERT INTO books (title, author, published_year) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$title, $author, $published_year]);

        echo "Книга занесена";
    } else {
        echo "Помилка";
    }
}
?>
