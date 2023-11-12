<?php
$xml = simplexml_load_file('book.xml');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Інформація про книгу</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>Заголовок</th>
            <th>Автор</th>
            <th>Видавник</th>
            <th>Дата публікації</th>
        </tr>
        <?php
        foreach ($xml->book as $book) {
            echo "<tr>";
            echo "<td>{$book->title}</td>";
            echo "<td>{$book->author}</td>";
            echo "<td>{$book->publisher}</td>";
            echo "<td>{$book->publication_date}</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
