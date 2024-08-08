namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing methods to retrieve various environment and system-related information.
    /// </summary>
    public static class ELEnvironment {
        /// <summary>
        /// Retrieves the operating system version and information as a string.
        /// </summary>
        /// <returns>A string representing the operating system version and information.</returns>
        public static string GetOperatingSystem() {
            // Return the operating system version and information
            return System.Environment.OSVersion.ToString();
        }

        /// <summary>
        /// Retrieves the current application's version as a string.
        /// </summary>
        /// <returns>A string representing the application's version.</returns>
        public static string GetAppVersion() {
            // Get the version of the currently executing assembly and return it as a string
            return System.Reflection.Assembly.GetExecutingAssembly().GetName().Version.ToString();
        }

        /// <summary>
        /// Retrieves the machine name on which the application is running.
        /// </summary>
        /// <returns>A string representing the machine name.</returns>
        public static string GetMachineName() {
            // Return the machine name
            return System.Environment.MachineName;
        }

        /// <summary>
        /// Retrieves the number of processors available on the machine.
        /// </summary>
        /// <returns>An integer representing the number of processors.</returns>
        public static int GetProcessorCount() {
            // Return the number of processors available
            return System.Environment.ProcessorCount;
        }
    }
}
