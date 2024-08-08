namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing methods for handling and retrieving details of exceptions.
    /// </summary>
    public static class ELException {
        /// <summary>
        /// Retrieves the details of an exception, including the message and stack trace.
        /// </summary>
        /// <param name="e">The exception to retrieve details from.</param>
        /// <returns>A formatted string containing the exception message and stack trace.</returns>
        public static string GetExceptionDetails(Exception e) {
            // Return a formatted string with the exception message and stack trace
            return $"Exception: {e.Message}{Environment.NewLine}StackTrace: {e.StackTrace}";
        }

        /// <summary>
        /// Retrieves the details of the inner exception, if it exists.
        /// </summary>
        /// <param name="ex">The exception that may contain an inner exception.</param>
        /// <returns>A formatted string containing the inner exception details or a message indicating no inner exception exists.</returns>
        public static string GetInnerExceptionDetails(Exception ex) {
            // Check if the exception has an inner exception and return its details
            return ex.InnerException != null ? GetExceptionDetails(ex.InnerException) : "No inner exception";
        }

        /// <summary>
        /// Handles an exception by logging its details using the ELLogging utility class.
        /// </summary>
        /// <param name="ex">The exception to handle.</param>
        public static void HandleException(Exception ex) {
            // Log the exception details using the ELLogging utility
            ELLogging.LogError(GetExceptionDetails(ex));
        }
    }
}
