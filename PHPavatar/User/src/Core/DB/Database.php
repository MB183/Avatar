<?php


namespace Core\DB;

use \PDO;
use \PDOStatement;

class Database implements DatabaseInterface
{

    const DB_HOST = 'localhost';
    const DB_NAME = 'avatar';
    const DB_USER = 'root';
    const DB_PASS = '';

    private $pdo;

    /**
     * Database constructor.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function executeQuery( $sql, array $params = [])
    {
        /**
         * @var PDOStatement
         */
        $statement = $this->pdo->prepare($sql);

        $statement->execute($params);

        return $statement;
    }

    public function queryOne( $sql, array $params = [])
    {
        /**
         * @var PDOStatement
         */
        $statement = $this->executeQuery($sql, $params);

        return $statement->fetch();
    }

    public function queryAll($sql, array $params = [])
    {
        /**
         * @var PDOStatement
         */
        $statement = $this->executeQuery($sql, $params);

        return $statement->fetchAll();
    }

}