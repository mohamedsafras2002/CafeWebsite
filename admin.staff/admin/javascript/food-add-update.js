document.addEventListener('DOMContentLoaded', function () {
    var forms = document.querySelectorAll('.food-form');
    forms.forEach(form => {
        form.addEventListener('input', function (event) {
            validateField(event.target);
        });

        form.addEventListener('submit', function (event) {
            if (!validateForm(form)) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    });

    function validateForm(form) {
        var isValid = true;
        var fields = form.querySelectorAll('.validate');
        fields.forEach(field => {
            if (!validateField(field)) {
                isValid = false;
            }
        });
        return isValid;
    }

    function validateField(field) {
        var fieldName = field.name;
        var value = field.value.trim();
        var errorElement = field.nextElementSibling;

        switch (fieldName) {
            case 'food_name':
                if (value === '') {
                    errorElement.textContent = 'Food Name is required';
                    return false;
                } else {
                    errorElement.textContent = '';
                    return true;
                }
            case 'cusine_type':
                if (value === '') {
                    errorElement.textContent = 'Cusine Type is required';
                    return false;
                } else {
                    errorElement.textContent = '';
                    return true;
                }
            case 'price':
                if (value < 1) {
                    errorElement.textContent = 'Price must be at greater the 0';
                    return false;
                }else if (!Number.isInteger(Number(value))) {
                    errorElement.textContent = 'Price must be number';
                    return false;
                
                } else {
                    errorElement.textContent = '';
                    return true;
                }
            case 'password':
                if (value === '') {
                    errorElement.textContent = 'Image path is required';
                    return false;
                } else {
                    errorElement.textContent = '';
                    return true;
                }
            default:
                return true;
        }
    }
});
