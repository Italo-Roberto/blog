<?php

require_once('connection.php');

$title = $_POST['title'];
$subtitle = $_POST['subtitle'];
$body = $_POST['body'];
$author = $_POST['author'];

$stmt = $conn->prepare("INSERT INTO posts(title, subtitle, body, author) VALUES(?, ?, ?, ?)");
$stmt->bind_param("ssss", $title, $subtitle, $body, $author);
$result = $stmt->execute();

if ($result) {
    header('Location: ../index.php');
}else{
    echo "Não foi possível postar!";
}