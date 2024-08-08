namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing methods for validating if strings can be converted to various primitive types.
    /// </summary>
    public static class ELPrimitiveValidation {
        /// <summary>
        /// Checks if the input string can be parsed to an integer.
        /// </summary>
        /// <param name="input">The input string to validate.</param>
        /// <returns>True if the string can be parsed to an integer; otherwise, false.</returns>
        public static bool IsValidInt(string input) {
            return int.TryParse(input, out _);
        }

        /// <summary>
        /// Checks if the input string can be parsed to a double.
        /// </summary>
        /// <param name="input">The input string to validate.</param>
        /// <returns>True if the string can be parsed to a double; otherwise, false.</returns>
        public static bool IsValidDouble(string input) {
            return double.TryParse(input, out _);
        }

        /// <summary>
        /// Checks if the input string can be parsed to a float.
        /// </summary>
        /// <param name="input">The input string to validate.</param>
        /// <returns>True if the string can be parsed to a float; otherwise, false.</returns>
        public static bool IsValidFloat(string input) {
            return float.TryParse(input, out _);
        }

        /// <summary>
        /// Checks if the input string can be parsed to a long integer.
        /// </summary>
        /// <param name="input">The input string to validate.</param>
        /// <returns>True if the string can be parsed to a long integer; otherwise, false.</returns>
        public static bool IsValidLong(string input) {
            return long.TryParse(input, out _);
        }

        /// <summary>
        /// Checks if the input string can be parsed to a boolean.
        /// </summary>
        /// <param name="input">The input string to validate.</param>
        /// <returns>True if the string can be parsed to a boolean; otherwise, false.</returns>
        public static bool IsValidBool(string input) {
            return bool.TryParse(input, out _);
        }

        /// <summary>
        /// Checks if the input string can be parsed to a character.
        /// </summary>
        /// <param name="input">The input string to validate.</param>
        /// <returns>True if the string can be parsed to a character; otherwise, false.</returns>
        public static bool IsValidChar(string input) {
            return char.TryParse(input, out _);
        }

        /// <summary>
        /// Checks if the input string can be parsed to a decimal.
        /// </summary>
        /// <param name="input">The input string to validate.</param>
        /// <returns>True if the string can be parsed to a decimal; otherwise, false.</returns>
        public static bool IsValidDecimal(string input) {
            return decimal.TryParse(input, out _);
        }

        /// <summary>
        /// Checks if the input string can be parsed to a DateTime object.
        /// </summary>
        /// <param name="input">The input string to validate.</param>
        /// <returns>True if the string can be parsed to a DateTime; otherwise, false.</returns>
        public static bool IsValidDateTime(string input) {
            return DateTime.TryParse(input, out _);
        }

        /// <summary>
        /// Checks if the input string can be parsed to a byte.
        /// </summary>
        /// <param name="input">The input string to validate.</param>
        /// <returns>True if the string can be parsed to a byte; otherwise, false.</returns>
        public static bool IsValidByte(string input) {
            return byte.TryParse(input, out _);
        }

        /// <summary>
        /// Checks if the input string can be parsed to a short integer.
        /// </summary>
        /// <param name="input">The input string to validate.</param>
        /// <returns>True if the string can be parsed to a short integer; otherwise, false.</returns>
        public static bool IsValidShort(string input) {
            return short.TryParse(input, out _);
        }
    }
}
