<?php

namespace Infrastructure\Authentication\Repository;

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

    public function get(string $emailAddress) : User
    {
        // @TODO LFI injection attack
        if (! file_exists($this->directory . '/' . $emailAddress)) {
            throw new \OutOfBoundsException(\sprintf(
                'User "%s" could not be found',
                $emailAddress
            ));
        }

        return \unserialize(\file_get_contents($this->directory . '/' . $emailAddress));
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
