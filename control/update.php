<?php

require_once('connection.php');

$id = $_POST['id'];
$title = $_POST['title'];
$body = $_POST['body'];
$author = $_POST['author'];

$stmt = $conn->prepare("UPDATE posts SET title=?, body=?, author=? WHERE id=?");
$stmt->bind_param("sssi", $title, $body, $author, $id);
try {
    $stmt->execute();
    header('Location: http://localhost/blog/index.php');
} catch (mysqli_sql_exception $th) {
    throw $th;
}