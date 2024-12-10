<?php

session_start();
include("../../php/db-conn.php");
header('Content-Type: application/json');

$order_id = $_GET['order_id'] ?? null;

if (!$order_id) {
    echo json_encode(["status" => "error", "message" => "Invalid request: Food Preorder ID is required"]);
    exit();
}

$query = $conn->prepare("SELECT * FROM food_preorder WHERE order_id = ?");
$query->bind_param("i", $order_id);
$query->execute();
$result = $query->get_result();
$food_preorder = $result->fetch_assoc();

if ($food_preorder) {
    echo json_encode($food_preorder);
} else {
    echo json_encode(["status" => "error", "message" => "Food Pre-Order not found"]);
}
