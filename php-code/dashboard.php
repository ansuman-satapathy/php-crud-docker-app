<?php
session_start();
include 'functions.php';
if (!isset($_SESSION['username']))
    header("Location: login.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="test.css">
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

        .table tr {
            text-align: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">
                <!-- Brand -->
                <h5 class="list-group-item list-group-item-action">Dashboard</h5>
                <a href=" dashboard.php" class="list-group-item list-group-item-action py-2 ripple active "
                    aria-current="true">
                    <span>Employees</span>
                    </>
                    <a href="dept.php" class="list-group-item list-group-item-action py-2 ripple">
                        <span>Departments</span>
                    </a>
                    <a href="insert.php" class="list-group-item list-group-item-action py-2 ripple">
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

    <!-- Main layout -->
    <main>
        <div class="container">
            <div class="table">
                <table id="employees" class="table table-bordered table-stripped table-hover">
                    <thead>
                        <tr class="table-dark">
                            <th scope="col" >Firstname</th>
                            <th scope="col">Lastname</th>
                            <th scope="col" >Email ID</th>
                            <th scope="col">Phone</th>
                            <th scope="col" width="20%">Address</th>
                            <th scope="col">Salary</th>
                            <th scope="col">Dept</th>
                            <th scope="col" width="10%">Joining</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $functions = new functions();
                        $rows = $functions->fetchRecord();
                        foreach ($rows as $row) { ?>
                            <tr>
                                <td><?php echo $row['firstname'] ?></td>
                                <td><?php echo $row['lastname'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['contactNo'] ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td><?php echo $row['salary'] ?></td>
                                <td><?php echo $row['dept_name'] ?></td>
                                <td><?php echo $row['joining_date'] ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="delete.php?id=<?php echo $row['id'] ?>"
                                            class="btn btn-danger btnsm">Delete</a>
                                        <a href="edit.php?id=<?php echo $row['id'] ?>"
                                            class="btn btn-primary btnsm">Edit</a>
                                        <a href="mail.php?id=<?php echo $row['id'] ?>"
                                            class="btn btn-warning btnsm">Email</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <!-- Main layout -->

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- Datatables -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#employees').DataTable();
        }); </script>
</body>

</html>