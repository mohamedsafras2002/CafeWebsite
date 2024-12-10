<?php
    session_start();
    include("php/db-conn.php");
    include("php/function.php");

    if (!isset($_SESSION['user_id'])) {
        header("Location: login-form-page.php");
        exit();
    }

    $success_message = '';
    $error_message = '';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $customer_id = $_SESSION['user_id']; 
        $name = htmlspecialchars(trim($_POST['name']));
        $person = htmlspecialchars(trim($_POST['person']));
        $date = htmlspecialchars(trim($_POST['date']));
        $time = htmlspecialchars(trim($_POST['time']));

        if (!empty($name) && !empty($person) && !empty($date) && !empty($time)) {
            $query = "INSERT INTO table_reservation (customer_id, name, person, date, time) VALUES ('$customer_id', '$name', '$person', '$date', '$time')";
            if (mysqli_query($conn, $query)) {
                $_SESSION['message'] = 'Table reserved successfully!';
                
            } else {
                $_SESSION['message'] = 'Error: ' . mysqli_error($conn);
            }
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
    <link rel="stylesheet" href="css/table-reservation.css">
    <link rel="stylesheet" href="css/about-page.css">
    <title>Table Reservation - The Gallery Café</title>
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
                <a class="preorder-cushine-header" href="preorder-cusine-page.php">Pre-Order Cuisine</a>
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
        <section class="gallery-container" id="gallery">
            <div class="gallery">
                <h3>Table Gallery</h3>
                <div class="picture-grid">
                    <div class="picture-container"><img src="pictures/table-pictures/1.jpg"></div>
                    <div class="picture-container"><img src="pictures/table-pictures/2.jpg"></div>
                    <div class="picture-container"><img src="pictures/table-pictures/3.jpg"></div>
                    <div class="picture-container"><img src="pictures/table-pictures/4.jpg"></div>
                </div>
            </div>
        </section>

        <section class="table-reservation-container" id="contact-us">
            <div class="reservation-layout">
                <div class="reservation-container">
                    <form class="reservation-form" id="reservation-form" method="post" autocomplete="off">
                        <label class="title">Reserve Table</label>
                        <div id="form-messages" style="color: green; margin-bottom: 10px;"></div>
                        <div class="input-section">
                            <label>Name</label>
                            <input id="name" type="text" name="name" placeholder="Enter your name">
                            <p id="nameError" class="error"></p>
                        </div>
                        <div class="input-section">
                            <label>Person</label>
                            <input id="person" type="number" name="person" placeholder="Enter the number of persons">
                            <p id="personError" class="error"></p>
                        </div>
                        <div class="input-section">
                            <label>Date</label>
                            <input id="date" type="date" name="date" placeholder="Enter the date">
                            <p id="dateError" class="error"></p>
                        </div>
                        <div class="input-section">
                            <label>Time</label>
                            <input id="time" type="time" name="time" placeholder="Enter the time">
                            <p id="timeError" class="error"></p>
                        </div>

                        <input type="hidden" id="customer-id" name="customer_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">

                        <div id="success-message" style="color: green; margin-top: 10px;"></div>
                        <div id="error-message" style="color: red; margin-top: 10px;"></div>

                        <input class="book-button" type="submit" value="Book now">
                    </form>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            let successMessage = "<?php echo isset($_SESSION['message']) ? htmlspecialchars($_SESSION['message']) : ''; ?>";
            if (successMessage) {
                document.getElementById('success-message').textContent = successMessage;
                <?php unset($_SESSION['message']); ?>
            }
        });

        function validateName() {
            const name = document.getElementById("name").value;
            const nameError = document.getElementById("nameError");
            if (name === "") {
                nameError.innerText = "Name is required.";
                return false;
            } else {
                nameError.innerText = "";
                return true;
            }
        }

        function validatePerson() {
            const person = document.getElementById("person").value;
            const personError = document.getElementById("personError");
            if (person === "") {
                personError.innerText = "Person quantity is required.";
                return false;
            } else if (person < 1) {
                personError.innerText = "Person must be at least 1.";
                return false;
            } else {
                personError.innerText = "";
                return true;
            }
        }

        function validateDate() {
            const date = document.getElementById("date").value;
            const dateError = document.getElementById("dateError");
            if (date === "") {
                dateError.innerText = "Date is required.";
                return false;
            } else {
                dateError.innerText = "";
                return true;
            }
        }

        function validateTime() {
            const time = document.getElementById("time").value;
            const timeError = document.getElementById("timeError");
            if (time === "") {
                timeError.innerText = "Time is required.";
                return false;
            } else {
                timeError.innerText = "";
                return true;
            }
        }

        document.getElementById("name").addEventListener("input", validateName);
        document.getElementById("person").addEventListener("input", validatePerson);
        document.getElementById("date").addEventListener("input", validateDate);
        document.getElementById("time").addEventListener("input", validateTime);

        document.getElementById('reservation-form').addEventListener('submit', function(event) {
            const isNameValid = validateName();
            const isPersonValid = validatePerson();
            const isDateValid = validateDate();
            const isTimeValid = validateTime();

            if (!isNameValid || !isPersonValid || !isDateValid || !isTimeValid) {
                
                event.preventDefault();
            }
        });
    </script>
    
</body>

</html>
