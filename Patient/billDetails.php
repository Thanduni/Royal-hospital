<?php 
session_start();
require_once("../conf/config.php");

if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Patient') {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL.'/css/style.css';?>">
    <link rel="stylesheet" href="<?php echo BASEURL.'/css/patientDash.css';?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="<?php echo BASEURL . '/js/appoinment.js'; ?>"></script>
    <link rel="stylesheet" href="<?php echo BASEURL.'/css/patientAppointment.css' ?>">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Bill Details</title>
    <style>
        body{
            background-color: #f9f8ff;
        }

        @media only screen and (max-width: 1430px) {
            body {
                background-color: #f9f8ff;
            }
        }
        .total .btn1{
            font-weight: 0;
            font-size: 16px;
            color: #fff;
            background-color:#0066cc;
            padding: 10px 30px;
            border: 2px solid #0066cc;
            box-shadow: rgb(0, 0, 0) 0px 0px 0px 0px;
            border-radius: 50px;
            transition : 1000ms;
            transform: translateY(0);
            display: flex;
            flex-direction: row;
            align-items: center;
            cursor: pointer;
            float: left;
        }

        .total .btn1:hover{

        transition : 1000ms;
        padding: 10px 50px;
        transform : translateY(-0px);
        background-color: #fff;
        color: #0066cc;
        border: solid 2px #0066cc;
        }

        .np_cost{
            display: grid;
            justify-content: start;
            margin-top: 20px;
        }

        .t_cost{
            display: grid;
            justify-content: start;
            margin-top: 100px;
        }

        .total .card-image img{
            width:300px;
            height: 200px;
        }

        .mcontent{
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            box-sizing: unset;
            width: 1430px;
            margin: 20px 20px 50px 50px;
            position: relative;
        }

        .pcontent {
            padding: 10px 10px;
            /* margin-top: 18px; */
            display: flex;
            /* margin-left: 50px; */
            float: left;
            height: 620px;
            width: 18%;
            flex: 1;
            background-color: #fff;
            box-sizing: border-box;
            position: relative;
            justify-content: space-between;
            flex-wrap: wrap;
            align-content: center;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <div class="user">

    <?php
    $total = 0;
    $total1 = 0;
    $total2 = 0;
    $npaid = 0;
    $name = urlencode( $_SESSION['name']);
    include(BASEURL.'/Components/PatientSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
    <!-- <?php //include(BASEURL.'/Components/PatientSidebar.php?profilePic='.$_SESSION['profilePic']."&name".$_SESSION['name']); ?> -->
    
    <div class="userContents"  id="center">
        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL.'/Components/patientTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
        ?>
        <div class="arrow">
                <img src="../images/arrow-right-circle.svg" alt="arrow">Bills
        </div>

        <div class="mcontent">
            <div class="pcontent">
                <div class="wrapper_p">
                <div class="table_header"><h3 style="color: var(--primary-color);">Bill Details</h3></div>
                <div class="table">
                    <div class="row headerT">
                        <div class="cell">Date</div>
                        <div class="cell">Type</div>
                        <div class="cell">Name</div>
                        <div class="cell">Quantity</div>
                        <div class="cell">Status</div>
                        <div class="cell">Cost</div>
                    </div>
                    <?php
                    $nic = $_SESSION['nic'];
                    $pid_query = "SELECT patientID FROM patient WHERE nic = '$nic'";
                    $result_pid = mysqli_query($con, $pid_query);
                    $pid = mysqli_fetch_assoc($result_pid)['patientID'];

                    $query = "select p.date,p.paid_status,p.quantity,p.item_flag,s.service_name,p.quantity*s.cost from purchases p inner join service s on p.item = s.serviceID where p.patientID = $pid and p.item_flag = 's';";
                    $query1 = "select p.date,p.paid_status,p.quantity,p.item_flag,t.test_name,p.quantity*t.cost from purchases p inner join test t on p.item = t.testID where p.patientID = $pid and p.item_flag = 't';";
                    $query2 = "select p.date,p.paid_status,p.quantity,p.item_flag,i.item_name,p.quantity*i.unit_price from purchases p inner join item i on p.item = i.itemID where p.patientID = $pid and p.item_flag = 'd';";

                    $qu1 = "select sum(p.quantity*s.cost) from purchases p inner join service s on p.item = s.serviceID where p.patientID = $pid and p.paid_status = 'not paid' and p.item_flag = 's';";
                    $qu2 = "select sum(p.quantity*t.cost) from purchases p inner join test t on  p.item = t.testID where p.patientID = $pid and p.paid_status = 'not paid' and p.item_flag = 't';"; //test
                    $qu3 = "select sum(p.quantity*i.unit_price) from purchases p inner join item i on  p.item = i.itemID where p.patientID = $pid and p.paid_status = 'not paid' and p.item_flag = 'd';"; //drug

                    $res1 = mysqli_query($con,$qu1);
                    $res2 = mysqli_query($con,$qu2);
                    $res3 = mysqli_query($con,$qu3);

                    $npaid1 = mysqli_fetch_assoc($res1);
                    $npaid2 = mysqli_fetch_assoc($res2);
                    $npaid3 = mysqli_fetch_assoc($res3);

                    $npaid = $npaid1['sum(p.quantity*s.cost)'] + $npaid2['sum(p.quantity*t.cost)'] + $npaid3['sum(p.quantity*i.unit_price)'];
                    $_SESSION['total'] = $npaid;

                    $result = mysqli_query($con,$query);
                    $result1 = mysqli_query($con,$query1);
                    $result2 = mysqli_query($con,$query2);

                        while($rows = mysqli_fetch_assoc($result)){?>
                            <div class="row">
                            <div class="cell" data-title="Date">
                                    <?php echo $rows['date']; ?>
                                </div>
                                <div class="cell" data-title="Date">
                                    <?php 
                                    if($rows['item_flag'] == 's')
                                    {
                                        echo 'Service';
                                    }
                                    elseif($rows['item_flag'] == 't')
                                    {
                                        echo 'Test';
                                    }
                                    elseif($rows['item_flag'] == 'd')
                                    {
                                        echo 'Drugs';
                                    }; ?>
                                </div>
                                
                                <div class="cell" style="width:250px;" data-title="Status">
                                    <?php echo $rows['service_name']; ?>
                                </div>
                                <div class="cell" data-title="Total Amount">
                                    <?php echo $rows['quantity']; ?>
                                </div>
                                <div class="cell" data-title="Bill Time">
                                    <?php
                                    if($rows['paid_status'] == 'paid')
                                    {
                                        echo 'Paid';
                                    }
                                    elseif($rows['paid_status'] == 'not paid')
                                    {?>
                                        <a style="color:red"> <?php echo 'Not Paid'; ?></a>
                                    <?php
                                    }
                                    ; ?>
                                </div>
                                <div class="cell" data-title="Bill Time">
                                    <?php echo $rows['p.quantity*s.cost'].'.00'; 
                                    $total = $total + $rows['p.quantity*s.cost'].'.00'?>
                                </div>
                            </div>

                    <?php
                    }
                    while($rows = mysqli_fetch_assoc($result1)){?>
                            <div class="row">
                            <div class="cell" data-title="Date">
                                    <?php echo $rows['date']; ?>
                                </div>
                                <div class="cell" data-title="Date">
                                    <?php 
                                    if($rows['item_flag'] == 's')
                                    {
                                        echo 'Service';
                                    }
                                    elseif($rows['item_flag'] == 't')
                                    {
                                        echo 'Test';
                                    }
                                    elseif($rows['item_flag'] == 'd')
                                    {
                                        echo 'Drugs';
                                    }; ?>
                                </div>
                                
                                <div class="cell" style="width:250px;" data-title="Status">
                                    <?php echo $rows['test_name']; ?>
                                </div>
                                <div class="cell" data-title="Total Amount">
                                    <?php echo $rows['quantity']; ?>
                                </div>
                                <div class="cell" data-title="Bill Time">
                                    <?php
                                    if($rows['paid_status'] == 'paid')
                                    {
                                        echo 'Paid';
                                    }
                                    elseif($rows['paid_status'] == 'not paid')
                                    {?>
                                        <a style="color:red"> <?php echo 'Not Paid'; ?></a>
                                    <?php
                                    }
                                    ; ?>
                                </div>
                                <div class="cell" data-title="Bill Time">
                                    <?php echo $rows['p.quantity*t.cost'].'.00'; 
                                    $total1 = $total1 + $rows['p.quantity*t.cost'].'.00'?>
                                </div>
                            </div>

                    <?php
                    }
                    while($rows = mysqli_fetch_assoc($result2)){?>
                            <div class="row">
                            <div class="cell" data-title="Date">
                                    <?php echo $rows['date']; ?>
                                </div>
                                <div class="cell" data-title="Date">
                                    <?php 
                                    if($rows['item_flag'] == 's')
                                    {
                                        echo 'Service';
                                    }
                                    elseif($rows['item_flag'] == 't')
                                    {
                                        echo 'Test';
                                    }
                                    elseif($rows['item_flag'] == 'd')
                                    {
                                        echo 'Drugs';
                                    }; ?>
                                </div>
                                
                                <div class="cell" style="width:250px;" data-title="Status">
                                    <?php echo $rows['item_name']; ?>
                                </div>
                                <div class="cell" data-title="Total Amount">
                                    <?php echo $rows['quantity']; ?>
                                </div>
                                <div class="cell" data-title="Bill Time">
                                    <?php
                                    if($rows['paid_status'] == 'paid')
                                    {
                                        echo 'Paid';
                                    }
                                    elseif($rows['paid_status'] == 'not paid')
                                    {?>
                                        <a style="color:red"> <?php echo 'Not Paid'; ?></a>
                                    <?php
                                    }
                                    ; ?>
                                </div>
                                <div class="cell" data-title="Bill Time">
                                    <?php echo $rows['p.quantity*i.unit_price'].'.00'; 
                                    $total2 = $total2 + $rows['p.quantity*i.unit_price'].'.00'?>
                                </div>
                            </div>

                    <?php
                    }
                    ?>
                </div>
                </div>
                <div class="total">
                    <a class="t_cost"><h1>Total Cost:<h2>LKR <?php echo($total+$total1+$total2).'.00'; ?></h2></h1></a>
                    <?php $_SESSION['total'] = $npaid.'.00'; ?>
                    <div class="card-image"><img src="<?php echo BASEURL.'/images/mastercard.jpg' ?>"></div>
                    <a class="np_cost"><h1>Total Not Paid Cost:<h2 id="pay" style="color:red;">LKR <?php echo$npaid.'.00'; ?></h2></h1></a>
                    <button id="pay-btn" class="btn1" onclick="func()">Pay Now</button>
            </div>
            </div>
        </div>
    </div>
</div>       
        <div id="login-modal">
        <div class="modal">
            <div class="login-form">
            <h2>Put Your Appointment</h2><br>
            <form  action="" method="post">
                <label for="">Date</label><br><br>
                <input type="date" name="date" id="date"><br><br>
                <label for="">Department</label><br><br>
                <select name="department" id="department">
                    <option value="">Please A Select Department</option>
                    <option value="Anesthetics">Anesthetics</option>
                    <option value="Cardiology">Cardiology</option>
                    <option value="Gastroentology">Gastroentology</option>
                </select><br><br>
                <label for="">Doctor</label><br><br>
                <select name="doctor" id="doctor">
                    <option value="">Select A Department First</option>
                </select><br><br>
                <label for="">Message</label><br><br>
                <textarea name="msg" id="msg" cols="30" rows="3" placeholder="Your Message To The Doctor"></textarea><br><br>
                <!-- <br><br><input type="submit" value="Submit" id="btn" name="btn" class="btn"> -->
               
                <button type="submit" name="cancel" id="cancel" value="cancel" class="cancel-modal">Cancel</button>
                <button type="submit" name="submit" id="btn" value="submit" onclick="">Submit</button>
            </form>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        $(function(){
            $('#openform').click(function(){
                $('#login-modal').fadeIn().css("display","flex");
            });
            $('.cancel-modal').click(function(){
                $('#login-modal').fadeOut();
            });
        });
        
        function func(){
            if(document.getElementById("pay").innerHTML == 'LKR 0.00')
            {
            document.getElementById("pay-btn").addEventListener("click", function(event){
            event.preventDefault()
            });
            }
            else{
                location.href='<?php echo BASEURL.'/Patient/stripe/checkout.php'?>';
            }
        }
    </script>
</body>
</html>
<?php } ?>