<?php
    session_start();

    include("php/db-conn.php");
    include("php/function.php");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $fullname = $_POST['fullname'];
        $mobile_no = $_POST['mobile_no'];
        $username = $_POST['username'];
        $password = $_POST['password'];


        $user_id = random_num(20);
        $query = "INSERT INTO customer (id, fullname, mobile_no, username, password) VALUES ('$user_id','$fullname','$mobile_no', '$username','$password')";

        mysqli_query($conn, $query);

        header("Location: login-form-page.php");
        die;
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
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/login-create-acc-page.css">
    <title>Create an account - The Gallery Café</title>
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
                <a class="preorder-cushine-header" href="preorder-cusine-page-visitor.php">Pre-Order Cusine</a>
            </div>
            <div class="right-button" id="about-us">
                <a class="about-us" href="about-page.html">About Us</a>
            </div>
            <div class="profile">
                <a href="login-form-page.php">
                    <button class="create-button" id="create-button">Login</button>
                </a>
            </div>
        </div>
    </header>

    <main>
        <section class="login-section">

            <form class="login-form" id="register-form" method="post" autocomplete="off">
                <label class="title">Sign Up</label>
                <div class="input-section">
                    <label>Full Name</label>
                    <input id="fullname" type="text" name="fullname" placeholder="Enter the full name">
                    <p id="fullnameError" class="error"></p>
                </div>
                <div class="input-section">
                    <label>Mobile Number</label>
                    <input id="mobile_no" type="text" name="mobile_no" placeholder="Enter the mobile number">
                    <p id="mobileError" class="error"></p>
                </div>
                <div class="input-section">
                    <label>Username</label>
                    <input id="username" type="text" name="username" placeholder="Enter the username">
                    <p id="usernameError" class="error"></p>
                </div>
                <div class="input-section">
                    <label>Password</label>
                    <input id="password" type="password" name="password" placeholder="Enter the password">
                    <p id="passwordError" class="error"></p>
                </div>

                <div class="input-section">
                    <label>Confirm Password</label>
                    <input id="c_password" type="password" name="c_password" placeholder="Confirm the password">
                    <p id="cPasswordError" class="error"></p>
                </div>

                <input id="register" class="register-button" type="submit" value="Register" name="register">


                <p class="signup">
                    Already have an account? <a href="login-form-page.php">Sign In</a>
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

   <script src="javascript/create-form-page.js"></script>



</body>

</html>