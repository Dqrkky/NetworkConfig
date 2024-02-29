<?php

$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestUri = $_SERVER["REQUEST_URI"];

$path = parse_url($requestUri, PHP_URL_PATH);
$parameters = $_GET;
header_remove("X-Powered-By");
header("Content-Type: application/json");

switch ($requestMethod) {
    case "GET":
        handleGetRequest($path, $parameters);
        break;
    case "POST":
        handlePostRequest($path, $parameters);
        break;
    case "PUT":
        handlePutRequest($path, $parameters);
        break;
    case "DELETE":
        handleDeleteRequest($path, $parameters);
        break;
    default:
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
}

function handleGetRequest($path, $parameters) {
    switch ($path) {
        case "/api/user":
            echo json_encode(["message" => "GET request to /api/user", "params" => $parameters]);
            break;
        case "/api/product":
            echo json_encode(["message" => "GET request to /api/product", "params" => $parameters]);
            break;
        default:
            http_response_code(404);
            echo json_encode(["error" => "Endpoint not found"]);
    }
}

function handlePostRequest($path, $parameters) {
    switch ($path) {
        case "/api/user":
            echo json_encode(["message" => "POST request to /api/user", "params" => $parameters]);
            break;
        case "/api/product":
            echo json_encode(["message" => "POST request to /api/product", "params" => $parameters]);
            break;
        default:
            http_response_code(404);
            echo json_encode(["error" => "Endpoint not found"]);
    }
}

function handlePutRequest($path, $parameters) {
    switch ($path) {
        case "/api/user":
            echo json_encode(["message" => "PUT request to /api/user", "params" => $parameters]);
            break;
        case "/api/product":
            echo json_encode(["message" => "PUT request to /api/product", "params" => $parameters]);
            break;
        default:
            http_response_code(404);
            echo json_encode(["error" => "Endpoint not found"]);
    }
}

function handleDeleteRequest($path, $parameters) {
    switch ($path) {
        case "/api/user":
            echo json_encode(["message" => "DELETE request to /api/user", "params" => $parameters]);
            break;
        case "/api/product":
            echo json_encode(["message" => "DELETE request to /api/product", "params" => $parameters]);
            break;
        default:
            http_response_code(404);
            echo json_encode(["error" => "Endpoint not found"]);
    }
}
?>