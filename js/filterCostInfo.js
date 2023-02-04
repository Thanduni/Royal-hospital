let paidStatus = document.getElementById("paidStatus");
let filterButton = document.getElementById("filterAppointment");
// alert(paidStatus);

function filterTables(){
    if(this.checked){
        var table, row, cell, i, txtValue;
        table = document.getElementsByClassName("table")[0];
        row = table.getElementsByClassName("row");
        for (i = 1; i < row.length; i++) {
            cell = row[i].getElementsByClassName("cell")[4];
            if (cell) {
                txtValue = cell.textContent || cell.innerText;
                if (txtValue.trim() === 'not paid'.trim() && row[i].style.display === "") {
                    row[i].style.display = "";
                } else {
                    row[i].style.display = "none";
                }
            }
        }

        table = document.getElementsByClassName("table")[1];
        row = table.getElementsByClassName("row");
        for (i = 1; i < row.length; i++) {
            cell = row[i].getElementsByClassName("cell")[4];
            if (cell) {
                txtValue = cell.textContent || cell.innerText;
                if (txtValue.trim() === 'not paid'.trim() && row[i].style.display === "") {
                    row[i].style.display = "";
                } else {
                    row[i].style.display = "none";
                }
            }
        }

        table = document.getElementsByClassName("table")[2];
        row = table.getElementsByClassName("row");
        for (i = 1; i < row.length; i++) {
            cell = row[i].getElementsByClassName("cell")[4];
            if (cell) {
                txtValue = cell.textContent || cell.innerText;
                if (txtValue.trim() === 'not paid'.trim() && row[i].style.display === "") {
                    row[i].style.display = "";
                } else {
                    row[i].style.display = "none";
                }
            }
        }

        table = document.getElementsByClassName("table")[3];
        row = table.getElementsByClassName("row");
        for (i = 1; i < row.length; i++) {
            cell = row[i].getElementsByClassName("cell")[4];
            if (cell) {
                txtValue = cell.textContent || cell.innerText;
                if (txtValue.trim() === 'not paid'.trim() && row[i].style.display === "") {
                    row[i].style.display = "";
                } else {
                    row[i].style.display = "none";
                }
            }
        }

        // let totalRow = document.getElementsByClassName("total");
        // for (i = 0; i < totalRow.length; i++) {
        //     cell = totalRow[i].getElementsByClassName("cell")[3];
        //
        //     if (cell) {
        //         totalRow[i].style.display = "";
        //     }
        // }

    }
    else{
        row = document.getElementsByClassName("row");
        for (i = 1; i < row.length; i++) {
            cell = row[i].getElementsByClassName("cell")[4];
            if (cell) {
                    row[i].style.display = "";
            }
        }
    }
}

function filterByDate(){
    let startDateWarn = document.getElementById("startDateWarn");
    let endDateWarn = document.getElementById("endDateWarn");
    let finalWarn = document.getElementById("finalWarning");
    if(!document.getElementById("startDate").value){
        startDateWarn.classList.add("alert");
        startDateWarn.innerHTML = "<b>Please enter a start date.</b>";
    }else if(!document.getElementById("endDate").value){
        endDateWarn.classList.add("alert");
        endDateWarn.innerHTML = "<b>Please enter a end date.</b>";
    }
    let startDate = new Date(document.getElementById("startDate").value);
    let endDate = new Date(document.getElementById("endDate").value);
    if(startDate > endDate){
        finalWarn.classList.add('alert');
        finalWarn.innerHTML = "<b>Please enter a valid start date and end date.</b>"
    } else{
        var table, row, cell, i, date;
        table = document.getElementsByClassName("table")[0];
        row = table.getElementsByClassName("row");
        for (i = 1; i < row.length; i++) {
            cell = row[i].getElementsByClassName("cell")[0];
            if (cell) {
                date = new Date(cell.textContent || cell.innerText);
                if (date >= startDate && date <= endDate) {
                    row[i].style.display = "";
                } else {
                    row[i].style.display = "none";
                }
            }
        }

        table = document.getElementsByClassName("table")[1];
        row = table.getElementsByClassName("row");
        for (i = 1; i < row.length; i++) {
            cell = row[i].getElementsByClassName("cell")[0];
            if (cell) {
                date = new Date(cell.textContent || cell.innerText);
                if (date >= startDate && date <= endDate) {
                    row[i].style.display = "";
                } else {
                    row[i].style.display = "none";
                }
            }
        }

        table = document.getElementsByClassName("table")[2];
        row = table.getElementsByClassName("row");
        for (i = 1; i < row.length; i++) {
            cell = row[i].getElementsByClassName("cell")[0];
            if (cell) {
                date = new Date(cell.textContent || cell.innerText);
                if (date >= startDate && date <= endDate) {
                    row[i].style.display = "";
                } else {
                    row[i].style.display = "none";
                }
            }
        }

        table = document.getElementsByClassName("table")[3];
        row = table.getElementsByClassName("row");
        for (i = 1; i < row.length; i++) {
            cell = row[i].getElementsByClassName("cell")[0];
            if (cell) {
                date = new Date(cell.textContent || cell.innerText);
                if (date >= startDate && date <= endDate) {
                    row[i].style.display = "";
                } else {
                    row[i].style.display = "none";
                }
            }
        }

    }

}

paidStatus.addEventListener('change', filterTables, false);

filterButton.addEventListener('click', filterByDate, false);