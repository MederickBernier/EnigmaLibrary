using System.Text.RegularExpressions;

namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing various validation methods for common data formats.
    /// </summary>
    public static class ELValidation {
        /// <summary>
        /// Validates if the input string is a valid email address format.
        /// </summary>
        /// <param name="email">The email address string to validate.</param>
        /// <returns>True if the email is in a valid format; otherwise, false.</returns>
        public static bool IsValidEmail(string email) {
            if (string.IsNullOrWhiteSpace(email)) return false;

            // Regular expression pattern to validate email format
            var emailRegex = new Regex(@"^[^@\s]+@[^@\s]+\.[^@\s]+$");

            // Check if the email matches the regular expression pattern
            return emailRegex.IsMatch(email);
        }

        /// <summary>
        /// Validates if the input string is a valid URL format.
        /// </summary>
        /// <param name="url">The URL string to validate.</param>
        /// <returns>True if the URL is in a valid format; otherwise, false.</returns>
        public static bool IsValidUrl(string url) {
            if (string.IsNullOrWhiteSpace(url)) return false;

            // Regular expression pattern to validate URL format
            var urlRegex = new Regex(@"^https?:\/\/[^\s/$.?#].[^\s]*$");

            // Check if the URL matches the regular expression pattern
            return urlRegex.IsMatch(url);
        }

        /// <summary>
        /// Validates if the input string can be parsed as a numeric value.
        /// </summary>
        /// <param name="input">The string to validate.</param>
        /// <returns>True if the string is numeric; otherwise, false.</returns>
        public static bool IsNumeric(string input) {
            // Use double.TryParse to check if the input can be parsed to a double
            return double.TryParse(input, out _);
        }

        /// <summary>
        /// Validates if the input string is a valid phone number format (e.g., E.164 format).
        /// </summary>
        /// <param name="phoneNumber">The phone number string to validate.</param>
        /// <returns>True if the phone number is in a valid format; otherwise, false.</returns>
        public static bool IsValidPhoneNumber(string phoneNumber) {
            // Regular expression pattern to validate phone number format (e.g., E.164 international format)
            var phoneRegex = new Regex(@"^\+?[1-9]\d{1,14}$");

            // Check if the phone number matches the regular expression pattern
            return phoneRegex.IsMatch(phoneNumber);
        }

        /// <summary>
        /// Validates if the input string is a valid postal code format.
        /// </summary>
        /// <param name="postalCode">The postal code string to validate.</param>
        /// <returns>True if the postal code is in a valid format; otherwise, false.</returns>
        public static bool IsValidPostalCode(string postalCode) {
            // Regular expression pattern to validate postal code format (Canadian postal code format)
            var postalCodeRegex = new Regex(@"^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$");

            // Check if the postal code matches the regular expression pattern
            return postalCodeRegex.IsMatch(postalCode);
        }
    }
}
