<?php



session_start();
include("../../php/db-conn.php");
header('Content-Type: application/json');

$table_reservation_id = $_POST['table_reservation_id'] ?? null;

if (!$table_reservation_id) {
    echo json_encode(["status" => "error", "message" => "Table reservation ID is required"]);
    exit();
}

$query = $conn->prepare("DELETE FROM table_reservation WHERE table_reservation_id = ?");
$query->bind_param("i", $table_reservation_id);

if ($query->execute()) {
    if ($query->affected_rows > 0) {
        echo json_encode(["status" => "success", "message" => "Table reservation deleted successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Table reservation ID does not exist"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Failed to delete Table reservation"]);
}


