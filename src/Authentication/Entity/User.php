<?php

namespace Authentication\Entity;

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

    private function __construct(string $emailAddress, string $passwordHash)
    {
        $this->emailAddress = $emailAddress;
        $this->passwordHash = $passwordHash;
    }

    public static function register(
        string $emailAddress,
        string $password,
        callable $hashingMechanism,
        ExistingUsers $existingUsers
    ) : self {
        if ($existingUsers->userExists($emailAddress)) {
            throw new \LogicException(\sprintf(
                'User "%s" is already registered',
                $emailAddress
            ));
        }

        $hash = $hashingMechanism($password);

        return new self($emailAddress, $hash);
    }
}
