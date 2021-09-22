<?php

require_once __DIR__ . "/../../model/Transaction.php";
require_once __DIR__ . "/../../config/Response.php";

header("Content-Type: application/json; charset=UTF-8");

$transaction = new Transaction();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    return Response::json([], 'Not found.', 404);
}

$postRequest = json_decode(file_get_contents('php://input'), true);

$params = [
    'invoiceId' => $postRequest['invoiceId'],
    'itemName' => $postRequest['itemName'],
    'amount' => $postRequest['amount'],
    'paymentType' => $postRequest['paymentType'],
    'customerName' => $postRequest['customerName'],
    'merchantId' => $postRequest['merchantId'],
    'referencesId' => 1,
];

if ($params['paymentType'] == 1) $vaNumber = rand(10000000, 99999999);
else $vaNumber = '';

$params['vaNumber'] = $vaNumber;
$params['status'] = 1;

$result = $transaction->createData(array_values($params));
$newData = $transaction->findById($result);

if ($result && $result > 0) {
    return Response::json(
        [
            "referencesId" => $newData['id'],
            "vaNumber" => $newData['va_number'],
            "status" => $transaction->generateStatus($newData['status'])
        ],
        'Success');
} else {
    return Response::json([], 'Error', 400);
}

