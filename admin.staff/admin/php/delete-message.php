<?php

session_start();
include("../../php/db-conn.php");
header('Content-Type: application/json');

$message_id = $_POST['message_id'] ?? null;

if (!$message_id) {
    echo json_encode(["status" => "error", "message" => "Message ID is required"]);
    exit();
}

$query = $conn->prepare("DELETE FROM message WHERE message_id = ?");
$query->bind_param("i", $message_id);

if ($query->execute()) {
    if ($query->affected_rows > 0) {
        echo json_encode(["status" => "success", "message" => "Message deleted successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Message ID does not exist"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Failed to delete message"]);
}


