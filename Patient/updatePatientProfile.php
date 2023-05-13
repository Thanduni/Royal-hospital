<?php
session_start();
//die( $_SESSION['mailaddress']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Patient') {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/updateProfile.css' ?>">
        <title>Patient update profile - Receptionist</title>
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
        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL.'/Components/PatientSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
        <div class="userContents" id="center">
        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL.'/Components/patientTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
        ?>
            <ul>
                <li class="userType"><img src="../images/userInPage.svg" alt="admin"> Patient</li>
            </ul>
            <div class="arrow">
                <img src="../images/arrow-right-circle.svg" alt="arrow">Profile
            </div>
            <div class="editRegion">
                <div class="editForm">
                    <h2>Edit profile</h2>
                    <?php
                    if (@$_GET['wrongResult']) {
                        ?>
                        <div class="alert">
                            <?php
                            echo $_GET["wrongResult"];
                            ?>
                        </div>
                        <?php
                    } ?>
                    <?php
                    if (@$_GET['correctResult']) {
                        ?>
                        <div class="success">
                            <?php
                            echo $_GET["correctResult"];
                            ?>
                        </div>
                        <?php
                    } ?>
                    <form action="updateProfile.php" onsubmit="return validateUpdateForm()"  method="post" enctype="multipart/form-data">
                        <?php
                        $nic =$_SESSION['nic'];
                        $q1 = "select * from patient where nic = $nic";
                        $res = mysqli_query($con,$q1);
                        $row1 = mysqli_fetch_array($res);
                        $pid = $row1['patientID'];

                        $result = mysqli_query($con, "select * from user where email = '" . $_SESSION['mailaddress'] . "'");

                        $row = mysqli_fetch_array($result);
                        ?>
                        <table>
                            <tr>
                                <td><label for="Name">Name: </label></td>
                                <td colspan="2"><input type="text" name="name" value="<?php echo $row['name'] ?> " required><div class="alert" id="nameDiv"></div></td>
                            </tr>
                            <tr>
                                <td><label for="address">Address: </label></td>
                                <td colspan="2"><textarea name="address" cols="30"
                                                          rows="3" required><?php echo $row['address'] ?></textarea><div class="alert" id="addressDiv"></div></td>
                            </tr>
                            <tr></tr>
                                <td><label for="contactnum">Contact number: </label></td>
                                <td colspan="2"><input type="number" name="contactNum" value="<?php echo $row['contact_num'] ?>" required><div class="alert" id="contactNum"></div></td>
                            </tr>
                            <tr>
                                <td><label for="dob">Date of birth: </label></td>
                                <td colspan="2"><input type="date" name="dob" max="<?php echo date("2005-m-d")?>" required></td>
                                <script>document.getElementsByName('dob')[0].value="<?php echo $row['DOB'] ?>";</script>
                            </tr>
                            <tr>
                                <td><label for="gender">Gender: </label></td>
                                <td>
                                    <label for="address">Male:</label>
                                    <input type="radio" id="M_gender" name="gender" value="m" required>
                                </td>
                                <td>
                                    <label for="address">Female:</label>
                                    <input type="radio" id="F_gender" name="gender" value="f" required>
                                </td>
                                <script>
                                    if('<?php echo $row['gender'] ?>' == 'm')
                                        document.getElementById('M_gender').checked = true;
                                    else
                                        document.getElementById('F_gender').checked = true;
                                </script>
                            </tr>
                            <tr>
                                <td><label for="height">Height(kg): </label></td>
                                <td colspan="2"><input type="number" name="height" value="<?php echo $row1['height'] ?>" required><div class="alert" id="height"></div></td>
                            </tr>
                            <tr>
                                <td><label for="weight">Weight(cm): </label></td>
                                <td colspan="2"><input type="number" name="weight" value="<?php echo $row1['weight'] ?>" required><div class="alert" id="weight"></div></td>
                            </tr>
                            <tr>
                                <td><label for="blood">Blood: </label></td>
                                <td colspan="2">
                            <select style="width: 250px;height:40px;float:left;border-radius:5px;font-size:18px;" type="text" id="blood_type" name="blood" value="<?php echo $row1['blood'] ?>" required>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                                <div class="alert" id="blood"></div></td>
                            </tr>
                            <script>
                                document.getElementById("blood_type")[7].setAttribute('selected','selected');
                                if('<?php echo $row1['bood']?>' == 'A+')
                                    document.getElementById("blood_type")[0].setAttribute('selected','selected');
                                else if('<?php echo $row1['bood']?>' == 'A-')
                                    document.getElementById("blood_type")[1].setAttribute('selected','selected');
                                else if('<?php echo $row1['bood']?>' == 'B+')
                                    document.getElementById("blood_type")[2].setAttribute('selected','selected');
                                else if('<?php echo $row1['bood']?>' == 'B-')
                                    document.getElementById("blood_type")[3].setAttribute('selected','selected');
                                else if('<?php echo $row1['bood']?>' == 'AB+')
                                    document.getElementById("blood_type")[4].setAttribute('selected','selected');
                                else if('<?php echo $row1['bood']?>' == 'AB-')
                                    document.getElementById("blood_type")[5].setAttribute('selected','selected');
                                else if('<?php echo $row1['bood']?>' == 'O+')
                                    document.getElementById("blood_type")[6].setAttribute('selected','selected');
                                else if('<?php echo $row1['bood']?>' == 'O-')
                                    document.getElementById("blood_type")[7].setAttribute('selected','selected');
                            </script>
                            <tr>
                                <td><label for="illness">Illness: </label></td>
                                <td colspan="2"><input type="text" name="illness" value="<?php echo $row1['illness'] ?>" required><div class="alert" id="illness"></div></td>
                            </tr>
                            <tr>
                                <td><label for="Drug_al">Drug Allergies: </label></td>
                                <td colspan="2"><input type="text" name="Drug_al" value="<?php echo $row1['drug_allergies'] ?>" required><div class="alert" id="Drug_al"></div></td>
                            </tr>
                            <tr>
                                <td><label for="profilePic">Profile Image: </label></td>
                                <td colspan="2"><img  src="<?php echo BASEURL . '/uploads/' . $row['profile_image'] ?>" id="profilePic" alt=""><br>
                                    <input type="file"  name="profile_image" required>
                                </td>
                            </tr>
                        </table>
                        <button name="updatePatient" type="submit" onclick="get()">Save changes</button>
                    </form>
                </div>
            </div>
            <div class="editRegion">
                <div class="editForm">
                    <h2>Change password</h2>

                    <form action="updateProfile.php" onsubmit="validatePasswordForm()" method="post">

                        <table>
                            <tr>
                                <td><label for="Old password">Old password: </label></td>
                                <td colspan="2"><input type="password" name="oldPassword" required><div class="alert password"></div></td>
                            </tr>
                            <tr>
                                <td><label for="New password">New password: </label></td>
                                <td colspan="2"><input type="password" name="newPassword" required><div class="alert password" ></div></td>
                            </tr>
                            <tr>
                                <td><label for="confirmPassword">Confirm Password: </label></td>
                                <td colspan="2"><input type="password" name="confirmPassword" required><div class="alert password"></div></td>
                            </tr>
                        </table>
                        <button name="changePassword" type="submit">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include(BASEURL . '/Components/Footer.php'); ?>

    <script src=<?php echo BASEURL . '/js/validateFormPatient.js' ?>>
    //<script src=<?php //echo BASEURL . '/js/validateFormReceptionist.js' ?>

    
    $(function(){
            $('#open').click(function(){
                $('#login-modal').fadeIn().css("display","flex");
            });
            $('#open-').click(function(){
                $('#login-modal').fadeIn().css("display","flex");
            });
            $('.cancel-modal').click(function(){
                $('#login-modal').fadeOut();
            });
        });

    </script>

    <div id="counter">0</div>

    </body>

    </html>
    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>