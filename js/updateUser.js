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

    form.scrollIntoView();

    let close = document.getElementById('cancel');
    close.addEventListener('click', function() {
        userForm.classList.remove("active");
    }, false);
}

function displayDoctorUpdateForm(nic) {
    let form = document.getElementById("addForm");
    form.action = '/royalhospital/Admin/updateDoctor.php?id=' + nic;
    document.getElementById("nicRow").classList.add("hide");

    let tableCon = document.getElementsByClassName(nic + "_tableCon");

    document.getElementById("titleOperation").innerHTML = "Update User | NIC : " + nic;

    let department = tableCon[0].textContent;

    let userForm = document.getElementById('userForm');
    userForm.classList.add("active");

    let IN_department = document.getElementById("IN_department");

    IN_department.value = department;
    form.scrollIntoView();


    let close = document.getElementById('cancel');
    close.addEventListener('click', function() {
        userForm.classList.remove("active");
    }, false);
}