<?php

namespace Authentication\Entity;

use Authentication\EmailAddress;
use Authentication\Password\HashPassword;
use Authentication\ReadModel\ExistingUsers;

class User
{
    /**
     * @var string
     */
    private $emailAddress;

    /**
     * @var string
     */
    private $passwordHash;

    private function __construct(EmailAddress $emailAddress, string $passwordHash)
    {
        $this->emailAddress = $emailAddress->toString();
        $this->passwordHash = $passwordHash;
    }

    public static function register(
        EmailAddress $emailAddress,
        string $password,
        HashPassword $hashingMechanism,
        ExistingUsers $existingUsers
    ) : self {
        if ($existingUsers->userExists($emailAddress)) {
            throw new \LogicException(\sprintf(
                'User "%s" is already registered',
                $emailAddress->toString()
            ));
        }

        return new self(
            $emailAddress,
            $hashingMechanism->hash($password)
        );
    }

    public function logIn(string $password, callable $passwordVerification) : bool
    {
        return $passwordVerification($password, $this->passwordHash);
    }
}
