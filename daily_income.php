<?php

include('connection.php');
$current_week = date("Y-m-d", strtotime("this week"));
$sql = "SELECT price, date_created, id FROM courier WHERE date_created >= '$current_week' ORDER BY date_created ASC";
$result = $conn->query($sql);

$data = array();
$i = 1;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[$i] = array("price" => $row["price"], "date_created" => $row["date_created"]);
        $i++;
    }
}
header('Content-Type: application/json');
echo json_encode($data);
?>