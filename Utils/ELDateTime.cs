namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing various methods for working with dates and times.
    /// </summary>
    public static class ELDateTime {
        /// <summary>
        /// Gets the current UTC time formatted as a string in the "yyyy-MM-dd HH:mm:ss" format.
        /// </summary>
        /// <returns>A string representing the current UTC time.</returns>
        public static string GetCurrentUtcTime() {
            // Return the current UTC time as a formatted string
            return DateTime.UtcNow.ToString("yyyy-MM-dd HH:mm:ss");
        }

        /// <summary>
        /// Formats a DateTime object according to the specified format string.
        /// </summary>
        /// <param name="date">The DateTime object to format.</param>
        /// <param name="format">The format string to apply to the DateTime object.</param>
        /// <returns>A string representing the formatted date and time.</returns>
        public static string FormatDate(DateTime date, string format) {
            // Format the DateTime object according to the specified format and return the result
            return date.ToString(format);
        }

        /// <summary>
        /// Calculates the age in years based on a given birth date.
        /// </summary>
        /// <param name="birthDate">The birth date to calculate the age from.</param>
        /// <returns>An integer representing the calculated age.</returns>
        public static int CalculateAge(DateTime birthDate) {
            // Calculate the age based on the current date and the provided birth date
            int age = DateTime.Today.Year - birthDate.Year;

            // Adjust the age if the birth date has not occurred yet this year
            if (birthDate.Date > DateTime.Today.AddYears(-age))
                age--;

            // Return the calculated age
            return age;
        }

        /// <summary>
        /// Checks if a given date falls on a weekend (Saturday or Sunday).
        /// </summary>
        /// <param name="date">The date to check.</param>
        /// <returns>True if the date is a Saturday or Sunday; otherwise, false.</returns>
        public static bool IsWeekend(DateTime date) {
            // Check if the date is Saturday or Sunday and return the result
            return date.DayOfWeek == DayOfWeek.Saturday || date.DayOfWeek == DayOfWeek.Sunday;
        }

        /// <summary>
        /// Determines if a given year is a leap year.
        /// </summary>
        /// <param name="year">The year to check.</param>
        /// <returns>True if the year is a leap year; otherwise, false.</returns>
        public static bool IsLeapYear(int year) {
            // Use the built-in method to check if the year is a leap year and return the result
            return DateTime.IsLeapYear(year);
        }
    }
}
