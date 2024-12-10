<?php
session_start();
include("../../php/db-conn.php");

function random_num($length) {
    $text = "";
    if ($length < 5) {
        $length = 5;
    }
    $len = rand(4, $length);
    for ($i = 0; $i < $len; $i++) {
        $text .= rand(0, 9);
    }
    return $text;
}

// Retrieve form data
$user_type = $_POST['user_type'];
$fullname = $_POST['fullname'];
$mobile_no = $_POST['mobile_no'];
$username = $_POST['username'];
$password = $_POST['password']; // Plaintext password as requested


// Prepare SQL based on user type
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($user_type === 'customer') {
        $session_id = random_num(10); // Generate a unique session key for the customer
        $stmt = $conn->prepare("INSERT INTO customer (id, fullname, mobile_no, username, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('issss', $session_id, $fullname, $mobile_no, $username, $password);
        $stmt->execute();
        
    } elseif ($user_type === 'admin') {
        $stmt = $conn->prepare("INSERT INTO admin (fullname, mobile_no, username, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $fullname, $mobile_no, $username, $password);
        $stmt->execute();
        
    } else {
        $stmt = $conn->prepare("INSERT INTO staff (fullname, mobile_no, username, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $fullname, $mobile_no, $username, $password);
        $stmt->execute();
    }
    
    
    
    header("Location: ../manage-user.php");
    exit();
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
