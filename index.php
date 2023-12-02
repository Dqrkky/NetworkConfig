<?php

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$parameters = $_GET;
$headers = apache_request_headers();
header_remove("X-Powered-By");
header("Content-Type: application/json");


switch ($_SERVER["REQUEST_METHOD"]) {
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
        echo json_encode(["error" => "Method not allowed"], JSON_PRETTY_PRINT);
}

// api.add_resource(ApiSpotifyAuthCode, "/api/spotify/auth/code")
// api.add_resource(ApiSpotifyAuthToken, "/api/spotify/auth/token")
// api.add_resource(ApiSpotifyRefreshToken, "/api/spotify/refresh/token")
// api.add_resource(ApiAmazonAuthCode, "/api/amazon/auth/code")
// api.add_resource(ApiAmazonAuthToken, "/api/amazon/auth/token")
// api.add_resource(ApiAmazonRefreshToken, "/api/amazon/refresh/token")
// api.add_resource(ApiGoogleAuthCode, "/api/google/auth/code")
// api.add_resource(ApiGoogleAuthToken, "/api/google/auth/token")
// api.add_resource(ApiGoogleRefreshToken, "/api/google/refresh/token")
function handleGetRequest($path, $parameters) {
    switch ($path) {
        case "/api/discord/auth/invite":
            echo json_encode(["message" => "GET request to /api/user", "params" => $parameters], JSON_PRETTY_PRINT);
            break;
        case "/api/discord/auth/code":
            echo json_encode(["message" => "GET request to /api/user", "params" => $parameters], JSON_PRETTY_PRINT);
            break;
        default:
            http_response_code(404);
            echo json_encode(["error" => "Endpoint not found"], JSON_PRETTY_PRINT);
    }
}

function handlePostRequest($path, $parameters) {
    switch ($path) {
        case "/api/discord/auth/token":
            echo json_encode(["message" => "POST request to /api/user", "params" => $parameters], JSON_PRETTY_PRINT);
            break;
        case "/api/discord/refresh/token":
                echo json_encode(["message" => "POST request to /api/user", "params" => $parameters], JSON_PRETTY_PRINT);
                break;
        default:
            http_response_code(404);
            echo json_encode(["error" => "Endpoint not found"], JSON_PRETTY_PRINT);
    }
}

function handlePutRequest($path, $parameters) {
    switch ($path) {
        case "/api/user":
            echo json_encode(["message" => "PUT request to /api/user", "params" => $parameters], JSON_PRETTY_PRINT);
            break;
        default:
            http_response_code(404);
            echo json_encode(["error" => "Endpoint not found"], JSON_PRETTY_PRINT);
    }
}

function handleDeleteRequest($path, $parameters) {
    switch ($path) {
        case "/api/user":
            echo json_encode(["message" => "DELETE request to /api/user", "params" => $parameters], JSON_PRETTY_PRINT);
            break;
        default:
            http_response_code(404);
            echo json_encode(["error" => "Endpoint not found"], JSON_PRETTY_PRINT);
    }
}
?>