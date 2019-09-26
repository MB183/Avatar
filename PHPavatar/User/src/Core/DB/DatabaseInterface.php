<?php

namespace Core\DB;
interface DatabaseInterface{

    public function queryOne( $sql, array $params);
    public function queryAll( $sql, array $params);
    public function executeQuery( $sql, array $params = []);

}
