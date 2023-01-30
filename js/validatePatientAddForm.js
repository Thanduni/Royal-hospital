let nameDiv = document.getElementById("name");
let nicDiv = document.getElementById("nic");
let addressDiv = document.getElementById("address");
let emailDiv = document.getElementById("email");
let contactNumDiv = document.getElementById("contactNum");
let passwordDiv = document.getElementById("password");
let emerConDiv = document.getElementById("emerCon");
let curUsingMedDiv = document.getElementById("curUsingMed");
let medHisComDiv = document.getElementById("medHisCom");
let drugAllergiesDiv = document.getElementById("drugAllergies");

let regName = /^[a-zA-Z]{3,}/;
let regNic = /^\d{12}[A-Z]?$/;
let regAddress = /^[\W\s\w]{3,},[\s\w]{3,},[\s\w]{3,}\.$/;
let regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
let regContactNum = /^[0-9]{10}$/;
let regPassword = /(?=.*\d.*)(?=.*[A-Z].*)(?=.*[a-z].*)(?=.*[!#\$%_&\?].*).{8,}/;

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
    let name = nameDiv.previousSibling.value;
    if (name == "" || !regName.test(name)) {
        nameDiv.classList.remove("hint");
        nameDiv.classList.add("alert");
        nameDiv.innerHTML = "<ul class='inputMsg'>\n" +
            "    <li>Please enter a valid name.</li>\n" +
            "</ul>"
    }
}

nameDiv.previousSibling.addEventListener("blur", validateName, false)

nameDiv.previousSibling.addEventListener("focus", function () {
    nameDiv.classList.remove("alert");
    nameDiv.classList.add("hint");
    nameDiv.innerHTML = "<ul class='inputMsg'>\n" +
        "    <li>Name should contain more than 2 characters and no numbers.</li>\n" +
        "</ul>";
    ;

    // alert("Hai");
}, false)

function validateEmail() {
    emailDiv.innerHTML = "";
    let email = emailDiv.previousSibling.value;
    if (email == "" || !regEmail.test(email)) {
        emailDiv.classList.remove("hint");
        emailDiv.classList.add("alert");
        emailDiv.innerHTML = "<ul class='inputMsg'>\n" +
            "    <li>Please enter a valid email.</li>\n" +
            "</ul>"
    }
}

emailDiv.previousSibling.addEventListener("blur", validateEmail, false)

emailDiv.previousSibling.addEventListener("focus", function () {
    emailDiv.classList.remove("alert");
    emailDiv.classList.add("hint");
    emailDiv.innerHTML = "<ul class='inputMsg'>\n" +
        "    <li>Enter a valid email address.</li>\n" +
        "</ul>";
}, false)

function validateContactNum() {
    contactNumDiv.innerHTML = "";
    let contactNum = contactNumDiv.previousSibling.value;
    if (contactNum == "" || !regContactNum.test(contactNum)) {
        contactNumDiv.classList.remove("hint");
        contactNumDiv.classList.add("alert");
        contactNumDiv.innerHTML = "<ul class='inputMsg'>\n" +
            "    <li>Please enter a valid contact number.</li>\n" +
            "</ul>"
    }
}

contactNumDiv.previousSibling.addEventListener("blur", validateContactNum, false)

contactNumDiv.previousSibling.addEventListener("focus", function () {
    contactNumDiv.classList.remove("alert");
    contactNumDiv.classList.add("hint");
    contactNumDiv.innerHTML = "<ul class='inputMsg'>\n" +
        "    <li>Contact number should contain 10 integers.</li>\n" +
        "</ul>"
    // alert("Hai");
}, false)

function validateEmerCon() {
    emerConDiv.innerHTML = "";
    let emerCon = emerConDiv.previousSibling.value;
    if (emerCon == "" || !regContactNum.test(emerCon)) {
        emerConDiv.classList.remove("hint");
        emerConDiv.classList.add("alert");
        emerConDiv.innerHTML = "<ul class='inputMsg'>\n" +
            "    <li>Please enter a valid contact number.</li>\n" +
            "</ul>"
    }
}

emerConDiv.previousSibling.addEventListener("blur", validateEmerCon, false)

emerConDiv.previousSibling.addEventListener("focus", function () {
    emerConDiv.classList.remove("alert");
    emerConDiv.classList.add("hint");
    emerConDiv.innerHTML = "<ul class='inputMsg'>\n" +
        "    <li>Contact number should contain 10 integers.</li>\n" +
        "</ul>"
    // alert("Hai");
}, false)

function validatePassword() {
    passwordDiv.innerHTML = "";
    let password = passwordDiv.previousSibling.value;
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

function validateCurrentlyUsingMedicine() {
    curUsingMedDiv.innerHTML = "";
    let medicine = curUsingMedDiv.previousSibling.value;
    if (medicine == "" || !regName.test(medicine)) {
        curUsingMedDiv.classList.remove("hint");
        curUsingMedDiv.classList.add("alert");
        curUsingMedDiv.innerHTML = "<ul class='inputMsg'>\n" +
            "    <li>Please enter a valid name.</li>\n" +
            "</ul>"
    }
}

curUsingMedDiv.previousSibling.addEventListener("blur", validateCurrentlyUsingMedicine, false)

curUsingMedDiv.previousSibling.addEventListener("focus", function () {
    curUsingMedDiv.classList.remove("alert");
    curUsingMedDiv.classList.add("hint");
    curUsingMedDiv.innerHTML = "<ul class='inputMsg'>\n" +
        "    <li>Currently using medicine should contain more than 2 characters and no numbers.</li>\n" +
        "</ul>";
    ;

    // alert("Hai");
}, false)

function validateMedicineHistoryComment() {
    medHisComDiv.innerHTML = "";
    let medHis = medHisComDiv.previousSibling.value;
    if (medHis == "" || !regName.test(medHis)) {
        medHisComDiv.classList.remove("hint");
        medHisComDiv.classList.add("alert");
        medHisComDiv.innerHTML = "<ul class='inputMsg'>\n" +
            "    <li>Please enter a valid comment.</li>\n" +
            "</ul>"
    }
}

medHisComDiv.previousSibling.addEventListener("blur", validateMedicineHistoryComment, false)

medHisComDiv.previousSibling.addEventListener("focus", function () {
    medHisComDiv.classList.remove("alert");
    medHisComDiv.classList.add("hint");
    medHisComDiv.innerHTML = "<ul class='inputMsg'>\n" +
        "    <li>Medicine history comments should contain more than 2 characters and no numbers.</li>\n" +
        "</ul>";
    ;

    // alert("Hai");
}, false)

function validateDrugAllergies() {
    drugAllergiesDiv.innerHTML = "";
    let drAll = drugAllergiesDiv.previousSibling.value;
    if (drAll == "" || !regName.test(drAll)) {
        drugAllergiesDiv.classList.remove("hint");
        drugAllergiesDiv.classList.add("alert");
        drugAllergiesDiv.innerHTML = "<ul class='inputMsg'>\n" +
            "    <li>Please enter a valid list.</li>\n" +
            "</ul>"
    }
}

drugAllergiesDiv.previousSibling.addEventListener("blur", validateDrugAllergies, false)

drugAllergiesDiv.previousSibling.addEventListener("focus", function () {
    drugAllergiesDiv.classList.remove("alert");
    drugAllergiesDiv.classList.add("hint");
    drugAllergiesDiv.innerHTML = "<ul class='inputMsg'>\n" +
        "    <li>Drug allergies list should contain more than 2 characters and no numbers.</li>\n" +
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
}, false)

function validatePatientForm() {
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
                    "    <li>Please enter your email properly.</li>\n" +
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
