namespace EnigmaLibrary.Utils;
public static class ELPrimitiveValidation {
    public static bool IsValidInt(string input) {
        return int.TryParse(input, out _);
    }

    public static bool isValidDouble(string input) {
        return double.TryParse(input, out _);
    }

    public static bool IsValidFloat(string input) {
        return float.TryParse(input, out _);
    }

    public static bool IsValidLong(string input) {
        return long.TryParse(input, out _);
    }

    public static bool IsValidBool(string input) {
        return bool.TryParse(input, out _);
    }

    public static bool IsValidChar(string input) {
        return char.TryParse(input, out _);
    }

    public static bool isValidDecimal(string input) {
        return decimal.TryParse(input, out _);
    }

    public static bool IsValidDateTime(string input) {
        return DateTime.TryParse(input, out _);
    }

    public static bool IsValidByte(string input) {
        return byte.TryParse(input, out _);
    }

    public static bool IsValidShort(string input) {
        return short.TryParse(input, out _);
    }
}
