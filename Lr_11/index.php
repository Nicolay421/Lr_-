<?php
$mysqli = new mysqli('localhost', 'root', '', 'products');

if ($mysqli->connect_error) {
    die('Error: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
$product_name = '52 inch TV';
$product_code = '9879798';
$find_id = 24;

$query = "UPDATE products SET product_name=?, product_code=? WHERE ID=?";
$statement = $mysqli->prepare($query);
$results = $statement->bind_param('ssi', $product_name, $product_code, $find_id);

if ($results) {
    print 'Запит успішно виконаний! Запис оновлено';
} else {
    print 'Помилка: (' . $mysqli->errno . ') ' . $mysqli->error;
}
?>
