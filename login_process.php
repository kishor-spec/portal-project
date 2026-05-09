<?php
include('include/header.php');   // This already has session_start()

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // ←←← CHANGE THIS TO YOUR ACTUAL EMAIL & PASSWORD
    if ($email == "kishorkoirala@gmail.com" && $password == "your_actual_password") {

        $_SESSION['email'] = $email;
        header('location:home.php');
        exit();
    } else {
        header('location:admin_login.php?invalid=1');
        exit();
    }
}

header('location:admin_login.php');
