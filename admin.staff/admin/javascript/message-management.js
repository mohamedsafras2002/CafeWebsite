function editMessage(msgID) {
    fetch(`php/get-message-details.php?message_id=${msgID}`)
        .then((response) => response.json())
        .then((data) => {

            document.getElementById("message_id").value = msgID;
            document.getElementById("customer_id").value = customer_id;
            document.getElementById("subject").value = data.subject;
            document.getElementById("message").value = data.message;
            document.getElementById("respond").value = data.respond;

            document.getElementById("edit-form-container").style.display = "block";
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Failed to load message details.');
        });
}

function deleteMessage(msgID) {
    if (confirm("Are you sure you want to delete this message?")) {
        fetch("php/delete-message.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `message_id=${encodeURIComponent(msgID)}`,
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





