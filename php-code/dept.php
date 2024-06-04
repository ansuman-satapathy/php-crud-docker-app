<?php
session_start();
include 'functions.php';
$success = "";
$error = "";

//Delete dept
if (isset($_GET['id'])) {
    $functions = new functions();
    $id = $_GET['id'];
    $sqlDelete = $functions->getConnection()->query("DELETE FROM `dept` WHERE `id` = '$id'");
    if ($sqlDelete) {
        $_SESSION['success'] = "Department deleted successfully!";
    } else {
        $_SESSION['error'] = "Failed to delete department.";
    }
    header("Location: dept.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="test.css">
</head>

<style>
    body {
        display: flex;
        height: 100vh;
        overflow: hidden;
        zoom: 95%;
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

    .table tr {
        text-align: center;
        justify-content: center;
    }

    .table {
        width: 70%;
        margin-top: 5rem;
        margin-left: 17rem;
    }
</style>

<body>

    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">
                <!-- Brand -->
                <a class="list-group-item list-group-item-action ms-3" href="">
                    <h5>Dashboard</h5>
                </a>
                <a href="dashboard.php" class="list-group-item list-group-item-action py-2" aria-current="true">
                    <span>Employees</span>
                </a>
                <a href="dept.php" class="list-group-item list-group-item-action py-2 ripple active">
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

    <div class="container mt-5">
        <div class="table">
            <?php
            if (!empty($_SESSION['success'])) {
                echo '<div class="alert alert-success text-center" role="alert">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']);
            }

            if (!empty($_SESSION['error'])) {
                echo '<div class="alert alert-danger text-center" role="alert">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            ?>

            <table id="dept" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $functions = new functions();
                    $sql = $functions->getConnection()->query("SELECT * FROM `dept`");
                    if ($sql) {
                        while ($row = $sql->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td>
                                    <a href="dept.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                    <a href="edit_dept.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- Datatables -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#dept').DataTable();
        });
    </script>
</body>

</html>