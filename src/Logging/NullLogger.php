<?php

namespace EnigmaLibrary\Logging;

class NullLogger implements LoggerInterface
{
    public function log(string $level, string $message, array $context = []): void
    {
        // No operation
    }

    public function info(string $message, array $context = []): void
    {
        // No operation
    }

    public function warning(string $message, array $context = []): void
    {
        // No operation
    }

    public function error(string $message, array $context = []): void
    {
        // No operation
    }
}