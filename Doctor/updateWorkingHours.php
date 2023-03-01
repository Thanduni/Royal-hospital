<?php
session_start();
//die( $_SESSION['mailaddress']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Doctor') {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/updateProfile.css' ?>">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
        <title>Doctor update working hours - Doctor</title>
        <style>
            p.royal {
                font-size: 20px;
            }

            #form button {
                margin: 20px;
            }

            .userContents td {
                vertical-align: middle;
            }

            .userContents button {
                vertical-align: center;
                float: unset;
                position: relative;
                top: 0;
                width: 200px;
            }

            input[type="time"] {
                margin: 15px;
            }

            p.addUSer {
                font-size: 30px;
            }

            .next {
                position: initial;
                height: auto;
            }

            td {
                text-align: center;
            }

            .banner {
                position: relative;
                height: 200px;
                background-image: url("../images/workingHour.jpg");
                background-size: cover;
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
                color: white;
                text-shadow: 0 0 1em var(--para-color), 0 0 var(--para-color);
            }

            .banner::after {
                content: "";
                background-color: rgba(0, 0, 0, 0.2);
                position: absolute;
                width: auto;
                height: 100%;
            }

            .newSlots {
                display: flex;
                justify-content: space-around;
            }
        </style>
        <script src="<?php echo BASEURL . '/js/updateUser.js' ?>"></script>
    </head>

    <body>
    <div class="user">
        <?php
        $name = urlencode($_SESSION['name']);
        include(BASEURL . '/Components/doctorSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
        <div class="userContents" id="center">
            <?php
            $name = urlencode( $_SESSION['name']);
            include(BASEURL.'/Components/doctorTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole'] . "&nic=" . $_SESSION['nic']);
            ?>
            <div class="arrow">
                <img src="../images/arrow-right-circle.svg" alt="arrow">Profile
            </div>
            <div class="editRegion">
                <div class="editForm">
                    <h2>Edit working hours</h2>
                    <table>
                        <tr>
                            <th>Day</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                        <?php
                        $query = "SELECT * FROM doctor_working_hours join doctor on doctor_working_hours.doctorID=doctor.doctorID 
                                                                     join user on doctor.nic=user.nic where doctor_working_hours.day_of_week='Monday' 
                                                                     and user.nic='" . $_SESSION['nic'] . "'";
                        $result = $con->query($query);
                        if (!$result) die("Database access failed: " . $con->error);
                        $rows = $result->num_rows;
                        $row = mysqli_fetch_array($result);
                        ?>
                        <tr>
                            <td rowspan="<?php echo $rows ?>"> <?php echo $row['day_of_week']; ?></td>
                            <td><?php echo date('h:i A', strtotime($row['start_time'])) ?></td>
                            <td><?php echo date('h:i A', strtotime($row['end_time'])); ?></td>
                        </tr>
                        <?php
                        if ($result) {
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td><?php echo date('h:i A', strtotime($row['start_time'])) ?></td>
                                    <td><?php echo date('h:i A', strtotime($row['end_time'])); ?></td>
                                </tr>
                            <?php }
                        } ?>
                        <tr>
                            <td style="border-bottom-style: solid; border-bottom-width: 1px; border-bottom-color: var(--para-color)"
                                colspan="3">
                                <button type="button" class="custom-btn" id="Monday" onclick="edit('Monday')"
                                        style="float: right">Edit schedule
                                </button>
                                <script type="text/javascript">
                                    $(function () {
                                        $('#Monday').click(function () {
                                            $('#userForm').fadeIn().css("display", "flex");
                                        });
                                    });
                                </script>
                            </td>
                        </tr>


                        <?php
                        $query = "SELECT * FROM doctor_working_hours join doctor on doctor_working_hours.doctorID=doctor.doctorID 
                                                                     join user on doctor.nic=user.nic where doctor_working_hours.day_of_week='Tuesday' 
                                                                     and user.nic='" . $_SESSION['nic'] . "'";
                        $result = $con->query($query);
                        if (!$result) die("Database access failed: " . $con->error);
                        $rows = $result->num_rows;
                        $row = mysqli_fetch_array($result);
                        ?>
                        <tr>
                            <td rowspan="<?php echo $rows ?>"><?php echo $row['day_of_week']; ?></td>
                            <td><?php echo date('h:i A', strtotime($row['start_time'])) ?></td>
                            <td><?php echo date('h:i A', strtotime($row['end_time'])); ?></td>
                        </tr>
                        <?php
                        if ($result) {
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td><?php echo date('h:i A', strtotime($row['start_time'])) ?></td>
                                    <td><?php echo date('h:i A', strtotime($row['end_time'])); ?></td>
                                </tr>
                            <?php }
                        } ?>
                        <tr>
                            <td style="border-bottom-style: solid; border-bottom-width: 1px; border-bottom-color: var(--para-color)"
                                colspan="3">
                                <button type="button" class="custom-btn" id="Tuesday" onclick="edit('Tuesday')"
                                        style="float: right">Edit schedule
                                </button>
                                <script type="text/javascript">
                                    $(function () {
                                        $('#Tuesday').click(function () {
                                            $('#userForm').fadeIn().css("display", "flex");
                                        });
                                    });
                                </script>
                            </td>
                        </tr>


                        <?php
                        $query = "SELECT * FROM doctor_working_hours join doctor on doctor_working_hours.doctorID=doctor.doctorID 
                                                                     join user on doctor.nic=user.nic where doctor_working_hours.day_of_week='Wednesday' 
                                                                     and user.nic='" . $_SESSION['nic'] . "'";
                        $result = $con->query($query);
                        if (!$result) die("Database access failed: " . $con->error);
                        $rows = $result->num_rows;
                        $row = mysqli_fetch_array($result);
                        ?>
                        <tr>
                            <td rowspan="<?php echo $rows ?>"><?php echo $row['day_of_week']; ?></td>
                            <td><?php echo date('h:i A', strtotime($row['start_time'])) ?></td>
                            <td><?php echo date('h:i A', strtotime($row['end_time'])); ?></td>
                        </tr>
                        <?php
                        if ($result) {
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td><?php echo date('h:i A', strtotime($row['start_time'])) ?></td>
                                    <td><?php echo date('h:i A', strtotime($row['end_time'])); ?></td>
                                </tr>
                            <?php }
                        } ?>
                        <tr>
                            <td style="border-bottom-style: solid; border-bottom-width: 1px; border-bottom-color: var(--para-color)"
                                colspan="3">
                                <button type="button" class="custom-btn" id="Wednesday" onclick="edit('Wednesday')"
                                        style="float: right">Edit schedule
                                </button>
                                <script type="text/javascript">
                                    $(function () {
                                        $('#Wednesday').click(function () {
                                            $('#userForm').fadeIn().css("display", "flex");
                                        });
                                    });
                                </script>
                            </td>
                        </tr>


                        <?php
                        $query = "SELECT * FROM doctor_working_hours join doctor on doctor_working_hours.doctorID=doctor.doctorID 
                                                                     join user on doctor.nic=user.nic where doctor_working_hours.day_of_week='Thursday' 
                                                                     and user.nic='" . $_SESSION['nic'] . "'";
                        $result = $con->query($query);
                        if (!$result) die("Database access failed: " . $con->error);
                        $rows = $result->num_rows;
                        $row = mysqli_fetch_array($result);
                        ?>
                        <tr>
                            <td rowspan="<?php echo $rows ?>"><?php echo $row['day_of_week']; ?></td>
                            <td><?php echo date('h:i A', strtotime($row['start_time'])) ?></td>
                            <td><?php echo date('h:i A', strtotime($row['end_time'])); ?></td>
                        </tr>
                        <?php
                        if ($result) {
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td><?php echo date('h:i A', strtotime($row['start_time'])) ?></td>
                                    <td><?php echo date('h:i A', strtotime($row['end_time'])); ?></td>
                                </tr>
                            <?php }
                        } ?>
                        <tr>
                            <td style="border-bottom-style: solid; border-bottom-width: 1px; border-bottom-color: var(--para-color)"
                                colspan="3">
                                <button type="button" class="custom-btn" id="Thursday" onclick="edit('Thursday')"
                                        style="float: right">Edit schedule
                                </button>
                                <script type="text/javascript">
                                    $(function () {
                                        $('#Thursday').click(function () {
                                            $('#userForm').fadeIn().css("display", "flex");
                                        });
                                    });
                                </script>
                            </td>
                        </tr>


                        <?php
                        $query = "SELECT * FROM doctor_working_hours join doctor on doctor_working_hours.doctorID=doctor.doctorID 
                                                                     join user on doctor.nic=user.nic where doctor_working_hours.day_of_week='Friday' 
                                                                     and user.nic='" . $_SESSION['nic'] . "'";
                        $result = $con->query($query);
                        if (!$result) die("Database access failed: " . $con->error);
                        $rows = $result->num_rows;
                        $row = mysqli_fetch_array($result);
                        ?>
                        <tr>
                            <td rowspan="<?php echo $rows ?>"><?php echo $row['day_of_week']; ?></td>
                            <td><?php echo date('h:i A', strtotime($row['start_time'])) ?></td>
                            <td><?php echo date('h:i A', strtotime($row['end_time'])); ?></td>
                        </tr>
                        <?php
                        if ($result) {
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td><?php echo date('h:i A', strtotime($row['start_time'])) ?></td>
                                    <td><?php echo date('h:i A', strtotime($row['end_time'])); ?></td>
                                </tr>
                            <?php }
                        } ?>
                        <tr>
                            <td style="border-bottom-style: solid; border-bottom-width: 1px; border-bottom-color: var(--para-color)"
                                colspan="3">
                                <button type="button" class="custom-btn" id="Friday" onclick="edit('Friday')"
                                        style="float: right">Edit schedule
                                </button>
                                <script type="text/javascript">
                                    $(function () {
                                        $('#Friday').click(function () {
                                            $('#userForm').fadeIn().css("display", "flex");
                                        });
                                    });
                                </script>
                            </td>
                        </tr>


                        <?php
                        $query = "SELECT * FROM doctor_working_hours join doctor on doctor_working_hours.doctorID=doctor.doctorID 
                                                                     join user on doctor.nic=user.nic where doctor_working_hours.day_of_week='Saturday' 
                                                                     and user.nic='" . $_SESSION['nic'] . "'";
                        $result = $con->query($query);
                        if (!$result) die("Database access failed: " . $con->error);
                        $rows = $result->num_rows;
                        $row = mysqli_fetch_array($result);
                        ?>
                        <tr>
                            <td rowspan="<?php echo $rows ?>"><?php echo $row['day_of_week']; ?></td>
                            <td><?php echo date('h:i A', strtotime($row['start_time'])) ?></td>
                            <td><?php echo date('h:i A', strtotime($row['end_time'])); ?></td>
                        </tr>
                        <?php
                        if ($result) {
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td><?php echo date('h:i A', strtotime($row['start_time'])) ?></td>
                                    <td><?php echo date('h:i A', strtotime($row['end_time'])); ?></td>
                                </tr>
                            <?php }
                        } ?>
                        <tr>
                            <td style="border-bottom-style: solid; border-bottom-width: 1px; border-bottom-color: var(--para-color)"
                                colspan="3">
                                <button type="button" class="custom-btn" id="Saturday" onclick="edit('Saturday')"
                                        style="float: right">Edit schedule
                                </button>
                                <script type="text/javascript">
                                    $(function () {
                                        $('#Saturday').click(function () {
                                            $('#userForm').fadeIn().css("display", "flex");
                                        });
                                    });
                                </script>
                            </td>
                        </tr>


                        <?php
                        $query = "SELECT * FROM doctor_working_hours join doctor on doctor_working_hours.doctorID=doctor.doctorID 
                                                                     join user on doctor.nic=user.nic where doctor_working_hours.day_of_week='Sunday' 
                                                                     and user.nic='" . $_SESSION['nic'] . "'";
                        $result = $con->query($query);
                        if (!$result) die("Database access failed: " . $con->error);
                        $rows = $result->num_rows;
                        $row = mysqli_fetch_array($result);
                        ?>
                        <tr>
                            <td rowspan="<?php echo $rows ?>"><?php echo $row['day_of_week']; ?></td>
                            <td><?php echo date('h:i A', strtotime($row['start_time'])) ?></td>
                            <td><?php echo date('h:i A', strtotime($row['end_time'])); ?></td>
                        </tr>
                        <?php
                        if ($result) {
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td><?php echo date('h:i A', strtotime($row['start_time'])) ?></td>
                                    <td><?php echo date('h:i A', strtotime($row['end_time'])); ?></td>
                                </tr>
                            <?php }
                        } ?>
                        <tr>
                            <td style="border-bottom-style: solid; border-bottom-width: 1px; border-bottom-color: var(--para-color)"
                                colspan="3">
                                <button type="button" class="custom-btn" value="Monday" id="Sunday" onclick="edit('Sunday')"
                                        style="float: right">Edit schedule
                                </button>
                                <script type="text/javascript">
                                    $(function () {
                                        $('#Sunday').click(function (e) {
                                            $('#userForm').fadeIn().css("display", "flex");
                                        });
                                    });
                                </script>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="userForm">
        <div id="form">
            <form method="post" enctype="multipart/form-data" onsubmit="return checkValidation()" id="time-slot-form"
                  name="userForm">
                <div class="banner">
                    <h1>User</h1>
                </div>
                <p class="royal">Royal Hospital Management System </p>
                <p class="addUser" id="titleOperation">Set working schedule</p>
                <div class="newSlots">
                    <label for="start-time">Start Time:</label>
                    <label for="end-time">End Time:</label>
                </div>
                <div class="newSlots">
                    <input type="time" name="start-time[]" class="start-time" required>
                    <input type="time" name="end-time[]" class="end-time" required>
                </div>
                <div id="time-durations"></div>
                <div class="newSlots">
                    <button type="button" class="custom-btn" id="add-time-slot-btn">Add Time Slot</button>
                </div>
                <div class="newSlots">
                    <button type="submit" name="submit" class="custom-btn" id="">Submit</button>
                    <button name="cancel" id="cancel" class="custom-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <script src=<?php echo BASEURL . '/js/doctorWorkinghours.js' ?>></script>
    <script type="text/javascript">
        $(function () {
            $('#cancel').click(function () {
                $('#userForm').fadeOut();
            });
        });
    </script>

    </body>

    </html>
    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>