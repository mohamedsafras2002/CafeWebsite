<?php 
    session_start();
    include("../php/db-conn.php");
    include("staff-session.php");
    $user_data = check_login($conn);

    $messages = $conn->query("SELECT * FROM message");
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
    <link rel="stylesheet" href="../admin/css/manage-user.css">
    <title>Manage Messages</title>
</head>
<body>
    

    <nav class="sidebar" id="sidebar">
        <div class="sidebar-toggle" onclick="toggleSidebar()">
            <img class="toggle-icon" src="../pictures/icons/hamburger.png">
        </div>
        <a href="staff-dashboard.php">
            <img src="../pictures/icons/home.png">
            <p>Home</p>
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
            <a class="logout-button" href="staff-logout.php">
                <img src="../pictures/icons/logout.png">
                <p>Logout</p>
            </a>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            <h1>Manage Messages</h1>

            <div class="header-container">
                <h2>Messages</h2>
            </div>

            <div class="grid-container">
                <?php while ($message = $messages->fetch_assoc()) : ?>
                    <div class="grid-item">
                        <p><span>ID:</span> <?= $message['message_id'] ?></p>
                        <p><span>Customer ID:</span> <?= $message['customer_id'] ?></p>
                        <p><span>Subject:</span> <?= $message['subject'] ?></p>
                        <p><span>Message:</span> <?= $message['message'] ?></p>
                        <p><span>Respond:</span> <?= $message['respond'] ?></p>
                        <button onclick="editMessage(<?= $message['message_id'] ?>)">Edit</button>
                        <button onclick="deleteMessage(<?= $message['message_id'] ?>)">Delete</button>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <div id="edit-form-container" class="edit-form-container">
            <div class="set-middle">
                <form id="edit-form" class="message-form" method="POST" action="php/update-message.php" autocomplete="off">
                    <input type="hidden" name="message_id" id="message_id">
                    <input type="hidden" name="customer_id" id="customer_id">
                    <label for="subject">Subject:</label>
                    <input type="text" name="subject" id="subject">
                    <p id="subjectError" class="error"></p>
                    <label for="message">Message:</label>
                    <input type="text" name="message" id="message">
                    <p id="messageError" class="error"></p>
                    <label for="respond">Respond the message:
                        <input type="checkbox" id="respond" name="respond" value="responded">
                    </label>
                    <button type="submit" id="update">Update</button>
                    <button type="button" onclick="closeEditForm()">Cancel</button>
                </form>
            </div>
        </div>

    </main>

    <script src="../javascript/sidebar-minimize.js"></script>

    <script src="../admin/javascript/message-management.js"></script>

    <script src="../admin/javascript/message-update.js"></script>

</body>
</html>