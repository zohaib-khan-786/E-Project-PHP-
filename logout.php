<?php

session_start();

session_destroy();


$referer = isset($_POST['referer']) ? $_POST['referer'] : 'http://localhost/Ismail/Front-End/index.php';

echo($referer);
$referer = trim($referer);


header('Location: ' . $referer);
exit();
?>
