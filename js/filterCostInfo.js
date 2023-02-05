let paidStatus = document.getElementById("paidStatus");

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
    }
    else{
        row = document.getElementsByClassName("row");
        for (i = 1; i < row.length; i++) {
            cell = row[i].getElementsByClassName("cell")[4];
            if (cell && row[i].style.display === "none") {
                    row[i].style.display = "";
            }
        }
    }
}



paidStatus.addEventListener('change', filterTables, false);
