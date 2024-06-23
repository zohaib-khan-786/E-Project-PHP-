<?php

include "connection.php";

session_start();

if(isset($_POST['enter'])){
    $code = $_POST['code'];
    if ($code == $_SESSION["randomCode"]){
        header("location: changePassword.php");
    }
    else if ($code != $_SESSION["randomCode"]) {
        echo "Invalid code";
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
        <form method="post">
            <h3 class="text-center">Enter Code</h3>
            
            <div class="mb-3 mt-4">
                <label for="exampleInputEmail1" class="form-label">Enter confirmation code</label>
                <input name="code" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            </div>
            
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mt-2" id="sendCodeButton" name="enter">Enter</button>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>