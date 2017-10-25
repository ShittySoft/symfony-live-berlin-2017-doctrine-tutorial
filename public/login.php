<?php

use Authentication\EmailAddress;
use Infrastructure\Authentication\Repository\FilesystemUsers;

require_once __DIR__ . '/../vendor/autoload.php';

$repository = new FilesystemUsers(__DIR__ . '/../data/users');

$user = $repository->get(new EmailAddress($_POST['emailAddress']));

if ($user->logIn($_POST['password'], 'password_verify')) {
    echo 'LOGIN OK';

    return;
}

echo 'LOGIN KO';