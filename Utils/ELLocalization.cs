using System.Globalization;

namespace EnigmaLibrary.Utils;
public static class ELLocalization {
    public static string Translate(string input, string targetLanguage) {
        Thread.CurrentThread.CurrentUICulture = new CultureInfo(targetLanguage);
        return input;
    }
}
