<?php
require_once("../conf/config.php");

if(isset($_GET['patientid'])){
    $patientID = $_GET['patientid'];
    $prescID = $_GET['prescriptionid'];
    $prescriptionID = $prescID;

    if(isset($_POST['save'])){
        //looping through medicines
        foreach($_POST['drugName'] as $key => $value){
            $drugName = $_POST['drugName'][$key];
            $dosage = $_POST['dosage'][$key];
            $days = $_POST['days'][$key];
            $frequency = $_POST['frequency'][$key];
            echo "<br>".$drugName."<br>";
            echo $dosage."<br>";
            echo $days."<br>";
            echo $frequency."<br>";
             
            //check if drug is available in hospital
            $get_item = "SELECT itemID,unit_price,unitType from item WHERE item_name =?";
            $get_item_query = mysqli_prepare($con, $get_item);
            mysqli_stmt_bind_param($get_item_query, "s", $value);
            mysqli_stmt_execute($get_item_query);
            $item_result = mysqli_stmt_get_result($get_item_query);

            if(mysqli_num_rows($item_result) > 0){
                //if available get itemID
                echo "Item available";
                $item_row = mysqli_fetch_assoc($item_result);
                $itemID = $item_row['itemID'];

                //check if there is enough quantity in inventory
                $check_inventory = "SELECT badgeNo, quantity*unit_quantity as quantity,unit_quantity FROM inventory WHERE itemID = ? AND expiredDate >= CURDATE() ORDER BY expiredDate ASC";
                $check_inventory_query = mysqli_prepare($con, $check_inventory);
                mysqli_stmt_bind_param($check_inventory_query, "i", $itemID);
                mysqli_stmt_execute($check_inventory_query);
                $inventory_result = mysqli_stmt_get_result($check_inventory_query);

                // $required_quantity = $dosage[$key] * $days[$key] * $frequency[$key];
                $required_quantity = $dosage * $days * $frequency;
                echo "required quantity = " . $required_quantity. "<br>";

                //this code will run until required quantity becomes 0
                while(mysqli_num_rows($inventory_result)>0 && $required_quantity > 0){
                    //if stock available in inventory
                    $inventory_row = mysqli_fetch_assoc($inventory_result);
                    $badgeNo = $inventory_row['badgeNo'];
                    $inventory_quantity = $inventory_row['quantity'];
                    $unit_quantity = $inventory_row['unit_quantity'];
                    echo "quantity(before) = " . $inventory_quantity. "<br>";

                    if($required_quantity <= $inventory_quantity){
                        $after_quantity = ($inventory_quantity - $required_quantity);
                         echo "after_quantity = ". $after_quantity. "<br>";
                        $new_quantity =  ($inventory_quantity - $required_quantity)/$unit_quantity;
                        echo "new_quantity = ". $new_quantity. "<br>";
                        $required_quantity = 0;
                    }
                    else {
                        $required_quantity -= $inventory_quantity;
                        $new_quantity = 0;
                    }

                    
                    $inv_update_query = "UPDATE inventory SET quantity = $new_quantity WHERE badgeNo = $badgeNo";
                    $inv_update_stmt = mysqli_query($con, $inv_update_query);
                    if($inv_update_stmt){
                        echo "Updated Successfully<br>";
                    }
                }

                if($required_quantity > 0){
                    // drug is out of stock
                    echo "Sorry, " . $value . " is out of stock.";
                }
                else {
                    // insert prescribed drug into database
                    
                    $save = "INSERT INTO prescribed_drugs(drug_name, quantity, days, frequency,prescriptionID,date) VALUES ('$value', '$dosage', '$days', '$frequency', '$prescriptionID', CURDATE());";
                    $stmt = mysqli_query($con, $save);
                    if($stmt){
                        echo "Prescription Added <br>";
                    }
                }
            }
            else{
                echo $value. " is not available";
            }
        }
    }
    header("Location: prescription.php?patientid=".$patientID);
}
               


?>