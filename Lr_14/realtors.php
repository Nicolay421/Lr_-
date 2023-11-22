<?php
include "config.php";
include "Realtor.php";

try {
    $realtors = Realtor::all($pdo);
    
    if (count($realtors) > 0) {
        echo "<h1>Список рієлторів</h1>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Ім'я рієлтора</th><th>Контактний номер</th><th>Email</th></tr>";
        
        foreach ($realtors as $realtor) {
            echo "<tr>";
            echo "<td>" . $realtor->id . "</td>";
            echo "<td>" . $realtor->name . "</td>";
            echo "<td>" . $realtor->contact_number . "</td>";
            echo "<td>" . $realtor->email . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "У базі даних немає рієлторів.";
    }
} catch (PDOException $e) {
    echo "Помилка підключення до бази даних: " . $e->getMessage();
}
?>
