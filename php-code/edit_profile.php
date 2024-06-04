<?php
session_start();
include 'functions.php';

$errors = [];
$success_msg = [];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Profile</title>
</head>

<body>
    <div class="container mt-5">
        <div class="error">
            <?php
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
            }
            ?>
        </div>
        <?php
        $firstnameErr = $lastnameErr = $passwordErr = $phoneErr = $fileErr = "";
        $profile_pic = "";

        if (isset($_GET['id'])) {
            $functions = new functions();
            $id = $_GET['id'];
            $result = $functions->getConnection()->query("SELECT * FROM `admins` WHERE `id` = '$id'");
            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();
            } else {
                $errors[] = "Unable to fetch details!";
            }
        } else {
            $errors[] = "ID not set!";
        }

        if (isset($_POST['update'])) {
            $functions = new functions();
            // Validation function
            function validateInput($data)
            {
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                $data = trim($data);
                return $data;
            }

            // firstname required
            if (empty($_POST['firstname'])) {
                $firstnameErr = "First name is required";
            } else {
                $firstname = validateInput($_POST['firstname']);
            }

            // lastname required
            if (empty($_POST['lastname'])) {
                $lastnameErr = "Last name is required";
            } else {
                $lastname = validateInput($_POST['lastname']);
            }

            // phone required
            if (empty($_POST['phone'])) {
                $phoneErr = "Phone is required";
            } else {
                $phoneNo = validateInput($_POST['phone']);
            }

            if ($firstnameErr == "" && $lastnameErr == "" && $phoneErr == "" && $fileErr == "") {
                // Update data
                $sql = "UPDATE admins SET `firstname` = '$firstname', `lastname` = '$lastname', 
                           `phone` = '$phoneNo' WHERE `id` = '$id'";
                if ($functions->getConnection()->query($sql) === true) {
                    $_SESSION['firstname'] = $firstname;
                    header("Refresh: 1; url=profile.php");
                    echo "<br>";
                    echo '<div class="alert alert-success text-center" role="alert">
                    Updated Successfully!!!
                  </div>';
                    exit;
                } else {
                    echo "<br>";
                    echo '<div class="alert alert-danger text-center" role="alert">
                    Failed to Update!!!
                  </div>';
                }
            }
        }

        ?>
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
        <h2>Edit Personal Details</h2>
        <form action="edit_profile.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
            <div class="form-group">
                <label for="firstname">First Name: <span
                        class="text-danger"><?php echo "*" . $firstnameErr; ?></span></label>
                <input type="text" class="form-control" name="firstname" placeholder="First Name"
                    value="<?php echo htmlspecialchars($user['firstname'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name: <span
                        class="text-danger"><?php echo "*" . $lastnameErr; ?></span></label>
                <input type="text" class="form-control" name="lastname" placeholder="Last Name"
                    value="<?php echo htmlspecialchars($user['lastname'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="username">Username: </label>
                <input type="text" class="form-control" name="username"
                    value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>" readonly>
            </div>

            <div class="form-group">
                <label for="email">Email: </label>
                <input type="text" class="form-control" name="email"
                    value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="phone">Contact No: <span class="text-danger"><?php echo "*" . $phoneErr; ?></span></label>
                <input type="text" class="form-control" name="phone" placeholder="Contact No"
                    value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
            </div>

            <button type="submit" class="btn btn-primary" name="update">Update</button>
            <a href="profile.php" type="submit" class="btn btn-primary" name="cancel">Cancel</a>

        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>