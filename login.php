<?php
session_start();
require_once 'connect.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $statement = $mysqli->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $statement->bind_param('ss',$username,$password);
    $statement->execute();
    $result = $statement->get_result();
    $user = $result->fetch_assoc();

    if($user) {
        $_SESSION['user_id'] = $user['id'];
        setcookie('bg_color',$user['bg_color'],time()+3600*24*30);
        setcookie('font_color',$user['font_color'],time()+3600*24*30);
        header("Location: index.php");
        exit;
    }
    else {
        echo "Неверный логин или пароль";
    }
}
?>

<form method="post">
    Логин: <input type="text" name="username" required><br>
    Пароль: <input type="password" name="password" required><br>
    <button type="submit">Войти</button>
</form>
<p>Нет аккаунта? <a href="register.php">Зарегистрироваться</a></p>