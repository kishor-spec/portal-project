<?php
session_start();
include('db/config.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // 1. Collect and Sanitize Text Data
    $title    = mysqli_real_escape_string($conn, $_POST['title']);
    $summary  = mysqli_real_escape_string($conn, $_POST['summary']);
    $content  = mysqli_real_escape_string($conn, $_POST['content']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $status   = mysqli_real_escape_string($conn, $_POST['status']);

    $image_name = "";

    // 2. Handle File Upload
    if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] == 0) {
        $target_dir = "uploads/news/";

        // Create unique name to prevent overwriting (e.g., 167253120_image.jpg)
        $file_ext   = pathinfo($_FILES["featured_image"]["name"], PATHINFO_EXTENSION);
        $image_name = time() . "_" . basename($_FILES["featured_image"]["name"]);
        $target_file = $target_dir . $image_name;

        // Simple validation: check if it's an image
        $check = getimagesize($_FILES["featured_image"]["tmp_name"]);
        if ($check !== false) {
            move_uploaded_file($_FILES["featured_image"]["tmp_name"], $target_file);
        } else {
            die("File is not a valid image.");
        }
    }

    // 3. Insert into Database using Prepared Statements (Security)
    $sql = "INSERT INTO news (title, summary, content, category, status, featured_image) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    // "ssssss" means 6 strings
    mysqli_stmt_bind_param($stmt, "ssssss", $title, $summary, $content, $category, $status, $image_name);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect back to home or manage news with success message
        header("Location: home.php?status=success");
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
