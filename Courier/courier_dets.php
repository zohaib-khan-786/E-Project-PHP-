<?php


include('../connection.php');


$result = mysqli_query($conn, "SELECT * FROM courier");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Couriers List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Couriers List</h1>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Reference ID</th>
                    <th>Sender Name</th>
                    <th>Recipient Name</th>
                    <th>Weight</th>
                    <th>Height</th>
                    <th>Width</th>
                    <th>Length</th>
                    <th>Type</th>
                    <th>From Branch</th>
                    <th>To Branch</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Generate table rows dynamically
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['reference_id']}</td>";
                    echo "<td>{$row['sender_name']}</td>";
                    echo "<td>{$row['recipient_name']}</td>";
                    echo "<td>{$row['weight']}</td>";
                    echo "<td>{$row['height']}</td>";
                    echo "<td>{$row['width']}</td>";
                    echo "<td>{$row['length']}</td>";
                    echo "<td>{$row['type']}</td>";
                    echo "<td>{$row['from_branch']}</td>";
                    echo "<td>{$row['to_branch']}</td>";
                    echo "<td>\${$row['price']}</td>";
                    echo "<td>{$row['status']}</td>";
                    echo "<td>
                            <button class='btn btn-warning btn-sm' onclick=\"updateCourier('{$row['reference_id']}')\">Update</button>
                            <button class='btn btn-danger btn-sm' onclick=\"deleteCourier('{$row['reference_id']}')\">Delete</button>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <a href="../generate_report.php">Download Report</a>



    <script>
        function updateCourier(referenceId) {
            // Redirect to the update page with the reference ID
            window.location.href = `update_courier.php?reference_id=${referenceId}`;
        }

        function deleteCourier(referenceId) {
            if (confirm("Are you sure you want to delete this courier?")) {
                // Redirect to the delete page with the reference ID
                window.location.href = `delete_courier.php?reference_id=${referenceId}`;
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
