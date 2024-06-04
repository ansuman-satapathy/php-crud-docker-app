<?php
session_start();
include "functions.php";
if (isset($_GET['id']))
    $id = $_GET['id'];
$functions = new functions();
$functions->deleteRecord($id);
header("Refresh:1; url=dashboard.php");
echo "<br>";
echo '<div class="alert alert-success text-center" role="alert">Record Deleted Successfully!!!</div>';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>