namespace EnigmaLibrary.Utils;
public static class ELFile {
    public static string ReadFile(string path) {
        if (!File.Exists(path)) throw new FileNotFoundException("File not Found");
        return File.ReadAllText(path);
    }

    public static void WriteFile(string path, string content) {
        File.WriteAllText(path, content);
    }

    public static void AppendToFile(string path, string content) {
        File.AppendAllText(path, content);
    }
}
