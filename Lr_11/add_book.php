<?php
$servername = "localhost";
$username = "ваш_ім'я_користувача";
$password = "ваш_пароль";
$dbname = "books_database";

// Підключення до бази даних
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка підключення
if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}

// Отримання даних з форми
$title = $_POST['title'];
$author = $_POST['author'];
$published_year = $_POST['published_year'];

// Додавання книги до таблиці
$sql = "INSERT INTO books (title, author, published_year) VALUES ('$title', '$author', '$published_year')";

if ($conn->query($sql) === TRUE) {
    echo "Книга успішно додана";
} else {
    echo "Помилка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
