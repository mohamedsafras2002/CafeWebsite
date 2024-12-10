<?php 
    $host = 'localhost';
    $username = 'root';
    $psw = '';
    $db_name = 'main_db';
    $conn = mysqli_connect($host, $username, $psw, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    
?>