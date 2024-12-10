document.getElementById('search-bar').addEventListener('input', function() {
    let searchQuery = this.value.toLowerCase();
    let foodCards = document.querySelectorAll('.food-card');

    foodCards.forEach(function(card) {
        let foodName = card.querySelector('.food-name').textContent.toLowerCase();
        let cuisineType = card.querySelector('.cusine-type').textContent.toLowerCase();
        
        if (foodName.includes(searchQuery) || cuisineType.includes(searchQuery)) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    });
});

function decreaseQuantity(btn) {
    let quantityElement = btn.nextElementSibling;
    let quantity = parseInt(quantityElement.textContent);
    if (quantity > 1) {
        quantityElement.textContent = quantity - 1;
    }
}

function increaseQuantity(btn) {
    let quantityElement = btn.previousElementSibling;
    let quantity = parseInt(quantityElement.textContent);
    quantityElement.textContent = quantity + 1;
}

document.querySelectorAll('.pre-order-btn').forEach(button => {
    button.addEventListener('click', function() {
        const foodCard = this.closest('.food-card');
        const foodId = this.getAttribute('data-id');
        const quantity = foodCard.querySelector('.quantity').textContent;

        fetch('php/preorder-cusine.php', { // Ensure this path is correct
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `food_id=${foodId}&quantity=${quantity}`
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            const successMessage = foodCard.querySelector('.success-message');
                successMessage.textContent = data.message;

            if (data.status === "success") {
                successMessage.style.display = 'block';
            } else {
                alert(data.message);
            }

            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 3000);
        })
        .catch(error => console.error('Error:', error));
    });
});