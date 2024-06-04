<?php
include 'db_connect.php';
include 'validation.php';
class functions
{
    private $conn;

    //db connection
    public function __construct()
    {
        $db = new db_connect();
        $this->conn = $db->connect();
    }
    public function getConnection()
    {
        return $this->conn;
    }

    //function to insert a new record
    public function insertRecord($post)
    {
        $check = new Validation();

        $firstname = $check->validateInput($_POST['firstname']);
        $lastname = $check->validateInput($_POST['lastname']);
        $email = $check->validateEmail($_POST['email']);
        $contactNo = $check->validateInput($_POST['contact-no']);
        $address = $check->validateInput($_POST['address']);
        $salary = $check->validateInput($_POST['salary']);
        $joining_date = $check->validateInput($_POST['joining-date']);
        $dept_id = $_POST['dept-id'];
        $admin_id = $_SESSION['admin_id'];

        //insert query
        $sql = $this->conn->query("INSERT INTO `employees` 
        (`firstname`, `lastname`, `email`, `contactNo`, `address`, `salary`, `joining_date`, `admin_id`, `dept_id`) VALUES 
        ('$firstname', '$lastname', '$email', '$contactNo', '$address', '$salary', '$joining_date', '$admin_id', '$dept_id')");

        if ($sql) {
            // echo "New record inserted successfully!"; 
        } else {
            echo "ERROR! " . $this->conn->error;
        }
    }

    //function to fetch record
    public function fetchRecord()
    {
        $admin_id = $_SESSION['admin_id'];
        $sql = $this->conn->query("SELECT employees.id, employees.firstname, employees.lastname, employees.email,
        employees.contactNo, employees.address, employees.salary, employees.joining_date, dept.name AS dept_name
        FROM employees
        INNER JOIN dept ON employees.dept_id = dept.id
        WHERE employees.admin_id = '$admin_id';
");

        if ($sql) {
            $results = [];
            while ($row = $sql->fetch_assoc()) {
                $results[] = $row;
            }
            return $results;
        } else {
            echo "ERROR! " . $this->conn->error;
        }
    }


    //function to delete a record
    public function deleteRecord($id)
    {
        $admin_id = $_SESSION['admin_id'];
        $sql = $this->conn->query("DELETE FROM `employees` WHERE `id` = '$id' AND `admin_id` = '$admin_id'");
        if ($sql) {
            // echo "Record deleted Successfully!";
        } else {
            echo "Error deleting record!" . $this->conn->error;
        }
    }

    //function to edit a record
    public function editRecord($id)
    {
        $check = new Validation();
        $admin_id = $_SESSION['admin_id'];


        $firstname = $check->validateInput($_POST['firstname']);
        $lastname = $check->validateInput($_POST['lastname']);
        $email = $check->validateEmail($_POST['email']);
        $contactNo = $check->validateInput($_POST['contact-no']);
        $address = $check->validateInput($_POST['address']);
        $salary = $check->validateInput($_POST['salary']);
        $joining_date = $check->validateInput($_POST['joining-date']);

        //update query
        $sql = $this->conn->query("UPDATE `employees` SET `firstname`='$firstname', `lastname`='$lastname', `email`='$email',`contactNo`='$contactNo', 
              `address`='$address', `salary`='$salary', `joining_date`='$joining_date' WHERE `id` = '$id' AND `admin_id` = '$admin_id'");
        if ($sql) {
            // echo "<center><h3>Record Updated Successfully!!!</h3></center>";
        } else {
            echo "ERROR! " . $this->conn->error;
        }
    }
}
