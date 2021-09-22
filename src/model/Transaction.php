<?php

require_once __DIR__ . "/../config/Database.php";

class Transaction extends Database {

    public function getData($referencesId, $merchantId) {
        $bindParam = [];

        if ($referencesId) $bindParam[] = $referencesId;
        if ($merchantId) $bindParam[] = $merchantId;

        return $this->select("SELECT id, merchant_id, status FROM transactions WHERE id = ? AND merchant_id = ?", $bindParam, 'ii');
    }

    public function findById($referenceId) {
        return $this->select("SELECT * FROM transactions WHERE id = $referenceId")[0];
    }

    public function createData($body) {
        return $this->insert(
            "INSERT INTO transactions VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            $body,
            "sssssssss"
        );
    }

    public function updateData($params) {
        return $this->update(
            "UPDATE transactions SET status = ? WHERE id = ?",
            $params,
            "si"
        );
    }

    public function generateStatus($status) {
        switch ($status) {
            case 1: return 'Pending';
                break;
            case 2: return 'Paid';
                break;
            case 3: return 'Failed';
                break;
        }
    }
}
