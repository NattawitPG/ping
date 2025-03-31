<?php
// Update this line with the correct database name
$conn = new mysqli('localhost', 'root', '', 'dreamworld_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

