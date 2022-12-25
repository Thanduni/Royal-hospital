// alert("hai");
// let add = document.getElementById("addButton");

function displayUserAddForm(e) {
    let userForm = document.getElementById('userForm');
    userForm.classList.add("active");

    let close = document.getElementById('cancel');
    close.addEventListener('click', function() {
        userForm.classList.remove("active");
    }, false);
}

// add.addEventListener("click", displayUserAddForm, false);