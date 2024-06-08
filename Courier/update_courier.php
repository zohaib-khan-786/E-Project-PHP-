<?php
include("../connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    .is-invalid {
        border: 1px solid red;
    }
    </style>
    <title>Document</title>
</head>

<body>

    <?php

    $courier_id = $_GET['reference_id'];
    $query = "SELECT * FROM courier WHERE reference_id = '$courier_id'";
    $result = mysqli_query($conn, $query);
    $row;
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }

        if (isset($_POST['submit'])) {

            $sender_name = mysqli_real_escape_string($conn, $_POST['sender_name']);
            $sender_address = mysqli_real_escape_string($conn, $_POST['sender_address']);
            $sender_contact = mysqli_real_escape_string($conn, $_POST['sender_contact']);
            $recipient_name = mysqli_real_escape_string($conn, $_POST['recipient_name']);
            $recipient_address = mysqli_real_escape_string($conn, $_POST['recipient_address']);
            $recipient_contact = mysqli_real_escape_string($conn, $_POST['recipient_contact']);
            $type = mysqli_real_escape_string($conn, $_POST['type']);
            $weight = mysqli_real_escape_string($conn, $_POST['weight']);
            $height = mysqli_real_escape_string($conn, $_POST['height']);
            $width = mysqli_real_escape_string($conn, $_POST['width']);
            $length = mysqli_real_escape_string($conn, $_POST['length']);
            $status = mysqli_real_escape_string($conn, $_POST['status']);
            $price = 100;

            $query = "UPDATE courier SET sender_name='$sender_name', sender_address='$sender_address', sender_contact='$sender_contact', recipient_name='$recipient_name', recipient_address='$recipient_address', recipient_contact='$recipient_contact', type='$type',  weight='$weight', height='$height', width='$width', length='$length', price='$price', status='$status' WHERE reference_id='$courier_id'";

            if (mysqli_query($conn, $query)) {
                header('Location: courier_dets.php?id='.$courier_id);
                exit();
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        }
    ?>

    <form method="POST" class="p-5" id="courier_form">
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Sender Name</label>
                    <input type="text" name="sender_name" value=<?php  echo $row['sender_name']; ?> class="form-control" required>

                </div>
                <div class="mb-3">
                    <label class="form-label">Sender Address</label>
                    <input type="text" name="sender_address" value=<?php  echo $row['sender_address']; ?>  class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sender Contact</label>
                    <input type="text" name="sender_contact" value=<?php  echo $row['sender_contact']; ?> class="form-control" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Recipient Name</label>
                    <input type="text" name="recipient_name" value=<?php  echo $row['recipient_name']; ?> class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Recipient Address</label>
                    <input type="text" name="recipient_address" value=<?php  echo $row['recipient_address']; ?> class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Recipient Contact</label>
                    <input type="text" name="recipient_contact" value=<?php  echo $row['recipient_contact']; ?> class="form-control" required>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <div class="col-lg-12">
                <div class="row py-3">
                    <div class="col">
                        <label>Weight: </label>
                        <input type="text" name="weight" value=<?php  echo $row['weight']; ?> class="form-control" required>
                    </div>
                    <div class="col">
                        <label>Height: </label>
                        <input type="text" name="height" value=<?php  echo $row['height']; ?> class="form-control" required>
                    </div>
                    <div class="col">
                        <label>Width: </label>
                        <input type="text" name="width" value=<?php  echo $row['width']; ?> class="form-control" required>
                    </div>
                    <div class="col">
                        <label>Length: </label>
                        <input type="text" name="length" value=<?php  echo $row['length']; ?> class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Courier Type</label>
                        <select name="type" class="form-select" required>
                            <option selected disabled>Choose...</option>
                            <option value="pickup">Pickup</option>
                            <option value="deliver">Deliver</option>
                        </select>
                    </div>
                </div>
               
            
          
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option selected disabled>Choose...</option>
                            <option value="pending">Pending</option>
                            <option value="in_transit">In Transit</option>
                            <option value="delivered">Delivered</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="returned">Returned</option>
                        </select>
                    </div>
                </div>
            </div>
            

        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
    


    <script>
    document.getElementById('courier_form').addEventListener('submit', function(event) {
        var inputs = document.querySelectorAll('#courier_form input[type="text"]');
        var allFilled = true;

        inputs.forEach(function(input) {
            if (!input.value.trim()) {
                allFilled = false;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (!allFilled) {
            event.preventDefault();
            alert('Please fill in all fields.');
        }
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
