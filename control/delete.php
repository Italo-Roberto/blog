<?php

require_once('connection.php');

$id = $_POST['id'];

$stmt = $conn->prepare("DELETE FROM posts WHERE id=?");
$stmt->bind_param("i", $id);
try {
    $stmt->execute();
    header('Location: http://localhost/blog/index.php');
} catch (mysqli_sql_exception $th) {
    throw $th;
}