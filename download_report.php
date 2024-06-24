<?php

$currentMonth = date('F');

$file = "C:/xampp/htdocs/E-Project/Report/Shipment_Report_".$currentMonth."_2024.pdf";

if (isset($_GET['tracking_id'])) {
    $tracking_id = $_GET['tracking_id'];
    $file = "C:/xampp/htdocs/E-Project/Report/Courier_Report_" . $tracking_id . ".pdf";
}

if (file_exists($file)) {

    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;

} else {
    echo "The file does not exist.";
}
?>
