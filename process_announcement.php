<?php
session_start();
include('db/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    $sql = "INSERT INTO announcements (title, content, is_active) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $title, $message, $is_active);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: announcements.php?status=success");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
