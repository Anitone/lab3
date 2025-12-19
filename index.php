<?php
session_start();

if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$bg = $_COOKIE['bg_color'] ?? 'white';
$font = $_COOKIE['font_color'] ??'black';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Главная</title>
</head>
<body style="background-color: <?= htmlspecialchars($bg) ?>; color: <?= htmlspecialchars($font) ?>;">
    <h1>Добро пожаловать!</h1>
    <p>Ваши настройки применены через cookies.</p>
    <a href="logout.php">Выйти</a>
</body>
</html>