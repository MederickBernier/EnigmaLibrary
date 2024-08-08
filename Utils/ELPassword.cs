namespace EnigmaLibrary.Utils;
public static class ELPassword {
    public static bool IsStrongPassword(string password) {
        if (string.IsNullOrWhiteSpace(password)) return false;

        bool hasUpperCase = password.Any(char.IsUpper);
        bool hasLowerCase = password.Any(char.IsLower);
        bool hasNumbers = password.Any(char.IsDigit);
        bool hasSpecialChar = password.Any(ch => !char.IsLetterOrDigit(ch));

        return password.Length >= 8 && hasUpperCase && hasLowerCase && hasNumbers && hasSpecialChar;
    }
}
