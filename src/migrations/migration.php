<?php

$servername = "db";
$username = "root";
$password = "example";
$dbName = "transaction_app";

$conn = new mysqli($servername, $username, $password, '', '3306');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE " . $dbName;

if ($conn->query($sql) === TRUE) {
    echo "Database created successfully \n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}

$conn->select_db($dbName);

$sql = <<<QUERY
CREATE TABLE IF NOT EXISTS transactions (
    id INT(11) AUTO_INCREMENT,
    invoice_id INT(11) NOT NULL,
    item_name VARCHAR(100) NOT NULL,
    amount DOUBLE NOT NULL,
    payment_type ENUM('1', '2') NOT NULL COMMENT '1. VA Number, 2. Credit Card',
    customer_name VARCHAR(100) NOT NULL,
    merchant_id INT(11) NOT NULL,
    status ENUM('1', '2', '3') DEFAULT '1' COMMENT '1. Pending, 2. Paid, 3. Failed',
    PRIMARY KEY (id)
);
QUERY;


if ($conn->query($sql) === TRUE) {
    echo "Create table successfully \n";
} else {
    echo "Tables generated successfully: " . $conn->error . "\n";
}

$conn->close();
