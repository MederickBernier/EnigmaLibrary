using System.Globalization;

namespace EnigmaLibrary;
public static class LocalizationUtils {
    public static string Translate(string input, string targetLanguage) {
        Thread.CurrentThread.CurrentUICulture = new CultureInfo(targetLanguage);
        return input;
    }
}
