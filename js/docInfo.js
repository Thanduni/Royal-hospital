let doctorDiv = document.getElementsByClassName('displayInfo')[0];


function displayDetails(nic){
    doctorDiv.classList.remove('showNothing');
    doctorDiv.classList.toggle('show');

    $.ajax({
        url: 'Homepage/getDoctorDetails.php',
        type: 'POST',
        data: {nic: nic},
        dataType: 'json',
        success: function(response) {
            doctorDiv.innerHTML = "<div>\n" +
                "                <i id=\"close\" class=\"fa-solid fa-rectangle-xmark\" onclick=\"hideDetails()\"></i>\n" +
                "            </div>\n" +
                "            <div id=\"imgHolder\">\n" +
                "                <img src=\"uploads/" + response['profile_image'] + "\">\n" +
                "                <text style=\"font-weight: 600; font-size: 25px\">"+ response['name'] +"</text>\n" +
                "            </div>\n" +
                "            <hr style=\"width: 80%;\">\n" +
                "            <ul>\n" +
                "                <li>\n" +
                "                    <strong>Phone:</strong>\n" +
                "                    <span>" + response['contact_num'] + "</span>\n" +
                "                </li>\n" +
                "                <li>\n" +
                "                    <strong>Email:</strong>\n" +
                "                    <span>" + response['email'] + "</span>\n" +
                "                </li>\n" +
                "                <li>\n" +
                "                    <strong>Address:</strong>\n" +
                "                    <span>" + response['address'] + "</span>\n" +
                "                </li>\n" +
                "                <li>\n" +
                "                    <strong>Department:</strong>\n" +
                "                    <span>" + response['department'] + "</span>\n" +
                "                </li>\n" +
                "            </ul>";
            // console.log(response['nic']);
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + xhr.responseText);
        }
    });
}

function hideDetails(){
    doctorDiv.classList.remove('show');
    doctorDiv.classList.toggle('showNothing');
}