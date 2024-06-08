<?php

    include('../connection.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Agent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php

        $id = $_GET['agent_id'];

        $query = "SELECT * FROM users WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);


    
        if (isset($_POST['submit'])) {
            $agent_name = mysqli_real_escape_string($conn,$_POST['agent_name']);
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $password = mysqli_real_escape_string($conn,$_POST['password']);
            $branch_id = mysqli_real_escape_string($conn,$_POST['branch_id']);
            $status = mysqli_real_escape_string($conn,$_POST['status']);
            $role = 'agent';

            $query = "UPDATE users SET name = '$agent_name', email = '$email' , role = '$role' , password = '$password' ,status = '$status' ,branch_id = '$branch_id' WHERE id = '$id'";
            $result = mysqli_query($conn, $query);
            if ($result) {
                header('location: agent_dets.php');
            }
        }
    
    ?>


    <div class="container mt-5">
        <h1>Create Agent</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="agent_name" class="form-label">Agent Name</label>
                <input type="text" class="form-control" id="agent_name" value=<?php echo $row['name'] ?> name="agent_name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" value=<?php echo $row['email'] ?> name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="pasword" class="form-control" value=<?php echo $row['password'] ?> id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="branch_id" class="form-label">Branch Id</label>
                <select class="form-select" id="branch_id" name="branch_id" required>
                    <option value="1">Branch 1</option>
                    <option value="2">Branch 2</option>
                    <option value="3">Branch 3</option>
                    <option value="4">Branch 4</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
