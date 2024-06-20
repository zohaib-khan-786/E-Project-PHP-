<?php

include "connection.php";

session_start();

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $uquery = mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND password='$password' AND role = 'user'");
    $aquery = mysqli_query($conn,"SELECT * FROM users WHERE Email='$email' AND Password='$password' AND role = 'agent'");

    if ($uquery) {      
    $unumrows = mysqli_num_rows($uquery);
    };
    if ($aquery) {
    $anumrows = mysqli_num_rows($aquery);
    }



    if($unumrows > 0){

        $udata = mysqli_fetch_assoc($uquery);
        $uname = $udata["name"];

        $_SESSION["sessionName"] = $uname;
        $_SESSION["position"] = " (User)";
        header("location: welcomeUserAgent.php");

    }
    else if ($anumrows > 0){

        $adata = mysqli_fetch_assoc($aquery);
        $aname = $adata["name"];
        $aemail = $adata["email"];
        $a_id = $adata["id"];

        $_SESSION["agentEmail"] = $aemail;
        $_SESSION["agentName"] = $aname;
        $_SESSION["agent_id"] = $a_id;
        $_SESSION["login"] = "true";

        header("location: Courier/index.php");

    }
    else {
        echo "Login Failed";
    }



}

// if(isset($_POST['login'])){
//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     $uquery = mysqli_query($connection,"SELECT * FROM users WHERE Email='$email' AND Password='$password'");

//     $unumrows = mysqli_num_rows($uquery);

//     if($unumrows > 0){

//         $udata = mysqli_fetch_assoc($uquery);
//         $uname = $udata["Name"];

//         header("location: welcomeUserAgent.php");
//         $_SESSION["sessionName"] = $uname;

//     }
//     else {
//         echo "Username or Password is incorrect";
//     }
// }

if(isset($_POST['reset'])){
    header("location: resetPassword.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .pass {
            color: green;
            font-size: large;
        }
        .fail {
            color: red;
            font-size: large;
        }
    </style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center">
    <div class="row">
        <div class="col-md-12 shadow p-5 mt-5">
        <form method="post" enctype="multipart/form-data">
            <h3 class="text-center ">Log-In</h3>
        
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>

            <div class="mb-3 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" name="login">Login</button>
            </div>
        </form>
        <div class="text-center mt-4">
            <h5>Forgot password?</h5>
            <form method="post">
                <button type="submit" class="btn btn-link" name="reset">Reset Password</button>
            </form>
        </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>