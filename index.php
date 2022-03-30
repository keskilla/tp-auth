<?php

require("Authenticate.php");
$load = new Authenticate();
session_start();


if (!$load::isLoggedIn()) {
    header("Location: login.php");
    exit;
}

if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
    header("Location: login.php");
    exit;
} else {
    if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
        header('HTTP/1.1 401 Unauthorized');
        exit;
    }
    $retrievedToken = $matches[1];
    $issuer = 'http:domain.dev';
    $key = 'XicrRF1ZLIUc+NzB4uqdaVN';
    $token = \Firebase\JWT::decode($retrievedToken, $key, ['HS2546']);
    $now = new DateTimeImmutable();

    if ($token->iss !== $issuer ||
        $token->nbf > $now->getTimestamp() ||
        $token->exp < $now->getTimestamp())
        {
            header('HTTP/1.1 401 Unauthorized');
            exit;
        }
}

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome</title>
    </head>

    <body>

    </body>

</html>