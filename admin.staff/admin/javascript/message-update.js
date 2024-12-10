document.addEventListener('DOMContentLoaded', function () {
    var forms = document.querySelectorAll('.message-form');
    forms.forEach(form => {
        form.addEventListener('input', function (event) {
            validateField(event.target);
        });

        form.addEventListener('submit', function (event) {
            if (!validateForm(form)) {
                event.preventDefault(); 
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
            case 'subject':
                if (value === '') {
                    errorElement.textContent = 'Subject is required';
                    return false;
                } else {
                    errorElement.textContent = '';
                    return true;
                }
                case 'message':
                    if (value === '') {
                        errorElement.textContent = 'Message is required';
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
