<?php

namespace EnigmaLibrary\Error;

interface ErrorManagerInterface
{
    /**
     * Handles PHP errors.
     *
     * @param int $errno The level of the error raised.
     * @param string $errstr The error message.
     * @param string $errfile The filename where the error was raised.
     * @param int $errline The line number where the error was raised.
     * @return bool True if the error was handled, false otherwise.
     */
    public static function handleError(int $errno, string $errstr, string $errfile, int $errline): bool;

    /**
     * Handles uncaught exceptions.
     *
     * @param \Throwable $exception The uncaught exception.
     * @return void
     */
    public static function handleException(\Throwable $exception): void;

    /**
     * Sets the global error and exception handlers.
     *
     * @return void
     */
    public static function setGlobalHandlers(): void;

    /**
     * Sets the logger to be used for logging errors and exceptions.
     *
     * @param \EnigmaLibrary\Logging\LoggerInterface $logger The logger instance.
     * @return void
     */
    public static function setLogger(\EnigmaLibrary\Logging\LoggerInterface $logger): void;
}