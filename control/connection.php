<?php

define('Host', 'localhost');
define('Dbname', 'blog');
define('User', 'root');
define('Passwd', '');

try {
    $conn = new mysqli(Host, User, Passwd, Dbname);
} catch (mysqli_sql_exception $th) {
     throw $th;
}