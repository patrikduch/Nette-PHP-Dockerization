<?php

namespace App\Services;

use Nette\Security\Passwords;

final class PasswordEncrypter
{
    /** @var Passwords */
    private $passwords;

    public function __construct(Passwords $passwords)
    {
        $this->passwords = $passwords;
    }

    public function encryptPassword($password) {
        return $this->passwords->hash($password);
    }
}
