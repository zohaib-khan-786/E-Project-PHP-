<?php

include "connection.php";

session_start();

$sql = "SELECT * FROM users WHERE role = 'Admin'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();

        $_SESSION["adminEmail"] = $row['email'];
        $_SESSION["adminName"] = $row['name'];
        $_SESSION["admin_id"] = $row['id'];
        $_SESSION["login"] = "true";
    
    header("Location: Dashboard/index.php");
};

?>