namespace EnigmaLibrary.Utils;
public static class ELCurrency {
    public static string FormatCurrency(decimal amount, string culture) {
        return string.Format(new System.Globalization.CultureInfo(culture), "{0:C}", amount);
    }
}
