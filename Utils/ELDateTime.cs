namespace EnigmaLibrary.Utils;
public static class ELDateTime {
    public static string GetCurrentUtcTime() {
        return DateTime.Now.ToString("yyyy-MM-dd HH:mm:ss");
    }

    public static string FormatDate(DateTime date, string format) {
        return date.ToString(format);
    }

    public static int CalculateAge(DateTime birthDate) {
        int age = DateTime.Today.Year - birthDate.Year;
        if (birthDate.Date > DateTime.Today.AddYears(-age)) age--;
        return age;
    }

    public static bool IsWeekend(DateTime date) {
        return date.DayOfWeek == DayOfWeek.Saturday || date.DayOfWeek == DayOfWeek.Sunday;
    }

    public static bool IsLeapYear(int year) {
        return DateTime.IsLeapYear(year);
    }
}
