<?php
include("../../php/db-conn.php");

$user_type = $_POST['user_type'];
$user_id = $_POST['user_id'];
$fullname = $_POST['fullname'];
$mobile_no = $_POST['mobile_no'];
$username = $_POST['username'];
$password = $_POST['password'];

if (!empty($password)) {
    $password = $password;
} else {
    // Fetch existing password if password is not updated
    if ($user_type == 'customer') {
        $query = $conn->prepare("SELECT password FROM customer WHERE customer_id = ?");
    } elseif ($user_type == 'admin') {
        $query = $conn->prepare("SELECT password FROM admin WHERE admin_id = ?");
    } else {
        $query = $conn->prepare("SELECT password FROM staff WHERE staff_id = ?");
    }

    $query->bind_param("i", $user_id);
    $query->execute();
    $result = $query->get_result();
    $user = $result->fetch_assoc();
    $password = $user['password'];
}

if ($user_type == 'customer') {
    $query = $conn->prepare("UPDATE customer SET fullname = ?, mobile_no = ?, username = ?, password = ? WHERE customer_id = ?");
} elseif ($user_type == 'admin') {
    $query = $conn->prepare("UPDATE admin SET fullname = ?, mobile_no = ?, username = ?, password = ? WHERE admin_id = ?");
} else {
    $query = $conn->prepare("UPDATE staff SET fullname = ?, mobile_no = ?, username = ?, password = ? WHERE staff_id = ?");
}


$query->bind_param("ssssi", $fullname, $mobile_no, $username, $password, $user_id);
$query->execute();

header("Location: ../manage-user.php");
exit();
