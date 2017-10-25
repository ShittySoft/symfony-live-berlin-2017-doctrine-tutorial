<?php

namespace Authentication\Repository;

use Authentication\EmailAddress;
use Authentication\Entity\User;

interface Users
{
    public function get(EmailAddress $emailAddress) : User;
    public function store(User $user);
}