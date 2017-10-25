<?php

namespace Infrastructure\Authentication\Repository;

use Authentication\EmailAddress;
use Authentication\Entity\User;
use Authentication\Repository\Users;
use Doctrine\ORM\EntityManager;

final class DoctrineUsers implements Users
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function get(EmailAddress $emailAddress) : User
    {
        $user = $this->entityManager->find(User::class, $emailAddress->toString());

        if (! $user instanceof User) {
            throw new \OutOfBoundsException(\sprintf(
                'User "%s" could not be found',
                $emailAddress->toString()
            ));
        }

        return $user;
    }

    public function store(User $user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
