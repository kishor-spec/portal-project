<?php
include_once('db/config.php');

$id = $_GET['id'];

$conn->execute_query("delete from announcements where id=$id");

header('Location: announcements.php');
exit();