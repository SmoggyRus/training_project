<?php
session_start();
require_once "db.php";
require_once "functions.php";

$pdo = dbConnect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $status = $_POST['status'];

    set_status($pdo,$user_id, $status);
    set_flash_message('success', 'Статус успешно изменен!');
    redirect_to('users.php');
}