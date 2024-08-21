<?php

namespace EnigmaLibrary\Logging;

class FileLogger implements LoggerInterface
{
    protected string $filePath;

    /**
     * Constructor to initialize the file path for logging.
     *
     * @param string $filePath The path to the log file.
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Logs a message with a specific level.
     *
     * @param string $level The log level (e.g., 'error', 'warning', 'info').
     * @param string $message The log message.
     * @param array $context Optional. Additional context for the log entry.
     * @return void
     */
    public function log(string $level, string $message, array $context = []): void
    {
        $logEntry = sprintf(
            "[%s] %s: %s %s",
            date('Y-m-d H:i:s'),
            strtoupper($level),
            $message,
            $this->formatContext($context)
        );
        file_put_contents($this->filePath, $logEntry . PHP_EOL, FILE_APPEND);
    }

    /**
     * Logs an informational message.
     *
     * @param string $message The log message.
     * @param array $context Optional. Additional context for the log entry.
     * @return void
     */
    public function info(string $message, array $context = []): void
    {
        $this->log('info', $message, $context);
    }

    /**
     * Logs a warning message.
     *
     * @param string $message The log message.
     * @param array $context Optional. Additional context for the log entry.
     * @return void
     */
    public function warning(string $message, array $context = []): void
    {
        $this->log('warning', $message, $context);
    }

    /**
     * Logs an error message.
     *
     * @param string $message The log message.
     * @param array $context Optional. Additional context for the log entry.
     * @return void
     */
    public function error(string $message, array $context = []): void
    {
        $this->log('error', $message, $context);
    }

    /**
     * Formats the context array into a JSON string for logging.
     *
     * @param array $context The context array.
     * @return string The formatted context as a JSON string.
     */
    protected function formatContext(array $context): string
    {
        return !empty($context) ? json_encode($context) : '';
    }
}