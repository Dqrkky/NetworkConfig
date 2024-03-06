<?php

header_remove("X-Powered-By");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

$request = array(
    'method' => $_SERVER['REQUEST_METHOD'],
    'path' => parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH),
    'params' => $_GET
);

switch ($request['method']) {
    case 'GET':
        if (preg_match('/\/api\/v1\/uptimerobot\/stats\/([\w@]+)\/([\w@]+)/', $request['path'], $matches)) {
            $url = "http://stats.uptimerobot.com/api/getMonitor/{$matches[1]}?m={$matches[2]}";
            $command = "curl -s -L {$url}";
            $response = shell_exec($command);
            if ($response != null) {
                $new_response = json_decode($response, true);
                if ($new_response && isset($new_response['status']) && $new_response['status'] == 'ok') {
                    http_response_code(200);
                    header('Content-Type: application/json');
                    echo json_encode($new_response, JSON_PRETTY_PRINT);
                    break;
                } else {
                    http_response_code(400);
                    header('Content-Type: application/json');
                    echo json_encode(['error' => 'Status error'], JSON_PRETTY_PRINT);
                    break;
                };
            } else {
                http_response_code(400);
                header('Content-Type: application/json');
                echo json_encode(['message' => 'Invalid request'], JSON_PRETTY_PRINT);
                break;
            };
        } else if (preg_match('/\/api\/v1\/uptimerobot\/stats\/([\w@]+)/', $request['path'], $matches)) {
            $url = "http://stats.uptimerobot.com/api/getMonitorList/{$matches[1]}";
            $command = "curl -s -L {$url}";
            $response = shell_exec($command);
            if ($response != null) {
                $new_response = json_decode($response, true);
                if ($new_response && isset($new_response['status']) && $new_response['status'] == 'ok') {
                    http_response_code(200);
                    header('Content-Type: application/json');
                    echo json_encode($new_response, JSON_PRETTY_PRINT);
                    break;
                } else {
                    http_response_code(400);
                    header('Content-Type: application/json');
                    echo json_encode(['error' => 'Status error'], JSON_PRETTY_PRINT);
                    break;
                };
            } else {
                http_response_code(400);
                header('Content-Type: application/json');
                echo json_encode(['message' => 'Invalid request'], JSON_PRETTY_PRINT);
                break;
            };
        } else {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Invalid request'], JSON_PRETTY_PRINT);
            break;
        };
    default:
        http_response_code(405);
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Method not allowed'], JSON_PRETTY_PRINT);
        break;
};
?>