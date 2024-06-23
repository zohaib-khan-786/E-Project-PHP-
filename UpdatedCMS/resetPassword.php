 <?php

// ob_start();
session_start();
include "connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if(isset($_POST['code'])){

  $email = $_POST['email'];

  $uquery = mysqli_query($connection,"SELECT * FROM users WHERE Email='$email'");

  $unumrows = mysqli_num_rows($uquery);

  if($unumrows > 0){

    $_SESSION["sendEmailTo"] = $email;

    $udata = mysqli_fetch_assoc($uquery);

    $name = $udata["Name"];

    $_SESSION["NameOfSendEmailTo"] = $name;

    $randomCode = random_int(100000,999999);

    $_SESSION["randomCode"] = $randomCode;
          
    $mail = new PHPMailer(true);

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'ismailnooruddin0@gmail.com';                     //SMTP username
    $mail->Password   = 'klotkcrnldaionwm';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    $mail->setFrom('ismailnooruddin0@gmail.com', 'Admin');
    $mail->addAddress($_SESSION["sendEmailTo"], $_SESSION["NameOfSendEmailTo"]);

    $mail->Subject = 'Confirmation Code';
    $mail->Body    = 'Dear ' . $_SESSION["NameOfSendEmailTo"] . '! Your confirmation code is: ' . $randomCode;

    $mail->send();

    header("location: enterCode.php");
  }
  else if ($unumrows < 1){
    echo "Email not found";
  }

}


// ob_end_clean();

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
            <h3 class="text-center">Reset Password</h3>
            
            <div class="mb-3 mt-4">
                <label for="exampleInputEmail1" class="form-label">Enter your email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mt-2" id="sendCodeButton" disabled name="code">Send Code</button>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>


<!-- Your HTML code remains the same -->

<script>
  const emailInput = document.getElementById("exampleInputEmail1");
  const sendCodeButton = document.getElementById("sendCodeButton");

  emailInput.addEventListener("input", () => {
    if (emailInput.checkValidity()) {
      sendCodeButton.removeAttribute("disabled");
    } else {
      sendCodeButton.setAttribute("disabled", "disabled");
    }
  });

</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>