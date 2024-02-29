<?php

header_remove("X-Powered-By");
header("Content-Type: application/json");

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$parameters = $_GET;

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        switch ($path) {
            case "/api/user":
                echo json_encode(["message" => "GET request to /api/user", "params" => $parameters], JSON_PRETTY_PRINT);
                break;
            default:
                http_response_code(404);
                echo json_encode(["error" => "Endpoint not found"], JSON_PRETTY_PRINT);
        }
    case "POST":
        switch ($path) {
            case "/api/user":
                echo json_encode(["message" => "POST request to /api/user", "params" => $parameters], JSON_PRETTY_PRINT);
                break;
            default:
                http_response_code(404);
                echo json_encode(["error" => "Endpoint not found"], JSON_PRETTY_PRINT);
        }
    case "PUT":
        switch ($path) {
            case "/api/user":
                echo json_encode(["message" => "PUT request to /api/user", "params" => $parameters], JSON_PRETTY_PRINT);
                break;
            default:
                http_response_code(404);
                echo json_encode(["error" => "Endpoint not found"], JSON_PRETTY_PRINT);
        }
    case "DELETE":
        switch ($path) {
            case "/api/user":
                echo json_encode(["message" => "DELETE request to /api/user", "params" => $parameters], JSON_PRETTY_PRINT);
                break;
            default:
                http_response_code(404);
                echo json_encode(["error" => "Endpoint not found"], JSON_PRETTY_PRINT);
        }
    default:
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"], JSON_PRETTY_PRINT);
}

?>