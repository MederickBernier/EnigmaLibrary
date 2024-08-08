using System.Text.RegularExpressions;

namespace EnigmaLibrary.Utils;
public static class ELValidation {
    public static bool IsValidEmail(string email) {
        if (string.IsNullOrWhiteSpace(email)) return false;
        var emailRegex = new Regex(@"^[^@\s]+@[^@\s]+\.[^@\s]+$");
        return emailRegex.IsMatch(email);
    }

    public static bool IsValidUrl(string url) {
        if (string.IsNullOrWhiteSpace(url)) return false;
        var urlRegex = new Regex(@"^https?:\/\/[^\s/$.?#].[^\s]*$");
        return urlRegex.IsMatch(url);
    }

    public static bool IsNumeric(string input) {
        return double.TryParse(input, out _);
    }

    public static bool IsValidPhoneNumber(string phoneNumber) {
        var phoneRegex = new Regex(@"^\+?[1-9]\d{1,14}$");
        return phoneRegex.IsMatch(phoneNumber);
    }

    public static bool IsValidPostalCode(string postalCode) {
        var postalCodeRegex = new Regex(@"^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$");
        return postalCodeRegex.IsMatch(postalCode);
    }
}
