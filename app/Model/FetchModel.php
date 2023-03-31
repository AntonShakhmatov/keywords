<?php

namespace App\Model;

use Nette;
use Nette\Database\Connection;
use Nette\Database\Explorer;
use Nette\Database\Context;
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
    
    /**
     * @param Context 
     */
    public $context;

    public function __construct(Connection $connection, Explorer $database, Passwords $passwords, Context $context){
        $this->connection = $connection;
        $this->database = $database;
        $this->passwords = $passwords;
        $this->context = $context;
    }

}