<?php
function dbConnect() {
    $host = "localhost";
    $username = "root";
    $password = "";
    $db = "diplom";

    try {
        $dsn = "mysql:host=$host;dbname=$db;";
        $pdo = new PDO($dsn, $username, $password);
        return $pdo;
    } catch (PDOException $error) {
        die("Ошибка подключения к базе данных: " . $error->getMessage());
    }
}