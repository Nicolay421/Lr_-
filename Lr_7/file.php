<?php
function saveToFile($text) {
    $file = fopen('file.txt', 'a'); 
    fwrite($file, $text . "\n"); 
    fclose($file); 
}
if (isset($_POST['text'])) {
    $text = $_POST['text'];
    saveToFile($text); 
    echo "Текст було збережено в файлі file.txt";
}
$fileContents = file_get_contents('file.txt');
$lines = explode("\n", $fileContents);
echo "<h2>Зміст файла file.txt:</h2>";
echo "<div>";
foreach ($lines as $line) {
    echo "<p>$line</p>";
}
echo "</div>";
?>
