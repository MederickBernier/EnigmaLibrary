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
     * @param string $unit The unit of time to return ('years', 'months', 'days').
     * @return int The difference between the two dates in the specified unit.
     */
    public static function dateDifference(\DateTime $date1, \DateTime $date2, string $unit = 'days'): int
    {
        $diff = $date1->diff($date2);

        switch ($unit) {
            case 'years':
                return $diff->y;
            case 'months':
                return $diff->m;
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
}