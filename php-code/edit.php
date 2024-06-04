<?php
session_start();
include 'functions.php';

$firstnameErr = $lastnameErr = $emailErr = $contactNoErr = $addressErr = $salaryErr = $dateErr = $deptErr = "";
$results = [];
$success = "";
$error = "";

if (isset($_GET['id'])) {
    $functions = new functions();
    $id = $_GET['id'];
    $sql = $functions->getConnection()->query("SELECT * FROM `employees` WHERE `id` = '$id'");
    if ($sql) {
        if ($sql->num_rows == 1) {
            $results = $sql->fetch_assoc();
        } else {
            echo "Error fetching record!";
        }
    } else {
        echo "Error fetching record!";
    }

    if (isset($_POST['submit'])) {
        $check = new Validation();

        // Validate form inputs
        if (empty($_POST['firstname'])) {
            $firstnameErr = "First name is required";
        } else {
            $firstname = $check->validateInput($_POST['firstname']);
        }

        if (empty($_POST['lastname'])) {
            $lastnameErr = "Last name is required";
        } else {
            $lastname = $check->validateInput($_POST['lastname']);
        }

        if (empty($_POST['email'])) {
            $emailErr = "Email is required";
        } else {
            $email = $check->validateEmail($_POST['email']);
            if ($email == "error") {
                $emailErr = "Enter a valid email address.";
            }
        }

        if (empty($_POST['contact-no'])) {
            $contactNoErr = "Phone is required";
        } else {
            $contactNo = $check->validateInput($_POST['contact-no']);
        }

        if (empty($_POST['address'])) {
            $addressErr = "Address is required";
        } else {
            $address = $check->validateInput($_POST['address']);
        }

        if (empty($_POST['salary'])) {
            $salaryErr = "Salary is required";
        } else {
            $salary = $check->validateInput($_POST['salary']);
        }

        if (empty($_POST['joining-date'])) {
            $dateErr = "Joining Date is required";
        } else {
            $joining_date = $check->validateInput($_POST['joining-date']);
        }

        if (empty($_POST['dept-id'])) {
            $deptErr = "Dept ID is required";
        } else {
            $joining_date = $check->validateInput($_POST['dept-id']);
        }

        // Update record
        if ($firstnameErr == "" && $lastnameErr == "" && $emailErr == "" && $contactNoErr == "" && $addressErr == "" && $salaryErr == "" && $dateErr == "" && $deptErr == "") {
            $functions->editRecord($id);
            header("Refresh:1; url=dashboard.php");
            $success = "Record Updated Successfully!!!";

        } else {
            $error = "Failed to Update";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
            zoom: 94%;
        }
    </style>
</head>

<body>
    <div class="container mt-5">

        <?php
        if (!empty($success))
            echo '<div class="alert alert-success text-center" role="alert">
            Update Success!!!
          </div>';
        ?>

        <?php
        if (!empty($error))
            echo '<div class="alert alert-danger text-center" role="alert">
            Failed to Update!!!
          </div>';
        ?>

        <h2>Edit Employee</h2>
        <form action="edit.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
            <div class="form-group">
                <label for="firstname">First Name: <span
                        class="text-danger"><?php echo "*" . $firstnameErr; ?></span></label>
                <input type="text" class="form-control" name="firstname" placeholder="First Name"
                    value="<?php echo htmlspecialchars($results['firstname']); ?>">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name: <span
                        class="text-danger"><?php echo "*" . $lastnameErr; ?></span></label>
                <input type="text" class="form-control" name="lastname" placeholder="Last Name"
                    value="<?php echo htmlspecialchars($results['lastname']); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email: <span class="text-danger"><?php echo "*" . $emailErr; ?></span></label>
                <input type="text" class="form-control" name="email" placeholder="Email"
                    value="<?php echo htmlspecialchars($results['email']); ?>">
            </div>
            <div class="form-group">
                <label for="contact-no">Contact No: <span
                        class="text-danger"><?php echo "*" . $contactNoErr; ?></span></label>
                <input type="text" class="form-control" name="contact-no" placeholder="Contact No"
                    value="<?php echo htmlspecialchars($results['contactNo']); ?>">
            </div>
            <div class="form-group">
                <label for="address">Address: <span class="text-danger"><?php echo "*" . $addressErr; ?></span></label>
                <input type="text" class="form-control" name="address" placeholder="City, State, Pincode"
                    value="<?php echo htmlspecialchars($results['address']); ?>">
            </div>
            <div class="form-group">
                <label for="salary">Salary: <span class="text-danger"><?php echo "*" . $salaryErr; ?></span></label>
                <input type="text" class="form-control" name="salary" placeholder="Salary"
                    value="<?php echo htmlspecialchars($results['salary']); ?>">
            </div>
            <div class="form-group">
                <label for="joining-date">Joining Date: <span
                        class="text-danger"><?php echo "*" . $dateErr; ?></span></label>
                <input type="date" class="form-control" name="joining-date"
                    value="<?php echo htmlspecialchars($results['joining_date']); ?>">
            </div>

            <div class="form-group">
                <label for="dept-id">Dept ID: <span class="text-danger"><?php echo "*" . $deptErr; ?></span></label>
                <input type="text" class="form-control" name="dept-id"
                    value="<?php echo htmlspecialchars($results['dept_id']); ?>">
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Update</button>
            <a href="dashboard.php" type="submit" class="btn btn-primary" name="cancel">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>