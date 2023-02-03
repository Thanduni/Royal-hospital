let nicDiv = document.getElementById("nic");
let depDiv = document.getElementById("depName");

let regNic = /^\d{12}[A-Z]?$/;
let regName = /^[a-zA-Z]{3,}/;

function validateName() {
    depDiv.innerHTML = "";
    var name = depDiv.previousSibling.value;
    if (name == "" || !regName.test(name)) {
        depDiv.classList.remove("hint");
        depDiv.classList.add("alert");
        depDiv.innerHTML = "<ul>\n" +
            "    <li>Please enter a valid department name.</li>\n" +
            "</ul>"
    }
}

depDiv.previousSibling.addEventListener("blur", validateName, false)

depDiv.previousSibling.addEventListener("focus", function () {
    depDiv.classList.remove("alert");
    depDiv.classList.add("hint");
    depDiv.innerHTML = "<ul>\n" +
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
}, false)

function validateNurseReceptionistStorekeeperForm(){
    let nic = nicDiv.previousSibling.value;
    let depName = depDiv.previousSibling.value;

    if(regNic.test(nic) && regName.test(depName))
        return true;
    else{
        if (!regName.test(depName)) {
            depDiv.classList.remove("hint");
            depDiv.classList.add("alert");
            depDiv.innerHTML = "<ul>\n" +
                "    <li>Please enter a valid department name.</li>\n" +
                "</ul>"
        }

        if (!regNic.test(nic)) {
            nicDiv.classList.remove("hint");
            nicDiv.classList.add("alert");
            nicDiv.innerHTML = "<ul>\n" +
                "    <li>Please enter your NIC properly.</li>\n" +
                "</ul>"
        }

    }
}


