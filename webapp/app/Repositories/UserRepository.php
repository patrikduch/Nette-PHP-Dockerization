<?php

namespace App\Repositories;

use App\Services\PasswordEncrypter;
use Nette;

final class UserRepository {

    private $database;
    private $passwordEncrypter;

    public function __construct(Nette\Database\Context $database, PasswordEncrypter $passwordEncrypter)
    {
        $this->database = $database;
        $this->passwordEncrypter = $passwordEncrypter;
    }

    public function signUpUser($username, $password) {

        $passwordHash = $this->passwordEncrypter->encryptPassword($password);

        if ($passwordHash) {
            $this->database->query(
                "INSERT INTO User (username, password)
                    VALUES ('$username', '$passwordHash');");
        }



    }

}