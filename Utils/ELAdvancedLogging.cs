namespace EnigmaLibrary.Utils;
public static class ELAdvancedLogging {
    private static readonly string logFilePath = "advanced_log.txt";

    public static void LogError(string message, Exception ex = null) {
        Log("ERROR", message, ex);
    }

    public static void LogInfo(string message) {
        Log("INFO", message);
    }

    public static void LogWarning(string message) {
        Log("WARNING", message);
    }

    private static void Log(string logType, string message, Exception ex = null) {
        string logMessage = $"{logType}: {DateTime.Now}: {message}";
        if (ex != null) {
            logMessage += $"{Environment.NewLine}Exception: {ex.Message}{Environment.NewLine}StackTrace: {ex.StackTrace}";
        }
        File.AppendAllText(logFilePath, logMessage + Environment.NewLine);
    }
}
