<?php

include ("HttpHandler.php");

$handler = new HandleMethod();

header_remove("X-Powered-By");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

$handler->register('on_get',function($config) {
    global $handler;
    switch ($config['path']) {
        case 'GET':
            case '/api/getIp':
                header("Content-Type: application/json");
                http_response_code(200);
                echo json_encode($handler->getIp(), JSON_PRETTY_PRINT);
                break;
            case '/api/getDevice':
                header("Content-Type: application/json");
                http_response_code(200);
                echo json_encode($handler->getDevice(), JSON_PRETTY_PRINT);
                break;
            case '/api/test':
                header("Content-Type: application/json");
                http_response_code(200);
                echo json_encode($handler->config, JSON_PRETTY_PRINT);
                break;
            default:
                if (preg_match('/\/api\/v1\/uptimerobot\/stats\/([\w@]+)\/([\w@]+)/', $config['path'], $matches)) {
                    $url = "http://stats.uptimerobot.com/api/getMonitor/{$matches[1]}?m={$matches[2]}";
                } else if (preg_match('/\/api\/v1\/uptimerobot\/stats\/([\w@]+)/', $config['path'], $matches)) {
                    $url = "http://stats.uptimerobot.com/api/getMonitorList/{$matches[1]}";
                } else {
                    $url = null;
                };
                if ($url) {
                    $command = "curl -s -L {$url}";
                    $response = shell_exec($command);
                    http_response_code(200);
                    header('Content-Type: application/json');
                    echo $response;
                    break;
                } else {
                    header("Content-Type: application/json");
                    http_response_code(405);
                    echo json_encode(array(
                        "error" => "Path {$config["path"]} doesnt exist"    
                    ), JSON_PRETTY_PRINT);
                }
    };
});

$handler->register("on_method_error", function (String $method) {
    header("Content-Type: application/json");
    http_response_code(405);
    echo json_encode(array(
        "error" => "Method $method not allowed"
    ), JSON_PRETTY_PRINT);
});

$handler->run();