<?php

namespace TaskForProman;

use PDO;
use PDOException;

class DatabaseConnector {
    private const DATABASE = "firebird:dbname=database.fdb;charset=utf8;";
    private const USERNAME = "sysdba";

    private array|false $row;

    function __construct (private readonly string $sql) {
        try {
            $pdoEstablish = new PDO(self::DATABASE, self::USERNAME, self::PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            $query = $pdoEstablish->query($this->sql);
            $this->row = $query->fetchAll(PDO::FETCH_OBJ);
            $query->closeCursor();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function getData(): array {
        return $this->row;
    }
}