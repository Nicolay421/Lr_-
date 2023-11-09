<?php
if (isset($_COOKIE['counter'])) {
    // Отримуємо поточне значення лічильника з cookie
    $counter = $_COOKIE['counter'];
} else {
    $counter = 0;
}
if (isset($_POST['update'])) {

    $counter++;
  
    setcookie('counter', $counter, time() + 3600 * 24);
}
if (isset($_POST['delete'])) {
 
    setcookie('counter', '', time() - 3600);

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cookie і лічильник</title>
</head>
<body>
    <h1>Cookie і лічильник</h1>
    <form>
        <label for="cookieValue">Значення cookie:</label>
        <input type="text" id="cookieValue" value="<?php echo $counter; ?>" readonly>
    </form>
    <form method="POST">
        <input type="submit" name="update" value="Оновити">
        <input type="submit" name="delete" value="Видалити cookie">
    </form>
</body>
</html>
