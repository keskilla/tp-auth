<?php


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = $load::login();
    if(empty($errors)) {
       $issuer = 'http://domain.dev';
       $key = 'XicrRF1ZLIUc+NzB4uqdaVN';
       $now = new DateTimeImmutable();
       $expiry = $now->modify('+20 minutes')->getTimestamp();
       $payload = [
           'iss' =>$issurer,
           'aud' =>$issuer,
           'iat' =>$now->modify('+1 minute')->getTimestamp(),
           'sub' => Authenticate::getFormFieldValue('username'),
           'exp' => $expiry
       ];

       echo \Firebase\JWT::encode($payload, $key);
       exit;
    }
}

?>