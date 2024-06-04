<?php
session_start();
include 'functions.php';

$errors = [];
$loginErr = $passErr = "";

if (isset($_POST['submit'])) {
    $functions = new functions();
    $login = $_POST['login']; // Username or Email
    $password = $_POST['password'];
    if (empty($_POST['login'])) {
        $loginErr = "Enter username/email!";
    } else if (empty($_POST['password'])) {
        $passErr = "Enter password!";
    } else {
        // Query to check if the login is valid
        $query = "SELECT * FROM admins WHERE username='$login' OR email='$login'";
        $result = $functions->getConnection()->query($query);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (($user['password']) === md5($password)) {
                // Password is correct, log in the user
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['firstname'] = $user['firstname'];
                $_SESSION['lastname'] = $user['lastname'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['phone'] = $user['phone'];
                // Redirect to the todo page
                header("Location:dashboard.php");
                exit();
            } else {
                echo "<br>";
                echo '<div class="alert alert-danger text-center" role="alert">
                        Invalid Password!!!
                      </div>';
            }
        } else {
            echo "<br>";
            echo '<div class="alert alert-danger text-center" role="alert">
                        User Does Not Exist!!!
                      </div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                        <a class="nav-link d-flex align-items-center" href="Register.php">Register</a>
                    </li>
                </ul>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->

        <!-- Login Form -->
        <h3>Login</h3>
        <form action="login.php" method="post">

            <div class="form-group">
                <label for="login">Username/Email:<span class="text-danger"><?php echo "*" . $loginErr ?></span></label>
                <input type="text" class="form-control" name="login" placeholder="Username/Email">
            </div>

            <div class="form-group">
                <label for="password">Password: <span class="text-danger"><?php echo "*" . $passErr; ?></span></label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Login</button>
        </form>
        <p class="mt-3">Don't have an account? <a href="register.php">Register</a></p>
        <p class="mt-3">Forgot password? <a href="reset_password.php">Reset</a></p>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>