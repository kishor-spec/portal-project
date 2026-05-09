<?php

include_once('db/config.php');

$id = $_GET['id'];

$conn->execute_query("delete from news where id=$id");

header('Location: manage_news.php');
exit();
