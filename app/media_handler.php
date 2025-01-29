<?php
session_start();
require_once "db.php";
require_once "functions.php";

$pdo = dbConnect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $avatar = $_FILES['avatar'];
    upload_avatar($pdo, $user_id, $avatar);
    set_flash_message('success', 'Аватарка изменена!');
    redirect_to('users.php');
}