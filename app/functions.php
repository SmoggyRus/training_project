<?php
require_once 'db.php';

// Основные функции
function get_user_by_email($pdo, $email)
{
    $sql = "SELECT * FROM `users` WHERE email = :email";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(["email" => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}
function add_user($pdo, $email, $password)
{
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ":email" => $email,
        ":password" => password_hash($password, PASSWORD_DEFAULT)
    ]);
    $user_id = $pdo->lastInsertId();
    return $user_id;
}
function login($pdo, $email, $password)
{
    //Получаем данные о пользователе
    $user = get_user_by_email($pdo, $email);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user;
        return true;
    }
    return false;
}
function is_logged_in(){
    if(isset($_SESSION["user_id"])){
        return true;
    }

    return false;
}
function is_not_logged_in() {
   return !is_logged_in();
}
function get_users($pdo) { // Возвращает всех пользователей из БД
$sql = "SELECT * FROM `users`";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $users;
}
function get_auth_user(){ // Возвращает текущего авторизованного пользователя
    if(is_logged_in()){
        return $_SESSION["user_id"];
    } else
        return false;
}
function is_admin($user) { // Проверка является ли пользователь администратором
    if (is_logged_in()) {
        if($user["role"] === "admin") {
            return true;
        }
        return false;
    }
}
function is_equal($user, $auth_user) { // Проверка на совпадение id авторизованного пользователя в списке пользователей
    if ($user['id'] === $auth_user['id']) {
        return true;
    };
    return false;
}
function delete_user($pdo, $user_id)
{
    $sql = "DELETE FROM `users` WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["user_id" => $user_id]);
    return true;
}

// Страница - добавить пользователя
function edit_information($pdo,$user_id, $username, $job_title, $phone, $address)
{
    $sql = "UPDATE users SET username = :username, job_title = :job_title, phone = :phone, address = :address WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':user_id' => $user_id,
        ':username' => $username,
        ':job_title' => $job_title,
        ':phone' => $phone,
        ':address' => $address,
    ]);
}
function set_status($pdo, $user_id, $status)
{
    $sql = "UPDATE users SET status = :status WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':user_id' => $user_id,
        ':status' => $status
    ]);
}
function upload_avatar($pdo, $user_id, $avatar)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $filename = $_FILES["avatar"]["name"];
        $filetype = $_FILES["avatar"]["type"];
        $tmp_name = $_FILES['avatar']['tmp_name'];
        $upload_dir = '../img/demo/avatars/';
        $allowed_types = ['image/jpeg', 'image/png'];

        if (!in_array($filetype, $allowed_types)) {
            $_SESSION['danger'] = 'Можно загружать файлы только в формате: jpg, png';
            redirect_to('create_user.php');
            return;
        }

        // Генерируем уникальное имя файла
        $new_filename = uniqid() . "." . pathinfo($filename, PATHINFO_EXTENSION);
        $target_file = $upload_dir . $new_filename;

        if (!move_uploaded_file($tmp_name, $target_file)) {
            $_SESSION['danger'] = 'Ошибка при загрузке файла!';
            redirect_to('create_user.php');
            return;
        }
    }

    $sql = "UPDATE users SET image = :image WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':user_id' => $user_id,
        ':image' => $new_filename
    ]);
}
function add_social_links($pdo, $user_id, $telegram,$instagram, $vk)
{
    $sql = "UPDATE users SET vk = :vk,telegram = :telegram, instagram = :instagram WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':user_id' => $user_id,
        ':vk' => $vk,
        ':telegram' => $telegram,
        ':instagram' => $instagram
    ]);
}

// Страница - Редактирование данных пользователя
function is_author ($logged_user, $edit_user) {
    if ($logged_user === $edit_user['id']) {
        return true;
    }
    return false;
}
function get_user_by_id($pdo, $user_id)
{
    $sql = "SELECT * FROM `users` WHERE id = :user_id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([":user_id" => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}
function edit_credentials($pdo, $user_id, $email, $password)
{
    $sql = "UPDATE users SET email = :email, password = :password WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':user_id' => $user_id,
        ':email' => $email,
        ':password' => $password
    ]);
}
// Вспомогательные функции
function set_flash_message($type, $message)
{
    $_SESSION[$type] = $message;
}
function display_flash_message($type)
{
    if (isset($_SESSION[$type])) {
        echo "<div class=\"alert alert-{$type} text-dark\" role=\"alert\">{$_SESSION[$type]}</div>";
        unset($_SESSION[$type]);
    }
}
function redirect_to($path){
    header("Location: /$path");
    exit;
}