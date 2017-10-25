<?php

namespace Authentication;

final class EmailAddress
{
    /**
     * @var string
     */
    private $emailAddress;

    public function __construct(string $emailAddress)
    {
        if (! filter_var($emailAddress, \FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(\sprintf(
                '"%s" is not an email',
                $emailAddress
            ));
        }

        $this->emailAddress = $emailAddress;
    }

    public function toString() : string
    {
        return $this->emailAddress;
    }
}
