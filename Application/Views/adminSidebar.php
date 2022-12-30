    <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
    <label for="openSidebarMenu" class="sidebarIconToggle">
        <div class="spinner diagonal part-1"></div>
        <div class="spinner horizontal"></div>
        <div class="spinner diagonal part-2"></div>
    </label>
    <div id="sidebarMenu">
        <div class="welcomeUser">
            <?php
            $profilePic = $_SESSION['profilePic'];
            echo
            "<p align='middle'>"
            ?>
            <img class='profilePic' align='middle' src=<?php echo BASEURL . '/public/assets/uploads/' . $profilePic ?>
            alt='Upload Image'>
            <?php
            echo $_SESSION['name'] . "</p>";
            ?>
        </div>
        <ul class="sidebarMenuInner">
            <li><a href="" target="_blank"><img class="icons"
                                                src=<?php echo BASEURL . '/public/assets/images/dashboard.svg' ?> alt="dashboard"
                                                align="middle">
                    <p>Dashboard</p>
                </a></li>
            <li><a href="<?php echo BASEURL.'/Admin'?>" target="_blank"><img class="icons"
                                                src=<?php echo BASEURL . '/public/assets/images/user.svg' ?> alt="user"
                                                align="middle">
                    <p>User</p>
                </a></li>
            <li><a href="" target="_blank"><img class="icons"
                                                src=<?php echo BASEURL . '/public/assets/images/doctor.svg' ?> alt="doctor"
                                                align="middle">
                    <p>Doctor</p>
                </a></li>
            <li><a href="" target="_blank"><img class="icons"
                                                src=<?php echo BASEURL . '/public/assets/images/nurse.svg' ?> alt="nurse"
                                                align="middle">
                    <p>Nurse</p>
                </a></li>
            <li><a href="" target="_blank"><img class="icons"
                                                src=<?php echo BASEURL . '/public/assets/images/receptionist.svg' ?> alt="noticeboard"
                                                align="middle">
                    <p>Receptionist</p>
                </a></li>
            <li><a href="" target="_blank"><img class="icons"
                                                src=<?php echo BASEURL . '/public/assets/images/noticeboard.svg' ?> alt="noticeboard"
                                                align="middle">
                    <p>Noticeboard</p>
                </a></li>
        </ul>
    </div>