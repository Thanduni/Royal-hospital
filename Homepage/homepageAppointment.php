<?php
session_start();

require_once("../conf/config.php");

if (!isset($_SESSION['mailaddress'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link rel="stylesheet" href="<?php echo BASEURL.'/css/style.css' ?>">
        <link rel="stylesheet" href="<?php echo BASEURL.'/css/appointment.css' ?>">
        <script src="<?php echo BASEURL. '/js/getDocDetails.js'; ?>"></script>
        <title>Appointment</title>
    </head>
    <body>
    <section class="header">
        <?php include(BASEURL.'/Components/Navbar.php'); ?>
        <div class="advertise">
            <div class="hey">
                <p style="color: white" class="title">Appointment</p>
            </div>
        </div>
        <div style="display: flex; justify-content: center">
            <div id="appointmentForm">
                <form method="post" onsubmit="return validateAppointmentForm()" action="<?php echo BASEURL.'/Homepage/addAppointment.php' ?>" enctype="multipart/form-data" id="addForm"
                      name="userForm">
                    <table>
                        <tr colspan="3">
                            <div class="alert" id="warning">
                                <?php
                                    if(@$_GET['warning'])
                                        echo $_GET['warning'];
                                ?>
                            </div>
                            <div class="success" id="warning">
                                <?php
                                if(@$_GET['result'])
                                    echo $_GET['result'];
                                ?>
                            </div>
                        </tr>
                        <tr id="nicRow">
                            <td>
                                <label for="">Date</label><br>
                            </td>
                            <td colspan="2">
                                <input type="date" name="date" id="date" min = "<?php echo date('Y-m-d') ?>" max = "<?php echo date('Y-m-d', strtotime('+1 week')) ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Department</label><br>
                            </td>
                            <td colspan="2">
                                <select name="department" id="department">
                                    <option value="">Please A Select Department</option>
                                    <option value="Anesthetics">Anesthetics</option>
                                    <option value="Cardiology">Cardiology</option>
                                    <option value="Gastroentology">Gastroentology</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label  for="">Doctor</label><br>
                            </td>
                            <td colspan="2">
                                <select name="doctor" id="doctor">
                                    <option value="">Select a doctor</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>NIC</label>
                            </td>
                            <td colspan="2">
                                <input type="text" name="nic"><div class="alert" style="width: 351px" id="nic"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Time</label><br>
                            </td>
                            <td colspan="2">
                                <select name="time" id="time">
                                    <option value="">Please select a time slot</option>
                                </select>                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Message</label><br>
                            </td>
                            <td colspan="2">
                                <textarea name="msg" id="msg" cols="30" rows="3" placeholder="Your Message To The Doctor"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2">
                                <button type="submit" style="color: var(--primary-color)" class="custom-btn" name="submit" id="btn" value="submit">Submit</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <?php include(BASEURL.'/Components/Footer.php'); ?>
    </section>
    <script>
        let form = document.getElementById("addForm");
        let nicDiv = document.getElementById("nic");
        let regNic = /^\d{12}[A-Z]?$/;

        function validateNIC() {
            nicDiv.innerHTML = "";
            let nic = nicDiv.previousSibling.value;
            if (nic == "" || !regNic.test(nic)) {
                nicDiv.classList.remove("hint");
                nicDiv.classList.add("alert");
                nicDiv.innerHTML = "<ul>\n" +
                    "    <li>Please enter your NIC properly.</li>\n" +
                    "</ul>"
            }
        }

        nicDiv.previousSibling.addEventListener("blur", validateNIC, false)

        nicDiv.previousSibling.addEventListener("focus", function () {
            nicDiv.classList.remove("alert");
            nicDiv.classList.add("hint");
            nicDiv.innerHTML = "<ul>\n" +
                "    <li>NIC should contain only 12 digits or with character at last after the digits.</li>\n" +
                "</ul>"
        }, false)

        function validateAppointmentForm(){
            let nic = nicDiv.previousSibling.value;
            if (regNic.test(nic))
                return true
            else{
                if (!regNic.test(nic)) {
                    nicDiv.classList.remove("hint");
                    nicDiv.classList.add("alert");
                    nicDiv.innerHTML = "<ul>\n" +
                        "    <li>Please enter your NIC properly.</li>\n" +
                        "</ul>"
                }
                form.scrollIntoView();
                return false;
            }
        }
    </script>
    </body>
    </html>


    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>