<?php
session_start();
include("../../php/db-conn.php");

$user_type = $_GET['user_type'];
$user_id = $_GET['user_id'];

if ($user_type == 'customer') {
    $query = $conn->prepare("SELECT * FROM customer WHERE customer_id = ?");
} elseif ($user_type == 'admin') {
    $query = $conn->prepare("SELECT * FROM admin WHERE admin_id = ?");
} else {
    $query = $conn->prepare("SELECT * FROM staff WHERE staff_id = ?");
}

$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

echo json_encode($user);

?>