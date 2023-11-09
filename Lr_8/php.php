<?php
// Зчитуємо вміст файлу XML
$xml = file_get_contents('auto.xml');

// Перетворюємо XML у масив або об'єкт SimpleXMLElement
$carData = new SimpleXMLElement($xml);

// Перетворюємо SimpleXMLElement у масив (якщо потрібно)
$carArray = json_decode(json_encode($carData), true);

// Виводимо дані у форматі таблиці або HTML-переліку
echo '<table>';
foreach ($carData->model as $model) {
    echo '<tr><td>' . $model . '</td></tr>';
}
echo '</table>';
?>
