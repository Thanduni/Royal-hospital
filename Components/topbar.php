<?php
session_start();
require_once("../conf/config.php");
?>
<div class="topbar">
  <div class="action">
      <div class="profile" onclick="menuToggle()";>
        <?php
          $profilePic = $_GET['profilePic'];
          echo
          "<p align='middle'>"
        ?>
          <img class='profilePic' align='middle' src=<?php echo BASEURL . '/uploads/' . $profilePic ?>
          alt='Upload Image'>
      </div>
      <div class="menu">
          <h3><?php echo $_GET['name']; ?><br><span>User role</span></h3>
          <ul class="topbarul">
              <li><img src="../images/user.svg" alt="profile image"><a href="#">My Profile</a></li>
              <li><img src="../images/edit.svg" alt="profile image"><a href="#">Edit Profile</a></li>
              <li><img src="../images/logout.svg" alt="profile image"><a href="<?php echo BASEURL . '/Homepage/logout.php?logout' ?>">Logout</a></li>
          </ul>
      </div>
  </div>
</div>           
<script>
    function menuToggle(){
        const togglemenu = document.querySelector('.menu');
        togglemenu.classList.toggle('active')
    }
  </script> 





