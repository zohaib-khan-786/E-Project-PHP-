<?php

include "connection.php";

session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .image {
            width: 200px;
            height: 200px;
            border: 2px solid black;
            border-radius: 50%;
            overflow: hidden;
        }

        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h1>Welcome <?php echo $_SESSION["sessionName"];
     print_r ($_SESSION["position"])?></h1>

</body>
</html>