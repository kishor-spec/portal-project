<?php
session_start();
include('db/config.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // 1. Collect and Sanitize Data
    // We need the ID to know which record to update
    $news_id  = mysqli_real_escape_string($conn, $_POST['news_id']);
    $title    = mysqli_real_escape_string($conn, $_POST['title']);
    $summary  = mysqli_real_escape_string($conn, $_POST['summary']);
    $content  = mysqli_real_escape_string($conn, $_POST['content']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $status   = mysqli_real_escape_string($conn, $_POST['status']);

    // 2. Fetch the current image first (in case the user doesn't upload a new one)
    $res = mysqli_query($conn, "SELECT featured_image FROM news WHERE id = '$news_id'");
    $row = mysqli_fetch_assoc($res);
    $image_name = $row['featured_image'];

    // 3. Handle New File Upload (if any)
    if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] == 0) {
        $target_dir = "uploads/news/";

        // Generate new name
        $new_image_name = time() . "_" . basename($_FILES["featured_image"]["name"]);
        $target_file = $target_dir . $new_image_name;

        // Simple validation
        $check = getimagesize($_FILES["featured_image"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["featured_image"]["tmp_name"], $target_file)) {

                // Optional: Delete the old physical file to save server space
                if (!empty($image_name) && file_exists($target_dir . $image_name)) {
                    unlink($target_dir . $image_name);
                }

                // Update variable to the new filename
                $image_name = $new_image_name;
            }
        } else {
            die("File is not a valid image.");
        }
    }

    // 4. Update Database using Prepared Statements
    $sql = "UPDATE news SET 
            title = ?, 
            summary = ?, 
            content = ?, 
            category = ?, 
            status = ?, 
            featured_image = ? 
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    // "ssssssi" -> 6 strings followed by 1 integer (id)
    mysqli_stmt_bind_param($stmt, "ssssssi", $title, $summary, $content, $category, $status, $image_name, $news_id);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect with updated status
        header("Location: edit_news.php?id=" . $news_id . "&status=updated");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    // If someone tries to access this file directly without POST
    header("Location: manage_news.php");
    exit();
}
