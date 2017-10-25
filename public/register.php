<?php

use Authentication\EmailAddress;
use Authentication\Entity\User;
use Infrastructure\Authentication\Password\DefaultHashPassword;
use Infrastructure\Authentication\ReadModel\BrutalExistingUsers;
use Infrastructure\Authentication\Repository\FilesystemUsers;

require_once __DIR__ . '/../vendor/autoload.php';

$emailAddress = new EmailAddress($_POST['emailAddress']);
$password     = $_POST['password'];

$repository    = new FilesystemUsers(__DIR__ . '/../data/users');
$existingUsers = new BrutalExistingUsers($repository);

$user = User::register(
    $emailAddress,
    $password,
    new DefaultHashPassword(),
    $existingUsers
);

$repository->store($user);

echo 'OK';