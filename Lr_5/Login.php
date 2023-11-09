<?php
require_once 'conf.php';
require_once 'users.php';
$login = $_POST['login'];
$password = $_POST['password'];


if (isset($users[$login]) && $users[$login]['password'] === $password) {
    $name = $users[$login]['name'];
    echo "Ви успішно увійшли як $name!";
} else {
    echo "Помилка входу. Спробуйте ще раз.";
}
?>
