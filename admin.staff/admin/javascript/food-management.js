function editFood(foodID) {
    fetch(`php/get-food-details.php?food_id=${foodID}`)
        .then((response) => response.json())
        .then((data) => {

            document.getElementById("food_id").value = foodID;
            document.getElementById("food_name").value = data.name;
            document.getElementById("cusine_type").value = data.cusine_type;
            document.getElementById("price").value = data.price;
            document.getElementById("image").value = data.image;

            document.getElementById("edit-form-container").style.display = "block";
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Failed to load food details.');
        });
}

// Function to delete a food item
function deleteFood(foodID) {
    if (confirm("Are you sure you want to delete this food?")) {
        fetch("php/delete-food.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `food_id=${encodeURIComponent(foodID)}`,
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
                alert("An error occurred while deleting the food.");
            });
    }
}

function closeEditForm() {
    document.getElementById("edit-form-container").style.display = "none";
}

function showAddFoodForm() {
    document.getElementById("add-user-form-container").style.display = "block";
}

function closeAddFoodForm() {
    document.getElementById("add-user-form-container").style.display = "none";
}




