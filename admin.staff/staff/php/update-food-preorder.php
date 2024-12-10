<?php

session_start();
include("../../php/db-conn.php");
// header('Content-Type: application/json');

$order_id = $_POST['order_id'] ?? null;
$food_id = $_POST['food_id'] ?? '';
$quantity = $_POST['quantity'] ?? '';
$state = isset($_POST['state']) ? 'confirmed' : '';

if (!$order_id) {
    echo json_encode(["status" => "error", "message" => "Table reservation ID is required"]);
    exit();
}

$query = $conn->prepare("UPDATE food_preorder SET food_id = ?, quantity = ?, state = ? WHERE order_id = ?");
$query->bind_param("issi", $food_id, $quantity, $state, $order_id);

$query->execute();

header("Location: ../manage-food-preorder.php");
exit();

?>

