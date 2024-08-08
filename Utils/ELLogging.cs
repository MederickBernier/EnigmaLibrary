namespace EnigmaLibrary.Utils;
public static class ELLogging {
    private static readonly string logFilePath = "log.txt";

    public static void LogError(string message) {
        Log("ERROR", message);
    }

    public static void LogInfo(string message) {
        Log("INFO", message);
    }

    public static void LogWarning(string message) {
        Log("WARNING", message);
    }

    private static void Log(string logType, string message) {
        File.AppendAllText(logFilePath, $"{logType}: {DateTime.Now}: {message}{Environment.NewLine}");
    }
}
