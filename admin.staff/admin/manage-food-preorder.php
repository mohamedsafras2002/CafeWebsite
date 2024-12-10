<?php 
    session_start();
    include("../php/db-conn.php");
    include("admin-session.php");
    $user_data = check_login($conn);

    $food_preorders = $conn->query("SELECT * FROM food_preorder");
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
    <title>Manage Food Pre-Orders</title>
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
            <h1>Manage Food Pre-Orders</h1>

            <div class="header-container">
                <h2>Food Pre-Orders</h2>
            </div>

            <div class="grid-container">
                <?php while ($food_preorder = $food_preorders->fetch_assoc()) : ?>
                    <div class="grid-item">
                        <p><span>ID:</span> <?= $food_preorder['order_id'] ?></p>
                        <p><span>Customer ID:</span> <?= $food_preorder['customer_id'] ?></p>
                        <p><span>Food ID:</span> <?= $food_preorder['food_id'] ?></p>
                        <p><span>Quantity of foods:</span> <?= $food_preorder['quantity'] ?></p>
                        <p><span>State:</span> <?= $food_preorder['state'] ?></p>
                        <button onclick="editFoodPre(<?= $food_preorder['order_id'] ?>)">Edit</button>
                        <button onclick="deleteFoodPre(<?= $food_preorder['order_id'] ?>)">Delete</button>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <div id="edit-form-container" class="edit-form-container">
            <div class="set-middle">
                <form id="edit-form" class="pre-order-form" method="POST" action="php/update-food-preorder.php" autocomplete="off">
                    <input type="hidden" name="order_id" id="order_id">
                    <input type="hidden" name="customer_id" id="customer_id">
                    <label for="food_id">Food ID:</label>
                    <input type="text" name="food_id" id="food_id">
                    <p id="foodIdError" class="error"></p>
                    <label for="quantity">Quantity:</label>
                    <input type="text" name="quantity" id="quantity">
                    <p id="quantityError" class="error"></p>
                    <label for="state">Confirm the Pre-Order:
                        <input type="checkbox" id="state" name="state" value="confirm">
                    </label>
                    <button type="submit" id="update">Update</button>
                    <button type="button" onclick="closeEditForm()">Cancel</button>
                </form>
            </div>
        </div>

    </main>

    <script src="../javascript/sidebar-minimize.js"></script>

    <script src="javascript/food-preorder-management.js"></script>

    <script src="javascript/food-preorder-update.js"></script>

</body>
</html>