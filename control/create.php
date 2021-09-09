<?php

require_once('connection.php');

$title = $_POST['title'];
$body = $_POST['body'];
$author = $_POST['author'];

$stmt = $conn->prepare("INSERT INTO posts(title, body, author) VALUES(?, ?, ?)");
$stmt->bind_param("sss", $title, $body, $author);
$result = $stmt->execute();

if ($result) {
    header('Location: ../index.php');
}else{
    echo "Não foi possível postar!";
}