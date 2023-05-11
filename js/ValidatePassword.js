let form = document.getElementsByTagName("form")[0];
let pass1 = document.getElementById("password1");
let pass2 = document.getElementById("password2");
let pass1Div = document.getElementById("password1Div");
let pass2Div = document.getElementById("password2Div");

let regPassword = /(?=.*\d.*)(?=.*[A-Z].*)(?=.*[a-z].*)(?=.*[!#\$%_&\?].*).{8,}/;

function validatePassword1() {
    pass1Div.innerHTML = "";
    var password = pass1.value;
    if (password == "" || !regPassword.test(password)) {
        pass1Div.classList.remove("hint");
        pass1Div.classList.add("alert");
        pass1Div.innerHTML = "<ul>\n" +
            "    <li>Please enter a valid password.</li>\n" +
            "</ul>"
    }
}

pass1.addEventListener("blur", validatePassword1, false);

pass1.addEventListener("focus", function () {
    pass1Div.classList.remove("alert");
    pass1Div.classList.add("hint");
    pass1Div.innerHTML = "<ul>\n" +
        "<li>It contains at least 8 characters and at most 20 characters.</li>\n" +
        "<li>It contains at least one digit.</li>\n" +
        "<li>It contains at least one upper case alphabet.</li>\n" +
        "<li>It contains at least one lower case alphabet.</li>\n" +
        "<li>It contains at least one special character which includes !@#$%&*()-+=^.</li>\n" +
        "<li>It doesn’t contain any white space.</li>\n" +
        "</ul>"
}, false)

function validatePassword2() {
    pass2Div.innerHTML = "";
    var password = pass2.value;
    if (password == "" || !regPassword.test(password)) {
        pass2Div.classList.remove("hint");
        pass2Div.classList.add("alert");
        pass2Div.innerHTML = "<ul>\n" +
            "    <li>Please enter a valid password.</li>\n" +
            "</ul>"
    }
}

pass2.addEventListener("blur", validatePassword2, false);

pass2.addEventListener("focus", function () {
    pass2Div.classList.remove("alert");
    pass2Div.classList.add("hint");
    pass2Div.innerHTML = "<ul>\n" +
        "<li>It contains at least 8 characters and at most 20 characters.</li>\n" +
        "<li>It contains at least one digit.</li>\n" +
        "<li>It contains at least one upper case alphabet.</li>\n" +
        "<li>It contains at least one lower case alphabet.</li>\n" +
        "<li>It contains at least one special character which includes !@#$%&*()-+=^.</li>\n" +
        "<li>It doesn’t contain any white space.</li>\n" +
        "</ul>"
}, false)

function validatePasswordForm() {
    if (regPassword.test(pass1) &&
        regPassword.test(pass2)) {
        return true;
    } else {
        if (!regPassword.test(pass1)) {
            pass1Div.classList.remove("hint");
            pass1Div.classList.add("alert");
            pass1Div.innerHTML = "<ul class='inputMsg'>\n" +
                "    <li>Please enter a valid password.</li>\n" +
                "</ul>"
        }
        if (!regPassword.test(pass2)) {
            pass2Div.classList.remove("hint");
            pass2Div.classList.add("alert");
            pass2Div.innerHTML = "<ul class='inputMsg'>\n" +
                "    <li>Please enter a valid password.</li>\n" +
                "</ul>"
        }
        form.scrollIntoView();
        return false;
    }
}