// alert("hai");
// let add = document.getElementById("addButton");

function displayUserAddForm(userRole = []) {
    let form = document.getElementById("addForm");
    form.action = '/royalhospital/Admin/addUser.php';
    document.getElementById("nicRow").classList.remove("hide");
    document.getElementById("passRow").classList.remove("hide");
    document.getElementById("IN_name").value = "";
    document.getElementById("IN_address").value = "";
    document.getElementById("IN_email").value = "";
    document.getElementById("IN_contnum").value = "";
    document.getElementById("M_gender").checked = false;
    document.getElementById("F_gender").checked = false;


    document.getElementById("titleOperation").innerHTML = "Add User";

    let userForm = document.getElementById('userForm');
    userForm.classList.add("active");
    form.scrollIntoView();

    let close = document.getElementById('cancel');
    close.addEventListener('click', function () {
        userForm.classList.remove("active");
    }, false);
}

function displayDoctorAddForm() {
    let form = document.getElementById("addForm");
    form.action = '/royalhospital/Admin/addDoctor.php';
    document.getElementById("nicRow").classList.remove("hide");

    document.getElementById("titleOperation").innerHTML = "Add Doctor";

    let userForm = document.getElementById('userForm');
    userForm.classList.add("active");
    form.scrollIntoView();

    let close = document.getElementById('cancel');
    close.addEventListener('click', function () {
        userForm.classList.remove("active");
    }, false);
}

function displayNurseAddForm() {
    let form = document.getElementById("addForm");
    form.action = '/royalhospital/Admin/addNurse.php';
    document.getElementById("nicRow").classList.remove("hide");

    document.getElementById("titleOperation").innerHTML = "Add Nurse";

    let userForm = document.getElementById('userForm');
    userForm.classList.add("active");
    form.scrollIntoView();

    let close = document.getElementById('cancel');
    close.addEventListener('click', function () {
        userForm.classList.remove("active");
    }, false);
}

function displayReceptionistAddForm() {
    let form = document.getElementById("addForm");
    form.action = '/royalhospital/Admin/addStorekeeper.php';
    document.getElementById("nicRow").classList.remove("hide");

    document.getElementById("titleOperation").innerHTML = "Add Receptionist";

    let userForm = document.getElementById('userForm');
    userForm.classList.add("active");
    form.scrollIntoView();

    let close = document.getElementById('cancel');
    close.addEventListener('click', function () {
        userForm.classList.remove("active");
    }, false);
}

function displayStorekeeperAddForm() {
    let form = document.getElementById("addForm");
    form.action = '/royalhospital/Admin/addReceptionist.php';
    document.getElementById("nicRow").classList.remove("hide");

    document.getElementById("titleOperation").innerHTML = "Add Storekeeper";

    let userForm = document.getElementById('userForm');
    userForm.classList.add("active");
    form.scrollIntoView();

    let close = document.getElementById('cancel');
    close.addEventListener('click', function () {
        userForm.classList.remove("active");
    }, false);
}
// add.addEventListener("click", displayUserAddForm, false);