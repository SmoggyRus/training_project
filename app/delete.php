<?php
session_start();
require_once 'functions.php';
require_once 'db.php';

if (is_not_logged_in()) {
    redirect_to('page_login.php');
    return;
}
if (!is_admin(get_auth_user()) && !is_author($_GET['id'], get_auth_user())) {
    set_flash_message("danger", "Вы можете удалить только свой профиль");
    redirect_to('users.php');
    return;
}

$pdo = dbConnect();

$user = get_user_by_id($pdo, $_GET['id']);

delete_user($pdo, $user['id']);
set_flash_message('success','Пользователь ' . $user['username'] . ' успешно удален!');

if (get_auth_user()['id'] == $user['id']) {
    redirect_to('page_register.php');
} else
    redirect_to('users.php');

?>