let form = document.getElementById("validateForm");
let nameDiv = document.getElementById("nameDiv");
let nicDiv = document.getElementById("nicDiv");
let addressDiv = document.getElementById("addressDiv");
let emailDiv = document.getElementById("emailDiv");
let passwordDiv = document.getElementById("passwordDiv");
let cpasswordDiv = document.getElementById("cpasswordDiv");
let phoneDiv = document.getElementById("phoneDiv");
let EphoneDiv = document.getElementById("EphoneDiv");


let regName = /^[a-zA-Z]{3,}/;
let regNic = /^\d{12}[A-Z]?$/;
let regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
let regPassword = /(?=.*\d.*)(?=.*[A-Z].*)(?=.*[a-z].*)(?=.*[!#\$%_&\?].*).{8,}/;
let regContactNum = /^[0-9]{10}$/;


function validateAddress() {
    addressDiv.innerHTML = "";
    let address = addressDiv.previousSibling.value;
    if (address == "" || !regAddress.test(address)) {
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
    addressDiv.innerHTML = "<ul class='inputMsg'>\n" +
        "    <li>Address should contain 3 parts ending with a fullstop(.).</li>\n" +
        "</ul>";
    ;

    // alert("Hai");
}, false)

function validateName() {
    nameDiv.innerHTML = "";
    var name = nameDiv.previousSibling.value;
    if (name == "" || !regName.test(name)) {
        nameDiv.classList.remove("hint");
        nameDiv.classList.add("alert");
        nameDiv.innerHTML = "<ul>\n" +
            "    <li>Please enter a valid name.</li>\n" +
            "</ul>";
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

function validateNIC() {
    nicDiv.innerHTML = "";
    let nic = nicDiv.previousSibling.value;
    if (nic == "" || !regNic.test(nic)) {
        nicDiv.classList.remove("hint");
        nicDiv.classList.add("alert");
        nicDiv.innerHTML = "<ul>\n" +
            "    <li>Please enter your NIC properly.</li>\n" +
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
}, false);

function validateEmail(){
    emailDiv.innerHTML = " ";
    let email = emailDiv.previousSibling.value;
    if(email == "" || !regEmail.test(email)){
        emailDiv.classList.remove("hint");
        emailDiv.classList.add("alert");
        emailDiv.innerHTML = "<ul>\n" + 
        "    <li>Please enter your email properly.</li>\n" +
        "</ul>"
    }
}

emailDiv.previousSibling.addEventListener("blur", validateEmail, false)

emailDiv.previousSibling.addEventListener("focus",function(){
    emailDiv.classList.remove("alert");
    emailDiv.classList.add("hint");
    emailDiv.innerHTML = "<ul>\n" +
    "    <li>Please enter valid email.</li>\n" +
    "</ul>"
},false)

function validatePassword() {
    passwordDiv.innerHTML = "";
    var password = passwordDiv.previousSibling.value;
    if (password == "" || !regPassword.test(password)) {
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

function validatecPassword() {
    cpasswordDiv.innerHTML = "";
    var password = passwordDiv.previousSibling.value;
    if (password == "" || !regPassword.test(password)) {
        cpasswordDiv.classList.remove("hint");
        cpasswordDiv.classList.add("alert");
        cpasswordDiv.innerHTML = "<ul>\n" +
            "    <li>Please enter a valid password.</li>\n" +
            "</ul>"
    }
}

cpasswordDiv.previousSibling.addEventListener("blur", validatecPassword, false)

cpasswordDiv.previousSibling.addEventListener("focus", function () {
    cpasswordDiv.classList.remove("alert");
    cpasswordDiv.classList.add("hint");
    cpasswordDiv.innerHTML = "<ul>\n" +
        "<li>It contains at least 8 characters and at most 20 characters.</li>\n" +
        "<li>It contains at least one digit.</li>\n" +
        "<li>It contains at least one upper case alphabet.</li>\n" +
        "<li>It contains at least one lower case alphabet.</li>\n" +
        "<li>It contains at least one special character which includes !@#$%&*()-+=^.</li>\n" +
        "<li>It doesn’t contain any white space.</li>\n" +
        "</ul>"
}, false)

function validateContactNum() {
    phoneDiv.innerHTML = "";
    var contactNum = phoneDiv.previousSibling.value;
    if (contactNum == "" || !regContactNum.test(contactNum)) {
        phoneDiv.classList.remove("hint");
        phoneDiv.classList.add("alert");
        phoneDiv.innerHTML = "<ul>\n" +
            "    <li>Please enter a valid contact number.</li>\n" +
            "</ul>"
    }
}

phoneDiv.previousSibling.addEventListener("blur", validateContactNum, false)

phoneDiv.previousSibling.addEventListener("focus", function () {
    phoneDiv.classList.remove("alert");
    phoneDiv.classList.add("hint");
    phoneDiv.innerHTML = "<ul>\n" +
        "    <li>Contact number should contain 10 integers.</li>\n" +
        "</ul>"
    // alert("Hai");
}, false)


function validateEContactNum() {
    EphoneDiv.innerHTML = "";
    var contactNum1 = EphoneDiv.previousSibling.value;
    if (contactNum1 == "" || !regContactNum.test(contactNum1)) {
        EphoneDiv.classList.remove("hint");
        EphoneDiv.classList.add("alert");
        EphoneDiv.innerHTML = "<ul>\n" +
            "    <li>Please enter a valid contact number.</li>\n" +
            "</ul>"
    }
}

EphoneDiv.previousSibling.addEventListener("blur", validateEContactNum, false)

EphoneDiv.previousSibling.addEventListener("focus", function () {
    EphoneDiv.classList.remove("alert");
    EphoneDiv.classList.add("hint");
    EphoneDiv.innerHTML = "<ul>\n" +
        "    <li>Contact number should contain 10 integers.</li>\n" +
        "</ul>"
    // alert("Hai");
}, false)



function validateForm() {
    address = addressDiv.previousSibling.value;
    email = emailDiv.previousSibling.value;
    contactNum = contactNumDiv.previousSibling.value;
    name = nameDiv.previousSibling.value;


    if (document.getElementById("nicRow").classList[0] === "hide" &&
        document.getElementById("passRow").classList[0] === "hide") {
        if (regAddress.test(address) &&
            regEmail.test(email) &&
            regName.test(name) &&
            regContactNum.test(contactNum)) {
            return true;
        } else {

            if (!regAddress.test(address)) {
                addressDiv.classList.remove("alert");
                addressDiv.classList.add("hint");
                addressDiv.innerHTML = "<ul>\n" +
                    "    <li>Address should contain 3 parts ending with a fullstop(.).</li>\n" +
                    "</ul>";
            }
            if (!regEmail.test(email)) {
                emailDiv.classList.remove("hint");
                emailDiv.classList.add("alert");
                emailDiv.innerHTML = "<ul>\n" +
                    "    <li>Please enter a valid email.</li>\n" +
                    "</ul>"
            }
            if (!regName.test(name)) {
                nameDiv.classList.remove("hint");
                nameDiv.classList.add("alert");
                nameDiv.innerHTML = "<ul>\n" +
                    "    <li>Please enter a valid name.</li>\n" +
                    "</ul>"
            }
            if (!regContactNum.test(contactNum)) {
                contactNumDiv.classList.remove("hint");
                contactNumDiv.classList.add("alert");
                contactNumDiv.innerHTML = "<ul>\n" +
                    "    <li>Please enter a valid contact number.</li>\n" +
                    "</ul>"
            }

            form.scrollIntoView();
            return false;
        }
    } else {
        nic = nicDiv.previousSibling.value;
        password = passwordDiv.previousSibling.value;
        if (regAddress.test(address) &&
            regEmail.test(email) &&
            regName.test(name) &&
            regContactNum.test(contactNum) &&
            regNic.test(nic) &&
            regPassword.test(password)) {
            return true;
        } else {

            if (!regAddress.test(address)) {
                addressDiv.classList.remove("alert");
                addressDiv.classList.add("hint");
                addressDiv.innerHTML = "<ul>\n" +
                    "    <li>Address should contain 3 parts ending with a fullstop(.).</li>\n" +
                    "</ul>";
            }
            if (!regEmail.test(email)) {
                emailDiv.classList.remove("hint");
                emailDiv.classList.add("alert");
                emailDiv.innerHTML = "<ul>\n" +
                    "    <li>Please enter a valid email.</li>\n" +
                    "</ul>"
            }
            if (!regName.test(name)) {
                nameDiv.classList.remove("hint");
                nameDiv.classList.add("alert");
                nameDiv.innerHTML = "<ul>\n" +
                    "    <li>Please enter a valid name.</li>\n" +
                    "</ul>"
            }
            if (!regContactNum.test(contactNum)) {
                contactNumDiv.classList.remove("hint");
                contactNumDiv.classList.add("alert");
                contactNumDiv.innerHTML = "<ul>\n" +
                    "    <li>Please enter a valid contact number.</li>\n" +
                    "</ul>"
            }
            if (!regNic.test(nic)) {
                nicDiv.classList.remove("hint");
                nicDiv.classList.add("alert");
                nicDiv.innerHTML = "<ul>\n" +
                    "    <li>Please enter your NIC properly.</li>\n" +
                    "</ul>"
            }
            if (!regPassword.test(password)) {
                passwordDiv.classList.remove("hint");
                passwordDiv.classList.add("alert");
                passwordDiv.innerHTML = "<ul>\n" +
                    "    <li>Please enter a valid password.</li>\n" +
                    "</ul>"
            }

            form.scrollIntoView();
            return false;
        }
    }

}
