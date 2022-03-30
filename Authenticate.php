<?php
declare(strict_types=1);

class Authenticate
{
    /**
     * @return bool
     */
    public static function isLoggedIn()
    {
        return (!empty($_SESSION['identity']));
    }

    /**
     * @throws \Exception
     */
    public static function generateCSRFToken()
    {
        if(empty($_SESSION['token'])) {
            $_SESSION['token'] = bin2hex(random_bytes(32));
        }
    }

    public static function login(): array
    {
        $errors = [];

        if (empty($_POST['username'])) {
            $errors['username'] = 'Username is missing';
        }

        if (empty($_POST['password'])) {
            $errors['password'] = 'password is missing';
        }

        if (empty($_POST['__csrf'])) {
            $errors['__csrf'] = 'token is missing';
        }

        if (!hash_equals($_SESSION['token'], $_POST['__csrf'])) {
            $errors['__csrf'] = 'CSRF token is invalid';
        }

        return $errors;

        
    }
}