namespace EnigmaLibrary;
public static class DirectoryUtils {
    public static void CreateDirectory(string path) {
        if (!Directory.Exists(path)) {
            Directory.CreateDirectory(path);
        }
    }

    public static bool DirectoryExists(string path) {
        return Directory.Exists(path);
    }

    public static void DeleteDirectory(string path, bool recursive) {
        if (Directory.Exists(path)) {
            Directory.Delete(path, recursive);
        }
    }
}
