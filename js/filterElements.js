function filterByName() {
    var input, filter, table, row, cell, i, txtValue;
    input = document.getElementById("myInputName");
    filter = input.value.toUpperCase();
    table = document.getElementsByClassName("table")[0];
    row = table.getElementsByClassName("row");
    for (i = 1; i < row.length; i++) {
        cell = row[i].getElementsByClassName("cell")[2];
        if (cell) {
            txtValue = cell.textContent || cell.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                row[i].style.display = "";
            } else {
                row[i].style.display = "none";
            }
        }
    }
}

function filterByNameUsers() {
    var input, filter, table, row, cell, i, txtValue;
    input = document.getElementById("myInputName");
    filter = input.value.toUpperCase();
    table = document.getElementsByClassName("table")[0];
    row = table.getElementsByClassName("row");
    for (i = 1; i < row.length; i++) {
        cell = row[i].getElementsByClassName("cell")[1];
        if (cell) {
            txtValue = cell.textContent || cell.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                row[i].style.display = "";
            } else {
                row[i].style.display = "none";
            }
        }
    }
}

function filterByRole() {
    var input, filter, table, row, cell, i, txtValue;
    input = document.getElementById("myInputRole");
    filter = input.value.toUpperCase();
    table = document.getElementsByClassName("table")[0];
    row = table.getElementsByClassName("row");
    for (i = 1; i < row.length; i++) {
        cell = row[i].getElementsByClassName("cell")[4];
        if (cell) {
            txtValue = cell.textContent || cell.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                row[i].style.display = "";
            } else {
                row[i].style.display = "none";
            }
        }
    }
}

function filterByRoleUsers() {
    var input, filter, table, row, cell, i, txtValue;
    input = document.getElementById("myInputRole");
    filter = input.value.toUpperCase();
    table = document.getElementsByClassName("table")[0];
    row = table.getElementsByClassName("row");
    for (i = 1; i < row.length; i++) {
        cell = row[i].getElementsByClassName("cell")[3];
        if (cell) {
            txtValue = cell.textContent || cell.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                row[i].style.display = "";
            } else {
                row[i].style.display = "none";
            }
        }
    }
}

function filterByNamePatient() {
    var input, filter, table, row, cell, i, txtValue;
    input = document.getElementById("myInputName");
    filter = input.value.toUpperCase();
    table = document.getElementsByClassName("table")[0];
    row = table.getElementsByClassName("row");
    for (i = 1; i < row.length; i++) {
        cell = row[i].getElementsByClassName("cell")[1];
        if (cell) {
            txtValue = cell.textContent || cell.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                row[i].style.display = "";
            } else {
                row[i].style.display = "none";
            }
        }
    }
}
