<?php

namespace Classes;

use \PDO;

class Database
{
    private $servername;
    private $username;
    private $password;
    private $databaseName;
    private $connection;

    public function __construct($servername, $username, $password, $databaseName)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->databaseName = $databaseName;
    }

    public function getConnection()
    {
        $this->connection = null;
        try {
            $this->connection = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->databaseName, $this->username, $this->password);
            $this->createTables();
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->connection;
    }
    
    private function createTables()
    {
        try {
            $dvdTable = "create table if not exists DVD (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                sku VARCHAR(30) NOT NULL,
                name VARCHAR(30) NOT NULL,
                price INT(6) NOT NULL,
                size INT(8) NOT NULL)";
            $bookTable = "create table if not exists BOOK (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                sku VARCHAR(30) NOT NULL,
                name VARCHAR(30) NOT NULL,
                price INT(6) NOT NULL,
                weight INT(3) NOT NULL)";
            $furnitureTable = "create table if not exists FURNITURE (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                sku VARCHAR(30) NOT NULL,
                name VARCHAR(30) NOT NULL,
                price INT(6) NOT NULL,
                height INT(5) NOT NULL,
                width INT(5) NOT NULL,
                length INT(5) NOT NULL)";
            $this->connection->exec($dvdTable);
            $this->connection->exec($bookTable);
            $this->connection->exec($furnitureTable);
        } catch(PDOException $exception) {
            echo $exception->getMessage();
        }
    }
}