// alert("hai");
// let add = document.getElementById("addButton");

function displayUserAddForm(e) {
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

    // for (let x in inputArray) {
    //     inputArray[x].value = "";
    // }


    let userForm = document.getElementById('userForm');
    userForm.classList.add("active");
    form.scrollIntoView();

    let close = document.getElementById('cancel');
    close.addEventListener('click', function() {
        userForm.classList.remove("active");
    }, false);
}

// add.addEventListener("click", displayUserAddForm, false);