namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing methods for password strength validation.
    /// </summary>
    public static class ELPassword {
        /// <summary>
        /// Checks if a password is strong based on specified criteria.
        /// </summary>
        /// <param name="password">The password string to validate.</param>
        /// <returns>True if the password is strong; otherwise, false.</returns>
        public static bool IsStrongPassword(string password) {
            // Return false if the password is null, empty, or consists only of white-space characters
            if (string.IsNullOrWhiteSpace(password)) return false;

            // Check if the password contains at least one uppercase letter
            bool hasUpperCase = password.Any(char.IsUpper);

            // Check if the password contains at least one lowercase letter
            bool hasLowerCase = password.Any(char.IsLower);

            // Check if the password contains at least one numeric digit
            bool hasNumbers = password.Any(char.IsDigit);

            // Check if the password contains at least one special character (non-alphanumeric)
            bool hasSpecialChar = password.Any(ch => !char.IsLetterOrDigit(ch));

            // Return true if the password meets all the criteria: length >= 8, and contains upper case, lower case, numbers, and special characters
            return password.Length >= 8 && hasUpperCase && hasLowerCase && hasNumbers && hasSpecialChar;
        }
    }
}
