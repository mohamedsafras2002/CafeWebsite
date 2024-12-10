<?php

session_start();
include("../../php/db-conn.php");

$message_id = $_POST['message_id'] ?? null;
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';
$respond = isset($_POST['respond']) ? 'responded' : '';

if (!$message_id) {
    echo json_encode(["status" => "error", "message" => "Message ID is required"]);
    exit();
}

$query = $conn->prepare("UPDATE message SET subject = ?, message = ?, respond = ? WHERE message_id = ?");
$query->bind_param("sssi", $subject, $message, $respond, $message_id);

$query->execute();

header("Location: ../manage-message.php");
exit();

?>

