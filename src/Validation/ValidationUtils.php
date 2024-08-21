<?php

namespace EnigmaLibrary\Validation;

class ValidationUtils
{
    /**
     * Validates an email address.
     *
     * @param string $email The email address to validate.
     * @return bool True if the email is valid, false otherwise.
     */
    public static function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Validates a phone number (international format).
     *
     * @param string $phone The phone number to validate.
     * @return bool True if the phone number is valid, false otherwise.
     */
    public static function validatePhoneNumber(string $phone): bool
    {
        return preg_match('/^\+?[1-9]\d{1,14}$/', $phone);
    }

    /**
     * Validates a URL.
     *
     * @param string $url The URL to validate.
     * @return bool True if the URL is valid, false otherwise.
     */
    public static function validateURL(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Validates an IP address (both IPv4 and IPv6).
     *
     * @param string $ip The IP address to validate.
     * @return bool True if the IP address is valid, false otherwise.
     */
    public static function validateIP(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP) !== false;
    }

    /**
     * Validates if a string contains only alphabetic characters.
     *
     * @param string $string The string to validate.
     * @return bool True if the string contains only alphabetic characters, false otherwise.
     */
    public static function validateAlpha(string $string): bool
    {
        return ctype_alpha($string);
    }

    /**
     * Validates if a string contains only alphanumeric characters.
     *
     * @param string $string The string to validate.
     * @return bool True if the string contains only alphanumeric characters, false otherwise.
     */
    public static function validateAlphanumeric(string $string): bool
    {
        return ctype_alnum($string);
    }

    /**
     * Validates a date string against a specified format.
     *
     * @param string $date The date string to validate.
     * @param string $format The format to validate against (default is 'Y-m-d').
     * @return bool True if the date is valid, false otherwise.
     */
    public static function validateDate(string $date, string $format = 'Y-m-d'): bool
    {
        $dateTime = \DateTime::createFromFormat($format, $date);
        return $dateTime && $dateTime->format($format) === $date;
    }

    /**
     * Validates if a string is a valid JSON.
     *
     * @param string $json The JSON string to validate.
     * @return bool True if the string is valid JSON, false otherwise.
     */
    public static function validateJSON(string $json): bool
    {
        json_decode($json);
        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * Validates if a string meets a minimum length.
     *
     * @param string $string The string to validate.
     * @param int $minLength The minimum length the string should have.
     * @return bool True if the string meets the minimum length, false otherwise.
     */
    public static function validateMinLength(string $string, int $minLength): bool
    {
        return strlen($string) >= $minLength;
    }

    /**
     * Validates if a string does not exceed a maximum length.
     *
     * @param string $string The string to validate.
     * @param int $maxLength The maximum length the string should have.
     * @return bool True if the string does not exceed the maximum length, false otherwise.
     */
    public static function validateMaxLength(string $string, int $maxLength): bool
    {
        return strlen($string) <= $maxLength;
    }

    /**
     * Validates if a value is within a specified range.
     *
     * @param int $value The value to validate.
     * @param int $min The minimum acceptable value.
     * @param int $max The maximum acceptable value.
     * @return bool True if the value is within the range, false otherwise.
     */
    public static function validateRange(int $value, int $min, int $max): bool
    {
        return $value >= $min && $value <= $max;
    }

    /**
     * Validates a credit card number using the Luhn algorithm.
     * 
     * @param string $number The credit card number to validate.
     * @return bool True if the credit card number is valid, false otherwise.
     */
    public static function validateCreditCard(string $number): bool
    {
        $number = preg_replace('/\D/', '', $number);
        $checksum = 0;
        $length = strlen($number);
        for ($i = $length - 1; $i >= 0; $i -= 2) {
            $checksum += $number[$i];
        }
        for ($i = $length - 2; $i >= 0; $i -= 2) {
            $digit = $number[$i] * 2;
            $checksum += ($digit < 10) ? $digit : ($digit - 9);
        }
        return ($checksum % 10) === 0;
    }

    /**
     * Validates a postal code based on country-specific formats.
     * 
     * @param string $postalCode The postal code to validate.
     * @param string $countryCode The country code for the postal code format (default is 'US').
     * @return bool True if the postal code is valid, false otherwise.
     */
    public static function validatePostalCode(string $postalCode, string $countryCode = 'US'): bool
    {
        $patterns = [
            'US' => '/^\d{5}(-\d{4})?$/', // United States: 12345 or 12345-6789
            'CA' => '/^[A-Z]\d[A-Z] \d[A-Z]\d$/', // Canada: A1A 1A1
            'GB' => '/^([A-Z]{1,2}\d[A-Z\d]? ?\d[A-Z]{2}|GIR ?0AA)$/', // UK: SW1A 1AA or GIR 0AA
            'FR' => '/^\d{5}$/', // France: 75008
            'DE' => '/^\d{5}$/', // Germany: 12345
            'AU' => '/^\d{4}$/', // Australia: 1234
            'IT' => '/^\d{5}$/', // Italy: 12345
            'ES' => '/^\d{5}$/', // Spain: 12345
            'NL' => '/^\d{4} ?[A-Z]{2}$/', // Netherlands: 1234 AB
            'BR' => '/^\d{5}-\d{3}$/', // Brazil: 12345-678
            'RU' => '/^\d{6}$/', // Russia: 123456
            'IN' => '/^\d{6}$/', // India: 110001
            'JP' => '/^\d{3}-\d{4}$/', // Japan: 123-4567
            'CN' => '/^\d{6}$/', // China: 123456
            'CH' => '/^\d{4}$/', // Switzerland: 1234
            'SE' => '/^\d{3} ?\d{2}$/', // Sweden: 123 45
            'NO' => '/^\d{4}$/', // Norway: 1234
            'BE' => '/^\d{4}$/', // Belgium: 1234
            'AT' => '/^\d{4}$/', // Austria: 1234
            'DK' => '/^\d{4}$/', // Denmark: 1234
            'FI' => '/^\d{5}$/', // Finland: 12345
            'IE' => '/^[A-Z]\d{2} ?[A-Z\d]{4}$/', // Ireland: A65 F4E2
            'PT' => '/^\d{4}-\d{3}$/', // Portugal: 1234-567
            'GR' => '/^\d{3} ?\d{2}$/', // Greece: 123 45
            'NZ' => '/^\d{4}$/', // New Zealand: 1234
            'ZA' => '/^\d{4}$/', // South Africa: 1234
            'MX' => '/^\d{5}$/', // Mexico: 12345
            'AR' => '/^([A-Z]\d{4}[A-Z]{3})|(\d{4})$/', // Argentina: A1234ABC or 1234
            'KR' => '/^\d{5}$/', // South Korea: 12345
            'PL' => '/^\d{2}-\d{3}$/', // Poland: 12-345
            'SG' => '/^\d{6}$/', // Singapore: 123456
            'HU' => '/^\d{4}$/', // Hungary: 1234
            'CZ' => '/^\d{3} ?\d{2}$/', // Czech Republic: 123 45
            'TR' => '/^\d{5}$/', // Turkey: 12345
            'IL' => '/^\d{5,7}$/', // Israel: 12345 or 1234567
            'AE' => '/^\d{5}$/', // UAE: 12345
            'MY' => '/^\d{5}$/', // Malaysia: 12345
        ];
        return isset($patterns[$countryCode]) ? preg_match($patterns[$countryCode], $postalCode) : false;
    }
}