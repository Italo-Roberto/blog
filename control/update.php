<?php

require_once('connection.php');

$id = $_POST['id'];
$title = $_POST['title'];
$subtitle = $_POST['subtitle'];
$body = $_POST['body'];

$stmt = $conn->prepare("UPDATE posts SET title=?, subtitle=?, body=? WHERE id=?");
$stmt->bind_param("sssi", $title, $subtitle, $body, $id);
$result = $stmt->execute();
try {
    $result;
    header('Location: http://localhost/blog/index.php');
} catch (mysqli_sql_exception $th) {
    throw $th;
}