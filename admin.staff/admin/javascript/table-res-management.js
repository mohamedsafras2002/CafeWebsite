function editTableRes(tableResID) {
    fetch(`php/get-table-res-details.php?table_reservation_id=${tableResID}`)
        .then((response) => response.json())
        .then((data) => {

            document.getElementById("table_reservation_id").value = tableResID;
            document.getElementById("customer_id").value = customer_id;
            document.getElementById("name").value = data.name;
            document.getElementById("person").value = data.person;
            document.getElementById("date").value = data.date;
            document.getElementById("time").value = data.time;
            document.getElementById("state").value = data.state;

            document.getElementById("edit-form-container").style.display = "block";
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Failed to load table reservation details.');
        });
}

// Function to delete a food item
function deleteTableRes(tableResID) {
    if (confirm("Are you sure you want to delete this table reservation?")) {
        fetch("php/delete-table-res.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `table_reservation_id=${encodeURIComponent(tableResID)}`,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("An error occurred while deleting the table reservation.");
            });
    }
}

function closeEditForm() {
    document.getElementById("edit-form-container").style.display = "none";
}





