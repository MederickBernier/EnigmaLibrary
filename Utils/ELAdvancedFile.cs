namespace EnigmaLibrary.Utils;
public static class ELAdvancedFile {
    public static string[] ReadAllLines(string path) {
        if (!File.Exists(path)) throw new FileNotFoundException("File not found");
        return File.ReadAllLines(path);
    }

    public static void WriteAllLines(string path, string[] lines) {
        File.WriteAllLines(path, lines);
    }

    public static void CopyDirectory(string sourceDir, string destinationDir, bool copySubDirs) {
        DirectoryInfo dir = new DirectoryInfo(sourceDir);
        DirectoryInfo[] dirs = dir.GetDirectories();

        if (!dir.Exists) throw new DirectoryNotFoundException($"Source directory not found: {sourceDir}");

        Directory.CreateDirectory(destinationDir);

        FileInfo[] files = dir.GetFiles();
        foreach (FileInfo file in files) {
            string tempPath = Path.Combine(destinationDir, file.Name);
            file.CopyTo(tempPath, false);
        }

        if (copySubDirs) {
            foreach (DirectoryInfo subdir in dirs) {
                string tempPath = Path.Combine(destinationDir, subdir.Name);
                CopyDirectory(subdir.FullName, tempPath, copySubDirs);
            }
        }
    }
}
