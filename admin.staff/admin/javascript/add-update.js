document.addEventListener('DOMContentLoaded', function () {
    var forms = document.querySelectorAll('.user-form');
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
            case 'fullname':
                if (value === '') {
                    errorElement.textContent = 'Full Name is required';
                    return false;
                } else {
                    errorElement.textContent = '';
                    return true;
                }
            case 'mobile_no':
                if (!/^\d{10}$/.test(value)) {
                    errorElement.textContent = 'Enter a valid 10-digit mobile number';
                    return false;
                } else {
                    errorElement.textContent = '';
                    return true;
                }
            case 'username':
                if (value.length < 3) {
                    errorElement.textContent = 'Username must be at least 3 characters long';
                    return false;
                } else {
                    errorElement.textContent = '';
                    return true;
                }
            case 'password':
                if (value.length < 6) {
                    errorElement.textContent = 'Password must be at least 6 characters long';
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
