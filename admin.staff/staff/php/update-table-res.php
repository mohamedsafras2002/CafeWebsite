<?php

session_start();
include("../../php/db-conn.php");
// header('Content-Type: application/json');

$table_reservation_id = $_POST['table_reservation_id'] ?? null;
$name = $_POST['name'] ?? '';
$person = $_POST['person'] ?? '';
$date = $_POST['date'] ?? '';
$time = $_POST['time'] ?? '';
$state = $_POST['state'] ?? '';
$state = isset($_POST['state']) ? 'confirmed' : '';

if (!$table_reservation_id) {
    echo json_encode(["status" => "error", "message" => "Table reservation ID is required"]);
    exit();
}

$query = $conn->prepare("UPDATE table_reservation SET name = ?, person = ?, date = ?, time = ?, state = ? WHERE table_reservation_id = ?");
$query->bind_param("sssssi", $name, $person, $date, $time, $state, $table_reservation_id);

$query->execute();

header("Location: ../manage-table-res.php");
exit();

?>

