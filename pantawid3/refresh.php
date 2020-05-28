<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dswd";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tbl_item";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $data1 =$row["SRN"];
        $data2= $row["item_transmittal"];
        $data3= $row["position"];
        $data4= $row["status_id"];
        echo "<img src='ahol.PNG' alt='Norway' style='width:100%;'>";
        echo "<div class='data1'>" . $data1  . "</div>";
        echo "<div class='data2'>" . $data2  . "</div>";
        echo "<div class='data3'>" . $data3  . "</div>";
        echo "<div class='data4'>" . $data4  . "</div>";
    }
} else {
    echo "0 results";
}
$conn->close();


?>