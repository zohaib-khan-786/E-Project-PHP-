<?php

session_start();
include "connection.php";


if(isset($_POST['changePass'])){
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if($pass1 == $pass2){
        mysqli_query($conn, "UPDATE users SET Password = '$pass1' WHERE Email = '$_SESSION[sendEmailTo]'");
        header("location: login.php");
    }
    else {
        echo "Password do not match";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    
<div class="container d-flex justify-content-center align-items-center">
    <div class="row">
        <div class="col-md-12 shadow p-5 mt-5">
        <form method="post" enctype="multipart/form-data">
            <h3 class="text-center ">Change Password</h3>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">New Password</label>
                <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="pass1" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Re-write new password</label>
                <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="pass2" required>
            </div>
            
            <div class="mb-3 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary" name="changePass">Change Password</button>
            </div>
        </form>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>