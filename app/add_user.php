<?php
session_start();
require_once "db.php";
require_once "functions.php";

$pdo = dbConnect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Общая информация
    $username = $_POST['username'];
    $job_title = $_POST['job_title'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    //Логин и пароль
    $email = $_POST['email'];
    $password = $_POST['password'];
    //Статус
    $status = $_POST['status'];
    $status = $statuses[$status] ?? NULL;
    // Аватар пользователя
    $avatar = $_FILES['avatar'];
    //Соц.сети
    $vk = $_POST['vk'];
    $telegram = $_POST['telegram'];
    $instagram = $_POST['instagram'];


    if (isset($_POST)) {
        $user = get_user_by_email($pdo, $email);
        // Если занят перенаправляем назад
        if (!empty($user)) {
            set_flash_message('danger', 'Этот эл.адрес уже занят другим пользователем.');
            redirect_to('create_user.php');
        }
        $user_id = add_user($pdo,$email,$password);
        if ($user_id) {
            edit_information($pdo,$user_id,$username,$job_title,$phone,$address);
            set_status($pdo,$user_id, $status);
            upload_avatar($pdo,$user_id,$avatar);
            add_social_links($pdo,$user_id,$vk,$telegram,$instagram);
            set_flash_message('success', 'Пользователь ' . '<strong>' .  $username . '</strong>' . ' успешно добавлен.');
            redirect_to('users.php');
        }
    }
}
