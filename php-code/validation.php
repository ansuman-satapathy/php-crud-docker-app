<?php
class validation
{
    // Normal validation
    function validateInput($data)
    {
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = trim($data);
        return $data;
    }

    // Email validation
    function validateEmail($data)
    {
        $data = $this->validateInput($data);
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            return "error";
        }
        return $data;
    }

    // Username validation
    function validateUsername($data)
    {
        global $errors;
        $data = $this->validateInput($data);
        if (!preg_match("/^[a-zA-Z0-9]*$/", $data)) {
            return "error";
        }
        return $data;
    }

    //Date Validation
    function validateDate($data)
    {
        $test_arr = explode('/', $data);
        if (count($test_arr) == 3) {
            if (checkdate($test_arr[0], $test_arr[1], $test_arr[2])) {
                return $data;
            } else {
                return "error";
            }
        } else {
            return "error";
        }
    }

    // Password validation
    function validatePassword($data)
    {
        $data = htmlspecialchars($data);
        if (strlen($data) < 6 || strlen($data) > 16) {
            return "error";
        }
        return $data;
    }
}