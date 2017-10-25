<?php

namespace Authentication\Password;

interface HashPassword
{
    public function hash(string $password) : string;
}
