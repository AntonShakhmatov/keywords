<?php

namespace App\Model;

use Nette;
use Nette\Database\Connection;
use Nette\Database\Explorer;
use Nette\Security\Passwords;

class FetchModel{

    /**
     * @param Connection 
     */
    private $connection;

    /**
     * @param Explorer
     */
    public $database;

    /**
     * @param Passwords
     */
    public $passwords;
    public function __construct(Connection $connection, Explorer $database, Passwords $passwords){
        $this->connection = $connection;
        $this->database = $database;
        $this->passwords = $passwords;
    }

}