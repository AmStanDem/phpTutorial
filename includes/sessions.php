<?php
session_start();

$logged_in = $_SESSION['logged_in'] ?? false;

function require_login($logged_in): void
{
    if ($logged_in === false || $logged_in === NULL)
    {
        header("Location: ../public/index.php");
        exit;
    }
}

function login($email,$password): void
{
    session_regenerate_id(true);
    $_SESSION['logged_in'] = true;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
}

function logout(): void
{
    session_unset();
    $_SESSION = [];
    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    session_destroy();
}