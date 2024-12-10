<?php

session_start();
include("../../php/db-conn.php");
header('Content-Type: application/json');

$food_id = $_POST['food_id'] ?? null;

if (!$food_id) {
    echo json_encode(["status" => "error", "message" => "Food ID is required"]);
    exit();
}

$query = $conn->prepare("DELETE FROM food WHERE food_id = ?");
$query->bind_param("i", $food_id);

if ($query->execute()) {
    if ($query->affected_rows > 0) {
        echo json_encode(["status" => "success", "message" => "Food deleted successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Food ID does not exist"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Failed to delete food"]);
}


