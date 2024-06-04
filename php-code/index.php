<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Employee Management</h2>
        <p class="mt-3"><?php if (isset($_SESSION['firstname'])) {
            echo "<center>Hello, " . $_SESSION['firstname'] . "!</center>"; ?>
                <?php ?>
            </p>
            <!-- Navbar -->
            <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
                <!-- Container wrapper -->
                <div class="container-fluid">
                    <!-- Right links -->
                    <ul class="navbar-nav ml-auto d-flex flex-row">
                        <li>
                            <a class="nav-link d-flex align-items-center" href="dashboard.php">Dashboard</a>
                        </li>
                        <li>
                            <a class="nav-link d-flex align-items-center" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
                <!-- Container wrapper -->
            </nav>
            <!-- Navbar -->

        <?php } else { ?>
            <!-- Navbar -->
            <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
                <!-- Container wrapper -->
                <div class="container-fluid">
                    <!-- Right links -->
                    <ul class="navbar-nav ml-auto d-flex flex-row">
                        <li>
                            <a class="nav-link d-flex align-items-center" href="login.php">Login</a>
                        </li>
                        <li>
                            <a class="nav-link d-flex align-items-center" href="register.php">Register</a>
                        </li>
                    </ul>
                </div>
                <!-- Container wrapper -->
            </nav>
            <!-- Navbar -->
        <?php } ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>