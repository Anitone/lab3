<?php
require_once 'connect.php';

function checker($color) {
    return preg_match('/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/', $color) ? $color : '#ffffff';
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $bg_color = checker($_POST['bg_color'] ?? 'white');
    $font_color = checker($_POST['font_color'] ?? 'black');
    $statement = $mysqli->prepare("INSERT INTO users (username, password, bg_color, font_color) VALUES (?, ?, ?, ?)");
    $statement->bind_param('ssss',$username,$password,$bg_color,$font_color);
    if($statement->execute()) {
        header("Location: login.php");
        exit;
    }
    else {
        echo "Ошибка: " . $statement->error;
    }
}
?>

<form method="post">
    Логин: <input type="text" name="username" required><br>
    Пароль: <input type="password" name="password" required><br>
    Цвет фона: <input type="text" name="bg_color" value="#FFFFFF"><br>
    Цвет шрифта: <input type="text" name="font_color" value="#000000"><br>
    <button type="submit">Зарегистрироваться</button>
</form>