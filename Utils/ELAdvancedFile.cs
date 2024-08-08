namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing advanced file and directory operations.
    /// </summary>
    public static class ELAdvancedFile {
        /// <summary>
        /// Reads all lines from a specified file and returns them as an array of strings.
        /// </summary>
        /// <param name="path">The full path to the file to be read.</param>
        /// <returns>An array of strings, each representing a line in the file.</returns>
        /// <exception cref="FileNotFoundException">Thrown if the specified file does not exist.</exception>
        public static string[] ReadAllLines(string path) {
            // Check if the file exists at the specified path
            if (!File.Exists(path))
                throw new FileNotFoundException("File not found");

            // Read all lines from the file and return them as a string array
            return File.ReadAllLines(path);
        }

        /// <summary>
        /// Writes an array of strings to a specified file, overwriting the file if it already exists.
        /// </summary>
        /// <param name="path">The full path to the file to be written.</param>
        /// <param name="lines">The array of strings to be written to the file.</param>
        public static void WriteAllLines(string path, string[] lines) {
            // Write all provided lines to the specified file
            // If the file already exists, it will be overwritten
            File.WriteAllLines(path, lines);
        }

        /// <summary>
        /// Copies the contents of one directory to another directory. Optionally copies subdirectories as well.
        /// </summary>
        /// <param name="sourceDir">The source directory to copy from.</param>
        /// <param name="destinationDir">The destination directory to copy to.</param>
        /// <param name="copySubDirs">If true, all subdirectories will be copied recursively.</param>
        /// <exception cref="DirectoryNotFoundException">Thrown if the source directory does not exist.</exception>
        public static void CopyDirectory(string sourceDir, string destinationDir, bool copySubDirs) {
            // Create a DirectoryInfo object for the source directory
            DirectoryInfo dir = new DirectoryInfo(sourceDir);

            // Get all subdirectories within the source directory
            DirectoryInfo[] dirs = dir.GetDirectories();

            // If the source directory does not exist, throw an exception
            if (!dir.Exists)
                throw new DirectoryNotFoundException($"Source directory not found: {sourceDir}");

            // Ensure the destination directory exists; if not, create it
            Directory.CreateDirectory(destinationDir);

            // Get all files in the source directory
            FileInfo[] files = dir.GetFiles();

            // Copy each file to the destination directory
            foreach (FileInfo file in files) {
                // Combine the destination directory path with the file name
                string tempPath = Path.Combine(destinationDir, file.Name);

                // Copy the file to the destination directory, without overwriting existing files
                file.CopyTo(tempPath, false);
            }

            // If copying subdirectories is requested, copy them recursively
            if (copySubDirs) {
                foreach (DirectoryInfo subdir in dirs) {
                    // Combine the destination directory path with the subdirectory name
                    string tempPath = Path.Combine(destinationDir, subdir.Name);

                    // Recursively copy the subdirectory to the destination
                    CopyDirectory(subdir.FullName, tempPath, copySubDirs);
                }
            }
        }
    }
}
