<?php

namespace EnigmaLibrary\Logging;

class BufferLogger implements LoggerInterface
{
    protected array $buffer = [];
    protected int $bufferSize;
    protected LoggerInterface $delegateLogger;

    /**
     * Constructor to initialize the buffer size and the logger to delegate to.
     *
     * @param LoggerInterface $delegateLogger The logger to write to when the buffer is flushed.
     * @param int $bufferSize The maximum number of log entries to hold before flushing.
     */
    public function __construct(LoggerInterface $delegateLogger, int $bufferSize = 10)
    {
        $this->delegateLogger = $delegateLogger;
        $this->bufferSize = $bufferSize;
    }

    public function log(string $level, string $message, array $context = []): void
    {
        $this->buffer[] = compact('level', 'message', 'context');
        if (count($this->buffer) >= $this->bufferSize) {
            $this->flush();
        }
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
     * Flushes the log buffer by writing all entries to the delegate logger.
     *
     * @return void
     */
    public function flush(): void
    {
        foreach ($this->buffer as $logEntry) {
            $this->delegateLogger->log($logEntry['level'], $logEntry['message'], $logEntry['context']);
        }
        $this->buffer = [];
    }

    /**
     * Destructor to ensure that any remaining log entries are flushed.
     */
    public function __destruct()
    {
        $this->flush();
    }
}