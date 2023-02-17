<style>
    <?php include'../css/nursetopbar.css';
    ?>
</style>

<div class="topbar">
<div class="action">
    <div class="profile" onclick="menuToggle()";>
        <img src="../images/Ellipse 21.jpg" alt="user-pic">
    </div>
    <div class="menu">
        <h3>Ms. Thanduni Aluthwala<br><span>Nursing Officer</span></h3>
        <ul>
            <li><img src="../images/user.png" alt="profile image"><a href="#">My Profile</a></li>
            <li><img src="../images/edit.png" alt="profile image"><a href="#">Edit Profile</a></li>
            <li><img src="../images/sign-out-alt.png" alt="profile image"><a href="#">Logout</a></li>
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