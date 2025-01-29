<?php
session_start();
require_once "db.php";
require_once "functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $pdo = dbConnect();

    $user = login($pdo, $email, $password);

    if (!$user) {
        set_flash_message('danger', 'Введён неверный пароль!');
        redirect_to("page_login.php");
    } else {
        set_flash_message('success', "Вы успешно вошли!");
        redirect_to("users.php");
    }
}