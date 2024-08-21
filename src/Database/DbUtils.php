<?php

namespace EnigmaLibrary\Database;

use PDO;

class DbUtils{
    /**
     * Connects to a database using PDO
     * 
     * @param string $dnb The Data Source Name (DSN) for the database connection.
     * @param string $username The username for the database connection.
     * @param string $password The password for the database connection.
     * @return \PDO The PDO instance for the database connection.
     */
    public static function connectToDatabase(string $dsn, string $username, string $password):PDO{
        try{
            $pdo = new \PDO($dsn, $username, $password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch(\PDOException $e){
            throw new \Exception('Database connection failed: '.$e->getMessage());
        }
    }

    /**
     * Builds a SELECT SQL query
     * 
     * @param string $table The name of the table
     * @param array $conditions An associatve array of conditions for the WHERE clause
     * @param array $columns An array of columns to select. Defaults to all columns
     * @return string the SQL query string
     */
    public static function buildSelectQuery(string $table, array $conditions = [], array $columns = ['*']):string{
        $columnsString = implode(',',$columns);
        $query = "SELECT {$columnsString} FROM {$table}";

        if(!empty($conditions)){
            $whereClauses = array_map(
                fn($key, $value) => sprintf("%s = '%s'", $key, addslashes($value)),
                array_keys($conditions),
                $conditions
            );
            $query .= ' WHERE '.implode(' AND ', $whereClauses);
        }
        return $query;
    }
}