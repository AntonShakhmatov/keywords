<?php

namespace App\Model;

use Nette;
use Nette\Database\Connection;
use Nette\Database\Explorer;

class KeywordsModel
{

    /**
     * @param Explorer
     */
    public $database;

    /**
     * @param Connection
     */
    public $connection;
    
    public function __construct(Explorer $database, Connection $connection)
    {
        $this->database = $database;
        $this->connection = $connection;
    }


}
