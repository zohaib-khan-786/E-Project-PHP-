<?php 

    include('../connection.php');

    
if ($_SESSION["login"] != "true") {
    header("location:../login.php");
  }

    $id = $_GET['agent_id'];

    $sql = "DELETE FROM users WHERE id = '$id'";

    $result = mysqli_query($conn,$sql);

    if($result){

        header('location: agent_dets.php');

    }

    else{

        echo "Error";

    }

    mysqli_close($conn);

    exit;


?>