// alert("hai");
// let add = document.getElementById("addButton");

function displayPatientAddForm(userRole = []) {
    let form = document.getElementById("addForm");
    form.action = '/royalhospital/Receptionist/addPatient.php';

    document.getElementById("nicRow").classList.remove("hide");
    document.getElementById("passRow").classList.remove("hide");

    document.getElementById("IN_name").value = "";
    document.getElementById("IN_address").value = "";
    document.getElementById("IN_email").value = "";
    document.getElementById("IN_contnum").value = "";
    document.getElementById("M_gender").checked = false;
    document.getElementById("F_gender").checked = false;
    document.getElementById("IN_dob").value = "";
    document.getElementById("IN_weight").value = "";
    document.getElementById("IN_height").value = "";
    document.getElementById("IN_drAllergies").value = "";
    document.getElementById("IN_medHisCom").value = "";
    document.getElementById("IN_curUsingMed").value = "";
    document.getElementById("IN_emerCon").value = "";

    document.getElementById("titleOperation").innerHTML = "Add Patient";


    let userForm = document.getElementById('userForm');
    // userForm.classList.add("active");
    form.scrollIntoView();

    // let close = document.getElementById('cancel');
    // close.addEventListener('click', function () {
    //     userForm.classList.remove("active");
    // }, false);
}

function displayUserAddForm(userRole = []) {
    let form = document.getElementById("addForm");
    form.action = '/royalhospital/Admin/addUser.php';
    document.getElementById("nicRow").classList.remove("hide");
    document.getElementById("passRow").classList.remove("hide");
    document.getElementById("userRoleRow").classList.remove("hide");
    document.getElementById("IN_name").value = "";
    document.getElementById("IN_address").value = "";
    document.getElementById("IN_email").value = "";
    document.getElementById("IN_contnum").value = "";
    document.getElementById("M_gender").checked = false;
    document.getElementById("F_gender").checked = false;


    document.getElementById("titleOperation").innerHTML = "Add User";


    $('#userForm').fadeIn().css("display","flex");
    // let userForm = document.getElementById('userForm');
    // userForm.classList.add("active");
    // form.scrollIntoView();
    //
    // let close = document.getElementById('cancel');
    // close.addEventListener('click', function () {
    //     userForm.classList.remove("active");
    // }, false);
}

function displayDoctorAddForm() {
    let form = document.getElementById("addForm");
    form.action = '/royalhospital/Admin/addDoctor.php';
    document.getElementById("nicRow").classList.remove("hide");

    document.getElementById("titleOperation").innerHTML = "Add Doctor";


    $('#userForm').fadeIn().css("display","flex");
    // let userForm = document.getElementById('userForm');
    // userForm.classList.add("active");
    // form.scrollIntoView();
    //
    // let close = document.getElementById('cancel');
    // close.addEventListener('click', function () {
    //     userForm.classList.remove("active");
    // }, false);
}

function displayNurseAddForm() {
    let form = document.getElementById("addForm");
    form.action = '/royalhospital/Admin/addNurse.php';
    document.getElementById("nicRow").classList.remove("hide");

    document.getElementById("titleOperation").innerHTML = "Add Nurse";


    $('#userForm').fadeIn().css("display","flex");
    // let userForm = document.getElementById('userForm');
    // userForm.classList.add("active");
    // form.scrollIntoView();
    //
    // let close = document.getElementById('cancel');
    // close.addEventListener('click', function () {
    //     userForm.classList.remove("active");
    // }, false);
}

function displayReceptionistAddForm() {
    let form = document.getElementById("addForm");
    form.action = '/royalhospital/Admin/addReceptionist.php';
    document.getElementById("nicRow").classList.remove("hide");

    document.getElementById("titleOperation").innerHTML = "Add Receptionist";


    $('#userForm').fadeIn().css("display","flex");
    // let userForm = document.getElementById('userForm');
    // userForm.classList.add("active");
    // form.scrollIntoView();
    //
    // let close = document.getElementById('cancel');
    // close.addEventListener('click', function () {
    //     userForm.classList.remove("active");
    // }, false);
}

function displayStorekeeperAddForm() {
    let form = document.getElementById("addForm");
    form.action = '/royalhospital/Admin/addStorekeeper.php';
    document.getElementById("nicRow").classList.remove("hide");

    document.getElementById("titleOperation").innerHTML = "Add Storekeeper";


    $('#userForm').fadeIn().css("display","flex");
    // let userForm = document.getElementById('userForm');
    // userForm.classList.add("active");
    // form.scrollIntoView();
    //
    // let close = document.getElementById('cancel');
    // close.addEventListener('click', function () {
    //     userForm.classList.remove("active");
    // }, false);
}
// add.addEventListener("click", displayUserAddForm, false);