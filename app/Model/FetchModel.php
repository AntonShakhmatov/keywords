<?php

namespace App\Model;

use Nette;
use Nette\Database\Connection;
use Nette\Database\Explorer;

class FetchModel{

    /**
     * @param Connection 
     */
    private $connection;

    /**
     * @param Explorer
     */
    public $database;

    public function __construct(Connection $connection, Explorer $database){
        $this->connection = $connection;
        $this->database = $database;
    }

}