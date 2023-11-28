<?php
include "Model.php";
include "config.php";

try {
    // Виведення фотогалереї
    $photos = Model::allPhotos($pdo);

    if (count($photos) > 0) {
        echo "<h1>Фотогалерея</h1>";
        echo "<div class='gallery'>";
        
        foreach ($photos as $photo) {
            echo "<div class='photo'>";
            echo "<img src='path/to/your/uploaded/photos/" . $photo->columns->filename . "' alt='" . $photo->columns->description . "'>";
            echo "<p>" . $photo->columns->description . "</p>";
            echo "</div>";
        }

        echo "</div>";
    } else {
        echo "Фотогалерея порожня.";
    }
} catch (PDOException $e) {
    echo "Помилка підключення до бази даних: " . $e->getMessage();
}
?>
