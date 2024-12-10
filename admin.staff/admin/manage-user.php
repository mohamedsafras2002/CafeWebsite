<?php
session_start();
include("../php/db-conn.php");
include("admin-session.php");
$user_data = check_login($conn);

// Fetch users
$customers = $conn->query("SELECT * FROM customer");
$admins = $conn->query("SELECT * FROM admin");
$staffs = $conn->query("SELECT * FROM staff");
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
    <title>Manage Users</title>
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
            <h1>Manage Users</h1>

            <div class="header-container">
                <h2>Customers</h2>
                <button class="add-button" onclick="showAddUserForm()">Add New User</button>
            </div>

            <div class="grid-container">
                <?php while ($customer = $customers->fetch_assoc()) : ?>
                    <div class="grid-item">
                        <p><span>ID:</span> <?= $customer['customer_id'] ?></p>
                        <p><span>Full Name:</span> <?= $customer['fullname'] ?></p>
                        <p><span>Mobile Number:</span> <?= $customer['mobile_no'] ?></p>
                        <p><span>Username:</span> <?= $customer['username'] ?></p>
                        <p><span>Password:</span> <?= $customer['password'] ?></p>
                        <button onclick="editUser('customer', <?= $customer['customer_id'] ?>)">Edit</button>
                        <button onclick="deleteUser('customer', <?= $customer['customer_id'] ?>)">Delete</button>
                    </div>
                <?php endwhile; ?>
            </div>

            <div class="header-container">
                <h2>Admins</h2>
                <button class="add-button" onclick="showAddUserForm()">Add New User</button>
            </div>

            <div class="grid-container">
                <?php while ($admin = $admins->fetch_assoc()) : ?>
                    <div class="grid-item">
                        <p><span>ID:</span> <?= $admin['admin_id'] ?></p>
                        <p><span>Full Name:</span> <?= $admin['fullname'] ?></p>
                        <p><span>Mobile Number:</span> <?= $admin['mobile_no'] ?></p>
                        <p><span>Username:</span> <?= $admin['username'] ?></p>
                        <p><span>Password:</span> <?= $admin['password'] ?></p>
                        <button onclick="editUser('admin', <?= $admin['admin_id'] ?>)">Edit</button>
                        <button onclick="deleteUser('admin', <?= $admin['admin_id'] ?>)">Delete</button>
                    </div>
                <?php endwhile; ?>
            </div>
            

            <div class="header-container">
                <h2>Staffs</h2>
                <button class="add-button" onclick="showAddUserForm()">Add New User</button>
            </div>
            
            <div class="grid-container">
                <?php while ($staff = $staffs->fetch_assoc()) : ?>
                    <div class="grid-item">
                        <p><span>ID:</span> <?= $staff['staff_id'] ?></p>
                        <p><span>Full Name:</span> <?= $staff['fullname'] ?></p>
                        <p><span>Mobile Number:</span> <?= $staff['mobile_no'] ?></p>
                        <p><span>Username:</span> <?= $staff['username'] ?></p>
                        <p><span>Password:</span> <?= $staff['password'] ?></p>
                        <button onclick="editUser('staff', <?= $staff['staff_id'] ?>)">Edit</button>
                        <button onclick="deleteUser('staff', <?= $staff['staff_id'] ?>)">Delete</button>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <div id="edit-form-container" class="edit-form-container">
            <div class="set-middle">
                <form id="edit-form" class="user-form" method="POST" action="php/update-user.php" autocomplete="off">
                    <input type="hidden" name="user_type" id="user_type">
                    <input type="hidden" name="user_id" id="user_id">
                    <label for="fullname">Full Name:</label>
                    <input type="text" name="fullname" id="fullname" required>
                    <p id="fullnameError" class="error"></p>
                    <label for="mobile_no">Mobile No:</label>
                    <input type="text" name="mobile_no" id="mobile_no" required>
                    <p id="mobileError" class="error"></p>
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required>
                    <p id="usernameError" class="error"></p>
                    <label for="password">Password:</label>
                    <input type="text" name="password" id="password">
                    <p id="passwordError" class="error"></p>
                    <button type="submit" id="update">Update</button>
                    <button type="button" onclick="closeEditForm()">Cancel</button>
                </form>
            </div>
        </div>



        <div id="add-user-form-container" class="edit-form-container">
            <div class="set-middle">
                <form id="add-user-form" class="user-form" method="POST" action="php/add-user.php" autocomplete="off">
                    <label for="user_type">User Type:</label>
                    <select name="user_type" id="user_type" required>
                        <option value="customer">Customer</option>
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                    </select>
                    <label for="fullname">Full Name:</label>
                    <input type="text" name="fullname" id="fullname">
                    <p id="fullnameError" class="error"></p>
                    <label for="mobile_no">Mobile Number:</label>
                    <input type="text" name="mobile_no" id="mobile_no">
                    <p id="mobileError" class="error"></p>
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username">
                    <p id="usernameError" class="error"></p>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password">
                    <p id="passwordError" class="error"></p>
                    <button type="submit" id="add-user">Add User</button>
                    <button type="button" onclick="closeAddUserForm()">Cancel</button>
                </form>
            </div>
        </div>
    </main>

    <script src="../javascript/sidebar-minimize.js"></script>

    <script src="javascript/user-management.js"></script>

    <script src="javascript/add-update.js"></script>

    
</body>

</html>