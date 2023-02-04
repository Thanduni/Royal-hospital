let nicDiv = document.getElementById("nic");

let regNic = /^\d{12}[A-Z]?$/;

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

function validateNurseReceptionistStorekeeperForm(){
    let nic = nicDiv.previousSibling.value;

    if(regNic.test(nic))
        return true;
    else{
        nicDiv.classList.remove("hint");
        nicDiv.classList.add("alert");
        nicDiv.innerHTML = "<ul>\n" +
            "    <li>Please enter your email properly.</li>\n" +
            "</ul>";

        form.scrollIntoView();
        return false;
    }
}


