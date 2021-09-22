<?php

require_once __DIR__ . "/../config/Const.php";

class Database {

    private $host = HOSTNAME;
    private $username = USERNAME;
    private $password = PASSWORD;
    private $dbName = DATABASE;
    public $conn;

    public function __construct() {
        $this->conn = null;
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbName);

        if ($this->conn->connect_error) {
            die("Connection failed : " . $this->conn->connect_error);
        }
    }

    public function select($query = '', $bindParam = [], $typeBind = '') {
        try {
            if (count($bindParam)) {
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param($typeBind, $referenceId, $merchantId);
                list($referenceId, $merchantId) = $bindParam;
                $stmt->execute();
                $result = $stmt->get_result();
            } else {
                $result = $this->conn->query($query);
            }

            $data = [];

            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        } catch (Error $e) {
            $data = [];
        }

        return $data;
    }

    public function insert($query, $bindParam, $typeBind) {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($typeBind, $invoiceId, $itemName, $amount, $paymentType, $customerName, $merchantId, $referencesId, $vaNumber, $status);
        list($invoiceId, $itemName, $amount, $paymentType, $customerName, $merchantId, $referencesId, $vaNumber, $status) = $bindParam;
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function update($query, $bindParam, $typeBind) {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($typeBind, $status, $referencesId);
        list($status, $referencesId) = $bindParam;

        return $stmt->execute();
    }
}
