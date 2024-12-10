<?php
    session_start();

    include("php/db-conn.php");
    include("php/function.php");


    $error_message = '';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $username = $_POST['username'];
        $password = $_POST['password'];

        if (!empty($username) && !empty($password) && !is_numeric($username)) {

            $query = "SELECT * FROM customer WHERE username = '$username' LIMIT 1";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['password'] === $password) {
                    $_SESSION['user_id'] = $user_data['id'];
                    header("Location: home-page-logined.php");
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
    <meta name="view-transition" content="same-origin">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="pictures/logo/fevicon-logo.png">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/login-create-acc-page.css">
    <link rel="stylesheet" href="css/footer.css">

    <title>Login - The Gallery Café</title>
</head>

<body>
    <header class="header">
        <div class="left-section">
            <img class="cafe-logo" src="pictures/logo/logo-white-bg.png">
        </div>

        <div class="right-section">
            <div class="right-button">
                <a class="home-header" href="home-page-visitor.html">Home</a>
            </div>
            <div class="right-button" id="reservation-header">
                <a class="reservation-header" href="table-reservation-page-visitor.html">Table Reservation</a>
            </div>
            <div class="right-button" id="preorder-cushine-header">
                <a class="preorder-cushine-header" href="preorder-cusine-page-visitor.php">Pre-Order Cushine</a>
            </div>
            <div class="right-button" id="about-us">
                <a class="about-us" href="about-page.html">About Us</a>
            </div>
            <div class="profile">
                <a href="create-form-page.php">
                    <button class="create-button" id="create-button">Create an account</button>
                </a>
            </div>
        </div>
    </header>

    <main>
        <section class="login-section">
            <form class="login-form" id="login-form" method="post" autocomplete="off">
                <label class="title">Sign In</label>
                <div class="input-section">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Enter the username">
                </div>
                <div class="input-section">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter the password">
                </div>

                <?php if ($error_message) : ?>
                    <div class="error-box show">
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php endif; ?>

                <button class="login-button" type="submit">
                    Login
                </button>

                <p class="signup">
                    Don't have an account? <a href="create-form-page.php">Sign Up</a>
                </p>

            </form>
        </section>
    </main>

    <footer class="footer">
        <div class="left-section">
            <div class="right-button">
                <a class="home-header" href="home-page-visitor.html">Home</a>
            </div>
            <div class="right-button" id="reservation-header">
                <a class="reservation-header" href="table-reservation-page-visitor.html">Table Reservation</a>
            </div>
            <div class="right-button" id="preorder-cushine-header">
                <a class="preorder-cushine-header" href="preorder-cusine-page-visitor.php">Pre-Order Cusine</a>
            </div>
            <div class="right-button" id="about-us">
                <a class="about-us" href="about-page.html">About Us</a>
            </div>
        </div>

        <div class="right-section">
            <div class="contact-box">
                <div class="location">
                    <img src="pictures/Icons/location.svg">
                    <p><span>Address:</span> 87B, Main Street, Colombo 04</p>
                </div>
                <div class="tel-no">
                    <img src="pictures/Icons/tel-no.svg">
                    <p><span>Phone:</span> +34763445243</p>
                </div>
                <div class="opening-time">
                    <img src="pictures/Icons/time.svg">
                    <div>
                        <p>
                            <span>Opening Hours:</span><br>
                            Monday - Friday <br>
                            09.00 AM - 05.00 PM <br>
                            Saturday - Sunday <br>
                            09.00 AM - 09.00 PM <br>
                        </p>
                    </div>
                </div>
            </div>
            <div class="logo-container">
                <img class="cafe-logo" src="pictures/logo/logo-white-bg.png">
            </div>
        </div>
    </footer>
</body>

</html>