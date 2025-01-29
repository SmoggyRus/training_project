<?php
session_start();
require_once "db.php";
require_once "functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $pdo = dbConnect();

    // Функция с проверкой на существование Email в БД
    $user = get_user_by_email($pdo, $email);

    // Если занят перенаправляем назад
    if (!empty($user)) {
        set_flash_message('danger', 'Этот эл. адрес уже занят другим пользователем.');
        redirect_to('page_register.php');
    }
    // Добавление пользователя в БД
    add_user($pdo, $email, $password);

    set_flash_message('success', 'Регистрация успешна!');
    redirect_to('page_login.php');
}