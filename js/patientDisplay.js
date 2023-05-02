function patientDisplay(nic){
    let form = document.getElementById("moreDetailsTable");

    $.ajax({
        url: '../Receptionist/getPatientDetails.php',
        type: 'POST',
        data: {nic: nic},
        dataType: 'json',
        success: function(response) {
            console.log(response.name);
            let newSegment = "<div class=\"wrapper_MD\">\n" +
                "            <div class=\"table_MD\">\n" +
                "                    <div class=\"row_MD\">\n" +
                "                    <div class=\"cell_MD_head\">NIC</div>\n" +
                "                        <div class=\"cell_MD\" data-title=\"NIC\">\n" +
                response.nic +
                "                        </div>\n" +
                "                    <div class=\"cell_MD_head\">Name</div>\n" +
                "                        <div class=\"cell_MD\" data-title=\"Name\">\n" +
                response.name +
                "                        </div>\n" +
                "                    <div class=\"cell_MD_head\">Patient ID</div>\n" +
                "                        <div class=\"cell_MD\" data-title=\"Patient ID\">\n" +
                response.patientID +
                "                        </div>\n" +
                "                    <div class=\"cell_MD_head\">Profile Image</div>\n" +
                "                        <div class=\"cell_MD\" style=\"width:100px\" data-title=\"Profile image\">\n" +
                "<img class='profilePic' src=\"../uploads/" + response.profile_image + "\"alt='Upload Image' width=150px>" +
                "                        </div>\n" +
                "                    <div class=\"cell_MD_head\">Address</div>\n" +
                "                        <div class=\"cell_MD\" data-title=\"Address\">\n" +
                response.address +
                "                        </div>\n" +
                "                    <div class=\"cell_MD_head\">Email</div>\n" +
                "                        <div class=\"cell_MD\" data-title=\"Email\">\n" +
                response.email +
                "                        </div>\n" +
                "                    <div class=\"cell_MD_head\">Contact Number</div>\n" +
                "                        <div class=\"cell_MD\" data-title=\"Contact number\">\n" +
                response.contact_num +
                "                        </div>\n" +
                "                    <div class=\"cell_MD_head\">Gender</div>\n" +
                "                        <div class=\"cell_MD\" data-title=\"Gender\">\n" +
                response.gender +
                "                        </div>\n" +
                "                    <div class=\"cell_MD_head\">Date of Birth</div>\n" +
                "                        <div class=\"cell_MD\" data-title=\"Date of Birth\">\n" +
                response.DOB +
                "                        </div>\n" +
                "                    <div class=\"cell_MD_head\">Weight(in kgs)</div>\n" +
                "                        <div class=\"cell_MD\" data-title=\"Weight(in kgs)\">\n" +
                response.weight +
                "                        </div>\n" +
                "                    <div class=\"cell_MD_head\">Receptionist ID of who adds tha patient</div>\n" +
                "                        <div class=\"cell_MD\" data-title=\"Receptionist ID of who adds tha patient\">\n"
                + response.receptionistID +
                "                        </div>\n" +
                "                    <div class=\"cell_MD_head\">Height(in cm)</div>\n" +
                "                        <div class=\"cell_MD\" data-title=\"Height(in cms)\">\n" +
                response.height +
                "                        </div>\n" +
                "                    <div class=\"cell_MD_head\">Illness</div>\n" +
                "                        <div class=\"cell_MD\" data-title=\"Illness\">\n" +
                response.illness +
                "                        </div>\n" +
                "                    <div class=\"cell_MD_head\">Drug allergies</div>\n" +
                "                        <div class=\"cell_MD\" data-title=\"Drug allergies\">\n" +
                response.drug_allergies +
                "                        </div>\n" +
                "                    <div class=\"cell_MD_head\">Medical history comments</div>\n" +
                "                        <div class=\"cell_MD\" data-title=\"Medical history comments\">\n" +
                response.medical_history_comments +
                "                        </div>\n" +
                "                    <div class=\"cell_MD_head\">Currently using Medicine</div>\n" +
                "                        <div class=\"cell_MD\" data-title=\"Currently using Medicine\">\n" +
                response.currently_using_medicine +
                "                        </div>\n" +
                "                    <div class=\"cell_MD_head\">Emergency contact </div>\n" +
                "                        <div class=\"cell_MD\" data-title=\"Emergency contact\">\n" +
                response.emergency_contact +
                "                        </div>\n" +
                "        <button class=\"custom-btn\" name=\"cancel\" id=\"exit\">Exit</button>\n" +
                "<div>\n" +
                '            \n' +
                "        </div>" +
                "            </div>\n" +
                "        </div>";

            document.getElementById("moreDetailsTable").innerHTML = newSegment;
            // alert(document.getElementById("exit"));
            // document.getElementById("exit").addEventListener("click", function (){
            //     document.getElementById("moreDetailsTable").classList.add('hide');
            //     console.log("Hey exit");
            // })
            $('#exit').click(function(){
                $('#moreDetailsTable').fadeOut();
            });
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + xhr.responseText);
        }
    });


}

// alert(document.getElementById("exit"));
//     document.getElementById("exit").addEventListener("click", function (){
//         // document.getElementById("moreDetailsTable").classList.add('hide');
//         console.log("Hey exit");
//     })



