<?php

require("Authenticate.php");
session_start();
$load = new Authenticate();

$load::generateCSRFToken();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = $load::login();
    if(empty($errors)) {
        session_regenerate_id(true);
    //    $_SESSION['identity'] = $load::getFormFieldValue('username');
        header('Location: /');
    }
}

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>login</title>
    </head>

    <body>

    </body>

</html>