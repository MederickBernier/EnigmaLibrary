<?php   

namespace EnigmaLibrary\DateTime;

class DateTimeUtils{
    /**
     * Formats a given DateTime object into a string
     * 
     * @param \DateTime $date The DateTime object to format.
     * @param string $format The format to use (default: Y-m-d H:i:s).
     * @return string The formatted date string.
     */
    public static function formatDate(\DateTime $date, string $format = 'Y-m-d H:i:s'):string{
        return $date->format($format);
    }

    /**
     * Calculates the difference between two dates.
     * 
     * @param \DateTime $date1 The first date.
     * @param \DateTime $date2 The second date.
     * @param string $unit The unit of time to return ('years','month','days').
     * @return int The difference between the two dates in the specified unit.
     */

     public static function dateDifference(\DateTime $date1, \DateTime $date2, string $unit = 'days'):int{
        $diff = $date1->diff($date2);

        switch($unit){
            case'years':
                return $diff->y;
            case 'months':
                return $diff->m;
            case 'days':
            default:
                return $diff->days;
        }
     }

     /**
      * Calculates the age based on a given birth date
      *
      *@param \DateTime $birthDate The birth date.
      *@return int The calculated age.
      */
      public static function calculateAge(\DateTime $birthDate):int{
        $today = new \DateTime('today');
        return $birthDate->diff($today)->y;
      }
}