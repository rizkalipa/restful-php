<?php

require_once "./model/Transaction.php";
require_once "./config/Response.php";

$transaction = new Transaction();

$referenceId = getopt(null, ['referenceId:'])['referenceId'];
$status = getopt(null, ['status:'])['status'];

$result = $transaction->updateData([
    $status,
    $referenceId
]);

$updatedData = $transaction->findById($referenceId);
$updatedData['status'] = $transaction->generateStatus($updatedData['status']);

if ($result) {
    echo "Success write status \n\n";
    echo "Reference ID : " . $updatedData['id'] . "\n";
    echo "Status : " . $updatedData['status'];
} else {
    echo "Error";
}
