<?php

require_once('connection.php');

$query = "SELECT * FROM posts ORDER BY id DESC";
$result = $conn->query($query);
$conn->close();
//Usar MYSQLI_ASSOC para exibir resultados pelo nome dos índices do array
$posts = $result->fetch_all(MYSQLI_ASSOC);