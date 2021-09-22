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
