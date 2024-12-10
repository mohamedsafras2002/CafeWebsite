function validateFullName() {
    const fullname = document.getElementById("fullname").value;
    const fullnameError = document.getElementById("fullnameError");
    if (fullname === "") {
        fullnameError.innerText = "Full name is required.";
        return false;
    } else {
        fullnameError.innerText = "";
        return true;
    }
}

function validateMobileNo() {
    const mobile_no = document.getElementById("mobile_no").value;
    const mobileError = document.getElementById("mobileError");
    const mobilePattern = /^\d{10}$/;
    if (mobile_no === "") {
        mobileError.innerText = "Mobile number is required.";
        return false;
    } else if (!mobilePattern.test(mobile_no)) {
        mobileError.innerText =
            "Invalid mobile number format. Must be 10 digits.";
        return false;
    } else {
        mobileError.innerText = "";
        return true;
    }
}

function validateUsername() {
    const username = document.getElementById("username").value;
    const usernameError = document.getElementById("usernameError");
    if (username === "") {
        usernameError.innerText = "Username is required.";
        return false;
    } else {
        usernameError.innerText = "";
        return true;
    }
}

function validatePassword() {
    const password = document.getElementById("password").value;
    const passwordError = document.getElementById("passwordError");
    if (password === "") {
        passwordError.innerText = "Password is required.";
        return false;
    } else if (password.length < 8) {
        passwordError.innerText =
            "Password must be at least 8 characters long.";
        return false;
    } else {
        passwordError.innerText = "";
        return true;
    }
}

function validateConfirmPassword() {
    const password = document.getElementById("password").value;
    const c_password = document.getElementById("c_password").value;
    const cPasswordError = document.getElementById("cPasswordError");
    if (c_password === "") {
        cPasswordError.innerText = "Confirm password is required.";
        return false;
    } else if (password !== c_password) {
        cPasswordError.innerText = "Passwords do not match.";
        return false;
    } else {
        cPasswordError.innerText = "";
        return true;
    }
}

document
    .getElementById("register-form")
    .addEventListener("submit", function (event) {
        event.preventDefault();

        const isFullNameValid = validateFullName();
        const isMobileNoValid = validateMobileNo();
        const isUsernameValid = validateUsername();
        const isPasswordValid = validatePassword();
        const isConfirmPasswordValid = validateConfirmPassword();

        if (
            isFullNameValid &&
            isMobileNoValid &&
            isUsernameValid &&
            isPasswordValid &&
            isConfirmPasswordValid
        ) {
            document.getElementById("register-form").submit();
        }
    });

document.getElementById("fullname").addEventListener("input", validateFullName);
document
    .getElementById("mobile_no")
    .addEventListener("input", validateMobileNo);
document.getElementById("username").addEventListener("input", validateUsername);
document.getElementById("password").addEventListener("input", validatePassword);
document
    .getElementById("c_password")
    .addEventListener("input", validateConfirmPassword);
