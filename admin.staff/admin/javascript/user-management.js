function editUser(userType, userId) {
    fetch(`php/get-user-details.php?user_type=${userType}&user_id=${userId}`)
        .then((response) => response.json())
        .then((data) => {
            document.getElementById("user_type").value = userType;
            document.getElementById("user_id").value = userId;
            document.getElementById("fullname").value = data.fullname;
            document.getElementById("mobile_no").value = data.mobile_no;
            document.getElementById("username").value = data.username;
            document.getElementById("password").value = data.password;

            document.getElementById("edit-form-container").style.display =
                "block";
        });
}

function deleteUser(userType, userId) {
    if (confirm("Are you sure you want to delete this user?")) {
        fetch("php/delete-user.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `user_type=${encodeURIComponent(
                userType
            )}&user_id=${encodeURIComponent(userId)}`,
        })
            .then((response) => {
                if (response.status === 200) {
                    alert("User deleted successfully");
                    location.reload();
                } else if (response.status === 400) {
                    alert(
                        "Invalid request: Please check the user type and ID."
                    );
                } else if (response.status === 500) {
                    alert("Failed to delete the user due to a server error.");
                } else {
                    alert("Unexpected error: " + response.statusText);
                }
            })
            .catch((error) => alert("Error: " + error));
    }
}

function closeEditForm() {
    document.getElementById("edit-form-container").style.display = "none";
}

function showAddUserForm() {
    document.getElementById("add-user-form-container").style.display = "block";
}

function closeAddUserForm() {
    document.getElementById("add-user-form-container").style.display = "none";
}
