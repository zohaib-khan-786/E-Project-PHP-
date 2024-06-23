<?php

    include("./connection.php");


    $sql = "SELECT * FROM users WHERE role = 'agent'";

    $result = $conn->query($sql);


    $active_user = 0;
    $inactive_user = 0;


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
           if ($row['status'] == 1 ) {
                $active_user += 1;
            } else if ($row['status'] == 0 ){
                $inactive_user += 1;
           }
        }
    }


$data = array(
    "activeUser" => $active_user,
    "inactiveUser" => $inactive_user
);


echo json_encode($data);

?>