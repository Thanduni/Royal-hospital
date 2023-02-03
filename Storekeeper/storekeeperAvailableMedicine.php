<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && isset($_SESSION['userRole']) && $_SESSION['userRole']=="Storekeeper") {
?> 

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/storekeeperStyle.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/storekeeperViewStock.css' ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .next {
            position: initial;
            height: auto;
        }
    </style>
    <title>Storekeeper Available Medicine</title>
</head>
<body>
<div class="user">
    <?php include(BASEURL . '/Components/storekeeperSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $_SESSION['name']); ?>
    <div class="userContents" id="center">
        <div class="title">
            <img src="<?php echo BASEURL . '/images/logo5.png' ?>" alt="logo">
            Royal Hospital Management System
        </div>
        <ul>
            <li class="userType"><img src=<?php echo BASEURL . '/images/userInPage.svg' ?> alt="Storekeeper">
                Storekeeper
            </li>
            <li class="logout"><a href="<?php echo BASEURL . '/Homepage/logout.php?logout' ?>">Logout
                    <img
                            src=<?php echo BASEURL . '/images/logout.jpg' ?> alt="logout"></a>
            </li>
        </ul>
        <div class="arrow">
            <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Available Medicine
        </div>

        <div class="pad">
            
        </div>
        <!-- content start -->

        <div class="table-box">
                <table>
                <tr>
                <!-- <th>medicine ID</th> -->
                <th>Medicine name</th>
                <!-- <th>badge no.</th> -->
                <!-- <th>company name</th> -->
                <!-- <th>suplier name</th> -->
                <!-- <th>unit type</th> -->
                <!-- <th>unit cost</th> -->
                
                <!-- <th>manufacture date</th> -->
                <th>Quantity</th>
                <th>Type</th>
                <!-- <th>use state</th> -->
                
                </tr>


                <?php
                    $sql="SELECT medicineName FROM availableitemstock WHERE fullQuantity>0";
                    $allResult=mysqli_query($con,$sql);
                    $num=mysqli_num_rows($allResult);
                    
                    $numberPages=8;
                    $totalPages=ceil($num/$numberPages);
                    

                    
            if(isset($_GET['page'])){
                $page=$_GET['page'];
            }
            else{
                $page=1;
            }
            // "SELECT * FROM `availableitemstock` WHERE fullQuantity>0"

            $startinglimit=($page-1)*$numberPages;
            $sql="SELECT * FROM `availableitemstock` WHERE fullQuantity>0 limit ".$startinglimit.','.$numberPages;
            $result=mysqli_query($con,$sql);


                    if($result){
                        while($row=mysqli_fetch_assoc($result)){
                            // $itemId = $row['itemID'];
                            // $badgeNo = $row['badgeNo'];
                            $medicineName = $row['medicineName'];
                            // $companyName = $row['companyName'];
                            // $supplierName = $row['supplierName'];
                            // $unitType = $row['unitType'];
                            // $unitCost = $row['unitCost'];
                            $fullQuantity = $row['fullQuantity'];
                            // $manufacturedDate = $row['manufactureDate'];
                            $unitType = $row['unitType'];
                            // $useState = $row['useState'];

                            echo '<tr>
                            
                            <td>'.$medicineName.'</td>
                            
                            <td>'.$fullQuantity.'</td>
                            
                            <td>'.$unitType.'</td>
                            
                            
                            </tr>';
                        }
                    }
                ?>


                <!-- <tr>
                <td>Jill</td>
                <td>Smith</td>
                <td>50</td>
                <td>Jill</td>
                <td>Smith</td>
                <td>50</td>
                <td>Jill</td>
                <td>Smith</td>
                <td>50</td>
                <td>Jill</td>
                <td>Smith</td>
                
                </tr> -->
            
            </table>
        </div>

        <!-- pagination buttons -->
        

        <div class="pagination-container">
        <div class="pagination">
          <ul class="pagination-2">

          <?php
            for($btn=1;$btn<=$totalPages;$btn++){
                echo '<li class="page-number active"><a href="storekeeperAvailableMedicine.php?page='.$btn.'">'.$btn.'</a></li>';
            }

            // if(isset($_GET['page'])){
            //     $page=$_GET['page'];
            // }
            // else{
            //     $page=1;
            // }

            // $startinglimit=($page-1)*$numberPages;
            // $sql="Select * from `inventory` limit ".$startinglimit.','.$numberPages;
            // $result=mysqli_query($con,$sql);
          ?>
            <!-- <li class="page-number prev"><a href="#">&laquo;</a></li>
            <li class="page-number"><a href="#">1</a></li>
            <li class="page-number active"><a href="#">2</a></li>
            <li class="page-number prev"><a href="#">&raquo;</a></li> -->
          </ul>
        </div>
        </div>


        <!-- content start -->
        <?php include(BASEURL . '/Components/Footer.php'); ?>
    </div>
</div>
</body>
</html>

    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>



<!-- CREATE TRIGGER updateStock AFTER INSERT ON inventory FOR EACH ROW BEGIN UPDATE availableitemstock SET fullQuantity = fullQuantity + NEW.quantity WHERE medicineName = NEW.medicineName AND unitType = NEW.unitType; END;

full stock count update trigger -->