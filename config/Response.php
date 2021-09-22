<?php

class Response {

    static function json($data, $message = '', $status = 200) {
        header('Content-Type: application/json');

        if ($status == 200) {
            header('HTTP/1.1 200');
        } elseif ($status == 400) {
            header('HTTP/1.1 400');
        } elseif ($status == 404) {
            header('HTTP/1.1 404');
        }

        echo json_encode(self::generateResponse($data, $message, $status));
    }

    static function generateResponse($data, $message, $status) {
        $statusResponse = '';

        if ($status == 200) {
            $statusResponse = 'OK';
        } else {
            $statusResponse = 'ERROR';
        }

        return [
            'status' => $statusResponse,
            'data' => $data,
            'meta' => [
                'message' => $message
            ]
        ];
    }
}
