<style>
    <?php include'nursetopbar.css';
    include 'nursetopbar.css';
    ?>
</style>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
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