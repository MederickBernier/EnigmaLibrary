namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing extended environment information about the system and user.
    /// </summary>
    public static class ELExtendedEnvironment {
        /// <summary>
        /// Retrieves the current user's username.
        /// </summary>
        /// <returns>A string representing the username of the current user.</returns>
        public static string GetCurrentUserName() {
            // Return the username of the current user
            return System.Environment.UserName;
        }

        /// <summary>
        /// Retrieves the path to the system directory.
        /// </summary>
        /// <returns>A string representing the path to the system directory.</returns>
        public static string GetSystemDirectory() {
            // Return the path to the system directory
            return System.Environment.SystemDirectory;
        }

        /// <summary>
        /// Retrieves a space-separated string of logical drive names.
        /// </summary>
        /// <returns>A string containing the names of all logical drives, separated by spaces.</returns>
        public static string GetLogicalDrives() {
            // Get an array of logical drive names and join them into a single string separated by spaces
            return string.Join(" ", System.Environment.GetLogicalDrives());
        }

        /// <summary>
        /// Determines if the operating system is 64-bit.
        /// </summary>
        /// <returns>True if the operating system is 64-bit; otherwise, false.</returns>
        public static bool Is64BitsOperatingSystem() {
            // Return true if the operating system is 64-bit, otherwise false
            return System.Environment.Is64BitOperatingSystem;
        }
    }
}
