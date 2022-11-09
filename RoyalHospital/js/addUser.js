let add = document.getElementsByTagName("button")[0];

function displayUserForm() {
    let note = document.getElementById('note');
    note.classList.add("active");

    let close = document.getElementById('cancel');
    close.addEventListener('click', function() {
        note.classList.remove("active");
    }, false);
}

add.addEventListener("click", displayUserForm, false);