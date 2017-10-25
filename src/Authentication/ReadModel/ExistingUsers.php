<?php

namespace Authentication\ReadModel;

use Authentication\EmailAddress;

interface ExistingUsers
{
    public function userExists(EmailAddress $emailAddress) : bool;
}
