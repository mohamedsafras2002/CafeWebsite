document.addEventListener('DOMContentLoaded', function () {
    var forms = document.querySelectorAll('.reservation-form');
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
            case 'name':
                if (value === '') {
                    errorElement.textContent = 'Name is required';
                    return false;
                } else {
                    errorElement.textContent = '';
                    return true;
                }
            case 'person':
                if (value < 1) {
                    errorElement.textContent = 'No of person must be at greater the 0';
                    return false;
                }else if (!Number.isInteger(Number(value))) {
                    errorElement.textContent = 'No of person must be number';
                    return false;
                
                } else {
                    errorElement.textContent = '';
                    return true;
                }
            case 'date':
                if (value === '') {
                    errorElement.textContent = 'Reservation date is required';
                    return false;
                } else {
                    errorElement.textContent = '';
                    return true;
                }
            case 'time':
                if (value === '') {
                    errorElement.textContent = 'Reservation time is required';
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
