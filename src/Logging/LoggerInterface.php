<?php

namespace EnigmaLibrary\Logging;

interface LoggerInterface
{
    /**
     * Logs a message with a specific level.
     *
     * @param string $level The log level (e.g., 'error', 'warning', 'info').
     * @param string $message The log message.
     * @param array $context Optional. Additional context for the log entry.
     * @return void
     */
    public function log(string $level, string $message, array $context = []): void;

    /**
     * Logs an informational message.
     *
     * @param string $message The log message.
     * @param array $context Optional. Additional context for the log entry.
     * @return void
     */
    public function info(string $message, array $context = []): void;

    /**
     * Logs a warning message.
     *
     * @param string $message The log message.
     * @param array $context Optional. Additional context for the log entry.
     * @return void
     */
    public function warning(string $message, array $context = []): void;

    /**
     * Logs an error message.
     *
     * @param string $message The log message.
     * @param array $context Optional. Additional context for the log entry.
     * @return void
     */
    public function error(string $message, array $context = []): void;
}