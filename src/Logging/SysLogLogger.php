<?php

namespace EnigmaLibrary\Logging;

class SyslogLogger implements LoggerInterface
{
    /**
     * Constructor to open syslog connection.
     */
    public function __construct()
    {
        openlog('EnigmaLibrary', LOG_ODELAY | LOG_PID, LOG_USER);
    }

    /**
     * Logs a message with a specific level to syslog.
     *
     * @param string $level The log level (e.g., 'error', 'warning', 'info').
     * @param string $message The log message.
     * @param array $context Optional. Additional context for the log entry.
     * @return void
     */
    public function log(string $level, string $message, array $context = []): void
    {
        $priority = $this->getSyslogPriority($level);
        $logEntry = sprintf("%s: %s %s", strtoupper($level), $message, $this->formatContext($context));
        syslog($priority, $logEntry);
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

    /**
     * Maps log levels to syslog priorities.
     *
     * @param string $level The log level.
     * @return int The syslog priority.
     */
    protected function getSyslogPriority(string $level): int
    {
        switch (strtolower($level)) {
            case 'error':
                return LOG_ERR;
            case 'warning':
                return LOG_WARNING;
            case 'info':
            default:
                return LOG_INFO;
        }
    }

    protected function formatContext(array $context): string
    {
        return !empty($context) ? json_encode($context) : '';
    }

    /**
     * Destructor to close syslog connection.
     */
    public function __destruct()
    {
        closelog();
    }
}