<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xml = simplexml_load_file('book.xml');

    $xml->title = $_POST['title'];
    $xml->author = $_POST['author'];
    $xml->publisher = $_POST['publisher'];
    $xml->publication_date = $_POST['publication_date'];

    $xml->asXML('book.xml');

    header('Location: index.php');
}
?>
