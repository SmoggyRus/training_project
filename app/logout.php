<?php
session_start();
require_once 'functions.php';
// Удаляем данные сессии
unset($_SESSION['user_id']);
unset($_SESSION['success']);
unset($_SESSION['error']);

// Уничтожаем сессию
session_destroy();

redirect_to('page_login.php');