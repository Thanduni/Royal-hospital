<?php
session_start();
require_once("../conf/config.php");
?>
<div class="topbar">
    <div class="action" style="display: flex;">
        <?php
        $query = "select *, DATE(timestamp) as date, TIME(timestamp) as time from notification where nic = '" . $_GET['nic'] . "' and Status = '0'";
        $result = mysqli_query($con, $query);
        ?>
        <div style="margin: 20px" onclick="notificationToggle()">
            <i style="font-size: 20px;" class="fa-solid fa-bell"></i>
            <span class="badge"><?php echo mysqli_num_rows($result); ?></span>
        </div>
        <div class="profile" onclick="menuToggle()";>

            <?php
            $profilePic = $_GET['profilePic'];
            ?>
            <img class='profilePic' src=<?php echo BASEURL . '/uploads/' . $profilePic ?>
            alt='Upload Image'>
        </div>
        <div class="notification">
            <ul class="topbarul">
                <?php

                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <li>
                            <?php echo $row['Message']?>
                            <div style="margin: 5px; text-align: left;">
                                <div style="text-align: left">
                                    <p style="float: left"><?php echo $row['date'] ?></p>
                                    <p><?php echo $row['time'] ?></p>
                                </div>
                                <a style="float: right" href="<?php echo BASEURL . '/Patient/markRead.php?notID='.$row['notificationID']?>">
                                    Mark as read
                                </a>
                            </div>
                        </li>
                        <?php

                    }
                }else{
                    ?>
                    <li>There are no notifications</li>
                    <?php
                }
                ?>

            </ul>
        </div>
        <div class="menu">
            <h3><?php echo $_GET['name']; ?><br><span><?php echo $_GET['userRole'] ?></span></h3>
            <ul class="topbarul">
                <li><img src="../images/edit.svg" alt="profile image"><a href="#"><a href="<?php echo BASEURL . '/Doctor/updateDoctorProfile.php' ?>">Edit Profile</a></a></li>
                <li><img src="../images/logout.png" alt="profile image"><a href="<?php echo BASEURL . '/Homepage/logout.php?logout' ?>">Logout</a></li>
            </ul>
        </div>
    </div>
</div>
<script>
    function menuToggle(){
        const togglemenu = document.querySelector('.menu');
        togglemenu.classList.toggle('active');
    }
    function notificationToggle(){
        const notificationMenu = document.querySelector('.notification');
        notificationMenu.classList.toggle('active');
    }
</script>





