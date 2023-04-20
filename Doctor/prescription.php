<?php
session_start();
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Doctor') {
    $nic = $_SESSION['nic'];
    $doctorID_query = "select doctorID from doctor join user on user.nic = doctor.nic where user.nic = $nic";
    $get_doctorID = mysqli_query($con,$doctorID_query);
    $row = mysqli_fetch_assoc($get_doctorID);
    $doctorID = $row["doctorID"];

?>
<?php
if(isset($_GET['prescriptionID'])){
    $prescriptionID = $_GET['prescriptionID'];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/doctorStyle.css' ?>">

    <link rel="stylesheet" href="<?php echo BASEURL . '/css/prescription.css' ?>">
    <title>Prescription</title>
</head>
<body>
    <div class="user">
        <?php 
        $name = urlencode( $_SESSION['name']);
        include(BASEURL . '/Components/doctorSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $_SESSION['name']); ?>
        <div class="userContents" id="center">
        <?php include(BASEURL.'/Components/topbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name);?>
                <div class="prescription-container">

                    <div class="tab-line">
                        <div class="medicine-button" id="medicine-button" onclick ="drugPrescription()">Prescribe Medicine</div>
                        <div class="test-button" id="test-button" onclick="testPrescription()">Prescribe Test</div>
                    </div>

                    <div class="prescribe-medicine-content">
                        <form action="#" class="insert-form" id="insert_form" method="post">
                            <div class="input-feild">
                                <table id="prescription-table">
                                    <tr>
                                        <th>Drug Name</th>
                                        <th>Dosage (per day)</th>
                                        <th>Frequency (per day)</th>
                                        <th>No of days</th>
                                    </tr>
                                    <div class="show-medicine">
                                        <?php
                                        if(isset($_POST['save'])){
                                            $drugName = $_POST['drugName'];
                                            $dosage = $_POST['dosage'];
                                            $days = $_POST['days'];
                                            $frequency = $_POST['frequency'];
                            
                                            foreach ($drugName as $key => $value){
                                             $save = "INSERT INTO prescribed_drugs(drug_name,days,quantity,frequency,prescriptionID) VALUES ('".$value."','".$dosage[$key]."','".$days[$key]."','".$frequency[$key]."','".$prescriptionID."');";
                            
                                             $query = mysqli_query($con,$save);
                                            }
                                        }

                                        ?>
                                    <tr>
                                        <td><input type="text" name="drugName[]"></td>
                                        <td><input type="number" name="dosage[]"></td>
                                        <td><input type="number" name="days[]"></td>
                                        <td><input type="number" name="frequency[]"></td>
                                        <td><input type="button" name="addd" class="add" value="Add"></td>
                                    </tr>
                                    </div>
                                </table>
                                <input type="submit" class="save-prescription" name="save" id="save" value="save data">
                            </div>  
                        </form> 
                        
                        <div class="show-prescription">
                            <table class="table">
                                <thead>
                                    <th>Drug Name</th>
                                    <th>Dosage (per day)</th>
                                    <th>Frequency (per day)</th>
                                    <th>No of days</th>
                                    <th>Edit</th>
                                    <th>Remove</th>
                                </thead>
                                <tbody>
                                <?php 
                                $select = "SELECT * from prescribed_drugs where prescriptionID =$prescriptionID";
                                $result = mysqli_query($con,$select);
                            
                                while($row= mysqli_fetch_array($result)){?>
                                <tr>
                                    <td><?php echo $row['drug_name'] ?></td>
                                    <td><?php echo $row['quantity'] ?></td>
                                    <td><?php echo $row['frequency'] ?></td>
                                    <td><?php echo $row['days'] ?></td>
                                    <td><input type="button" name="edit" class="edit-prescription" value="Edit"></td>
                                    <td><input type="button" name="remove" class="remove-prescription" value="Remove"></td>
                                </tr>
                                <?php
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- <div class="prescribe-test-content">
                        <form action="post">
                            <div class="prescription-group">
                                <label>Test Name </label>
                                <input type="text" class="form-control" placeholder="Test Name" name="Test Name">
                            </div>
                            <button type="submit" name ="submit-test-prescription">Submit</button>
                        </form>
                    </div> -->
                </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        // to add rows
        $(document).ready(function(){
            $(".add").click(function(e){    //pass parameter e
                e.preventDefault();         //stop page refresh
                $("#prescription-table").append(`<tr>
                    <td><input type="text" name="drugName[]"></td>
                    <td><input type="number" name="dosage[]"></td>
                    <td><input type="number" name="days[]"></td>
                    <td><input type="number" name="frequency[]"></td>
                    <td><input type="button" name="remove" class="remove" value="Remove"></td>
                    </tr>`);
            });

            //remove rows
            $(document).on('click', '.remove', function(e){
                e.preventDefault();
                let = row_med = $(this).parent().parent();  //select parent of parent of remove btn.. which is <tr>
                $(row_med).remove();
            });



        });
    </script>
<script>

// <form autocomplete="off" action="/prescription.php"><div class="autocomplete">
//                             <label for="name"> NAme</label>
//                             <input type="text" id="drugName" name="drugName">
//                             </div></form>
//     var DrugNames = ["Panadol","Anastrozol","AndroGel","Annovera","Erleada"];


// function autocomplete(input_text, arr){
//     var currentFocus;

//     input_text.addEventListner("input",function(e){
//         var a,b,i,val=this.value;
//         closeAllLists();

//         if(!val){
//             return false;
//         }
//         currentFocus =-1;

//         a = document.createElement("DIV");
//         a.setAttribute("id", this.id + "autocomplete-list");
//         a.setAttribute("class","autocomplete-items");

//         this.parentNode.appendChild(a);

//         for (i = 0; i < arr.length; i++) {
//             /*check if the item starts with the same letters as the text field value:*/
//             if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
//               /*create a DIV element for each matching element:*/
//               b = document.createElement("DIV");
//               /*make the matching letters bold:*/
//               b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
//               b.innerHTML += arr[i].substr(val.length);
//               /*insert a input field that will hold the current array item's value:*/
//               b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
//               /*execute a function when someone clicks on the item value (DIV element):*/
//                   b.addEventListener("click", function(e) {
//                   /*insert the value for the autocomplete text field:*/
//                   input_text.value = this.getElementsByTagName("input")[0].value;
//                   /*close the list of autocompleted values,
//                   (or any other open lists of autocompleted values:*/
//                   closeAllLists();
//               });
//               a.appendChild(b);
//             }
//           }
//       });
//       /*execute a function presses a key on the keyboard:*/
//       input_text.addEventListener("keydown", function(e) {
//           var x = document.getElementById(this.id + "autocomplete-list");
//           if (x) x = x.getElementsByTagName("div");
//           if (e.keyCode == 40) {
//             /*If the arrow DOWN key is pressed,
//             increase the currentFocus variable:*/
//             currentFocus++;
//             /*and and make the current item more visible:*/
//             addActive(x);
//           } else if (e.keyCode == 38) { //up
//             /*If the arrow UP key is pressed,
//             decrease the currentFocus variable:*/
//             currentFocus--;
//             /*and and make the current item more visible:*/
//             addActive(x);
//           } else if (e.keyCode == 13) {
//             /*If the ENTER key is pressed, prevent the form from being submitted,*/
//             e.preventDefault();
//             if (currentFocus > -1) {
//               /*and simulate a click on the "active" item:*/
//               if (x) x[currentFocus].click();
//             }
//           }
//       });
//       function addActive(x) {
//         /*a function to classify an item as "active":*/
//         if (!x) return false;
//         /*start by removing the "active" class on all items:*/
//         removeActive(x);
//         if (currentFocus >= x.length) currentFocus = 0;
//         if (currentFocus < 0) currentFocus = (x.length - 1);
//         /*add class "autocomplete-active":*/
//         x[currentFocus].classList.add("autocomplete-active");
//       }
//       function removeActive(x) {
//         /*a function to remove the "active" class from all autocomplete items:*/
//         for (var i = 0; i < x.length; i++) {
//           x[i].classList.remove("autocomplete-active");
//         }
//       }
//       function closeAllLists(elmnt) {
//         /*close all autocomplete lists in the document,
//         except the one passed as an argument:*/
//         var x = document.getElementsByClassName("autocomplete-items");
//         for (var i = 0; i < x.length; i++) {
//           if (elmnt != x[i] && elmnt != input_text) {
//           x[i].parentNode.removeChild(x[i]);
//         }
//       }
//     }
//     /*execute a function when someone clicks in the document:*/
//     document.addEventListener("click", function (e) {
//         closeAllLists(e.target);
//     });
// }

//     autocomplete(document.getElementById("drugName"), DrugNames);
</script>
</body>
</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>