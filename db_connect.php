<?php

$servername = "localhost";
$username = "root";
$password = "lacam";
$database="triagebot_2";

try {
    $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo json_encode("Connection failed: " . $e->getMessage());
}
?>
