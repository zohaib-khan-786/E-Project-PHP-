<?php

    include('../connection.php');


    if ($_SESSION["login"] != "true") {
        header("location:../login.php");
      }

    $id = $_GET['reference_id'];

    $sql = "DELETE FROM courier WHERE reference_id = '$id'";

    $result = mysqli_query($conn,$sql);

    if($result){

        header('location: courier_dets.php');

    }

    else{

        echo "Error";

    }

    mysqli_close($conn);

    exit;

?>