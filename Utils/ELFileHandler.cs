namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing methods for handling file operations such as checking existence, deleting, and copying files.
    /// </summary>
    public static class ELFileHandler {
        /// <summary>
        /// Checks if a file exists at the specified path.
        /// </summary>
        /// <param name="path">The path to the file to check.</param>
        /// <returns>True if the file exists; otherwise, false.</returns>
        public static bool FileExists(string path) {
            // Return true if the file exists at the specified path, otherwise false
            return File.Exists(path);
        }

        /// <summary>
        /// Deletes the file at the specified path if it exists.
        /// </summary>
        /// <param name="path">The path to the file to delete.</param>
        public static void DeleteFile(string path) {
            // Check if the file exists before attempting to delete it
            if (File.Exists(path)) {
                // Delete the file
                File.Delete(path);
            }
        }

        /// <summary>
        /// Copies a file from the source path to the destination path, overwriting the destination file if it exists.
        /// </summary>
        /// <param name="source">The path to the source file.</param>
        /// <param name="destination">The path to the destination file.</param>
        public static void CopyFile(string source, string destination) {
            // Check if the source file exists before attempting to copy it
            if (File.Exists(source)) {
                // Copy the source file to the destination path, overwriting the destination file if it exists
                File.Copy(source, destination, true);
            }
        }
    }
}
