<?php

use Authentication\Entity\User;
use Infrastructure\Authentication\ReadModel\BrutalExistingUsers;
use Infrastructure\Authentication\Repository\FilesystemUsers;

require_once __DIR__ . '/../vendor/autoload.php';

$emailAddress = $_POST['emailAddress'];
$password     = $_POST['password'];

$repository    = new FilesystemUsers(__DIR__ . '/../data/users');
$existingUsers = new BrutalExistingUsers($repository);

$user = User::register(
    $emailAddress,
    $password,
    function (string $password) : string {
        return \password_hash($password, \PASSWORD_DEFAULT);
    },
    $existingUsers
);

$repository->store($user);

echo 'OK';