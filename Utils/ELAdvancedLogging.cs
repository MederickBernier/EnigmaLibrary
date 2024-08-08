namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing advanced logging functionality.
    /// Logs are written to a text file, with different log levels (Error, Info, Warning).
    /// </summary>
    public static class ELAdvancedLogging {
        // Static readonly field to hold the path of the log file.
        private static readonly string logFilePath = "advanced_log.txt";

        /// <summary>
        /// Logs an error message, optionally including an exception's details.
        /// </summary>
        /// <param name="message">The error message to log.</param>
        /// <param name="ex">Optional: The exception to include in the log.</param>
        public static void LogError(string message, Exception ex = null) {
            // Call the private Log method with "ERROR" as the log type.
            Log("ERROR", message, ex);
        }

        /// <summary>
        /// Logs an informational message.
        /// </summary>
        /// <param name="message">The informational message to log.</param>
        public static void LogInfo(string message) {
            // Call the private Log method with "INFO" as the log type.
            Log("INFO", message);
        }

        /// <summary>
        /// Logs a warning message.
        /// </summary>
        /// <param name="message">The warning message to log.</param>
        public static void LogWarning(string message) {
            // Call the private Log method with "WARNING" as the log type.
            Log("WARNING", message);
        }

        /// <summary>
        /// A private method that handles the core logging functionality for all log types.
        /// </summary>
        /// <param name="logType">The type of log (ERROR, INFO, WARNING).</param>
        /// <param name="message">The message to log.</param>
        /// <param name="ex">Optional: The exception to include in the log.</param>
        private static void Log(string logType, string message, Exception ex = null) {
            // Construct the log message with the log type, current date and time, and the provided message.
            string logMessage = $"{logType}: {DateTime.Now}: {message}";

            // If an exception is provided, include its message and stack trace in the log.
            if (ex != null) {
                logMessage += $"{Environment.NewLine}Exception: {ex.Message}{Environment.NewLine}StackTrace: {ex.StackTrace}";
            }

            // Append the constructed log message to the log file, adding a new line.
            File.AppendAllText(logFilePath, logMessage + Environment.NewLine);
        }
    }
}
