<?php
session_start();
include("../php/db-conn.php");
include("admin-session.php");


$user_data = check_login($conn);

// Fetch foods
$foods = $conn->query("SELECT * FROM food");

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
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="css/manage-user.css">
    <title>Manage Foods</title>
</head>

<body>

    <nav class="sidebar" id="sidebar">
        <div class="sidebar-toggle" onclick="toggleSidebar()">
            <img class="toggle-icon" src="../pictures/icons/hamburger.png">
        </div>
        <a href="admin-dashboard.php">
            <img src="../pictures/icons/home.png">
            <p>Home</p>
        </a>
        <a href="manage-user.php">
            <img src="../pictures/icons/user.png">
            <p>Manage Users</p>
        </a>
        <a href="manage-food.php">
            <img src="../pictures/icons/food.png">
            <p>Manage Foods</p>
        </a>
        <a href="manage-table-res.php">
            <img src="../pictures/icons/table.png">
            <p>Manage Table Reservations</p>
        </a>
        <a href="manage-food-preorder.php">
            <img src="../pictures/icons/order.png">
            <p>Manage Food Pre-Orders</p>
        </a>
        <a href="manage-message.php">
            <img src="../pictures/icons/message.png">
            <p>Manage Messages</p>
        </a>
        <div class="logout-box">
            <a class="logout-button" href="admin-logout.php">
                <img src="../pictures/icons/logout.png">
                <p>Logout</p>
            </a>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            <h1>Manage Foods</h1>

            <div class="header-container">
                <h2>Foods</h2>
                <button class="add-button" onclick="showAddFoodForm()">Add New Food</button>
            </div>

            <div class="grid-container">
                <?php while ($food = $foods->fetch_assoc()) : ?>
                    <div class="grid-item">
                        <p><span>ID:</span> <?= $food['food_id'] ?></p>
                        <p><span>Food Name:</span> <?= $food['name'] ?></p>
                        <p><span>Cusine Type:</span> <?= $food['cusine_type'] ?></p>
                        <p><span>Price:</span> <?= $food['price'] ?></p>
                        <p><span>Image Path:</span> <?= $food['image'] ?></p>
                        <button onclick="editFood(<?= $food['food_id'] ?>)">Edit</button>
                        <button onclick="deleteFood(<?= $food['food_id'] ?>)">Delete</button>
                    </div>
                <?php endwhile; ?>
            </div>

        </div>

        <div id="edit-form-container" class="edit-form-container">
            <div class="set-middle">
                <form id="edit-form" class="food-form" method="POST" action="php/update-food.php" autocomplete="off">
                    <input type="hidden" name="food_id" id="food_id">
                    <label for="food_name">Food Name:</label>
                    <input type="text" name="food_name" id="food_name">
                    <p id="foodError" class="error"></p>
                    <label for="cusine_type">Cusine Type:</label>
                    <input type="text" name="cusine_type" id="cusine_type">
                    <p id="cusineError" class="error"></p>
                    <label for="price">Price:</label>
                    <input type="text" name="price" id="price">
                    <p id="priceError" class="error"></p>
                    <label for="image">Image Path:</label>
                    <input type="text" name="image" id="image">
                    <p id="imageError" class="error"></p>
                    <button type="submit" id="update">Update</button>
                    <button type="button" onclick="closeEditForm()">Cancel</button>
                </form>
            </div>
        </div>



        <div id="add-user-form-container" class="edit-form-container">
            <div class="set-middle">
                <form id="add-user-form" class="food-form" method="POST" action="php/add-food.php" autocomplete="off">
                    <input type="hidden" name="food_id" id="food_id">
                    <label for="food_name">Food Name:</label>
                    <input type="text" name="food_name" id="food_name">
                    <p id="foodError" class="error"></p>
                    <label for="mobile_no">Cusine Type:</label>
                    <input type="text" name="cusine_type" id="cusine_type">
                    <p id="cusineError" class="error"></p>
                    <label for="price">Price:</label>
                    <input type="text" name="price" id="price">
                    <p id="priceError" class="error"></p>
                    <label for="image">Image Path:</label>
                    <input type="text" name="image" id="image">
                    <p id="imageError" class="error"></p>
                    <button type="submit" id="add-food">Add Food</button>
                    <button type="button" onclick="closeAddFoodForm()">Cancel</button>
                </form>
            </div>
        </div>
    </main>

    <script src="../javascript/sidebar-minimize.js"></script>

    <script src="javascript/food-management.js"></script>

    <script src="javascript/food-add-update.js"></script>

    

</body>

</html>