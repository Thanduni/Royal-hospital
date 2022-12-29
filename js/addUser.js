// alert("hai");
// let add = document.getElementById("addButton");

function displayUserAddForm(userRole=[]) {
    let form = document.getElementById("addForm");
    // if(userRole[0] === "Doctor"){
    //     alert(userRole[0]);
    // }else{
        form.action = '/royalhospital/Admin/addUser.php';
    // }
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
    close.addEventListener('click', function() {
        userForm.classList.remove("active");
    }, false);
}

function displayDoctorAddForm(){
    let form = document.getElementById("addForm");
    form.action = '/royalhospital/Admin/addDoctor.php';
    document.getElementById("nicRow").classList.remove("hide");
    // document.getElementById("passRow").classList.remove("hide");
    // document.getElementById("IN_name").value = "";
    // document.getElementById("IN_address").value = "";
    // document.getElementById("IN_email").value = "";
    // document.getElementById("IN_contnum").value = "";
    // document.getElementById("M_gender").checked = false;
    // document.getElementById("F_gender").checked = false;

    document.getElementById("titleOperation").innerHTML = "Add Doctor";

    let userForm = document.getElementById('userForm');
    userForm.classList.add("active");
    form.scrollIntoView();

    let close = document.getElementById('cancel');
    close.addEventListener('click', function() {
        userForm.classList.remove("active");
    }, false);
}

// add.addEventListener("click", displayUserAddForm, false);