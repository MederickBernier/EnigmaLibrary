<?php

namespace EnigmaLibrary\DateTime;

class DateTimeUtils
{
    /**
     * Formats a given DateTime object into a string.
     * 
     * @param \DateTime $date The DateTime object to format.
     * @param string $format The format to use (default: Y-m-d H:i:s).
     * @return string The formatted date string.
     */
    public static function formatDate(\DateTime $date, string $format = 'Y-m-d H:i:s'): string
    {
        return $date->format($format);
    }

    /**
     * Calculates the difference between two dates.
     * 
     * @param \DateTime $date1 The first date.
     * @param \DateTime $date2 The second date.
     * @param string $unit The unit of time to return (years, months, days).
     * @return int The difference between the two dates in the specified unit.
     */
    public static function dateDifference(\DateTime $date1, \DateTime $date2, string $unit = 'days'): int
    {
        $diff = $date1->diff($date2);

        switch ($unit) {
            case 'years':
                return $diff->y;
            case 'months':
                return $diff->y * 12 + $diff->m; // Convertir les années en mois et ajouter les mois
            case 'days':
            default:
                return $diff->days;
        }
    }

    /**
     * Calculates the age based on a given birth date.
     *
     * @param \DateTime $birthDate The birth date.
     * @return int The calculated age.
     */
    public static function calculateAge(\DateTime $birthDate): int
    {
        $today = new \DateTime('today');
        return $birthDate->diff($today)->y;
    }

    /**
     * Checks if a given date falls on a weekend.
     * 
     * @param \DateTime $date The date to check.
     * @return bool True if the date is a weekend, false otherwise.
     */
    public static function isWeekend(\DateTime $date): bool
    {
        return in_array($date->format('N'), [6, 7]);
    }

    /**
     * Checks if a given year is a leap year.
     * 
     * @param int $year The year to check.
     * @return bool True if the year is a leap year, false otherwise.
     */
    public static function isLeapYear(int $year): bool
    {
        return ($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0);
    }

    /**
     * Adds a specified number of business days to a date.
     * 
     * @param \DateTime $date The starting date.
     * @param int $days The number of business days to add.
     * @return \DateTime The resulting date after adding the business days.
     */
    public static function addBusinessDays(\DateTime $date, int $days): \DateTime
    {
        $counter = 0;
        while ($counter < $days) {
            $date->modify('+1 day');
            if (!in_array($date->format('N'), [6, 7])) {
                $counter++;
            }
        }
        return $date;
    }

    /**
     * Returns the number of days in a given month.
     * 
     * @param int $year The year.
     * @param int $month The month (1-12).
     * @return int The number of days in the month.
     */
    public static function daysInMonth(int $year, int $month): int
    {
        return cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }

    /**
     * Returns the start and end dates of a given month.
     * 
     * @param int $year The year.
     * @param int $month The month (1-12).
     * @return array An array with two DateTime objects: start and end of the month.
     */
    public static function getStartAndEndOfMonth(int $year, int $month): array
    {
        $start = new \DateTime("{$year}-{$month}-01");
        $end = new \DateTime($start->format('Y-m-t'));
        return [$start, $end];
    }

    /**
     * Checks if a given date is in the past.
     * 
     * @param \DateTime $date The date to check.
     * @return bool True if the date is in the past, false otherwise.
     */
    public static function isPastDate(\DateTime $date): bool
    {
        $today = new \DateTime();
        return $date < $today;
    }

    /**
     * Converts a DateTime object to a specific timezone.
     * 
     * @param \DateTime $date The DateTime object to convert.
     * @param string $timezone The target timezone.
     * @return \DateTime The DateTime object adjusted to the new timezone.
     */
    public static function convertToTimezone(\DateTime $date, string $timezone): \DateTime
    {
        return $date->setTimezone(new \DateTimeZone($timezone));
    }

    /**
     * Returns the week number for a given date.
     * 
     * @param \DateTime $date The date to check.
     * @return int The week number (1-52).
     */
    public static function getWeekNumber(\DateTime $date): int
    {
        return (int) $date->format('W');
    }

    /**
     * Returns the quarter of the year for a given date.
     * 
     * @param \DateTime $date The date to check.
     * @return int The quarter (1-4).
     */
    public static function getQuarter(\DateTime $date): int
    {
        $month = (int) $date->format('m');
        return ceil($month / 3);
    }

    /**
     * Returns the day of the year for a given date.
     * 
     * @param \DateTime $date The date to check.
     * @return int The day of the year (1-366).
     */
    public static function getDayOfYear(\DateTime $date): int
    {
        return (int) $date->format('z') + 1;
    }

    /**
     * Adds a specified number of months to a date.
     * 
     * @param \DateTime $date The starting date.
     * @param int $months The number of months to add.
     * @return \DateTime The resulting date after adding the months.
     */
    public static function addMonths(\DateTime $date, int $months): \DateTime
    {
        return $date->modify("+{$months} months");
    }

    /**
     * Subtracts a specified number of months from a date.
     * 
     * @param \DateTime $date The starting date.
     * @param int $months The number of months to subtract.
     * @return \DateTime The resulting date after subtracting the months.
     */
    public static function subtractMonths(\DateTime $date, int $months): \DateTime
    {
        return $date->modify("-{$months} months");
    }

    /**
     * Returns the start of the day (00:00:00) for a given date.
     * 
     * @param \DateTime $date The date to modify.
     * @return \DateTime The start of the day.
     */
    public static function getStartOfDay(\DateTime $date): \DateTime
    {
        return $date->setTime(0, 0, 0);
    }

    /**
     * Returns the end of the day (23:59:59) for a given date.
     * 
     * @param \DateTime $date The date to modify.
     * @return \DateTime The end of the day.
     */
    public static function getEndOfDay(\DateTime $date): \DateTime
    {
        return $date->setTime(23, 59, 59);
    }

    /**
     * Validates if a string is a valid date.
     * 
     * @param string $date The date string to validate.
     * @param string $format The format to validate against (default is 'Y-m-d').
     * @return bool True if the date is valid, false otherwise.
     */
    public static function isValidDate(string $date, string $format = 'Y-m-d'): bool
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    /**
     * Returns the number of days in a given year.
     * 
     * @param int $year The year to check.
     * @return int The number of days in the year.
     */
    public static function getDaysInYear(int $year): int
    {
        return (new \DateTime("{$year}-12-31"))->format('z') + 1;
    }

    /**
     * Calculates the time difference in minutes between two dates.
     * 
     * @param \DateTime $date1 The first date.
     * @param \DateTime $date2 The second date.
     * @return int The difference in minutes.
     */
    public static function getTimeDifferenceInMinutes(\DateTime $date1, \DateTime $date2): int
    {
        $interval = $date1->diff($date2);
        return ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;
    }
}