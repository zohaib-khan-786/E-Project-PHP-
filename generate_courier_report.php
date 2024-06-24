<?php
require 'vendor/autoload.php';
include('connection.php');
session_start();

if (!isset($_SESSION["sessionName"])) {
    header("location:./login.php");
    exit();
}

if (!isset($_GET['tracking_id'])) {
    echo "No tracking ID provided.";
    exit();
}

$tracking_id = $_GET['tracking_id'];

$sql = "SELECT reference_id, sender_name, sender_address, recipient_name, recipient_address, status, date_created FROM courier WHERE reference_id = '$tracking_id'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "No courier found with the provided tracking ID.";
    exit();
}

$courier = $result->fetch_assoc();

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Courier Management System');
$pdf->SetTitle('Courier Report');
$pdf->SetSubject('Courier Report for Tracking ID: ' . $tracking_id);
$pdf->SetKeywords('TCPDF, PDF, courier, report, tracking');

$pdf->SetHeaderData('', 0, 'Courier Report', 'Generated by Courier Management System');

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 0, 'Courier Report', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
$pdf->Ln(10);

$pdf->SetFont('helvetica', '', 10);
$pdf->Write(0, "Report Details\n", '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(0, "Tracking ID: " . $tracking_id . "\n", '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(0, "Generated on: " . date('F j, Y') . "\n", '', 0, 'L', true, 0, false, false, 0);
$pdf->Ln(10);

$pdf->Write(0, "Courier Details\n", '', 0, 'L', true, 0, false, false, 0);
$pdf->Ln(2);

$tableHTML = '
<table border="1" cellpadding="3">
    <tr>
        <th>Field</th>
        <th>Details</th>
    </tr>
    <tr>
        <td>Courier ID</td>
        <td>' . $courier['reference_id'] . '</td>
    </tr>
    <tr>
        <td>Sender Name</td>
        <td>' . $courier['sender_name'] . '</td>
    </tr>
    <tr>
        <td>Sender Address</td>
        <td>' . $courier['sender_address'] . '</td>
    </tr>
    <tr>
        <td>Recipient Name</td>
        <td>' . $courier['recipient_name'] . '</td>
    </tr>
    <tr>
        <td>Recipient Address</td>
        <td>' . $courier['recipient_address'] . '</td>
    </tr>
    <tr>
        <td>Status</td>
        <td>' . $courier['status'] . '</td>
    </tr>
    <tr>
        <td>Date & Time</td>
        <td>' . $courier['date_created'] . '</td>
    </tr>
</table>';

$pdf->writeHTML($tableHTML, true, false, false, false, '');
$pdf->Ln(10);

$pdf->Write(0, "Prepared By\n", '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(0, "Courier Management System\n", '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(0, "Contact Information for Queries: support@couriercompany.com\n", '', 0, 'L', true, 0, false, false, 0);

$filePath = "C:/xampp/htdocs/E-Project/Report/Courier_Report_" . $tracking_id . ".pdf";
$pdf->Output($filePath, 'F');

header('location: download_report.php?tracking_id='.$tracking_id);
?>
