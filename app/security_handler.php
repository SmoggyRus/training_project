<?php
session_start();
require_once "db.php";
require_once "functions.php";

$pdo = dbConnect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Общая информация
    $user_id = $_POST['user_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = get_user_by_id($pdo, $user_id);

    if ($email !== $user['email']) {
        // Функция с проверкой на существование Email в БД
        $user = get_user_by_email($pdo, $email);

        // Если занят перенаправляем назад
        if (!empty($user)) {
            set_flash_message('danger', 'Этот эл. адрес уже занят другим пользователем.');
            redirect_to('security.php?user_id=' . $user_id);
            return;
        }
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    edit_credentials($pdo, $user_id, $email, $password);
    set_flash_message('success', 'Успешно изменено!');
    redirect_to('users.php');
}