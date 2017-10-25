<?php

namespace Infrastructure\Authentication\ReadModel;

use Authentication\Repository\Users;

final class BrutalExistingUsers implements \Authentication\ReadModel\ExistingUsers
{
    /**
     * @var Users
     */
    private $repository;

    public function __construct(Users $repository)
    {
        $this->repository = $repository;
    }

    public function userExists(string $emailAddress) : bool
    {
        try {
            $this->repository->get($emailAddress);
        } catch (\OutOfBoundsException $ignored) {
            return false;
        }

        return true;
    }
}
