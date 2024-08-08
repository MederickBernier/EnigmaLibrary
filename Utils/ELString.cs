namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing various string manipulation methods.
    /// </summary>
    public static class ELString {
        /// <summary>
        /// Converts a string to title case (capitalizes the first letter of each word).
        /// </summary>
        /// <param name="input">The input string to convert.</param>
        /// <returns>The input string in title case, or an empty string if the input is null or whitespace.</returns>
        public static string ToTitleCase(string input) {
            if (string.IsNullOrWhiteSpace(input)) return string.Empty;
            return System.Globalization.CultureInfo.CurrentCulture.TextInfo.ToTitleCase(input.ToLower());
        }

        /// <summary>
        /// Reverses the characters in a string.
        /// </summary>
        /// <param name="input">The input string to reverse.</param>
        /// <returns>The reversed string, or an empty string if the input is null or whitespace.</returns>
        public static string ReverseString(string input) {
            if (string.IsNullOrWhiteSpace(input)) return string.Empty;
            char[] charArray = input.ToCharArray();
            Array.Reverse(charArray);
            return new string(charArray);
        }

        /// <summary>
        /// Checks if a string is a palindrome (reads the same forward and backward).
        /// </summary>
        /// <param name="input">The input string to check.</param>
        /// <returns>True if the input string is a palindrome; otherwise, false.</returns>
        public static bool IsPalindrome(string input) {
            if (string.IsNullOrWhiteSpace(input)) return false;
            string reversed = ReverseString(input);
            return input.Equals(reversed, StringComparison.OrdinalIgnoreCase);
        }

        /// <summary>
        /// Removes special characters from a string, leaving only letters, digits, and whitespace.
        /// </summary>
        /// <param name="input">The input string from which to remove special characters.</param>
        /// <returns>A string containing only letters, digits, and whitespace, or an empty string if the input is null or whitespace.</returns>
        public static string RemoveSpecialCharacters(string input) {
            if (string.IsNullOrWhiteSpace(input)) return string.Empty;
            return new string(input.Where(c => char.IsLetterOrDigit(c) || char.IsWhiteSpace(c)).ToArray());
        }

        /// <summary>
        /// Checks if a string contains only letters.
        /// </summary>
        /// <param name="input">The input string to check.</param>
        /// <returns>True if the string contains only letters; otherwise, false.</returns>
        public static bool ContainsOnlyLetters(string input) {
            return !string.IsNullOrEmpty(input) && input.All(char.IsLetter);
        }

        /// <summary>
        /// Checks if a string contains only digits.
        /// </summary>
        /// <param name="input">The input string to check.</param>
        /// <returns>True if the string contains only digits; otherwise, false.</returns>
        public static bool ContainsOnlyDigits(string input) {
            return !string.IsNullOrEmpty(input) && input.All(char.IsDigit);
        }

        /// <summary>
        /// Checks if a string contains only letters and digits.
        /// </summary>
        /// <param name="input">The input string to check.</param>
        /// <returns>True if the string contains only letters and digits; otherwise, false.</returns>
        public static bool ContainsOnlyLettersAndDigits(string input) {
            return !string.IsNullOrEmpty(input) && input.All(char.IsLetterOrDigit);
        }
    }
}
