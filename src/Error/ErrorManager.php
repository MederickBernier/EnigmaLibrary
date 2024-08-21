<?php

namespace EnigmaLibrary\Error;

use EnigmaLibrary\Logging\LoggerInterface;

class ErrorManager implements ErrorManagerInterface
{
    /**
     * @var LoggerInterface The logger instance used for logging errors and exceptions.
     */
    protected static LoggerInterface $logger;

    /**
     * Handles PHP errors.
     *
     * @param int $errno The level of the error raised.
     * @param string $errstr The error message.
     * @param string $errfile The filename where the error was raised.
     * @param int $errline The line number where the error was raised.
     * @return bool True if the error was handled, false otherwise.
     */
    public static function handleError(int $errno, string $errstr, string $errfile, int $errline): bool
    {
        $errorMessage = sprintf(
            "PHP Error [Level: %d] %s in %s on line %d",
            $errno,
            $errstr,
            $errfile,
            $errline
        );

        self::$logger->error($errorMessage);

        // Don't execute PHP's internal error handler
        return true;
    }

    /**
     * Handles uncaught exceptions.
     *
     * @param \Throwable $exception The uncaught exception.
     * @return void
     */
    public static function handleException(\Throwable $exception): void
    {
        $exceptionMessage = sprintf(
            "Uncaught Exception [%s]: %s in %s on line %d\nStack trace:\n%s",
            get_class($exception),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine(),
            $exception->getTraceAsString()
        );

        self::$logger->error($exceptionMessage);
    }

    /**
     * Sets the global error and exception handlers.
     *
     * @return void
     */
    public static function setGlobalHandlers(): void
    {
        set_error_handler([self::class, 'handleError']);
        set_exception_handler([self::class, 'handleException']);
    }

    /**
     * Sets the logger to be used for logging errors and exceptions.
     *
     * @param LoggerInterface $logger The logger instance.
     * @return void
     */
    public static function setLogger(LoggerInterface $logger): void
    {
        self::$logger = $logger;
    }
}