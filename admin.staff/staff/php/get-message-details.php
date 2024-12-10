<?php

session_start();
include("../../php/db-conn.php");
header('Content-Type: application/json');

$message_id = $_GET['message_id'] ?? null;

if (!$message_id) {
    echo json_encode(["status" => "error", "message" => "Invalid request: Message ID is required"]);
    exit();
}

$query = $conn->prepare("SELECT * FROM message WHERE message_id = ?");
$query->bind_param("i", $message_id);
$query->execute();
$result = $query->get_result();
$message = $result->fetch_assoc();

if ($message) {
    echo json_encode($message);
} else {
    echo json_encode(["status" => "error", "message" => "Message not found"]);
}
