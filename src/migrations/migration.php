<?php

$servername = "db";
$username = "root";
$password = "example";
$dbName = "transaction_app";

$conn = new mysqli($servername, $username, $password, '', '3306');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if no exist
$sql = "CREATE DATABASE " . $dbName;

if ($conn->query($sql) === TRUE) {
    echo "Database created successfully \n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}

$conn->select_db($dbName);

// Create table and seed dummy data
$sql = <<<QUERY
    CREATE TABLE IF NOT EXISTS transactions (
        id INT(11) AUTO_INCREMENT,
        invoice_id INT(11) NOT NULL,
        item_name VARCHAR(100) NOT NULL,
        amount DOUBLE NOT NULL,
        payment_type ENUM('1', '2') NOT NULL COMMENT '1. VA Number, 2. Credit Card',
        customer_name VARCHAR(100) NOT NULL,
        merchant_id INT(11) NOT NULL,
        references_id INT(11) NOT NULL,
        va_number VARCHAR(99) NULL,
        status ENUM('1', '2', '3') DEFAULT '1' COMMENT '1. Pending, 2. Paid, 3. Failed',
        PRIMARY KEY (id)
    );
    
    INSERT INTO transactions VALUES
        (NULL, 1, 'Gula', 35000, '1', 'Customer - 1', 1, 1, '', '1'),
        (NULL, 2, 'Garam', 55000, '2', 'Customer - 2', 2, 2, '', '2'),
        (NULL, 3, 'Roti', 75000, '3', 'Customer - 3', 3, 3, '', '3');
QUERY;


if ($conn->multi_query($sql) === TRUE) {
    echo "Create table successfully \n";
} else {
    echo "Tables generated successfully: " . $conn->error . "\n";
}

$conn->close();
