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
     * Begins a transaction.
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
     * Executes an arbitrary SQL query.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $query The SQL query to execute.
     * @param array $params Optional parameters for the query.
     * @return bool True on success, false on failure.
     */
    public static function executeQuery(\PDO $pdo, string $query, array $params = []): bool
    {
        $stmt = $pdo->prepare($query);
        return $stmt->execute($params);
    }

    /**
     * Fetches a single row from the database.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $query The SQL query to execute.
     * @param array $params Optional parameters for the query.
     * @return array The fetched row as an associative array.
     */
    public static function fetchSingle(\PDO $pdo, string $query, array $params = []): array
    {
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Bulk inserts multiple rows into a table.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $table The name of the table.
     * @param array $data An array of associative arrays representing rows to insert.
     * @return bool True on success, false on failure.
     */
    public static function bulkInsert(\PDO $pdo, string $table, array $data): bool
    {
        $columns = implode(', ', array_keys($data[0]));
        $placeholders = implode(', ', array_fill(0, count($data[0]), '?'));
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";

        $stmt = $pdo->prepare($sql);
        foreach ($data as $row) {
            if (!$stmt->execute(array_values($row))) {
                return false;
            }
        }
        return true;
    }

    /**
     * Truncates a table, removing all rows but keeping the structure intact.
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
     * Retrieves the list of columns from a table.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $table The name of the table.
     * @return array An array of column names.
     */
    public static function getTableColumns(\PDO $pdo, string $table): array
    {
        $stmt = $pdo->query("SHOW COLUMNS FROM {$table}");
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    /**
     * Counts the number of records in a table with optional conditions.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $table The name of the table.
     * @param array $conditions An associative array of conditions for the WHERE clause.
     * @return int The number of records matching the conditions.
     */
    public static function countRecords(\PDO $pdo, string $table, array $conditions = []): int
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
     * Fetches all rows from a query.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $sql The SQL query to execute.
     * @param array $params Optional parameters for the query.
     * @return array The fetched rows as an array of associative arrays.
     */
    public static function fetchAll(\PDO $pdo, string $sql, array $params = []): array
    {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Fetches a single column from a query.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $sql The SQL query to execute.
     * @param array $params Optional parameters for the query.
     * @param int $columnIndex The index of the column to fetch.
     * @return array The fetched column as an array.
     */
    public static function fetchColumn(\PDO $pdo, string $sql, array $params = [], int $columnIndex = 0): array
    {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN, $columnIndex);
    }

    /**
     * Counts the number of rows in a table with optional conditions.
     * 
     * @param \PDO $pdo The PDO instance for the database connection.
     * @param string $table The name of the table.
     * @param array $conditions Optional conditions for the query.
     * @return int The number of rows in the table.
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
}