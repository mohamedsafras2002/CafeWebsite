<?php
include("../../php/db-conn.php");


$user_type = $_POST['user_type'] ?? null;
$user_id = $_POST['user_id'] ?? null;

if (!$user_type || !$user_id) {
    http_response_code(400);
    header('Status: 400 Bad Request');
    exit();
}

$query = null;

if ($user_type == 'customer') {
    $query = $conn->prepare("DELETE FROM customer WHERE customer_id = ?");
} elseif ($user_type == 'admin') {
    $query = $conn->prepare("DELETE FROM admin WHERE admin_id = ?");
} elseif ($user_type == 'staff') {
    $query = $conn->prepare("DELETE FROM staff WHERE staff_id = ?");
} else {
    http_response_code(400);
    header('Status: 400 Bad Request');
    exit();
}

$query->bind_param("i", $user_id);

if ($query->execute()) {
    http_response_code(200);
    header('Status: 200 OK');
} else {
    http_response_code(500);
    header('Status: 500 Internal Server Error');
}
