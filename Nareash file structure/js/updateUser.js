// let update = document.getElementById("")

function displayUserUpdateForm(nic) {
    let form = document.getElementById("addForm");
    form.action = '/royalhospital/Admin/updateUser.php?id=' + nic;
    document.getElementById("nicRow").classList.add("hide");
    document.getElementById("passRow").classList.add("hide");


    let tableCon = document.getElementsByClassName(nic + "_tableCon");

    document.getElementById("titleOperation").innerHTML = "Update User | NIC : " + nic;

    let name = tableCon[0].textContent;
    let address = tableCon[1].textContent;
    let email = tableCon[2].textContent;
    let contactNum = tableCon[3].textContent;
    let gender = tableCon[4].textContent;
    let userRole = tableCon[5].textContent;

    // alert(tableCon[0].textContent);


    let userForm = document.getElementById('userForm');
    userForm.classList.add("active");

    let IN_name = document.getElementById("IN_name");
    let IN_address = document.getElementById("IN_address");
    let IN_email = document.getElementById("IN_email");
    let IN_contnum = document.getElementById("IN_contnum");
    let M_gender = document.getElementById("M_gender");
    let F_gender = document.getElementById("F_gender");
    if(gender === "m")
        M_gender.setAttribute("checked", "checked");
    else
        F_gender.setAttribute("checked", "checked");

    let IN_userRole = document.getElementById("IN_userRole");

    IN_name.value = name;
    IN_address.value = address;
    IN_email.value = email;
    IN_contnum.value = contactNum;
    if(userRole === "Patient")
        IN_userRole.selectedIndex = 0;
    else if(userRole === "Doctor")
        IN_userRole.selectedIndex = 1;
    else if(userRole === "Receptionist")
        IN_userRole.selectedIndex = 2;
    else if(userRole === "Storekeeper")
        IN_userRole.selectedIndex = 3;
    else if(userRole === "Nurse")
        IN_userRole.selectedIndex = 4;
    form.scrollIntoView();


    let close = document.getElementById('cancel');
    close.addEventListener('click', function() {
        userForm.classList.remove("active");
        // document.getElementById("passToJS").innerHTML = "";
    }, false);
}

// update.addEventListener("click", displayUserForm, false);