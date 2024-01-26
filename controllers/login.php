<?php
    require 'views/login.view.php';
    if($_POST){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
        $query = $connection->prepare('SELECT * FROM akun WHERE username = ? AND password = ?');
        $query->execute([$username, $password]);
        $akun = $query->fetch(PDO::FETCH_ASSOC);
        echo "1";
        if (count($akun) > 0) {
                $_SESSION['username'] = $akun['username'];
                $_SESSION['role'] = $akun['role'];
                header('location: /');
        }
        else {
            echo "Username atau email yang anda masukkan salah";
        }
    }