<?php

session_start();
include("../../php/db-conn.php");
header('Content-Type: application/json');

$food_id = $_GET['food_id'] ?? null;

if (!$food_id) {
    echo json_encode(["status" => "error", "message" => "Invalid request: food_id is required"]);
    exit();
}

$query = $conn->prepare("SELECT * FROM food WHERE food_id = ?");
$query->bind_param("i", $food_id);
$query->execute();
$result = $query->get_result();
$food = $result->fetch_assoc();

if ($food) {
    echo json_encode($food);
} else {
    echo json_encode(["status" => "error", "message" => "Food not found"]);
}
