<?php
session_start();
include 'functions.php';

$firstnameErr = $lastnameErr = $emailErr = $contactNoErr = $addressErr = $salaryErr = $dateErr = $deptErr = "";
$success = "";
$error = "";
if (isset($_POST['submit'])) {
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

    //email required
    if (empty($_POST['email'])) {
        $emailErr = "Email is required";
    } else {
        $email = $check->validateEmail($_POST['email']);
        if ($email == "error") {
            $emailErr = "Enter a valid email address.";
        }
    }

    //phone required
    if (empty($_POST['contact-no'])) {
        $contactNoErr = "Phone is required";
    } else {
        $contactNo = $check->validateInput($_POST['contact-no']);
    }

    //address required
    if (empty($_POST['address'])) {
        $addressErr = "Address is required";
    } else {
        $address = $check->validateInput($_POST['address']);
    }

    //salary required
    if (empty($_POST['salary'])) {
        $salaryErr = "Salary is required";
    } else {
        $salary = $check->validateInput($_POST['salary']);
    }

    //Date required
    if (empty($_POST['joining-date'])) {
        $dateErr = "Joining Date is required";
    } else {
        $joining_date = $check->validateInput($_POST['joining-date']);
    }

    //Dept required
    if (empty($_POST['dept-id'])) {
        $deptErr = "Dept ID is required";
    } else {
        $joining_date = $check->validateInput($_POST['dept-id']);
    }

    //insert new
    if (
        $firstnameErr == "" && $lastnameErr == "" && $emailErr == ""
        && $contactNoErr == "" && $addressErr == "" && $salaryErr == "" && $dateErr == ""
    ) {
        $functions = new functions();
        $functions->insertRecord($_POST);
        header("Refresh:1; url=dashboard.php");
        $success = "Success";
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="test.css">
    <title>Add New Employee</title>
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
            margin-top: 10px;
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            overflow-y: auto;
            zoom: 94%
        }

        .container {
            padding-top: 20px;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">
                <!-- Brand -->
                <a class="list-group-item list-group-item-action ms-3" href="">
                    <h5>Dashboard</h5>
                </a>
                <a href="dashboard.php" class="list-group-item list-group-item-action py-2 ripple  "
                    aria-current="true">
                    <span>Employees</span>
                </a>
                <a href="dept.php" class="list-group-item list-group-item-action py-2 ripple">
                    <span>Departments</span>
                </a>
                <a href="insert.php" class="list-group-item list-group-item-action py-2 ripple active">
                    <span>Add New Employee</span>
                </a>
                <a href="insert_dept.php" class="list-group-item list-group-item-action py-2 ripple">
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
    <main>
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
            <h3>Add New Record</h3>
            <form action="insert.php" method="post">
                <div class="form-group">
                    <label for="firstname">First Name: <span
                            class="text-danger"><?php echo "*" . $firstnameErr ?></span></label>
                    <input type="text" class="form-control" name="firstname" placeholder="First Name">
                </div>

                <div class="form-group">
                    <label for="lastname">Last Name: <span
                            class="text-danger"><?php echo "*" . $lastnameErr ?></span></label>
                    <input type="text" class="form-control" name="lastname" placeholder="Last Name">
                </div>

                <div class="form-group">
                    <label for="email">Email: <span class="text-danger"><?php echo "*" . $emailErr ?></span></label>
                    <input type="email" class="form-control" name="email" placeholder="user@gmail.com">
                </div>

                <div class="form-group">
                    <label for="contact-no">Contact No: <span
                            class="text-danger"><?php echo "*" . $contactNoErr ?></span></label>
                    <input type="text" class="form-control" name="contact-no" placeholder="9937213689">
                </div>

                <div class="form-group">
                    <label for="address">Address: <span
                            class="text-danger"><?php echo "*" . $addressErr ?></span></label>
                    <input type="text" class="form-control" name="address" placeholder="City, State, Pincode">
                </div>

                <div class="form-group">
                    <label for="salary">Salary: <span class="text-danger"><?php echo "*" . $salaryErr ?></span></label>
                    <input type="text" class="form-control" name="salary" placeholder="2000000">
                </div>

                <div class="form-group">
                    <label for="joining-date">Joining Date: <span
                            class="text-danger"><?php echo "*" . $dateErr ?></span></label>
                    <input type="date" class="form-control" name="joining-date">
                </div>

                <div class="form-group">
                    <label for="dept-id">Dept ID: <span class="text-danger"><?php echo "*" . $deptErr ?></span></label>
                    <input type="text" class="form-control" name="dept-id" placeholder="1-10">
                </div>

                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <a href="dashboard.php" class="btn btn-primary" name="submit">Go Back<a />

            </form>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>