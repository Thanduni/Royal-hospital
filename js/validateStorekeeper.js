let regName = /^[a-zA-Z]{3,}/;
let medicineDiv = document.getElementById("medicineName");
let companyDiv = document.getElementById("company");


function validateMedicine() {
    medicineDiv.innerHTML = "";
    var name = medicineDiv.previousSibling.value;
    if (name == "" || !regName.test(name)) {
        medicineDiv.classList.remove("hint");
        medicineDiv.classList.add("alert");
        medicineDiv.innerHTML = "<ul>\n" +
            "    <li>Please enter a valid name.</li>\n" +
            "</ul>"
    }
}

medicineDiv.previousSibling.addEventListener("blur", validateMedicine, false);

medicineDiv.previousSibling.addEventListener("focus", function () {
    medicineDiv.classList.remove("alert");
    medicineDiv.classList.add("hint");
    medicineDiv.innerHTML = "<ul>\n" +
        "    <li>Medicine name should contain more than 2 characters and no numbers.</li>\n" +
        "</ul>";
    ;

    // alert("Hai");
}, false)


function validateCompany() {
    companyDiv.innerHTML = "";
    var name = companyDiv.previousSibling.value;
    if (name == "" || !regName.test(name)) {
        companyDiv.classList.remove("hint");
        companyDiv.classList.add("alert");
        companyDiv.innerHTML = "<ul>\n" +
            "    <li>Please enter a valid name.</li>\n" +
            "</ul>"
    }
}

companyDiv.previousSibling.addEventListener("blur", validateCompany, false);

companyDiv.previousSibling.addEventListener("focus", function () {
    companyDiv.classList.remove("alert");
    companyDiv.classList.add("hint");
    companyDiv.innerHTML = "<ul>\n" +
        "    <li>Company name should contain more than 2 characters and no numbers.</li>\n" +
        "</ul>";
    ;

    // alert("Hai");
}, false)

function validateForm() {
    let medicine = medicineDiv.previousSibling.value;
    let company = companyDiv.previousSibling.value;

    if(regName.test(medicine) &&
        regName.test(company)){
        return true;
    } else {
        if (!regName.test(medicine)) {
            medicineDiv.classList.remove("alert");
            medicineDiv.classList.add("hint");
            medicineDiv.innerHTML = "<ul>\n" +
                "    <li>Medicine name should contain more than 2 characters and no numbers.</li>\n" +
                "</ul>";
        }
        if (!regName.test(company)) {
            companyDiv.classList.remove("hint");
            companyDiv.classList.add("alert");
            companyDiv.innerHTML = "<ul>\n" +
                "    <li>Company name should contain more than 2 characters and no numbers.</li>\n" +
                "</ul>"
        }

        return false;
    }
}

