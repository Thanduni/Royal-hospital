let form = document.getElementById("userForm");
let warning = document.getElementById("warning");
let nameDiv = document.getElementById("name");
let addressDiv = document.getElementById("address");
let nicDiv = document.getElementById("nic");
let emailDiv = document.getElementById("email");
let contactNumDiv = document.getElementById("contactNum");
let passwordDiv = document.getElementById("password");

// let nic = nicDiv.previousSibling.value;
// let name = nameDiv.previousSibling.value;
// let address = addressDiv.previousSibling.value;
// let email = emailDiv.previousSibling.value;
// let contactNum = contactNumDiv.previousSibling.value;
// let password = passwordDiv.previousSibling.value;

let regNic = "/^\d{12}[A-Z]?$/g";
let regName = "/^[a-zA-Z]{3,}/";
let regAddress = "/^[\W\s\w]{3,},[\s\w]{3,},[\s\w]{3,}\.$/g";
let regEmail = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/g";
let regContactNum = "/^[0-9]{10}$/g";
let regPassword = "/(?=.*\d.*)(?=.*[A-Z].*)(?=.*[a-z].*)(?=.*[!#\$%_&\?].*).{8,}/g";

function validateAddress() {
    addressDiv.innerHTML = "";
    let address = addressDiv.previousSibling.value;
    if (address == "" || !preg_match(regAddress, address)) {
        addressDiv.classList.remove("hint");
        addressDiv.classList.add("alert");
        addressDiv.innerHTML = "<ul>\n" +
            "    <li>Please enter a valid address.</li>\n" +
            "</ul>"
    }
}

addressDiv.previousSibling.addEventListener("blur", validateAddress, false)

addressDiv.previousSibling.addEventListener("focus", function () {
    addressDiv.classList.remove("alert");
    addressDiv.classList.add("hint");
    addressDiv.innerHTML = "<ul>\n" +
        "    <li>Address should contain 3 parts ending with a fullstop(.).</li>\n" +
        "</ul>";
    ;

    // alert("Hai");
}, false)

function validateName() {
    nameDiv.innerHTML = "";
    var name = nameDiv.previousSibling.value;
    if (name == "" || !preg_match(regName, name)) {
        nameDiv.classList.remove("hint");
        nameDiv.classList.add("alert");
        nameDiv.innerHTML = "<ul>\n" +
            "    <li>Please enter a valid name.</li>\n" +
            "</ul>"
    }
}

nameDiv.previousSibling.addEventListener("blur", validateName, false)

nameDiv.previousSibling.addEventListener("focus", function () {
    nameDiv.classList.remove("alert");
    nameDiv.classList.add("hint");
    nameDiv.innerHTML = "<ul>\n" +
        "    <li>Name should contain more than 2 characters and no numbers.</li>\n" +
        "</ul>";
    ;

    // alert("Hai");
}, false)

function validateEmail() {
    emailDiv.innerHTML = "";
    var email = emailDiv.previousSibling.value;
    if (email == "" || !preg_match(regEmail, email)) {
        emailDiv.classList.remove("hint");
        emailDiv.classList.add("alert");
        emailDiv.innerHTML = "<ul>\n" +
            "    <li>Please enter a valid email.</li>\n" +
            "</ul>"
    }
}

emailDiv.previousSibling.addEventListener("blur", validateEmail, false)

emailDiv.previousSibling.addEventListener("focus", function () {
    emailDiv.classList.remove("alert");
    emailDiv.classList.add("hint");
    emailDiv.innerHTML = "<ul>\n" +
        "    <li>Enter a valid email address.</li>\n" +
        "</ul>";
}, false)

function validatePassword() {
    passwordDiv.innerHTML = "";
    var password = passwordDiv.previousSibling.value;
    if (password == "" || !preg_match(regPassword, password)) {
        passwordDiv.classList.remove("hint");
        passwordDiv.classList.add("alert");
        passwordDiv.innerHTML = "<ul>\n" +
            "    <li>Please enter a valid password.</li>\n" +
            "</ul>"
    }
}

passwordDiv.previousSibling.addEventListener("blur", validatePassword, false)

passwordDiv.previousSibling.addEventListener("focus", function () {
    passwordDiv.classList.remove("alert");
    passwordDiv.classList.add("hint");
    passwordDiv.innerHTML = "<ul>\n" +
        "<li>It contains at least 8 characters and at most 20 characters.</li>\n" +
        "<li>It contains at least one digit.</li>\n" +
        "<li>It contains at least one upper case alphabet.</li>\n" +
        "<li>It contains at least one lower case alphabet.</li>\n" +
        "<li>It contains at least one special character which includes !@#$%&*()-+=^.</li>\n" +
        "<li>It doesn’t contain any white space.</li>\n" +
        "</ul>"
}, false)

function validateContactNum() {
    contactNumDiv.innerHTML = "";
    var contactNum = contactNumDiv.previousSibling.value;
    if (contactNum == "" || !regContactNum.test(contactNum)) {
        contactNumDiv.classList.remove("hint");
        contactNumDiv.classList.add("alert");
        contactNumDiv.innerHTML = "<ul>\n" +
            "    <li>Please enter a valid contact number.</li>\n" +
            "</ul>"
    }
}

contactNumDiv.previousSibling.addEventListener("blur", validateContactNum, false)

contactNumDiv.previousSibling.addEventListener("focus", function () {
    contactNumDiv.classList.remove("alert");
    contactNumDiv.classList.add("hint");
    contactNumDiv.innerHTML = "<ul>\n" +
        "    <li>Contact number should contain 10 integers.</li>\n" +
        "</ul>"
    // alert("Hai");
}, false)

function validateNIC() {
    nicDiv.innerHTML = "";
    let nic = nicDiv.previousSibling.value;
    if (nic == "" || !preg_match(regNic, nic)) {
        nicDiv.classList.remove("hint");
        nicDiv.classList.add("alert");
        nicDiv.innerHTML = "<ul>\n" +
            "    <li>Please enter your email properly.</li>\n" +
            "</ul>"
    }
}

nicDiv.previousSibling.addEventListener("blur", validateNIC, false)

nicDiv.previousSibling.addEventListener("focus", function () {
    nicDiv.classList.remove("alert");
    nicDiv.classList.add("hint");
    nicDiv.innerHTML = "<ul>\n" +
        "    <li>NIC should contain only 12 digits or with character at last after the digits.</li>\n" +
        "</ul>"
}, false)

function validateForm() {
    nic = nicDiv.previousSibling.value;
    name = nameDiv.previousSibling.value;
    address = addressDiv.previousSibling.value;
    email = emailDiv.previousSibling.value;
    contactNum = contactNumDiv.previousSibling.value;
    password = passwordDiv.previousSibling.value;

    // console.log(regAddress.test(address));
    // console.log(regPassword.test(password));
    // console.log(regEmail.test(email));
    // console.log(regName.test(name));
    // console.log(regNic.test(nic));
    // console.log(regContactNum.test(contactNum));

    if (preg_match(regAddress, address) &&
        preg_match(regPassword, password) &&
        preg_match(regEmail, email) &&
        preg_match(regName, name) &&
        preg_match(regNic, nic) &&
        preg_match(regContactNum, contactNum)) {
        alert(address + " " + preg_match(regAddress, address) + "<br>");
        alert(password + " " + preg_match(regPassword, password) + "<br>");
        alert(email + " " + preg_match(regEmail, email) + "<br>");
        alert(name + " " + preg_match(regName, name) + "<br>");
        alert(nic + " " + preg_match(regNic, nic) + "<br>");
        alert(contactNum + " " + preg_match(regContactNum, contactNum));
        return true;
    } else {
        document.write(address + " " + preg_match(regAddress, address) + "<br>");
        document.write(password + " " + preg_match(regPassword, password) + "<br>");
        document.write(email + " " + preg_match(regEmail, email) + "<br>");
        document.write(name + " " + preg_match(regName, name) + "<br>");
        document.write(nic + " " + preg_match(regNic, nic) + "<br>");
        document.write(contactNum + " " + preg_match(regContactNum, contactNum));
        form.scrollIntoView();
        return false;
    }
}
