let add = document.getElementsByTagName("button")[0];
// let elNote;

function displayUserForm(e) {
    // let msg = '<div class=\"header\"><a id=\"close\" href="#">close X</a></div>';
    let msg = '<div class=\"form\">';
    msg += '<form action=\"../addUser.php\" method=\"post\">';

    msg += '<table><tr><td><label for=\"Name\">Name</label></td>';
    msg += '<td><input type=\"text\" name=\"name\" id=\"\"></td></tr> ';

    msg += '<tr><td><label for=\"Job\">Job</label></td>';
    msg += '<td><input type=\"text\" name=\"job\" id=\"\"> </td></tr> ';

    msg += '<tr><td><label for=\"Job\">Job:</label></td>';
    msg += '<td><input type=\"text\" name=\"Job\" id=\"\"></td></tr>  ';

    msg += '<tr><td><label for=\"nic\">NIC:</label></td>';
    msg += '<td><input type=\"text\" name=\"nic\" id=\"\"></td></tr>  ';

    msg += '<tr><td valign="top"><label for=\"address\">Address:</label></td>';
    msg += '<td><textarea name=\"address\" id=\"\" rows="3" cols="20"></textarea></td></tr>  ';

    msg += '<tr><td><label for=\"contact\">Contact number:</label></td>';
    msg += '<td><input type=\"text\" name=\"contactNum\" id=\"\"> </td></tr> ';

    msg += '<tr><td><label for=\"gender\">Gender:</label></td>';
    msg += '<td><label for=\"male\">Male:</label>';
    msg += '<input type=\"radio\" name=\"gender\" value=\"m\">';
    msg += '<label for=\"female\">Female:</label>';
    msg += '<input type=\"radio\" name=\"gender\" value=\"f\"></td></tr> ';

    msg += '<tr><td><label for=\"email\">Email:</label></td>';
    msg += '<td><input type=\"email\" name=\"email\" id=\"\"></td></tr> ';

    msg += '<tr><td><label for=\"userrole\">User role:</label></td>';
    msg += '<td><input type=\"email\" name=\"userRole\" id=\"\"></td></tr> ';

    msg += '<tr><td></td>';
    msg += '<td><button name="addUser" type=\"button\">Apply</button><button type=\"button\" id=\"cancel\">Cancel</button></td></tr>';

    msg += '</table> </form> </div>';

    let elNote = document.createElement('div'); // Create a new element
    elNote.setAttribute('id', 'note'); // Add an id of note
    elNote.innerHTML = msg; // Add the message
    document.body.appendChild(elNote); // Add it to the page

    let elClose = document.getElementById('cancel'); // Get the close button
    elClose.addEventListener('click', function() {
        document.body.removeChild(elNote); // Remove the note
    }, false); // Click close-clear note
}

add.addEventListener("click", displayUserForm, false);