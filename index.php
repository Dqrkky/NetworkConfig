<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

$method = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];

switch ($method) {
    case 'GET':
        if (preg_match('/\/api\/v1\/uptimerobot\/stats\/([\w@]+)\/([\w@]+)/', $request, $matches)) {
            $url = "http://stats.uptimerobot.com/api/getMonitor/{$matches[1]}?m={$matches[2]}";
            $command = "curl -s -L {$url}";
            $response = shell_exec($command);
            if ($response != null) {
                $new_response = json_decode($response, true);
                if ($new_response && isset($new_response['status']) && $new_response['status'] == 'ok') {
                    http_response_code(200);
                    header('Content-Type: application/json');
                    echo json_encode($new_response);
                } else {
                    http_response_code(400);
                    header('Content-Type: application/json');
                    echo json_encode(['error' => 'Status error']);
                };
            } else {
                http_response_code(400);
                header('Content-Type: application/json');
                echo json_encode(['message' => 'Invalid request']);
            };
        } else if (preg_match('/\/api\/v1\/uptimerobot\/stats\/([\w@]+)/', $request, $matches)) {
            $url = "http://stats.uptimerobot.com/api/getMonitorList/{$matches[1]}";
            $command = "curl -s -L {$url}";
            $response = shell_exec($command);
            if ($response != null) {
                $new_response = json_decode($response, true);
                if ($new_response && isset($new_response['status']) && $new_response['status'] == 'ok') {
                    http_response_code(200);
                    header('Content-Type: application/json');
                    echo json_encode($new_response);
                } else {
                    http_response_code(400);
                    header('Content-Type: application/json');
                    echo json_encode(['error' => 'Status error']);
                };
            } else {
                http_response_code(400);
                header('Content-Type: application/json');
                echo json_encode(['message' => 'Invalid request']);
            };
        } else {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Invalid request']);
        };
        break;
    case 'POST': 
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Invalid request']);
        break;
    case 'PUT':
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Invalid request']);
        break;
    case 'DELETE':
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Invalid request']);
        break;
    default:
        http_response_code(405);
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Method not allowed']);
        break;
};
?>