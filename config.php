<?php
$host = '127.0.0.1';
$user = 'root';
$password = '1234';
$database = 'users_db';
$port = 3307; // Add your environment's specific port if it isn't 3306

// Pass the port as the 5th argument
$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>
