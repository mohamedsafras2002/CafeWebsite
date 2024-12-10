function editFoodPre(foodPreID) {
    fetch(`php/get-food-preorder-details.php?order_id=${foodPreID}`)
        .then((response) => response.json())
        .then((data) => {

            document.getElementById("order_id").value = foodPreID;
            document.getElementById("customer_id").value = customer_id;
            document.getElementById("food_id").value = data.food_id;
            document.getElementById("quantity").value = data.quantity;
            document.getElementById("state").value = data.state;

            document.getElementById("edit-form-container").style.display = "block";
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Failed to load table reservation details.');
        });
}

function deleteFoodPre(foodPreID) {
    if (confirm("Are you sure you want to delete this table reservation?")) {
        fetch("php/delete-food-preorder.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `order_id=${encodeURIComponent(foodPreID)}`,
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
                alert("An error occurred while deleting the food preorder.");
            });
    }
}

function closeEditForm() {
    document.getElementById("edit-form-container").style.display = "none";
}





