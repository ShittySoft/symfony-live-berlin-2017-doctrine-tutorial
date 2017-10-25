<?php

namespace Infrastructure\Authentication\Repository;

use Authentication\EmailAddress;
use Authentication\Entity\User;
use Authentication\Repository\Users;

final class FilesystemUsers implements Users
{
    /**
     * @var string
     */
    private $directory;

    public function __construct(string $directory)
    {
        $this->directory = $directory;
    }

    public function get(EmailAddress $emailAddress) : User
    {
        if (! file_exists($this->directory . '/' . $emailAddress->toString())) {
            throw new \OutOfBoundsException(\sprintf(
                'User "%s" could not be found',
                $emailAddress->toString()
            ));
        }

        return \unserialize(\file_get_contents($this->directory . '/' . $emailAddress->toString()));
    }

    public function store(User $user)
    {
        $reflectionAddress = (new \ReflectionClass($user))->getProperty('emailAddress');

        $reflectionAddress->setAccessible(true);

        return \file_put_contents(
            $this->directory . '/' . $reflectionAddress->getValue($user),
            \serialize($user)
        );
    }
}
