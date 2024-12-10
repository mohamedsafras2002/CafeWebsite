<?php

session_start();
include("../../php/db-conn.php");

$food_id = $_POST['food_id'] ?? null;
$food_name = $_POST['food_name'] ?? '';
$cusine_type = $_POST['cusine_type'] ?? '';
$price = $_POST['price'] ?? '';
$image = $_POST['image'] ?? '';

if (!$food_id) {
    echo json_encode(["status" => "error", "message" => "Food ID is required"]);
    exit();
}

$query = $conn->prepare("UPDATE food SET name = ?, cusine_type = ?, price = ?, image = ? WHERE food_id = ?");
$query->bind_param("ssssi", $food_name, $cusine_type, $price, $image, $food_id);

$query->execute();

header("Location: ../manage-food.php");
exit();

?>

