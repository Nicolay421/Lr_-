<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $required_fields = ['book_id', 'title', 'author', 'publisher', 'publication_date'];
    foreach ($required_fields as $field) {
        if (!isset($_POST[$field])) {
            die("Ошибка: Не все необходимые поля предоставлены.");
        }
    }

    $xml = simplexml_load_file('book.xml');
    $book_id_to_update = (string)$_POST['book_id'];

    $bookToUpdate = null;
    foreach ($xml->book as $book) {
        if ((string)$book['id'] === $book_id_to_update) {
            $bookToUpdate = $book;
            break;
        }
    }
    if ($bookToUpdate !== null) {
        $bookToUpdate->title = $_POST['title'];
        $bookToUpdate->author = $_POST['author'];
        $bookToUpdate->publisher = $_POST['publisher'];
        $bookToUpdate->publication_date = $_POST['publication_date'];
        $xml->asXML('book.xml');
        header('Location: index.php');
        exit();
    } else {
        die("Ошибка: Книга с ID $book_id_to_update не найдена.");
    }
}
?>
