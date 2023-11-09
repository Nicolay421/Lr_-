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
        $xml = simplexml_load_file('book.xml');
        echo "<tr>";
        echo "<td>{$xml->title}</td>";
        echo "<td>{$xml->author}</td>";
        echo "<td>{$xml->publisher}</td>";
        echo "<td>{$xml->publication_date}</td>";
        echo "</tr>";
        ?>
    </table>
</body>
</html>
