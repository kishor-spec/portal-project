<?php
session_start();

if ($_SESSION['email'] == true) {
} else
    header('location:admin_login.php');
$page = 'category';

include('include/header.php');
