<?php

namespace EnigmaLibrary\Logging;

use PDO;

class DatabaseLogger implements LoggerInterface
{
    protected PDO $pdo;
    protected string $tableName;

    /**
     * Constructor to initialize the PDO instance and the table name.
     *
     * @param PDO $pdo The PDO instance for the database connection.
     * @param string $tableName The name of the table to log into.
     */
    public function __construct(PDO $pdo, string $tableName = 'logs')
    {
        $this->pdo = $pdo;
        $this->tableName = $tableName;
    }

    /**
     * Logs a message with a specific level to the database.
     *
     * @param string $level The log level (e.g., 'error', 'warning', 'info').
     * @param string $message The log message.
     * @param array $context Optional. Additional context for the log entry.
     * @return void
     */
    public function log(string $level, string $message, array $context = []): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO {$this->tableName} (level, message, context, created_at)
            VALUES (:level, :message, :context, :created_at)
        ");

        $stmt->execute([
            'level' => $level,
            'message' => $message,
            'context' => json_encode($context),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function info(string $message, array $context = []): void
    {
        $this->log('info', $message, $context);
    }

    public function warning(string $message, array $context = []): void
    {
        $this->log('warning', $message, $context);
    }

    public function error(string $message, array $context = []): void
    {
        $this->log('error', $message, $context);
    }
}