<?php
$conn = mysqli_connect("localhost", "root", "", "cms");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
};
?>