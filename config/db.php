<?php

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'insti';

$conn = new mysqli($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}   

?>