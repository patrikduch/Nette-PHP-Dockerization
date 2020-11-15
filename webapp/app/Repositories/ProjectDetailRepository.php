<?php

namespace App\Repositories;

use Nette;

class ProjectDetailRepository {

    private $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

    public function getProjectName() {

        return $this->database->fetch('SELECT name FROM PROJECTDETAIL');
    }
}