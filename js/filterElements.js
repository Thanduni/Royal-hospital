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

function filterByNameMedicine() {
    var input, filter, table, row, cell, i, txtValue;
    input = document.getElementById("myInputName");
    filter = input.value.toUpperCase();
    table = document.getElementsByClassName("table")[0];
    row = table.getElementsByClassName("row");
    for (i = 1; i < row.length; i++) {
        cell = row[i].getElementsByClassName("cell")[0];
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

function filterByMedicine() {
    var input, filter, table, row, cell, i, txtValue;
    input = document.getElementById("myInputName");
    filter = input.value.toUpperCase();
    table = document.getElementsByClassName("table")[0];
    row = table.getElementsByClassName("row");
    for (i = 1; i < row.length; i++) {
        cell = row[i].getElementsByClassName("cell")[0];
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

let switchButton = document.getElementById("switch");

switchButton.addEventListener("change", function(){
    var table, row, cell, i;
    table = document.getElementsByClassName("table")[0];
    // alert(table);
    row = table.getElementsByClassName("row");
    if(this.checked){
        // alert("Checked");
        for (i = 1; i < row.length; i++) {
            cell = row[i].getElementsByClassName("cell")[8];
            if(cell.textContent.trim() === "Expired"){
                row[i].style.display = "";
            }
            else{
                row[i].style.display = "none";
            }
        }
    }else{
        for (i = 1; i < row.length; i++) {
            cell = row[i].getElementsByClassName("cell")[8];
            if(cell.textContent.trim() === "In Stock".trim()){
                row[i].style.display = "";
            }
            else{
                row[i].style.display = "none";
            }
        }
    }
})


function filterByUseState() {
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
