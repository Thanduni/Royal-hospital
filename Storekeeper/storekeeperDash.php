<?php
require_once("DBconnect.php");
session_start();
if (isset($_SESSION['mailaddress'])) {
    ?>



    <!DOCTYPE html>
    <html lang="en">
    <!--    <php echo "" ?>-->
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/storekeeper_dashboard.css">
        <link rel="stylesheet" href="css/style.php">
        <title>Storekeeper Dashboard </title>
        <style>

            
        </style>
    </head>

    <body>
    <div class="user">
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
                <img class='profilePic' align='middle' src='/uploads/$profilePic' alt='Upload Image' width=50px>
                    "<p align='middle'>
                    ". $_SESSION['name']. "</p>";
                    ?>
            </div>
            <ul class="sidebarMenuInner">
                <li><a href="/storekeepeDash.php/" target="_blank"><img class="icons" src="/images/dashboard.svg" alt="dashboard"
                align="middle">
                        <p>Dashboard</p>
                    </a></li>
                    <li><a href="/storekeeper_add_medicine.php/" target="_blank"><img class="icons" src="/images/receptionist.svg" alt="noticeboard"
                        align="middle">
                        <p>Add Medicine</p>
                        </a></li>
                        <li><a href="" target="_blank"><img class="icons" src="/images/noticeboard.svg" alt="noticeboard"
                                                align="middle">
                        <p>View stocks</p>
                        </a></li>
                <li><a href="" target="_blank"><img class="icons" src="/images/doctor.svg" alt="doctor" align="middle">
                        <p>Profile</p>
                    </a></li>
                
                
            </ul>
        </div>
        <div class="userContents" id="center">
            <div class="title">
                <img src="/images/logo5.png" alt="logo">
                Royal Hospital Management System
            </div>
            <ul>
                <li class="userType"><img src="/images/userInPage.svg" alt="admin"> Storekeeper</li>
                <li class="logout"><a href="logout.php?logout">Logout <img src="/images/logout.jpg" alt="logout"></a>
                </li>
            </ul>
            <div class="arrow">
                <img src="/images/arrow-right-circle.svg" alt="arrow">Dashboard
            </div>
            
            <div class="userClass">
                <div class="left">
                    <div class="tablebox">
                        <table>



                            <tr>
                    
                                <th>#</th>
                    
                                <th>MEDICINE</th>
                    
                                <th>AVAILABILITY</th>
                    
                                
                            </tr>
                            
                    
                            <tr>
                    
                                <td>1</td>
                    
                                <td>Medicine 1</td>
                    
                                <td>Available</td>
                    
                                
                    
                            </tr>
                    
                            <tr>
                    
                                <td>2</td>
                    
                                <td>Medicine 2</td>
                    
                                <td>Not Available</td>
                    
                                
                    
                            </tr>
                    
                            <tr>
                    
                                <td>3</td>
                    
                                <td>Medicine 3</td>
                    
                                <td>Available</td>
                    
                                
                    
                            </tr>
                    
                            <tr>
                    
                                <td>4</td>
                    
                                <td>Medicine 4</td>
                    
                                <td>Available</td>
                    
                                
                    
                            </tr>
                    
                            <tr>
                    
                                <td>5</td>
                    
                                <td>Medicine 5</td>
                    
                                <td>Not Available</td>
                    
                                
                    
                            </tr>
                    
                            <tr>
                    
                                <td>6</td>
                    
                                <td>Medicine 6</td>
                    
                                <td>Not Available</td>
                    
                               
                    
                            </tr>
                    
                            <tr>
                    
                                <td>7</td>
                    
                                <td>Medicine 7</td>
                    
                                <td>Available</td>
                    
                                
                    
                            </tr>
                    
                            <tr>
                    
                                <td>8</td>
                    
                                <td>Medicine 8</td>
                    
                                <td>Not Available</td>
                    
                                
                    
                            </tr>
                    
                        </table>
                    </div>
                </div>

                <div class="right">
                    <div class="up">
                        <p>
                            <a href="http://localhost/project/Royal-hospital/storekeeper_add_medicine.php/"><button type="button">View Medicine</button></a>
                        </p>
                    </div>

                    <div class="down">
                        <table>



                            <tr>
                    
                                <th>#</th>
                    
                                <th>LOW STOCK MEDICINE</th>
                    
                            
                    
                                
                            </tr>
                    
                    
                            <tr>
                    
                                <td>1</td>
                    
                                <td>Medicine 1</td>

                    
                                
                    
                            </tr>
                    
                            <tr>
                    
                                <td>2</td>
                    
                                <td>Medicine 2</td>
                    
                           
                    
                                
                    
                            </tr>
                    
                            <tr>
                    
                                <td>3</td>
                    
                                <td>Medicine 3</td>
                    
                             
                    
                                
                    
                            </tr>
                    
                            <tr>
                    
                                <td>4</td>
                    
                                <td>Medicine 4</td>
                    
                              
                    
                                
                    
                            </tr>
                    
                            <tr>
                    
                                <td>5</td>
                    
                                <td>Medicine 5</td>
                    
                               
                    
                                
                    
                            </tr>
                    
                            
                    
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    </body>

    </html>
    <?php
} else {
    header("location:login.php");
}
?>