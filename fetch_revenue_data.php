<?php

include ('connection.php');

$sql = "SELECT price FROM courier";
$result = $conn->query($sql);

$prices = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $prices[] = $row['price'];
    }
} else {
    echo json_encode(array('error' => 'No data found'));
    exit();
}


// Calculate total revenue and growth
$total_revenue = array_sum($prices);
$previous_revenue = -1;
$current_year = date("Y");
$previous_year = $current_year - 1;
$sql = "SELECT profit FROM yearly_profit WHERE year = $previous_year";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $previous_revenue = $row['profit'];
}

$growth_percentage = 100;
if ($previous_revenue > 0) {
   
    $growth_percentage = (($total_revenue - $previous_revenue) / $previous_revenue) * 100;
} else {
    $growth_percentage = 100;
}

$data = array(
    'total_revenue' => $total_revenue,
    'growth_percentage' => $growth_percentage
);

echo json_encode($data);
?>
