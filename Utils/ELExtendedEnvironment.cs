namespace EnigmaLibrary.Utils;
public static class ELExtendedEnvironment {
    public static string GetCurrentUserName() {
        return Environment.UserName;
    }

    public static string GetSystemDirectory() {
        return Environment.SystemDirectory;
    }

    public static string GetLogicalDrives() {
        return string.Join(" ", Environment.GetLogicalDrives());
    }

    public static bool Is64BitsOperatingSystem() {
        return Environment.Is64BitOperatingSystem;
    }
}
