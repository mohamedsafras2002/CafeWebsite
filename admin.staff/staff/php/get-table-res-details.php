<?php

session_start();
include("../../php/db-conn.php");
header('Content-Type: application/json');

$table_reservation_id = $_GET['table_reservation_id'] ?? null;

if (!$table_reservation_id) {
    echo json_encode(["status" => "error", "message" => "Invalid request: table_reservation_id is required"]);
    exit();
}

$query = $conn->prepare("SELECT * FROM table_reservation WHERE table_reservation_id = ?");
$query->bind_param("i", $table_reservation_id);
$query->execute();
$result = $query->get_result();
$table_reservation = $result->fetch_assoc();

if ($table_reservation) {
    echo json_encode($table_reservation);
} else {
    echo json_encode(["status" => "error", "message" => "Table reservation not found"]);
}
