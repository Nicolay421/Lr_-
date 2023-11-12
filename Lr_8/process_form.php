<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xml = simplexml_load_file('book.xml');

    foreach ($xml->book as $book) {
        $book->title = $_POST['title'];
        $book->author = $_POST['author'];
        $book->publisher = $_POST['publisher'];
        $book->publication_date = $_POST['publication_date'];
    }

    $xml->asXML('book.xml');

    header('Location: index.php');
}
?>
