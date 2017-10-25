<?php

namespace Authentication\ReadModel;

interface ExistingUsers
{
    public function userExists(string $emailAddress) : bool;
}
