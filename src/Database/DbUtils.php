<?php

namespace EnigmaLibrary\Database;

use PDO;

class DbUtils
{
    /**
     * Connects to a database using PDO.
     * 
     * @param string $dsn The Data Source Name (DSN) for the database connection.
     * @param string $username The username for the database connection.
     * @param string $password The password for the database connection.
     * @return \PDO The PDO instance for the database connection.
     * @throws \Exception if the connection fails.
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
     * Builds a SELECT SQL query.
     * 
     * @param string $table The name of the table.
     * @param array $conditions An associative array of conditions for the WHERE clause.
     * @param array $columns An array of columns to select. Defaults to all columns.
     * @return string The SQL query string.
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

    /**
     * Inserts data into a table.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $table The name of the table to insert data into.
     * @param array $data An associative array of data to insert (column => value).
     * @return bool True on success, false on failure.
     */
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

    /**
     * Updates data in a table.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $table The name of the table to update.
     * @param array $data An associative array of data to update (column => value).
     * @param array $conditions An associative array of conditions for the WHERE clause.
     * @return bool True on success, false on failure.
     */
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

    /**
     * Deletes data from a table.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $table The name of the table to delete data from.
     * @param array $conditions An associative array of conditions for the WHERE clause.
     * @return bool True on success, false on failure.
     */
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

    /**
     * Fetches all rows from a SQL query.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $sql The SQL query to execute.
     * @param array $params Optional parameters to bind to the query.
     * @return array An array of rows.
     */
    public static function fetchAll(\PDO $pdo, string $sql, array $params = []): array
    {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Fetches a single column from all rows in a SQL query.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $sql The SQL query to execute.
     * @param array $params Optional parameters to bind to the query.
     * @param int $columnIndex The index of the column to fetch.
     * @return array An array of values from the specified column.
     */
    public static function fetchColumn(\PDO $pdo, string $sql, array $params = [], int $columnIndex = 0): array
    {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN, $columnIndex);
    }

    /**
     * Counts the number of rows in a table that match the specified conditions.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $table The name of the table to count rows in.
     * @param array $conditions An associative array of conditions for the WHERE clause.
     * @return int The number of matching rows.
     */
    public static function countRows(\PDO $pdo, string $table, array $conditions = []): int
    {
        $sql = "SELECT COUNT(*) FROM {$table}";
        if (!empty($conditions)) {
            $wherePart = implode(' AND ', array_map(fn($key) => "{$key} = :{$key}", array_keys($conditions)));
            $sql .= " WHERE {$wherePart}";
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute($conditions);
        return (int) $stmt->fetchColumn();
    }

    /**
     * Begins a database transaction.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @return bool True on success, false on failure.
     */
    public static function beginTransaction(\PDO $pdo): bool
    {
        return $pdo->beginTransaction();
    }

    /**
     * Commits the current transaction.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @return bool True on success, false on failure.
     */
    public static function commitTransaction(\PDO $pdo): bool
    {
        return $pdo->commit();
    }

    /**
     * Rolls back the current transaction.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @return bool True on success, false on failure.
     */
    public static function rollBackTransaction(\PDO $pdo): bool
    {
        return $pdo->rollBack();
    }

    /**
     * Fetches a single row from a SQL query.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $sql The SQL query to execute.
     * @param array $params Optional parameters to bind to the query.
     * @return array|null The fetched row or null if no row is found.
     */
    public static function fetchSingleRow(\PDO $pdo, string $sql, array $params = []): ?array
    {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Executes a SQL query that does not return a result set (e.g., INSERT, UPDATE, DELETE).
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $sql The SQL query to execute.
     * @param array $params Optional parameters to bind to the query.
     * @return bool True on success, false on failure.
     */
    public static function executeQuery(\PDO $pdo, string $sql, array $params = []): bool
    {
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Gets the ID of the last inserted row.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string|null $name The name of the sequence object from which the ID should be returned.
     * @return string The ID of the last inserted row.
     */
    public static function getLastInsertId(\PDO $pdo, string $name = null): string
    {
        return $pdo->lastInsertId($name);
    }

    /**
     * Builds an INSERT SQL query.
     * 
     * @param string $table The name of the table.
     * @param array $data An associative array of data to insert (column => value).
     * @return string The SQL query string.
     */
    public static function buildInsertQuery(string $table, array $data): string
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        return "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
    }

    /**
     * Builds an UPDATE SQL query.
     * 
     * @param string $table The name of the table.
     * @param array $data An associative array of data to update (column => value).
     * @param array $conditions An associative array of conditions for the WHERE clause.
     * @return string The SQL query string.
     */
    public static function buildUpdateQuery(string $table, array $data, array $conditions): string
    {
        $setPart = implode(', ', array_map(fn($key) => "{$key} = :{$key}", array_keys($data)));
        $wherePart = implode(' AND ', array_map(fn($key) => "{$key} = :where_{$key}", array_keys($conditions)));
        return "UPDATE {$table} SET {$setPart} WHERE {$wherePart}";
    }

    /**
     * Truncates a table, deleting all its rows without removing the table structure.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $table The name of the table to truncate.
     * @return bool True on success, false on failure.
     */
    public static function truncateTable(\PDO $pdo, string $table): bool
    {
        $sql = "TRUNCATE TABLE {$table}";
        return $pdo->exec($sql) !== false;
    }

    /**
     * Creates a new table in the database.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $table The name of the table to create.
     * @param array $columns An associative array of columns (column name => definition).
     * @param array $options Additional SQL options for table creation.
     * @return bool True on success, false on failure.
     */
    public static function createTable(\PDO $pdo, string $table, array $columns, array $options = []): bool
    {
        $columnsSql = [];
        foreach ($columns as $column => $definition) {
            $columnsSql[] = "{$column} {$definition}";
        }
        $optionsSql = implode(' ', $options);
        $sql = "CREATE TABLE {$table} (" . implode(', ', $columnsSql) . ") {$optionsSql}";
        return $pdo->exec($sql) !== false;
    }

    /**
     * Drops a table from the database.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $table The name of the table to drop.
     * @return bool True on success, false on failure.
     */
    public static function dropTable(\PDO $pdo, string $table): bool
    {
        $sql = "DROP TABLE IF EXISTS {$table}";
        return $pdo->exec($sql) !== false;
    }

    /**
     * Fetches all values from a specific column in a table.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $table The name of the table.
     * @param string $column The name of the column to fetch.
     * @return array An array of values from the specified column.
     */
    public static function fetchAllColumns(\PDO $pdo, string $table, string $column): array
    {
        $sql = "SELECT {$column} FROM {$table}";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    /**
     * Fetches all distinct values from a specific column in a table.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $table The name of the table.
     * @param string $column The name of the column to fetch.
     * @return array An array of distinct values from the specified column.
     */
    public static function fetchColumnDistinct(\PDO $pdo, string $table, string $column): array
    {
        $sql = "SELECT DISTINCT {$column} FROM {$table}";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    /**
     * Locks a table for exclusive access.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $table The name of the table to lock.
     * @param string $mode The lock mode (default is 'WRITE').
     * @return bool True on success, false on failure.
     */
    public static function lockTable(\PDO $pdo, string $table, string $mode = 'WRITE'): bool
    {
        $sql = "LOCK TABLES {$table} {$mode}";
        return $pdo->exec($sql) !== false;
    }

    /**
     * Unlocks all previously locked tables.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @return bool True on success, false on failure.
     */
    public static function unlockTables(\PDO $pdo): bool
    {
        return $pdo->exec("UNLOCK TABLES") !== false;
    }

    /**
     * Checks if a table exists in the database.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $table The name of the table to check.
     * @return bool True if the table exists, false otherwise.
     */
    public static function tableExists(\PDO $pdo, string $table): bool
    {
        try {
            $result = $pdo->query("SELECT 1 FROM {$table} LIMIT 1");
        } catch (\PDOException $e) {
            return false;
        }
        return $result !== false;
    }

    /**
     * Fetches all values from a specific column in a table, filtered by conditions.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $table The name of the table.
     * @param string $column The name of the column to fetch.
     * @param array $conditions An associative array of conditions for the WHERE clause.
     * @return array An array of values from the specified column.
     */
    public static function fetchColumnByCondition(\PDO $pdo, string $table, string $column, array $conditions): array
    {
        $wherePart = implode(' AND ', array_map(fn($key) => "{$key} = :{$key}", array_keys($conditions)));
        $sql = "SELECT {$column} FROM {$table} WHERE {$wherePart}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($conditions);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }
}