<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'db-conn.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Customer ID is not set in the session.'
    ]);
    exit;
}

$customer_id = (int)$_SESSION['user_id'];
$food_id = isset($_POST['food_id']) ? (int)$_POST['food_id'] : 0;
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

if ($food_id === 0 || $quantity < 1) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid input data.'
    ]);
    exit;
}

$sql = "INSERT INTO food_preorder (customer_id, food_id, quantity) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Prepare failed: ' . $conn->error
    ]);
    exit;
}

$stmt->bind_param("iii", $customer_id, $food_id, $quantity);

$response = [];
if ($stmt->execute()) {
    $response['status'] = "success";
    $response['message'] = "Order placed successfully!";
} else {
    $response['status'] = "error";
    $response['message'] = "Execute failed: " . $stmt->error;
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>
