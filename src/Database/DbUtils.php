<?php

namespace EnigmaLibrary\Database;

use PDO;

class DbUtils
{
    /**
     * Connects to a database using PDO
     * 
     * @param string $dnb The Data Source Name (DSN) for the database connection.
     * @param string $username The username for the database connection.
     * @param string $password The password for the database connection.
     * @return \PDO The PDO instance for the database connection.
     */
    public static function connectToDatabase(string $dsn, string $username, string $password): PDO
    {
        try {
            $pdo = new \PDO($dsn, $username, $password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\PDOException $e) {
            throw new \Exception('Database connection failed: ' . $e->getMessage());
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
    public static function buildSelectQuery(string $table, array $conditions = [], array $columns = ['*']): string
    {
        $columnsString = implode(',', $columns);
        $query = "SELECT {$columnsString} FROM {$table}";

        if (!empty($conditions)) {
            $whereClauses = array_map(
                fn($key, $value) => sprintf("%s = '%s'", $key, addslashes($value)),
                array_keys($conditions),
                $conditions
            );
            $query .= ' WHERE ' . implode(' AND ', $whereClauses);
        }
        return $query;
    }

    public static function insertData(\PDO $pdo, string $table, array $data): bool
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $pdo->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        return $stmt->execute();
    }

    public static function updateData(\PDO $pdo, string $table, array $data, array $conditions): bool
    {
        $setPart = implode(', ', array_map(fn($key) => "{$key} = :{$key}", array_keys($data)));
        $wherePart = implode(' AND ', array_map(fn($key) => "{$key} = :where_{$key}", array_keys($conditions)));
        $sql = "UPDATE {$table} SET {$setPart} WHERE {$wherePart}";
        $stmt = $pdo->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        foreach ($conditions as $key => $value) {
            $stmt->bindValue(":where_{$key}", $value);
        }

        return $stmt->execute();
    }

    public static function deleteData(\PDO $pdo, string $table, array $conditions): bool
    {
        $wherePart = implode(' AND ', array_map(fn($key) => "{$key} = :{$key}", array_keys($conditions)));
        $sql = "DELETE FROM {$table} WHERE {$wherePart}";
        $stmt = $pdo->prepare($sql);

        foreach ($conditions as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        return $stmt->execute();
    }
}