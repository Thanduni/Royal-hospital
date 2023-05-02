// let update = document.getElementById("")

function displayUserUpdateForm(nic) {
    let form = document.getElementById("addForm");

    form.action = '/royalhospital/Admin/updateUser.php?id=' + nic;
    document.getElementById("nicRow").classList.add("hide");
    document.getElementById("passRow").classList.add("hide");
    document.getElementById("userRoleRow").classList.add("hide");


    let tableCon = document.getElementsByClassName(nic + "_tableCon");
    document.getElementById("titleOperation").innerHTML = "Update User | NIC : " + nic;

    let name = tableCon[0].textContent;
    let address = tableCon[1].textContent;
    let email = tableCon[2].textContent;
    let contactNum = tableCon[3].textContent;
    let gender = tableCon[4].textContent;
    let dob = tableCon[6].textContent;


    let userForm = document.getElementById('userForm');
    // userForm.classList.add("active");


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
    let IN_dob = document.getElementById("IN_dob");


    IN_name.value = name;
    IN_address.value = address;
    IN_email.value = email;
    IN_contnum.value = contactNum;
    IN_dob.value = dob;
    form.scrollIntoView();



    // let close = document.getElementById('cancel');
    // close.addEventListener('click', function() {
    //     userForm.classList.remove("active");
    //     // document.getElementById("passToJS").innerHTML = "";
    // }, false);
}

// update.addEventListener("click", displayUserForm, false);

function displayDoctorUpdateForm(nic) {
    let form = document.getElementById("addForm");
    form.action = '/royalhospital/Admin/updateDoctor.php?id=' + nic;
    document.getElementById("nicRow").classList.add("hide");

    let tableCon = document.getElementsByClassName(nic + "_tableCon");

    document.getElementById("titleOperation").innerHTML = "Update User | NIC : " + nic;

    let department = tableCon[0].textContent;


    let userForm = document.getElementById('userForm');
    // userForm.classList.add("active");

    let IN_department = document.getElementById("IN_department");

    IN_department.value = department;
    form.scrollIntoView();


    // let close = document.getElementById('cancel');
    // close.addEventListener('click', function() {
    //     userForm.classList.remove("active");
    //     // document.getElementById("passToJS").innerHTML = "";
    // }, false);
}

function displayPatientUpdateForm(nic) {
    let form = document.getElementById("addForm");

    form.action = '/royalhospital/Receptionist/updatePatient.php?id=' + nic;
    document.getElementById("nicRow").classList.add("hide");
    document.getElementById("passRow").classList.add("hide");


    let tableCon = document.getElementsByClassName(nic + "_tableCon");

    document.getElementById("titleOperation").innerHTML = "Update Patient | NIC : " + nic;

    let name = tableCon[0].textContent;
    let address = tableCon[1].textContent;
    let email = tableCon[2].textContent;
    let contactNum = tableCon[3].textContent;
    let gender = tableCon[4].textContent;
    let dob = tableCon[5].textContent;
    let weight = tableCon[6].textContent;
    let height = tableCon[7].textContent;
    let illness = tableCon[8].textContent;
    let drug_allergies = tableCon[9].textContent;
    let medical_history_comments = tableCon[10].textContent;
    let currently_using_medicine = tableCon[11].textContent;
    let emergency_contact = tableCon[12].textContent;

    let userForm = document.getElementById('userForm');
    // userForm.classList.add("active");

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
    let IN_dob = document.getElementById("IN_dob");
    let IN_illness = document.getElementById("IN_illness");
    let IN_weight = document.getElementById("IN_weight");
    let IN_height = document.getElementById("IN_height");
    let IN_drAllergies = document.getElementById("IN_drAllergies");
    let IN_medHisCom = document.getElementById("IN_medHisCom");
    let IN_curUsingMed = document.getElementById("IN_curUsingMed");
    let IN_emerCon = document.getElementById("IN_emerCon");


    IN_name.value = name;
    IN_address.value = address;
    IN_email.value = email;
    IN_contnum.value = contactNum;
    IN_dob.value = dob;
    IN_illness.value = illness;
    IN_weight.value = weight;
    IN_height.value = height;
    IN_drAllergies.value = drug_allergies;
    IN_medHisCom.value = medical_history_comments;
    IN_curUsingMed.value = currently_using_medicine;
    IN_emerCon.value = emergency_contact;
    form.scrollIntoView();



    // let close = document.getElementById('cancel');
    // close.addEventListener('click', function() {
    //     userForm.classList.remove("active");
    //     // document.getElementById("passToJS").innerHTML = "";
    // }, false);
}
