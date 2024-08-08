namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing simple logging functionality with different log levels.
    /// </summary>
    public static class ELLogging {
        // Path to the log file where all log entries will be written
        private static readonly string logFilePath = "log.txt";

        /// <summary>
        /// Logs an error message to the log file.
        /// </summary>
        /// <param name="message">The error message to log.</param>
        public static void LogError(string message) {
            // Log the error message with the "ERROR" log type
            Log("ERROR", message);
        }

        /// <summary>
        /// Logs an informational message to the log file.
        /// </summary>
        /// <param name="message">The informational message to log.</param>
        public static void LogInfo(string message) {
            // Log the informational message with the "INFO" log type
            Log("INFO", message);
        }

        /// <summary>
        /// Logs a warning message to the log file.
        /// </summary>
        /// <param name="message">The warning message to log.</param>
        public static void LogWarning(string message) {
            // Log the warning message with the "WARNING" log type
            Log("WARNING", message);
        }

        /// <summary>
        /// Appends a log entry to the log file with a specific log type and message.
        /// </summary>
        /// <param name="logType">The type of log (e.g., "ERROR", "INFO", "WARNING").</param>
        /// <param name="message">The message to log.</param>
        private static void Log(string logType, string message) {
            // Append the log entry to the log file with the specified log type, current timestamp, and message
            File.AppendAllText(logFilePath, $"{logType}: {DateTime.Now}: {message}{Environment.NewLine}");
        }
    }
}
