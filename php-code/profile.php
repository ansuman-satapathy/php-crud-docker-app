<?php
session_start();
include 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/profile.css">
    <title>Profile</title>
</head>

<body>
    <div class="container mt-4">
        <?php
        if (isset($_SESSION['username'])) {
            $functions = new functions();
            $username = $_SESSION['username'];
            $query = "SELECT * FROM admins WHERE `username` = '$username'";
            $result = $functions->getConnection()->query($query);
            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();
                ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Profile Details</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <?php
                            echo "Hello, " . $_SESSION['firstname'] . "!" . "<br>";
                            echo "Here are your details!" . "<br>";
                            echo "............................................" . "<br>";
                            echo "First Name: " . $user['firstname'] . "<br>";
                            echo "Last Name: " . $user['lastname'] . "<br>";
                            echo "User Name: " . $user['username'] . "<br>";
                            echo "Email: " . $user['email'] . "<br>";
                            echo "Phone No: " . $user['phone'] . "<br>";
                            ?>
                        </p>
                        <a href="edit_profile.php?id=<?php echo $user['id']; ?>" class="btn btn-primary">Edit Your Details</a>
                        <a href="reset_password.php" class="btn btn-primary">Reset Password</a>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>