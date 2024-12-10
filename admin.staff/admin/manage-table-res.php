<?php 
    session_start();
    include("../php/db-conn.php");
    include("admin-session.php");
    $user_data = check_login($conn);

    $table_reservations = $conn->query("SELECT * FROM table_reservation");
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
    <title>Manage Table Reservations</title>
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
            <h1>Manage Table Reservations</h1>

            <div class="header-container">
                <h2>Table Reservations</h2>
            </div>

            <div class="grid-container">
                <?php while ($table_reservation = $table_reservations->fetch_assoc()) : ?>
                    <div class="grid-item">
                        <p><span>ID:</span> <?= $table_reservation['table_reservation_id'] ?></p>
                        <p><span>Customer ID:</span> <?= $table_reservation['customer_id'] ?></p>
                        <p><span>Name:</span> <?= $table_reservation['name'] ?></p>
                        <p><span>No of Persons:</span> <?= $table_reservation['person'] ?></p>
                        <p><span>Reservation Date:</span> <?= $table_reservation['date'] ?></p>
                        <p><span>Reservation Time:</span> <?= $table_reservation['time'] ?></p>
                        <p><span>State:</span> <?= $table_reservation['state'] ?></p>
                        <button onclick="editTableRes(<?= $table_reservation['table_reservation_id'] ?>)">Edit</button>
                        <button onclick="deleteTableRes(<?= $table_reservation['table_reservation_id'] ?>)">Delete</button>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <div id="edit-form-container" class="edit-form-container">
            <div class="set-middle">
                <form id="edit-form" class="reservation-form" method="POST" action="php/update-table-res.php" autocomplete="off">
                    <input type="hidden" name="table_reservation_id" id="table_reservation_id">
                    <input type="hidden" name="customer_id" id="customer_id">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name">
                    <p id="nameError" class="error"></p>
                    <label for="cusine_type">No of Pesons:</label>
                    <input type="text" name="person" id="person">
                    <p id="personError" class="error"></p>
                    <label for="date">Reservation Date:</label>
                    <input type="date" name="date" id="date">
                    <p id="dateError" class="error"></p>
                    <label for="time">Reservation Time:</label>
                    <input type="time" name="time" id="time">
                    <p id="timeError" class="error"></p>
                    <label for="state">Confirm the Reservation:
                        <input type="checkbox" id="state" name="state" value="confirm">
                    </label>
                    
                    <button type="submit" id="update">Update</button>
                    <button type="button" onclick="closeEditForm()">Cancel</button>
                </form>
            </div>
        </div>

    </main>

    <script src="../javascript/sidebar-minimize.js"></script>

    <script src="javascript/table-res-management.js"></script>

    <script src="javascript/table-res-update.js"></script>

</body>
</html>