<?php
header_remove("X-Powered-By");
header("Content-Type: application/json");

include("router.php");
include("amazon.php");

$router = new Amazon(
    $id="dghdghf",
    $secret="fdhdf"
);
echo json_encode($router->code(
    $redirect="https://localost",
    $scopes=array(
        "profile",
        "me"
    )
))
?>