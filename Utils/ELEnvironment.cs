namespace EnigmaLibrary.Utils;
public static class ELEnvironment {
    public static string GetOperatingSystem() {
        return Environment.OSVersion.ToString();
    }

    public static string GetAppVersion() {
        return System.Reflection.Assembly.GetExecutingAssembly().GetName().Version.ToString();
    }

    public static string GetMachineName() {
        return Environment.MachineName;
    }

    public static int GetProcessorCount() {
        return Environment.ProcessorCount;
    }
}
