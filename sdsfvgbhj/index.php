<?php
header_remove("X-Powered-By");
header("Content-Type: application/json");
header("Cache-Control: no-cache");

include("router.php");
include("amazon.php");

$router = new Amazon(
    $id="dghdghf",
    $secret="fdhdf"
);


$redirect_url = $router->code(
    $redirect="https://localost",
    $scopes=array(
        "profile",
        "me"
    )
);
echo $redirect_url;
//header("Location: $redirect_url", true, 301);