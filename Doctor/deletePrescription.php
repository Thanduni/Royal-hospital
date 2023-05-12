<?php
require_once("../conf/config.php");

if (isset($_GET['pdID'])) {
    $pdID = $_GET['pdID'];
    $patientID = $_GET['patientID'];

    // select the drug name and quantity from the prescribed_drugs table
    $select = "SELECT drug_name,date, days*quantity*frequency as Prescibed_quantity FROM prescribed_drugs WHERE pdID = '$pdID'";
    $result = mysqli_query($con, $select);
    $row = mysqli_fetch_assoc($result);
    $drugName = $row['drug_name'];
    $prescribed_date = $row['date'];
    $Prescibed_quantity = $row['Prescibed_quantity'];
    echo "Prescribed quantity ". $Prescibed_quantity. "<br>";

    //get itemID
    $itemID_query = "SELECT itemID,unit_quantity from item WHERE item_name = '$drugName'";
    $get_itemID = mysqli_query($con,$itemID_query);

    //check if the medicine was in stores
    if(mysqli_num_rows($get_itemID)>0){
        $item_row = mysqli_fetch_assoc($get_itemID);
        $itemID = $item_row['itemID'];
        $unit_quantity = $item_row['unit_quantity'];

        mysqli_begin_transaction($con);

        try{
            //get badgeNo
            $get_unit_quantity = "SELECT badgeNo from inventory WHERE itemID = $itemID AND expiredDate >= CURDATE() ORDER BY expiredDate ASC limit 1";
            $get_unit_quantity_query = mysqli_query($con,$get_unit_quantity);
            $get_results = mysqli_fetch_assoc($get_unit_quantity_query);
            $badgeNo = $get_results['badgeNo'];

            //quantity in inventory table -> how many units in a badge
            $quantity = $Prescibed_quantity/$unit_quantity;

            // update the inventory
            $update = "UPDATE inventory SET quantity = quantity + '$quantity' WHERE itemID = '$itemID' AND badgeNo = '$badgeNo';";
            mysqli_query($con, $update);

            //delete from purchase table
            $delete_from_purchases = "DELETE from purchases WHERE item ='$itemID' AND date = '$prescribed_date' AND patientID = '$patientID'";
            mysqli_query($con,$delete_from_purchases);

            //delete from prescription table
            $delete = "DELETE from prescribed_drugs WHERE pdID = ?;";
            $stmt = mysqli_prepare($con, $delete);
            mysqli_stmt_bind_param($stmt, "s", $pdID);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            //commit transaction
            mysqli_commit($con);
            header("Location: prescription.php?patientid=".$patientID);
        }
        catch(EXception $e){
            //rollback
            mysqli_rollback($con);
            echo "Error: " . $e->getMessage();
        }        
    }
    else{
        $delete = "DELETE FROM prescribed_drugs WHERE pdID = ?;";
        $stmt = mysqli_prepare($con, $delete);
        mysqli_stmt_bind_param($stmt, "s", $pdID);
        mysqli_stmt_execute($stmt);

        $affectedRows = mysqli_stmt_affected_rows($stmt);

        if ($affectedRows > 0) {
            // Deletion was successful
            header("Location: prescription.php?patientid=".$patientID);
        } else {
            // No rows were affected, deletion may not have occurred
            echo "Deletion did not execute properly.";
        }

        mysqli_stmt_close($stmt);

    }
}

else if(isset($_GET['ptID'])){
    $ptID = $_GET['ptID'];
    $patientID = $_GET['patientID'];

    $delete_test = "DELETE from prescribed_tests WHERE ptID = $ptID";
    $delete_test_query = mysqli_query($con,$delete_test);
    if($delete_test_query){
        header("Location: prescriptionTest.php?patientid=".$patientID);
    }
}
