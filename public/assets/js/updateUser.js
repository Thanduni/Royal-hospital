let update = document.getElementById("update");

function displayUserForm() {
    let note = document.getElementById('note');
    note.classList.add("active");

    let close = document.getElementById('cancel');
    close.addEventListener('click', function() {
        note.classList.remove("active");
        note.
    }, false);
}

add.addEventListener("click", displayUserForm, false);