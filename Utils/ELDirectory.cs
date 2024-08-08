namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing methods for common directory operations.
    /// </summary>
    public static class ELDirectory {
        /// <summary>
        /// Creates a directory at the specified path if it does not already exist.
        /// </summary>
        /// <param name="path">The path of the directory to create.</param>
        public static void CreateDirectory(string path) {
            // Check if the directory does not exist
            if (!Directory.Exists(path)) {
                // Create the directory
                Directory.CreateDirectory(path);
            }
        }

        /// <summary>
        /// Checks if a directory exists at the specified path.
        /// </summary>
        /// <param name="path">The path of the directory to check.</param>
        /// <returns>True if the directory exists; otherwise, false.</returns>
        public static bool DirectoryExists(string path) {
            // Return true if the directory exists, otherwise false
            return Directory.Exists(path);
        }

        /// <summary>
        /// Deletes a directory at the specified path, with an option to delete recursively.
        /// </summary>
        /// <param name="path">The path of the directory to delete.</param>
        /// <param name="recursive">True to delete directories, subdirectories, and files in the specified directory; otherwise, false.</param>
        public static void DeleteDirectory(string path, bool recursive) {
            // Check if the directory exists
            if (Directory.Exists(path)) {
                // Delete the directory, with the option to delete all its contents recursively
                Directory.Delete(path, recursive);
            }
        }
    }
}
