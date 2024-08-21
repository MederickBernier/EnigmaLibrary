<?php

namespace EnigmaLibrary\Logging;

class ConsoleLogger implements LoggerInterface
{
    /**
     * Logs a message with a specific level to the console.
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
        echo $logEntry . PHP_EOL;
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

    protected function formatContext(array $context): string
    {
        return !empty($context) ? json_encode($context) : '';
    }
}