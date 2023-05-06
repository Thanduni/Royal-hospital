    // Get the input element
    var input = document.getElementById("myInput");

    // Add event listener to the input element
    input.addEventListener("keyup", function() {
        // Get the value of the input element and convert to lowercase
        var filter = input.value.toLowerCase();
      
        // Get the table rows
        var rows = document.getElementsByTagName("tr");
        
        // Loop through the rows and hide those that do not match the search query
        for (var i = 0; i < rows.length; i++) {
            var patient = rows[i].querySelector(".up-cell");
            var room = rows[i].querySelectorAll("td")[1];
            if (patient || room) {
                if (patient.innerHTML.toLowerCase().indexOf(filter) > -1 || room.innerHTML.toLowerCase().indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    });

