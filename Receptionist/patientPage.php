<?php
session_start();

require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Receptionist') {
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/adminUsersPage.css' ?>">
        <title>Receptionist patient page - Patient</title>
        <style>
            p.royal {
                font-size: 20px;
            }

            p.addUSer {
                font-size: 30px;
            }

            .next {
                position: initial;
                height: auto;
            }
        </style>
        <script src="<?php echo BASEURL . '/js/updateUser.js' ?>"></script>

    </head>

    <body>
    <div class="user">
        <?php include(BASEURL . '/Components/ReceptionistSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $_SESSION['name']); ?>
        <div class="userContents" id="center">
            <div class="title">
                <img src="../images/logo5.png" alt="logo">
                Royal Hospital Management System
            </div>
            <ul>
                <li class="userType"><img src="../images/userInPage.svg" alt="admin">Receptionist</li>
                <li class="logout"><a href="<?php echo BASEURL . '/Homepage/logout.php?logout' ?>">Logout
                        <img src="../images/logout.svg">
                    </a></li>
            </ul>
            <div class="arrow">
                <img src="../images/arrow-right-circle.svg" alt="arrow">Patient
            </div>
            <p>
                <script src="<?php echo BASEURL . '/js/addUser.js' ?>"></script>
                <button type="button" id="addButton" onclick="displayPatientAddForm()">+Add nurse</button>
            </p>

            <div class="filter">
                <input type="text" id="myInputName" onkeyup="filterByName()" placeholder="Search for names.." title="Type in a name">
            </div>

            <div class="userClass">
                <?php
                $query1 = "SELECT * FROM user where user_role = 'Patient'";
                $result1 = $con->query($query1);

                $rows = $result1->num_rows;
                ?>

                <div class="wrapper">
                    <div class="table">
                        <div class="row headerT">
                            <div class="cell">Options</div>
                            <div class="cell">NIC</div>
                            <div class="cell">Name</div>
                            <div class="cell">Patient ID</div>
                            <div class="cell">Profile Image</div>
                            <div class="cell">Address</div>
                            <div class="cell">Email</div>
                            <div class="cell">Contact Number</div>
                            <div class="cell">Gender</div>
                            <div class="cell">Date of Birth</div>
                            <div class="cell">Weight(in kgs)</div>
                            <div class="cell">Receptionist ID of who adds tha patient</div>
                            <div class="cell">Height(in cm)</div>
                            <div class="cell">Illness</div>
                            <div class="cell">Drug allergies</div>
                            <div class="cell">Medical history comments</div>
                            <div class="cell">Currently using Medicine</div>
                            <div class="cell">Emergency contact </div>
                        </div>
                        <?php
                        for ($j = 0; $j < $rows; ++$j) {
                            $result1->data_seek($j);
                            $row1 = $result1->fetch_array(MYSQLI_ASSOC);
                            $query2 = "SELECT * FROM patient where nic = '".$row1['nic']."'";
                            $result2 = $con->query($query2);
                            $result2->data_seek(0);
                            $row2 = $result2->fetch_array(MYSQLI_ASSOC);
                        ?>
                            <ul class="tableCon">
                                <li class="<?php echo $row1['nic'] ?>_tableCon"><?php echo $row1['name'] ?></li>
                                <li class="<?php echo $row1['nic'] ?>_tableCon"><?php echo $row1['address'] ?></li>
                                <li class="<?php echo $row1['nic'] ?>_tableCon"><?php echo $row1['email'] ?></li>
                                <li class="<?php echo $row1['nic'] ?>_tableCon"><?php echo $row1['contact_num'] ?></li>
                                <li class="<?php echo $row1['nic'] ?>_tableCon"><?php echo $row1['gender'] ?></li>
                                <li class="<?php echo $row1['nic'] ?>_tableCon"><?php echo $row1['DOB'] ?></li>
                                <li class="<?php echo $row1['nic'] ?>_tableCon"><?php echo $row2['weight'] ?></li>
                                <li class="<?php echo $row1['nic'] ?>_tableCon"><?php echo $row2['height'] ?></li>
                                <li class="<?php echo $row1['nic'] ?>_tableCon"><?php echo $row2['illness'] ?></li>
                                <li class="<?php echo $row1['nic'] ?>_tableCon"><?php echo $row2['drug_allergies'] ?></li>
                                <li class="<?php echo $row1['nic'] ?>_tableCon"><?php echo $row2['medical_history_comments'] ?></li>
                                <li class="<?php echo $row1['nic'] ?>_tableCon"><?php echo $row2['currently_using_medicine'] ?></li>
                                <li class="<?php echo $row1['nic'] ?>_tableCon"><?php echo $row2['emergency_contact'] ?></li>
                            </ul>
                            <div class="row">
                                <div class="cell" style="100px" data-title="Options">
                                    <button class="edit" id="<?php echo $row1['nic'] ?>"
                                            onclick="displayPatientUpdateForm(<?php echo $row1['nic'] ?>);"><img
                                            src="<?php echo BASEURL . '/images/edit.svg' ?>" alt=" Edit">
                                        Edit
                                    </button>
                                    <a href="<?php echo BASEURL . '/Receptionist/deletePatient.php?id=' . $row1['nic'] ?>">
                                        <button><img src="<?php echo BASEURL . '/images/trash.svg' ?>" alt="Delete">Delete
                                        </button>
                                    </a>
                                </div>
                                <div class="cell" data-title="NIC">
                                    <?php echo $row1['nic']; ?>
                                </div>
                                <div class="cell" data-title="Name">
                                    <?php echo $row1['name']; ?>
                                </div>
                                <div class="cell" data-title="Patient ID">
                                    <?php echo $row2['patientID']; ?>
                                </div>
                                <div class="cell" style="width:100px" data-title="Profile image">
                                    <?php
                                    echo "<img class='profilePic' src='" . BASEURL . "/uploads/".$row1['profile_image']." alt='Upload Image' width=150px>";
                                    ?>
                                </div>
                                <div class="cell" data-title="Address">
                                    <?php echo $row1['address']; ?>
                                </div>
                                <div class="cell" data-title="Email">
                                    <?php echo $row1['email']; ?>
                                </div>
                                <div class="cell" data-title="Contact number">
                                    <?php echo $row1['contact_num']; ?>
                                </div>
                                <div class="cell" data-title="Gender">
                                    <?php echo $row1['gender']; ?>
                                </div>
                                <div class="cell" data-title="Date of Birth">
                                    <?php echo $row1['DOB']; ?>
                                </div>
                                <div class="cell" data-title="Weight(in kgs)">
                                    <?php echo $row2['weight']; ?>
                                </div>
                                <div class="cell" data-title="Receptionist ID of who adds tha patient">
                                    <?php echo $row2['receptionistID']; ?>
                                </div>
                                <div class="cell" data-title="Height(in cms)">
                                    <?php echo $row2['height']; ?>
                                </div>
                                <div class="cell" data-title="Illness">
                                    <?php echo $row2['illness']; ?>
                                </div>
                                <div class="cell" data-title="Drug allergies">
                                    <?php echo $row2['drug_allergies']; ?>
                                </div>
                                <div class="cell" data-title="Medical history comments">
                                    <?php echo $row2['medical_history_comments']; ?>
                                </div>
                                <div class="cell" data-title="Currently using Medicine">
                                    <?php echo $row2['currently_using_medicine']; ?>
                                </div>
                                <div class="cell" data-title="Emergency contact">
                                    <?php echo $row2['emergency_contact']; ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
            </div>
        </div>
        </div>
    </div>
        <div id="userForm">
            <div id="form">
                <form method="post" onsubmit="return validateForm()" enctype="multipart/form-data" id="addForm"
                      name="userForm">
                    <p class="royal">Royal Hospital Management System </p>
                    <p class="addUser" id="titleOperation">Add user</p>
                    <table>
                        <tr colspan="3">
                            <div class="alert" id="warning"></div>
                        </tr>
                        <tr id="nicRow">
                            <td>
                                <label for="nic">NIC:</label>
                            </td>
                            <td colspan="2">
                                <input type="text" name="nic" id="IN_nic"><div class="alert" id="nic"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="Name">Name:</label>
                            </td>
                            <td colspan="2">
                                <input type="text" name="name" id="IN_name" required><div class="alert" id="name"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="address">Address:</label>
                            </td>
                            <td colspan="2">
                                <textarea type="text" name="address" id="IN_address" rows=3 required></textarea><div class="alert" id="address"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="email">Email:</label>
                            </td>
                            <td colspan="2">
                                <input type="email" name="email" id="IN_email" required><div class="alert" id="email"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="contact">Contact number:</label>
                            </td>
                            <td colspan="2">
                                <input type="text" name="contactNum" id="IN_contnum" required><div class="alert" id="contactNum"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="gender">Gender:</label>
                            </td>
                            <td colspan="1">
                                <label for="gender">Male:</label>
                                <input type="radio" id="M_gender" name="gender" value="m" required>
                            </td>
                            <td colspan="1">
                                <label for="gender">Female:</label>
                                <input type="radio" id="F_gender" name="gender" value="f" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="dob">Date of Birth:</label>
                            </td>
                            <td colspan="2">
                                <input type="date" name="dob" id="IN_dob" max="<?php echo date("2005-m-d") ?>" required><div class="alert" id="dob"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="Weight">Weight(in kgs):</label>
                            </td>
                            <td colspan="2">
                                <input type="number" step="0.01" name="weight" min="" max="" id="IN_weight" required><div class="alert" id="weight"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="Height">Height(in cms):</label>
                            </td>
                            <td colspan="2">
                                <input type="number" name="height" step="0.01" min="" max="" id="IN_height" required><div class="alert" id="height"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="illness">Drug allergies:</label>
                            </td>
                            <td colspan="2">
                                <textarea type="text" name="illness" id="IN_illness" rows=3 required></textarea><div class="alert" id="illness"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="drugAllergies">Drug allergies:</label>
                            </td>
                            <td colspan="2">
                                <textarea type="text" name="drugAllergies" id="IN_drAllergies" rows=3 required></textarea><div class="alert" id="drugAllergies"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="medicalHistoryComments">Medical History Comments:</label>
                            </td>
                            <td colspan="2">
                                <textarea type="text" name="medHisCom" id="IN_medHisCom" rows=3 required></textarea><div class="alert" id="medHisCom"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="currentlyUsingMedicine">Currently Using Medicine:</label>
                            </td>
                            <td colspan="2">
                                <textarea type="text" name="curUsingMed" id="IN_curUsingMed" rows=3 required></textarea><div class="alert" id="curUsingMed"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="emergencyContact">Emergency contact number:</label>
                            </td>
                            <td colspan="2">
                                <input type="text" name="emerCon" id="IN_emerCon" required><div class="alert" id="emerCon"></div>
                            </td>
                        </tr>
                        <tr id="passRow">
                            <td>
                                <label for="password">Password:</label>
                            </td>
                            <td colspan="2">
                                <input type="text" name="password" id="IN_password"><div class="alert" id="password"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="profile_image">Profile picture:</label>
                            </td>
                            <td colspan="2">
                                <input type="file" name="profile_image" id="IN_profPic" value="IN_profPic.txt" required>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2">
                                <button type="submit" id="submit" name="addUser">Apply</button>
                                <button name="cancel" id="cancel">Cancel</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    <?php include(BASEURL . '/Components/Footer.php'); ?>

    <script src=<?php echo BASEURL . '/js/ValidatePatientAddForm.js' ?>></script>
    <script src=<?php echo BASEURL . '/js/filterElements.js' ?>></script>

    </body>

    </html>
    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>