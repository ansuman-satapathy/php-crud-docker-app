<?php
session_start();
include 'functions.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <?php
    if (isset($_POST['submit'])) {
        $functions = new functions();
        $email = $_POST['email'];
        $sql = $functions->getConnection()->query("SELECT `email`, `password` FROM admins WHERE `email` = '$email'");
        if ($sql->num_rows == 1) {
            $row = $sql->fetch_assoc();
            $oldpasswordDb = $row['password'];
            $oldpasswordForm = md5($_POST['old-password']);
            $newpassword = md5($_POST['new-password']);
            if ($oldpasswordDb == $oldpasswordForm) {
                $updateSql = $functions->getConnection()->query("UPDATE admins SET `password` = '$newpassword'");

                if ($updateSql) {
                    header("Refresh:1; url=profile.php");
                    echo "<br>";
                    echo '<div class="alert alert-success text-center" role="alert">Password changed successfully!!!</div>';
                } else {
                    echo "<br>";
                    echo '<div class="alert alert-danger text-center" role="alert">Failed to reset password!!!
            </div>';

                }
            } else {
                echo "<br>";
                echo '<div class="alert alert-danger text-center" role="alert">Invalid Password!!!
            </div>';
            }

        } else {
            echo "<br>";
            echo '<div class="alert alert-danger text-center" role="alert">Email does not exist!!!
            </div>';
        }
    }
    ?>
    <div class="container mt-5">
        <h3>Reset Password</h3>
        <form action="reset_password.php" method="post">
            <div class="form-group">
                <label for="email">Enter Registered Email: </label>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <label for="old-password">Enter Old Password: </label>
                <input type="password" class="form-control" name="old-password" placeholder="Old Password">
            </div>

            <div class="form-group">
                <label for="new-password">Enter New Password: </label>
                <input type="password" class="form-control" name="new-password" placeholder="New Password">
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Reset</button>
            <a href="login.php" type="submit" class="btn btn-primary" name="submit">Cancel</a>

        </form>

    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>