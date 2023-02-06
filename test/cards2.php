<?php

$conn = mysqli_connect("localhost", "root", "", "royalhospita");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT inventory.medicineName, inventory.badgeNo, inventory.quantity, inventory.manufacturedDate, inventory.expiredDate, 
               item.company, item.type, item.cost, canuse.state
        FROM inventory
        JOIN item ON inventory.item_id = item.id
        JOIN canuse ON inventory.canuse_id = canuse.id";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>Badge No</th>";
    echo "<th>Quantity</th>";
    echo "<th>Manufacture Date</th>";
    echo "<th>Expire Date</th>";
    echo "<th>Company</th>";
    echo "<th>Type</th>";
    echo "<th>Cost</th>";
    echo "<th>State</th>";
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["badge_no"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "<td>" . $row["manufacture_date"] . "</td>";
        echo "<td>" . $row["expire_date"] . "</td>";
        echo "<td>" . $row["company"] . "</td>";
        echo "<td>" . $row["type"] . "</td>";
        echo "<td>" . $row["cost"] . "</td>";
        echo "<td>" . $row["state"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

mysqli_close($conn);

?>