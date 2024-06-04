<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
include 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                    // Enable verbose debug output
        $mail->isSMTP();                                        // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                        // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'ansumanyt8@gmail.com';            // SMTP username
        $mail->Password = 'blmmpxrpiydypwnq';               // SMTP password
        $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );


        $row = null;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $functions = new functions();
            $sql = $functions->getConnection()->query("SELECT email FROM `employees` WHERE `id` = '$id'");
            if ($sql) {
                if ($sql->num_rows == 1) {
                    $row = $sql->fetch_assoc();
                } else {
                    echo "Error: No matching record found!";
                }
            } else {
                echo "Error fetching record!";
            }
        } else {
            echo "Error: ID parameter missing!";
        }

        if (isset($_POST['submit'])) {
            if ($row) {

                $mail->setFrom('ansumanyt8@gmail.com', 'ADMIN');
                $mail->addAddress($row['email']); // Add a recipient
                $mail->isHTML(true);
                $mail->Subject = $_POST['subject'];
                $mail->Body = $_POST['message'];
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                if ($mail->send()) {
                    echo '<div class="alert alert-success text-center" role="alert">
            Email Sent Successfully!!!
          </div>';
                } else {
                    echo    '<div class="alert alert-danger text-center" role="alert">
                Failed to send Email!!!
              </div>';
                }
            } else {
                echo '<div class="alert alert-danger text-center" role="alert">
            "Error: Unable to send email. Recipient email not found."
          </div>';
            }
        }

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    ?>

    <div class="container mt-5">
        <h3>Send a Message: </h3>
        <form action="mail.php?id=<?php echo isset($id) ? $id : ''; ?>" method="post">
            <div class="form-group">
                <label for="email-to">Email To:<span class="text-danger"></span></label>
                <input type="text" class="form-control" name="email-to" placeholder="Receiver's Email ID"
                    value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="subject">Subject: <span class="text-danger"></span></label>
                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
            </div>
            <div class="form-group">
                <label for="message">Message: <span class="text-danger"></span></label>
                <input type="text" class="form-control" name="message" placeholder="Message" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Send</button>
            <a href="dashboard.php" type="submit" class="btn btn-primary" name="cancel">Cancel</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>