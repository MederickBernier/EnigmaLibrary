using System.Globalization;

namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class for basic localization functionality.
    /// </summary>
    public static class ELLocalization {
        /// <summary>
        /// Sets the current UI culture to the specified target language.
        /// Note: This method does not perform actual translation of the input string; 
        /// it only changes the UI culture for resource-based localization.
        /// </summary>
        /// <param name="input">The string to be "translated" (in this implementation, the string is returned unchanged).</param>
        /// <param name="targetLanguage">The target language code (e.g., "en-US", "fr-FR").</param>
        /// <returns>The input string, unchanged.</returns>
        public static string Translate(string input, string targetLanguage) {
            // Set the current UI culture to the specified target language
            Thread.CurrentThread.CurrentUICulture = new CultureInfo(targetLanguage);

            // Return the input string unchanged (this method is a placeholder for real translation functionality)
            return input;
        }
    }
}
