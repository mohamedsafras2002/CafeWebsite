<?php
    session_start();

    include("php/db-conn.php");
    include("php/function.php");

    if (!isset($_SESSION['user_id'])) {
        header("Location: login-form-page.php");
        exit();
    }


    $success_message = '';
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $customer_id = $_POST['customer_id'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $customer_id = htmlspecialchars(trim($customer_id));
        $subject = htmlspecialchars(trim($subject));
        $message = htmlspecialchars(trim($message));

        if (!empty($customer_id) && !empty($subject) && !empty($message)) {
            $query = "INSERT INTO message (customer_id, subject, message) VALUES ('$customer_id', '$subject', '$message')";
            if (mysqli_query($conn, $query)) {
                $_SESSION['message'] = 'Message sent successfully!';
                header("Location: about-page-logined.php");
                exit();
            } else {
                $_SESSION['message'] = 'Error: ' . mysqli_error($conn);
            }
        } else {
            $_SESSION['message'] = 'Please fill out all fields.';
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="pictures/logo/fevicon-logo.png">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/home-page-logined.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/about-page.css">
    <title>About Us - The Gallery Café</title>
</head>

<body>
    <header class="header">
        <div class="left-section">
            <img class="cafe-logo" src="pictures/logo/logo-white-bg.png">
        </div>

        <div class="right-section">
            <div class="right-button">
                <a class="home-header" href="home-page-logined.php">Home</a>
            </div>
            <div class="right-button" id="reservation-header">
                <a class="reservation-header" href="table-reservation-page.php">Table Reservation</a>
            </div>
            <div class="right-button" id="preorder-cushine-header">
                <a class="preorder-cushine-header" href="preorder-cusine-page.php">Pre-Order Cusine</a>
            </div>
            <div class="right-button" id="about-us">
                <a class="about-us" href="about-page-logined.php">About Us</a>
            </div>
            <div class="profile">
                <a href="logout.php">
                    <button class="login-button">Logout</button>
                </a>
            </div>
        </div>
    </header>

    <main>
        <section>
            <div class="slideshow-container">
                <div class="mySlides fade">
                    <img class="slideshow-picture" src="pictures/slideshow/1.jpg">
                </div>

                <div class="mySlides fade">
                    <img class="slideshow-picture" src="pictures/slideshow/2.jpg">
                </div>

                <div class="mySlides fade">
                    <img class="slideshow-picture" src="pictures/slideshow/3.jpg">

                </div>

                <div class="mySlides fade">
                    <img class="slideshow-picture" src="pictures/slideshow/4.jpg">
                </div>
                <div class="overlay">
                    <div class="restaurant-title">
                        <h1>About Us></h1>
                        <div>
                            <a href="#welcome">
                                The Gallery Café
                            </a>
                            <a href="#our-story">
                                Our Story
                            </a>
                            <a href="#gallery">
                                Gallery
                            </a>
                            <a href="#contact-us">
                                Contact Us
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="about-container" id="welcome">
            <div class="content">
                <h3>The Gallery Café</h3>
                <p>Nestled in the heart of Colombo, The Gallery Café offers a unique culinary experience that blends
                    exquisite cuisine with an artistic ambiance. Since our opening in 2022, we have been dedicated to
                    providing our guests with not only delicious food but also an unforgettable dining experience.</p>
            </div>
        </section>

        <section class="about-container" id="our-story">

            <div class="content">
                <h3>Our Story</h3>
                <p>The Gallery Café was founded by Abdul Azeez, a passionate foodie and art enthusiast, who envisioned a
                    place where culinary artistry meets visual art. What started as a small café has grown into one of
                    Colombo's most beloved dining destinations, renowned for its innovative dishes, exceptional service,
                    and vibrant atmosphere.</p>
            </div>
        </section>

        <section class="gallery-container
        " id="gallery">
            <div class="gallery">
                <h3>Gallery</h3>
                <div class="picture-grid">
                    <div class="picture-container"><img src="pictures/about-page/1.jpg"></div>
                    <div class="picture-container"><img src="pictures/about-page/2.jpg"></div>
                    <div class="picture-container"><img src="pictures/about-page/3.jpg"></div>
                    <div class="picture-container"><img src="pictures/about-page/4.jpg"></div>
                    <div class="picture-container"><img src="pictures/about-page/5.jpg"></div>
                    <div class="picture-container"><img src="pictures/about-page/6.jpg"></div>
                    <div class="picture-container"><img src="pictures/about-page/7.jpg"></div>
                    <div class="picture-container"><img src="pictures/about-page/8.jpg"></div>
                </div>
            </div>
        </section>

        <section class="contact-container" id="contact-us">
            <div class="contact-layout">
                <div class="message-container">
                    <form class="message-form" id="message-form" method="post" autocomplete="off">
                        <label class="title">Send Mesaage</label>
                        <div class="input-section">
                            <label>Subject</label>
                            <input type="text" name="subject" placeholder="Enter your subject">
                        </div>
                        <div class="input-section">
                            <label>Message</label>
                            <textarea name="message" rows="5" cols="40">
                                </textarea>
                        </div>

                        <input type="hidden" id="customer-id" name="customer_id">

                        <div id="success-message" style="color: green; margin-top: 10px;"></div>

                        <input class="send-button" type="submit" value="Send">


                    </form>
                </div>
                <div class="contact-details">
                    <div class="contact-box">
                        <h3>Contact details</h3>
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

                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="left-section">

            <div class="right-button">
                <a class="home-header" href="home-page-logined.php">Home</a>
            </div>
            <div class="right-button" id="reservation-header">
                <a class="reservation-header" href="table-reservation-page.php">Table Reservation</a>
            </div>
            <div class="right-button" id="preorder-cushine-header">
                <a class="preorder-cushine-header" href="preorder-cusine-page.php">Pre-Order Cushine</a>
            </div>
            <div class="right-button" id="about-us">
                <a class="about-us" href="about-page-logined.php">About Us</a>
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

    
    <script src="javascript/home-page-slideshow.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var customerId = "<?php echo htmlspecialchars($_SESSION['user_id']); ?>";
            document.getElementById('customer-id').value = customerId;
        });

        let successMessage = "<?php echo isset($_SESSION['message']) ? htmlspecialchars($_SESSION['message']) : ''; ?>";
        
        
        if (successMessage) {
            document.getElementById('success-message').textContent = successMessage;
 
            <?php unset($_SESSION['message']); ?>
        }
    </script>

</body>

</html>