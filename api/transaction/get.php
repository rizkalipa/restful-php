<?php

require_once __DIR__ . "/../../model/Transaction.php";
require_once __DIR__ . "/../../config/Response.php";

$transaction = new Transaction();

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    return Response::json([], 'Not found.', 404);
}

$referencesId = $_GET['referenceId'];
$merchantId = $_GET['merchantId'];

$data = $transaction->getData($referencesId, $merchantId);

if (count($data)) {
    $status = $data[0]['status'];
    $data[0]['status'] = $transaction->generateStatus($status);

    return Response::json($data);
} else {
    return Response::json([], 'Data not found', 404);
}
