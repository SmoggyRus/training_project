<?php
session_start();
require_once "db.php";
require_once "functions.php";

$pdo = dbConnect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Общая информация
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $job_title = $_POST['job_title'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $vk = $_POST['vk'];
    $telegram = $_POST['telegram'];
    $instagram = $_POST['instagram'];


    edit_information($pdo,$user_id,$username,$job_title,$phone,$address);
    add_social_links($pdo,$user_id, $telegram, $instagram, $vk);
    set_flash_message('success', 'Общая информация о пользователе ' . '<strong>' . $username . '</strong>' . ' была изменена!');
    redirect_to("users.php");
}