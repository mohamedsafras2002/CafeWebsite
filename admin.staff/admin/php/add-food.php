<?php
session_start();
include("../../php/db-conn.php");


// Retrieve form data
$food_name = $_POST['food_name'];
$cusine_type = $_POST['cusine_type'];
$price = $_POST['price'];
$image = $_POST['image']; 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $stmt = $conn->prepare("INSERT INTO food (name, cusine_type, price, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $food_name, $cusine_type, $price, $image);
        $stmt->execute();
    
    
    
    header("Location: ../manage-food.php");
    exit();
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
