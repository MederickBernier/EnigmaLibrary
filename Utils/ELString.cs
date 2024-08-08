namespace EnigmaLibrary.Utils;
public static class ELString {
    public static string ToTitleCase(string input) {
        if (string.IsNullOrWhiteSpace(input)) return string.Empty;
        return System.Globalization.CultureInfo.CurrentCulture.TextInfo.ToTitleCase(input);
    }

    public static string ReverseString(string input) {
        if (string.IsNullOrWhiteSpace(input)) return string.Empty;
        char[] charArray = input.ToCharArray();
        Array.Reverse(charArray);
        return new string(charArray);
    }

    public static bool IsPalindrome(string input) {
        if (string.IsNullOrWhiteSpace(input)) return false;
        string reversed = ReverseString(input);
        return input.Equals(reversed, StringComparison.OrdinalIgnoreCase);
    }

    public static string RemoveSpecialCharacters(string input) {
        if (string.IsNullOrWhiteSpace(input)) return string.Empty;
        return new string(input.Where(c => char.IsLetterOrDigit(c) || char.IsWhiteSpace(c)).ToArray());
    }

    public static bool ContainsOnlyLetters(string input) {
        return input.All(char.IsLetter);
    }

    public static bool ContainsOnlyDigits(string input) {
        return input.All(char.IsDigit);
    }

    public static bool ContainsOnlyLettersAndDigits(string input) {
        return input.All(char.IsLetterOrDigit);
    }
}
