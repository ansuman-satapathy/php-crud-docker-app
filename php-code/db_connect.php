<?php
define('DB_SERVER', "mysql");
define('DB_USER', "root");
define('DB_PASS', "mariadb");
define('DB_NAME', "emp_management");

class db_connect
{
    function connect()
    {
        $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        // Check connection
        if ($conn->errno) {
            echo "Failed to connect to MySQL: " . $conn->errno;
        }
        return $conn;
    }
}

/*
/*
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL, 
    phone VARCHAR(15)
);
*/

/*
CREATE TABLE dept (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50)
);
*/

/*
CREATE TABLE employees(
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(30),
    lastname VARCHAR(30),
    email VARCHAR(100),
    contactNo VARCHAR(10),
    address VARCHAR(200),
    salary VARCHAR(12),
    joining_date DATE,
    admin_id INT,
    dept_id INT,
    FOREIGN KEY(admin_id) REFERENCES admins(id),
    FOREIGN KEY(dept_id) REFERENCES dept(id)
);
*/

