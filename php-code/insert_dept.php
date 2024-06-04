<?php
session_start();
include 'functions.php';

$error = "";
$success = "";
if (isset($_POST['submit'])) {
    $functions = new functions();
    $dept = $_POST['dept'];
    $sql = $functions->getConnection()->query("INSERT INTO `dept`(`name`) VALUES ('$dept')");
    if ($sql) {
        $success = "Success";
        header("Location:dept.php");
        exit();

    } else {
        $error = "Error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="test.css">
    <title>New Department</title>
    <style>
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
            zoom: 90%;
        }

        #sidebarMenu {
            margin-top: 4rem;
            width: 250px;
            position: fixed;
            height: 100%;
        }

        #main-navbar {
            width: calc(100% - 250px);
            margin-left: 250px;
            z-index: 1000;

        }

        main {
            margin-top: 53px;
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            overflow-y: auto;
        }

        .container {
            padding-top: 20px;
        }
    </style>
</head>

<body>

    <?php

    ?>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">
                <!-- Brand -->
                <a class="list-group-item list-group-item-action ms-3" href="">
                    <h5>Dashboard</h5>
                </a>
                <a href="dashboard.php" class="list-group-item list-group-item-action py-2  " aria-current="true">
                    <span>Employees</span>
                </a>
                <a href="dept.php" class="list-group-item list-group-item-action py-2 ripple">
                    <span>Departments</span>
                </a>
                <a href="insert.php" class="list-group-item list-group-item-action py-2 ripple">
                    <span>Add New Employee</span>
                </a>
                <a href="insert_dept.php" class="list-group-item list-group-item-action py-2 ripple active">
                    <span>Add New Department</span></a>
            </div>
        </div>
    </nav>
    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <div class="collapse navbar-collapse d-flex" id="navbarNav">
                <!-- Brand -->
                <a class="nav-link ms-auto d-flex align-items-center" href="dashboard.php">
                    <h3>Manage Employees</h3>
                </a>

                <!-- Right links -->

                <ul class="navbar-nav ms-auto d-flex flex-row">
                    <li></li>
                    <li>
                        <a class="nav-link d-flex align-items-center" href="logout.php">Logout</a>
                    </li>
                    <li>
                        <a class="nav-link d-flex align-items-center" href="profile.php">Profile</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->

    <div class="container mt-5">
        <?php
        if (!empty($success))
            echo '<div class="alert alert-success text-center" role="alert">
            Added new Record!!!
          </div>';
        ?>

        <?php
        if (!empty($error))
            echo '<div class="alert alert-danger text-center" role="alert">
            Failed to Add!!!
          </div>';
        ?>
        <main>
            <h3>Add New Department</h3>

            <form action="insert_dept.php" method="post">

                <div class="form-group mt-3">
                    <label for="dept">Department Name: </label>
                    <input type="text" class="form-control" name="dept" placeholder="Dept Name" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3" name="submit">Add</button>
                <a href="dashboard.php" class="btn btn-primary mt-3" name="submit">Go Back<a />


                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            </form>
        </main>
    </div>

</body>

</html>