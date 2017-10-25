<?php

namespace Infrastructure\Authentication\Password;

use Authentication\Password\HashPassword;

final class DefaultHashPassword implements HashPassword
{
    public function hash(string $password) : string
    {
        return \password_hash($password, \PASSWORD_DEFAULT);
    }
}