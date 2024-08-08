namespace EnigmaLibrary.Utils;
public static class ELFileHandler {
    public static bool FileExists(string path) {
        return File.Exists(path);
    }

    public static void DeleteFile(string path) {
        if (File.Exists(path)) {
            File.Delete(path);
        }
    }

    public static void CopyFile(string source, string destination) {
        if (File.Exists(source)) {
            File.Copy(source, destination, true);
        }
    }
}
