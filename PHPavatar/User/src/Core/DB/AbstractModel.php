<?php


namespace Core\DB;

use Core\DB\Database;

abstract class AbstractModel
{

    protected $db;

    public function __construct(DatabaseInterface $db)
    {

        $this->db = $db;
    }

}