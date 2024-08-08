namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class for handling currency formatting operations.
    /// </summary>
    public static class ELCurrency {
        /// <summary>
        /// Formats a decimal amount as a currency string, according to the specified culture.
        /// </summary>
        /// <param name="amount">The monetary amount to format.</param>
        /// <param name="culture">The culture identifier (e.g., "en-US", "fr-FR") used to format the currency.</param>
        /// <returns>A string representing the formatted currency amount.</returns>
        public static string FormatCurrency(decimal amount, string culture) {
            // Create a CultureInfo object based on the provided culture identifier
            var cultureInfo = new System.Globalization.CultureInfo(culture);

            // Format the amount as a currency string according to the specified culture
            return string.Format(cultureInfo, "{0:C}", amount);
        }
    }
}
