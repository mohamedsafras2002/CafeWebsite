<?php
    session_start();

    include("../php/db-conn.php");
    include("admin-session.php");


    $error_message = '';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $username = $_POST['username'];
        $password = $_POST['password'];

        if (!empty($username) && !empty($password) && !is_numeric($username)) {

            $query = "SELECT * FROM admin WHERE username = '$username' LIMIT 1";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['password'] === $password) {
                    $_SESSION['admin_id'] = $user_data['admin_id'];
                    header("Location: admin-dashboard.php");
                    exit();
                } else {
                    $error_message = 'Wrong username or password!';
                }
            } else {
                $error_message = 'Wrong username or password!';
            }
        } else {
            $error_message = 'Both fields are required and username should not be numeric!';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../pictures/logo/fevicon-logo.png">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/login-page.css">


    <title>Admin Login</title>
</head>

<body>

    <main>
        <div class="login-box">
            <h2>Admin Login</h2>
            <form method="POST" autocomplete="off">
                <input type="hidden" name="user_role" value="admin">
                
                <input type="text" id="username" name="username" placeholder="Enter username">
                
                <input type="password" id="password" name="password" placeholder="Enter password">
                <button id="login-button" type="submit">Login</button>
            </form>
            <?php 

                if ($error_message) : ?>
                    <div class="error-box show">
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php endif; ?>
            <p>Login with <a href="../staff/staff-login.php">Operational Staff</a></p>
        </div>
    </main>

</body>

</html>