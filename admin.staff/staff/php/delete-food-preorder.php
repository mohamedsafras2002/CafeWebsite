<?php



session_start();
include("../../php/db-conn.php");
header('Content-Type: application/json');

$order_id = $_POST['order_id'] ?? null;

if (!$order_id) {
    echo json_encode(["status" => "error", "message" => "Food Pre-Order ID is required"]);
    exit();
}

$query = $conn->prepare("DELETE FROM food_preorder WHERE order_id = ?");
$query->bind_param("i", $order_id);

if ($query->execute()) {
    if ($query->affected_rows > 0) {
        echo json_encode(["status" => "success", "message" => "Food pre-order deleted successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Food pre-order ID does not exist"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Failed to delete Food pre-order"]);
}


