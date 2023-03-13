<?php
session_start();
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Doctor') {
  
?>
<?php
$mindate = date("Y-m-d");
$mintime = date("h:i");
if(isset($_GET['patientid'])){
    $patientID = $_GET['patientid'];
    $patientName = $_GET['name'];
    $age = $_GET['age'];
}
?>

<!-- Writing data into database -->
<?php 
if (isset($_POST['submit'])) {
    $drugName = $_POST['drugName'];
    $dosage = $_POST['dosage'];
    $days = $_POST['days'];
    $frequency = $_POST['frequency'];

    $drug_prescription = "INSERT into prescribed_drugs(drug_name,patientID,days,quantity,frequency) values('$drugName','$patientID','$days','$dosage','$frequency');";
    $drug_prescription_write =mysqli_query($con,$drug_prescription);

    // if($result){

    // }
}
?>
<?php
if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $investigation = $_POST['investigation'];
    $impression = $_POST['impression'];

    $prescription = "INSERT into prescription(date,patientID,doctorID,investigation,impression) values('$date','$patientID','$doctorID','$investigation','$impression');";
    $prescription_write = mysqli_query($con,$prescription);
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
                <script src="<?php echo BASEURL . '/js/prescription.js' ?>"></script>
                <script src="<?php echo BASEURL . '/js/searchDrugName.js' ?>"></script>
                    <div class="tab-line">
                        <div class="medicine-button" id="medicine-button" onclick ="drugPrescription()">Prescribe Medicine</div>
                        <div class="test-button" id="test-button" onclick="testPrescription()">Prescribe Test</div>
                    </div>
                    <div class="prescribe-medicine-content">
                        <form method="post">
                            <div class="first-row">
                                <div class="form-group">
                                    <label>Name: </label>
                                    <input type="text" value="<?php echo $patientName?>">
                                </div>
                                <div class="form-group">
                                    <label>Patient ID: </label>
                                    <input type="text" value ="<?php echo $patientID?>">
                                </div>
                                
                                
                            </div>
                            <div class="second-row">
                                <div class="form-group">
                                    <label>Age: </label>
                                    <input type="text" value="<?php echo $age?>">
                                </div>
                                <div class="form-group">
                                    <label>Date: </label>
                                    <input type="date" name="date" value ="<?php echo date('Y-m-d') ?>" min="<?php echo $mindate?>">
                                </div>
                            </div> 
                            <div class="third-row">
                                <div class="form-group">
                                    <label>Investigation: </label>
                                    <input type="text" name="investigation" >
                                </div>
                                <div class="form-group">
                                    <label>Impression: </label>
                                    <input type="text" name="impression">
                                </div>
                            </div>

                            
                            <div class="form-middle">
                                <table id="prescription-table">
                                    <thead>
                                        <th>Drug Name</th>
                                        <th>Dosage (per day)</th>
                                        <th>Frequency (per day)</th>
                                        <th>No of days</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <!-- <td><form autocomplete="off" action="/prescription.php"><div class="autocomplete"><input type="text" id="drugName" name="drugName"></div></form></td> -->
                                            <!-- <ul class="list"></ul> -->
                                            
                                            <td><input type="text" name="drugName"></td>
                                            <td><input type="number" name="dosage"></td>
                                            <td><input type="number" name="days"></td>
                                            <td><input type="number" name="frequency"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                </form>
                                <img src="../images/pluss.png" alt="+" id ="addRowButton" onclick="addRow()">
                            </div>
                            <button class="addPrescription-button" type="submit" name="submit">Submit</button>
                            <!-- <form autocomplete="off" action="/prescription.php"><div class="autocomplete">
                            <label for="name"> NAme</label>
                            <input type="text" id="drugName" name="drugName">
                            </div></form> -->
                    </div>
                    <div class="prescribe-test-content">
                        <form action="post">
                            <div class="prescription-group">
                                <label>Test Name </label>
                                <input type="text" class="form-control" placeholder="Test Name" name="Test Name">
                            </div>
                            <button type="submit" name ="submit-test-prescription">Submit</button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
<script>
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