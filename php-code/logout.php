<?php
session_start();
//clear session variables
session_unset();
//destroy session
session_destroy();
//redirect
header("Location:login.php");
exit;
