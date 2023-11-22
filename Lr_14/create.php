<?php
include "config.php";
include "Realtor.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_realtor'])) {
    $name = $_POST['name'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];

    $realtor = new Realtor($pdo);
    $result = $realtor->create($name, $contact_number, $email);

    if ($result) {
        echo "Новий рієлтор успішно доданий.";
    } else {
        echo "Помилка при додаванні нового рієлтора.";
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_realtor'])) {
    $id = $_POST['realtor_id'];
    $name = $_POST['name'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];

    $realtor = new Realtor($pdo);
    $realtor->find($id);
    $realtor->name = $name;
    $realtor->contact_number = $contact_number;
    $realtor->email = $email;

    $result = $realtor->update();

    if ($result) {
        echo "Інформація про рієлтора оновлена.";
    } else {
        echo "Помилка при оновленні інформації про рієлтора.";
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $realtor = new Realtor($pdo);
    $realtor->find($id);

    $result = $realtor->delete();

    if ($result) {
        echo "Рієлтор видалений.";
    } else {
        echo "Помилка при видаленні рієлтора.";
    }
}


$realtors = Realtor::all($pdo);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Додати рієлтора</title>
</head>

<body>

    <h2>Додати нового рієлтора</h2>
    <form method="POST" action="create.php">
        <label for="name">Ім'я рієлтора:</label>
        <input type="text" name="name" required><br>

        <label for="contact_number">Контактний номер:</label>
        <input type="text" name="contact_number" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <input type="submit" name="add_realtor" value="Додати рієлтора">
    </form>

    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
        $id = $_GET['id'];

        $realtor = new Realtor($pdo);
        $realtor->find($id);
    ?>
        <h2>Редагувати рієлтора</h2>
        <form method="POST" action="realtors.php">
            <input type="hidden" name="realtor_id" value="<?php echo $realtor->id; ?>">

            <label for="name">Ім'я рієлтора:</label>
            <input type="text" name="name" value="<?php echo $realtor->name; ?>" required><br>

            <label for="contact_number">Контактний номер:</label>
            <input type="text" name="contact_number" value="<?php echo $realtor->contact_number; ?>" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $realtor->email; ?>" required><br>

            <input type="submit" name="update_realtor" value="Оновити рієлтора">
        </form>
    <?php
    }
    ?>

</body>

</html>
