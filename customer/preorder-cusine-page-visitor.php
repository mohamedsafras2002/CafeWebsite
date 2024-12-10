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
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/home-page.css">
    <link rel="stylesheet" href="css/preorder-cusine.css">
    <title>Pre-Order cushine - The Gallery Café</title>

    <style>
        .preorder-container a {
            background-color: black;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            transition: 0.15s;
        }

        .preorder-container a:hover {
            opacity: 0.85;
        }
    </style>
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
                <a class="preorder-cushine-header" href="preorder-cusine-page-visitor.php">Pre-Order Cuisine</a>
            </div>
            <div class="right-button" id="about-us">
                <a class="about-us" href="about-page.html">About Us</a>
            </div>
            <div class="profile">
                <a href="login-form-page.php">
                    <button class="login-button">Login</button>
                </a>
                <a href="create-form-page.php">
                    <button class="create-button">Create an account</button>
                </a>
            </div>
        </div>
    </header>


    <main>
        <div class="food-card-container">
            <h3>Pre-Order Cusine</h3>
            <div class="search-container">
                <input class="search-bar" type="search" name="search" id="search-bar" placeholder="Search cusine" autocomplete="off">
            </div>
            <div class="food-card-grid">
                <?php
                include 'php/db-conn.php';
                $sql = "SELECT * FROM food";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="food-card">
                        <div class="food-pic-container">
                            <img class="food-pic" src="../' . $row["image"] . '" alt="' . $row["name"] . '">
                        </div>
                        <div class="food-details">
                            <div class="food-name">' . $row["name"] . '</div>
                            <div class="cusine-type">- ' . $row["cusine_type"] . ' -</div>
                            <div class="food-price">LKR ' . $row["price"] . '</div>
                            <div class="preorder-container">
                                <a class="pre-order-btn"  href="login-form-page.php">Pre-Order</a>
                            </div>
                            <div class="quantity-container">
                                <button class="minus" onclick="decreaseQuantity(this)">-</button>
                                <span class="quantity">1</span>
                                <button class="plus" onclick="increaseQuantity(this)">+</button>
                            </div>
                            
                        </div>
                    </div>';
                    }
                } else {
                    echo "No food items available.";
                }
                $conn->close();
                ?>

            </div>
        </div>
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
                <a class="preorder-cushine-header" href="preorder-cusine-visitor.php">Pre-Order Cushine</a>
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
    

    <script>
        document.getElementById('search-bar').addEventListener('input', function() {
            let searchQuery = this.value.toLowerCase();
            let foodCards = document.querySelectorAll('.food-card');

            foodCards.forEach(function(card) {
                let foodName = card.querySelector('.food-name').textContent.toLowerCase();
                let cuisineType = card.querySelector('.cusine-type').textContent.toLowerCase();

                if (foodName.includes(searchQuery) || cuisineType.includes(searchQuery)) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        });

        function decreaseQuantity(btn) {
            let quantityElement = btn.nextElementSibling;
            let quantity = parseInt(quantityElement.textContent);
            if (quantity > 1) {
                quantityElement.textContent = quantity - 1;
            }
        }

        function increaseQuantity(btn) {
            let quantityElement = btn.previousElementSibling;
            let quantity = parseInt(quantityElement.textContent);
            quantityElement.textContent = quantity + 1;
        }
    </script>
</body>

</html>










