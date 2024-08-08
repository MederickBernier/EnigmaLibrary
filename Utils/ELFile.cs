namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing methods for common file operations.
    /// </summary>
    public static class ELFile {
        /// <summary>
        /// Reads the entire content of a file as a string.
        /// </summary>
        /// <param name="path">The path to the file to be read.</param>
        /// <returns>A string containing the content of the file.</returns>
        /// <exception cref="FileNotFoundException">Thrown if the specified file does not exist.</exception>
        public static string ReadFile(string path) {
            // Check if the file exists at the specified path
            if (!File.Exists(path))
                throw new FileNotFoundException("File not Found");

            // Read and return the content of the file
            return File.ReadAllText(path);
        }

        /// <summary>
        /// Writes the specified content to a file, overwriting the file if it already exists.
        /// </summary>
        /// <param name="path">The path to the file to be written.</param>
        /// <param name="content">The content to write to the file.</param>
        public static void WriteFile(string path, string content) {
            // Write the specified content to the file, overwriting it if it already exists
            File.WriteAllText(path, content);
        }

        /// <summary>
        /// Appends the specified content to a file. If the file does not exist, it creates a new file.
        /// </summary>
        /// <param name="path">The path to the file to be appended.</param>
        /// <param name="content">The content to append to the file.</param>
        public static void AppendToFile(string path, string content) {
            // Append the specified content to the file, creating the file if it does not exist
            File.AppendAllText(path, content);
        }
    }
}
