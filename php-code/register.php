<?php
session_start();
include 'functions.php';

$firstnameErr = $lastnameErr = $usernameErr = $emailErr = $passwordErr = $phoneErr = $fileErr = "";
// Sanitizing form input and storing in DB
if (isset($_POST['submit'])) {
    $functions = new functions();
    $check = new Validation();
    //firstname required
    if (empty($_POST['firstname'])) {
        $firstnameErr = "First name is required";
    } else {
        $firstname = $check->validateInput($_POST['firstname']);
    }

    //lastname required
    if (empty($_POST['lastname'])) {
        $lastnameErr = "Lastname is required";
    } else {
        $lastname = $check->validateInput($_POST['lastname']);
    }

    //username required
    if (empty($_POST['username'])) {
        $usernameErr = "Username is required";
    } else {
        $username = $check->validateUsername($_POST['username']);
        if ($username == "error") {
            $usernameErr = "Username can have only numbers or alphabets.";
        }
    }

    //email required
    if (empty($_POST['email'])) {
        $emailErr = "Email is required";
    } else {
        $email = $check->validateEmail($_POST['email']);
        if ($email == "error") {
            $emailErr = "Enter a valid email address.";
        }
    }

    //password required
    $password = "";
    if (empty($_POST['password'])) {
        $passwordErr = "Password is required";
    } else {
        $password = $check->validatePassword($_POST['password']);
        if ($password == "error") {
            $passwordErr = "Password length must be between 6 to 16 characters.";
        }
    }

    //phone required
    if (empty($_POST['phone'])) {
        $phoneErr = "Phone is required";
    } else {
        $phoneNo = $check->validateInput($_POST['phone']);
    }

    // Hashing the password
    $hashedPassword = md5($password);

    //Generate password token to reset password

    if ($firstnameErr == "" && $lastnameErr == "" && $usernameErr == "" && $emailErr == "" && $passwordErr == "") {
        // Query for checking unique username & email
        $uniqueUserNameCheck = $functions->getConnection()->query("SELECT username FROM `admins` WHERE username = '$username'");
        $uniqueEmailCheck = $functions->getConnection()->query("SELECT email FROM `admins` WHERE email = '$email'");

        if ($uniqueUserNameCheck->num_rows > 0) {
            $usernameErr = "Username not available!";
        } elseif ($uniqueEmailCheck->num_rows > 0) {
            $emailErr = "Email already exists!";
        } else {
            // Insert data
            $sql = $functions->getConnection()->query("INSERT INTO admins(`firstname`, `lastname`, `username`, `email`, `password`, `phone`) 
                                 VALUES('$firstname', '$lastname', '$username', '$email', '$hashedPassword', '$phoneNo')");
            if ($sql) {
                // Set session variables and redirect to dashboard page
                $_SESSION['username'] = $username;
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['email'] = $email;
                $_SESSION['phone'] = $phoneNo;
                $_SESSION['admin_id'] = $functions->getConnection()->insert_id;
                header("Refresh: 1; url=dashboard.php");
                echo "<br>";
                echo "<br>";
                echo '<div class="alert alert-success text-center" role="alert">
                    Registration Successful!!!
                  </div>';
            } else {
                $errors[] = "Error: " . $sql . "<br>" . $functions->getConnection()->error;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Register</title>
</head>

<body>
    <div class="container mt-5">

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Right links -->
                <ul class="navbar-nav ml-auto d-flex flex-row">
                    <li>
                        <a class="nav-link d-flex align-items-center" href="index.php">Home</a>
                    </li>
                    <li>
                        <a class="nav-link d-flex align-items-center" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
        <h3>Register</h3>
        <form action="register.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="firstname">First Name: <span
                        class="text-danger"><?php echo "*" . $firstnameErr; ?></span></label>
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name: <span
                        class="text-danger"><?php echo "*" . $lastnameErr; ?></span></label>
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name">
            </div>
            <div class="form-group">
                <label for="username">User Name: <span
                        class="text-danger"><?php echo "*" . $usernameErr; ?></span></label>
                <input type="text" class="form-control" name="username" id="username" placeholder="User Name">
            </div>
            <div class="form-group">
                <label for="email">Email Id: <span class="text-danger"><?php echo "*" . $emailErr; ?></span></label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email Id">
            </div>
            <div class="form-group">
                <label for="password">Password: <span
                        class="text-danger"><?php echo "*" . $passwordErr; ?></span></label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="phone">Phone No: <span class="text-danger"><?php echo "*" . $phoneErr; ?></span></label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone No">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Register</button>
        </form>
        <p class="mt-3">Already have an account? <a href="login.php">Login</a></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>